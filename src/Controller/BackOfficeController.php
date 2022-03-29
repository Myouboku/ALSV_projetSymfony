<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class BackOfficeController extends AbstractController {
  /**
   * @Route("BackOffice", name="backoffice")
   */
  function backoffice() {
    return $this->render('backoffice.html.twig');
  }
}
?>