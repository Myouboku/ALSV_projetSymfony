<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginForm;
use Symfony\Component\HttpFoundation\Response;

class AccueilController extends AbstractController {

    /**
     * @Route("Accueil", name="accueil")
     */

    function login(ManagerRegistry $doctrine) {
        return $this->render('accueil.html.twig');
    }
}