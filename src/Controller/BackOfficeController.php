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
  function backoffice() {
    return $this->render('backoffice.html.twig');
  }

  public function recherche_entreprise(ManagerRegistry $doctrine)
  {
    $recherche = isset($_POST['text_recherche']) ? $_POST['text_recherche'] : '';
    $type_recherche = $_POST['search-type'];
    
    switch($type_recherche) 
    {
      case "raisonSociale":
        $stmt = $doctrine->getConnection()->prepare('SELECT * FROM entreprise');
        $result = $stmt->execute();
        return $this->render('entreprise.html.twig',[ 'entreprise' => $result->fetchAll()] );
        break;
    }
  }
}
?>