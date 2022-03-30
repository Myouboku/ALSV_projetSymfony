<?php

namespace App\Controller;


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
    $stmt = $doctrine->getConnection()->prepare('SELECT * FROM entreprise');
    $ListeUser = $doctrine->getConnection()->prepare('SELECT uti_username from utilisateur');
    $ListeProfil = $doctrine->getConnection()->prepare('SELECT * FROM personne');
    $result = $stmt->execute();
    $resultProfil = $ListeProfil->execute();
    $resultUser = $ListeUser->execute();
    return $this->render('backoffice.html.twig',[ 'entreprise' => $result->fetchAll() , 'user' => $resultUser->fetchAll(), 'personne' => $resultProfil->fetchAll()] );
  }
}
?>