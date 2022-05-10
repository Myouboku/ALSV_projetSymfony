<?php

namespace App\Controller;


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
  public function backoffice(ManagerRegistry $doctrine)
  {
    // NOTE si la variable connexion est à false, on redirige vers la page d'accueil
    if (!$this->get('session')->get('connected')) {
      return $this->redirectToRoute('accueil');
    }

    $stmt = $doctrine->getConnection()->prepare('SELECT entreprise.id as ent_id, ent_rs,ent_adresse,ent_cp,ent_ville,ent_pays, IFNULL(opt_libelle, "-") as Opt_Libelle from entreprise LEFT join entreprise_option on entreprise.opt_id = entreprise_option.id;');
    $ListeUser = $doctrine->getConnection()->prepare('SELECT utilisateur.id as uti_id, uti_username,uti_role from utilisateur');
    $ListeProfil = $doctrine->getConnection()->prepare('SELECT personne.id as per_id,per_nom, per_prenom, IFNULL(Concat(0,per_tel), "-") as per_tel, per_mail FROM personne');
    $result = $stmt->execute();
    $resultProfil = $ListeProfil->execute();
    $resultUser = $ListeUser->execute();

    if($_POST) {
      if($_POST['deconnectButton']){
        $this->get('session')->set('connected', false);
        return $this->redirectToRoute('accueil');
      }
    }

    return $this->render('backoffice.html.twig', ['entreprise' => $result->fetchAll(), 'user' => $resultUser->fetchAll(), 'personne' => $resultProfil->fetchAll()]);
    require_once('AccueilController.php');
  }
}
