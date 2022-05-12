<?php

namespace App\Controller;

use Doctrine\Common\Collections\Expr\Value;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;


class BackOfficeController extends AbstractController
{
  /**
   * @Route("BackOffice", name="backoffice")
   */
    public function backoffice(ManagerRegistry $doctrine) {
      // NOTE si la variable connexion est à false, on redirige vers la page d'accueil
      if (!$this->get('session')->get('connected')) {
        return $this->redirectToRoute('accueil');
      }

      // SECTION Suppression
      if (isset($_POST['deleteEntr'])) {
        $stmt = $doctrine->getConnection()->prepare('CALL PS_D_Entreprise(:IdEntreprise);');
        $stmt->bindValue('IdEntreprise', intval($_POST['deleteEntr']));
        $stmt->execute();
        $stmt = null;
      }

      // NOTE suppression d'un tuteur
      if(isset($_POST['deleteTut'])) {
        $stmt = $doctrine->getConnection()->prepare('CALL PS_D_Tuteur(:IdTuteur);');
        $stmt->bindValue('IdTuteur', intval($_POST['deleteTut']));
        $stmt->execute();
        $stmt = null;
      }
      // !SECTION Suppression
       
      // NOTE insertion entreprise
      if (isset($_POST['raisonSociale'])) {
        $stmt = $doctrine->getConnection()->prepare('CALL PS_I_Entreprise(:RaisonSociale,:Adresse,:CodePostal,:Pays,:Ville,:Option_id,:Personne);');
        $stmt->bindValue('RaisonSociale', $_POST['raisonSociale']);
        $stmt->bindValue('Adresse', $_POST['adresse']);
        $stmt->bindValue('CodePostal', $_POST['codePostal']);
        $stmt->bindValue('Ville', $_POST['ville']);
        $stmt->bindValue('Pays', $_POST['pays']);
        $stmt->bindValue('Option_id', intval($_POST['acceptedOption']));
        $stmt->bindValue('Personne', intval($_POST['tutor']));
        $stmt->execute();
        $stmt = null;
      }

      // NOTE modification entreprise
      if (isset($_POST['modif_rs'])) {        
        $stmt = $doctrine->getConnection()->prepare('CALL PS_E_Entreprise(:IdEntr, :RaisonSociale,:Adresse,:CodePostal,:Pays,:Ville,:Option_id,:Personne);');
        $stmt->bindValue('IdEntr', intval($_POST['idEntr']));
        $stmt->bindValue('RaisonSociale', $_POST['modif_rs']);
        $stmt->bindValue('Adresse', $_POST['modif_adresse']);
        $stmt->bindValue('CodePostal', $_POST['modif_cp']);
        $stmt->bindValue('Ville', $_POST['modif_ville']);
        $stmt->bindValue('Pays', $_POST['modif_pays']);
        $stmt->bindValue('Option_id', intval($_POST['modif_option']));
        $stmt->bindValue('Personne', intval($_POST['modif_tuteur']));
        $stmt->execute();
        $stmt = null;
      }

      // NOTE insertion tuteur
      if (isset($_POST['lastName'])) {
        $stmt = $doctrine->getConnection()->prepare('CALL PS_I_Tuteur(:Mail,:Nom,:Prenom,:Telephone);');
        $stmt->bindValue('Nom', $_POST['lastName']);
        $stmt->bindValue('Prenom', $_POST['firstName']);
        $stmt->bindValue('Mail', $_POST['email']);
        $stmt->bindValue('Telephone', $_POST['phone']);
        $stmt->execute();
        $stmt = null;
      }      
      
      // NOTE insertion utilisateur
      if (isset($_POST['username'])){
        $stmt = $doctrine->getConnection()->prepare('CALL PS_I_Utilisateur(:Username,:Password,:role);');
        $stmt->bindValue('Username', $_POST['username']);
        $stmt->bindValue('Password', $_POST['password']);
        $stmt->bindValue('role', substr($_POST['role'], 0, 1));
        $stmt->execute();
        $stmt = null;
      }

      // NOTE edit tuteur
      if (isset($_POST['prenom'])) {
        $stmt = $doctrine->getConnection()->prepare('CALL PS_E_Tuteur(:idTut, :nom, :prenom, :email, :tel, :annee, :profil, :fonction);');
        $stmt->bindValue('idTut', $_POST['idTut']);
        $stmt->bindValue('nom', $_POST['nom']);
        $stmt->bindValue('prenom', $_POST['prenom']);
        $stmt->bindValue('email', $_POST['email']);
        $stmt->bindValue('tel', $_POST['tel']);
        $stmt->bindValue('annee', $_POST['annee']);
        $stmt->bindValue('profil', intval($_POST['profil']));
        $stmt->bindValue('fonction', intval($_POST['fonction']));
        $stmt->execute();
        $stmt = null;
      }
   
      $stmt = $doctrine->getConnection()->prepare('SELECT entreprise.id as ent_id, ent_rs, CONCAT(per_nom, " ", per_prenom)  as per_nom, ent_adresse,ent_cp,ent_ville,ent_pays, IFNULL(opt_libelle, "-") as Opt_Libelle from entreprise LEFT join entreprise_option on entreprise.opt_id = entreprise_option.id LEFT JOIN personne on entreprise.personne_id = personne.id Order by entreprise.id;');
      $ListeUser = $doctrine->getConnection()->prepare('SELECT utilisateur.id as uti_id, uti_username,uti_role from utilisateur');
      $ListeOption = $doctrine->getConnection()->prepare('SELECT opt_libelle, id from entreprise_option');
      $ListeProfil = $doctrine->getConnection()->prepare('SELECT personne.id as per_id,per_nom, per_prenom, IFNULL(Concat(0,per_tel), "-") as per_tel, per_mail FROM personne');
      $result = $stmt->execute();
      //$resultEntreprise = $ListEntreprise->execute();
      $resultProfil = $ListeProfil->execute();
      $resultUser = $ListeUser->execute();
      $resultOption = $ListeOption->execute();       
      
      if(isset($_POST['deconnectButton'])){
        $this->get('session')->set('connected', false);
        return $this->redirectToRoute('accueil');
      }    
      require_once('AccueilController.php');
      return $this->render('backoffice.html.twig',[ 'entreprise' => $result->fetchAll(), 'user' => $resultUser->fetchAll(),'option' => $resultOption->fetchAll(),  'personne' => $resultProfil->fetchAll()] );
    }
  }
?>
