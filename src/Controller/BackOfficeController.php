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
    $stmt = $doctrine->getConnection()->prepare('SELECT ent_rs,ent_adresse,ent_cp,ent_ville,ent_pays from entreprise');
    $ListeUser = $doctrine->getConnection()->prepare('SELECT uti_username from utilisateur');
    $ListeProfil = $doctrine->getConnection()->prepare('SELECT per_nom, per_prenom, per_tel, per_mail FROM personne');
    $result = $stmt->execute();
    $resultProfil = $ListeProfil->execute();
    $resultUser = $ListeUser->execute();
    return $this->render('backoffice.html.twig',[ 'entreprise' => $result->fetchAll() , 'user' => $resultUser->fetchAll(), 'personne' => $resultProfil->fetchAll()] );
  }
}
?>