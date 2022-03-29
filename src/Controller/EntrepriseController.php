<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;


class EntrepriseController extends AbstractController
{

  /**
   * @Route("ListeEntreprise", name="Entreprise")
   */

  function entreprise(ManagerRegistry $doctrine)
  {
    return $this->render('entreprise.html.twig');
  }
}
