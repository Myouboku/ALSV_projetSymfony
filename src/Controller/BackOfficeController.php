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

      if (isset($_POST['deleteEntr'])) {
        $stmt = $doctrine->getConnection()->prepare('CALL PS_D_Entreprise(:IdEntreprise);');
        $stmt->bindValue('IdEntreprise', intval($_POST['deleteEntr']));
        $stmt->execute();
        $stmt = null;
      }

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


  
      $stmt = $doctrine->getConnection()->prepare('SELECT entreprise.id as ent_id, ent_rs,ent_adresse,ent_cp,ent_ville,ent_pays, IFNULL(opt_libelle, "-") as Opt_Libelle from entreprise LEFT join entreprise_option on entreprise.opt_id = entreprise_option.id Order by entreprise.id;');
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

      return $this->render('backoffice.html.twig',[ 'entreprise' => $result->fetchAll(), 'user' => $resultUser->fetchAll(),'option' => $resultOption->fetchAll(),  'personne' => $resultProfil->fetchAll()] );
      
      require_once('AccueilController.php');
    }
  }
?>
