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
     * @Route("Acceuil", name="accueil")
     */

    function login(ManagerRegistry $doctrine) {
        $entityManager = $doctrine->getManager();
        $login = $entityManager->getRepository(Annonce::class)->findAll();
        return $this->render('accueil.html.twig',['listeannonces'=>$login]);
    }
}