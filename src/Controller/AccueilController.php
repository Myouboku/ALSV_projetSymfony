<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Login;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\VarDumper\VarDumper;

class AccueilController extends AbstractController {

    /**
     * @Route("Accueil", name="accueil", methods={"POST", "GET"})
     */

    // function login(ManagerRegistry $doctrine) {
    //     return $this->render('accueil.html.twig');
    // }

    function loginAction(Request $request, ManagerRegistry $doctrine) {
        $form = $this->createForm(Login::class);
        $form->handleRequest($request);

        $username = isset($_POST['login'])?$_POST['login']:'';
        $password = isset($_POST['password'])?$_POST['password']:'';
        if ($username == 'admin' && $password == 'admin') {
            $this->addFlash('success', 'Bienvenue');
            return $this->redirectToRoute('Entreprise');
        } else {
            $this->addFlash('error', "Nom d'Utilisateur ou mot de passe incorrect");
        }

        return $this->render('accueil.html.twig', [
                    'form' => $form->createView()
        ]);
    }
}