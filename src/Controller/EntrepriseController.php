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
    $stmt = $doctrine->getConnection()->prepare('SELECT ent_rs,ent_adresse,ent_cp,ent_ville,ent_pays FROM entreprise');
    $result = $stmt->execute();
    return $this->render('entreprise.html.twig',[ 'entreprise' => $result->fetchAll()] );
  }
}