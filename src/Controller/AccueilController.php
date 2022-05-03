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
        $form = $this->createForm(Login::class);
        $form->handleRequest($request);

        $username = isset($_POST['login']) ? $_POST['login'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // SECTION PS de verif login/mdp
        $stmt = $doctrine->getConnection()->prepare("call PS_Verification_Login(:username, :password)");
        $stmt->bindValue('username', $username);
        $stmt->bindValue('password', $password);
        $result = $stmt->execute();
        // !SECTION

        $datas = $result->fetchAll();

        if ($datas != null) {
            if ($datas[0]['UTI_ROLE'] === "A")
                return $this->redirectToRoute('backoffice');
            else
                return $this->redirectToRoute('Entreprise');
        }

        return $this->render('accueil.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
