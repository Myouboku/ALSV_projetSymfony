<?php

namespace App\Controller;

use Doctrine\Common\Collections\Expr\Value;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;


class BackOfficeController extends AbstractController {
  /**
   * @Route("BackOffice", name="backoffice")
   */
    public function backoffice(ManagerRegistry $doctrine) {
    
      $stmt = $doctrine->getConnection()->prepare('SELECT entreprise.id as ent_id, ent_rs,ent_adresse,ent_cp,ent_ville,ent_pays, IFNULL(opt_libelle, "-") as Opt_Libelle from entreprise LEFT join entreprise_option on entreprise.opt_id = entreprise_option.id;');
      $ListeUser = $doctrine->getConnection()->prepare('SELECT utilisateur.id as uti_id, uti_username,uti_role from utilisateur');
      $ListeProfil = $doctrine->getConnection()->prepare('SELECT personne.id as per_id,per_nom, per_prenom, IFNULL(Concat(0,per_tel), "-") as per_tel, per_mail FROM personne');
      $result = $stmt->execute();
      //$resultEntreprise = $ListEntreprise->execute();
      $resultProfil = $ListeProfil->execute();
      $resultUser = $ListeUser->execute();
      if(isset($_POST['SelectedEnt'])) { 
        $Id = isset($_POST['SelectedEnt']) ? $_POST['SelectedEnt'] : 0;
        $DeleteEnt = $doctrine->getConnection()->prepare('CALL PS_D_Utilisateur(:Id) ');
        $DeleteEnt -> bindValue('Id', $Id); 
        // suppression de l'utilisateur en fonction de l'id
        $DeleteEnt->execute();
      }       
      
      if (isset($_POST['deleteEntr'])) {
        $stmt = $doctrine->getConnection()->prepare('CALL PS_D_Entreprise(:IdEntreprise);');
        $stmt->bindValue('IdEntreprise', intval($_POST['deleteEntr']));
        $stmt->execute();
        $stmt = null;
      }      

      return $this->render('backoffice.html.twig',[ 'entreprise' => $result->fetchAll(), 'user' => $resultUser->fetchAll(), 'personne' => $resultProfil->fetchAll()] );
      
      require_once('AccueilController.php');
      if ( $datas != null) {
        if ($datas[0]['UTI_ROLE'] === "A") {
          return $this->redirectToRoute('Creation');
        }
        else {
          return $this->redirectToRoute('Entreprise');
        }
      }
    }
  }
?>