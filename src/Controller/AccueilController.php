<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Login;

class AccueilController extends AbstractController
{

    /**
     * @Route("Accueil", name="accueil", methods={"POST", "GET"})
     */
    function loginAction(Request $request, ManagerRegistry $doctrine)
    {
        // NOTE initialisation et démarrage de la session
        $session = $request->getSession();
        $session->start();

        $form = $this->createForm(Login::class);
        $form->handleRequest($request);

        if($session->get('connected')) {
            // NOTE redirection de l'utilisateur vers sa page correspondante en fonction de son rôle
            if ($session->get('role') === "A")
                return $this->redirectToRoute('backoffice');
            elseif ($session->get('role') === "P")
                return $this->redirectToRoute('Entreprise');
            else
                return $this->redirectToRoute('error');
        }

        if ($form->isSubmitted()) {
            if(!$session->get('connected')) {
                $username = isset($_POST['login']) ? $_POST['login'] : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';

                // SECTION PS de verif login/mdp
                $stmt = $doctrine->getConnection()->prepare("call PS_Verification_Login(:username, :password)");
                $stmt->bindValue('username', $username);
                $stmt->bindValue('password', $password);
                $result = $stmt->execute();
                // !SECTION

                $datas = $result->fetchAll();

                if ($datas) {
                    $session->set('username', $datas[0]['uti_username']);
                    $session->set('role', $datas[0]['UTI_ROLE']);
                    $session->set('connected', true);
                }

                // NOTE redirection de l'utilisateur vers sa page correspondante en fonction de son rôle
                if ($session->get('role') === "A")
                    return $this->redirectToRoute('backoffice');
                elseif ($session->get('role') === "P")
                    return $this->redirectToRoute('Entreprise');
                else
                    return $this->redirectToRoute('error');
            }
        }
        return $this->render('accueil.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
