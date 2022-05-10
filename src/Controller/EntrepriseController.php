<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginForm;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;


class EntrepriseController extends AbstractController {
  /**
   * @Route("ListeEntreprise", name="Entreprise")
   */
  public function entreprise(ManagerRegistry $doctrine) 
  {
    // NOTE si la variable connexion est à false, on redirige vers la page d'accueil
    if (!$this->get('session')->get('connected')) {
      return $this->redirectToRoute('accueil');
    }

    $stmt = $doctrine->getConnection()->prepare('SELECT ent_rs,ent_adresse,ent_cp,ent_ville,ent_pays, IFNULL(opt_libelle, "Pas Option") as Opt_Libelle from entreprise LEFT join entreprise_option on entreprise.opt_id = entreprise_option.id;');
    $result = $stmt->execute();

    if(isset($_POST['deconnectButton'])){
      $this->get('session')->set('connected', false);
      return $this->redirectToRoute('accueil');
    }

    return $this->render('entreprise.html.twig',[ 'entreprise' => $result->fetchAll()] );
  }
}
