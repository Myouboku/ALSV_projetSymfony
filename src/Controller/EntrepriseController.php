<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginForm;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;


class EntrepriseController extends AbstractController {
  /**
   * @Route("ListeEntreprise", name="Entreprise")
   */
  public function entreprise(ManagerRegistry $doctrine) 
  {
    // NOTE si la variable connexion est à false, on redirige vers la page d'accueil
    if (!$this->get('session')->get('connected')) {
      return $this->redirectToRoute('accueil');
    }

    

    $stmt = $doctrine->getConnection()->prepare('SELECT concat(per_prenom, " ", per_nom) as tuteur, ent_rs,ent_adresse,ent_cp,ent_ville,ent_pays, IFNULL(opt_libelle, "-") as Opt_Libelle from entreprise AS e LEFT join entreprise_option on e.opt_id = entreprise_option.id LEFT JOIN personne AS p ON e.personne_id = p.id;');
    $result = $stmt->execute();
    $stmt = null;

    $role = 'Professeur';
    $utilisateur = ''; 
    // séparer le nom et prénom de l'utilisateur
    $utilisateur = explode('.', $this->get('session')->get('username'));
    
      
    $prenom = ucfirst($utilisateur[0]); 
    $nom = ucfirst($utilisateur[1]);
    

    if(isset($_POST['deconnectButton'])){
      $this->get('session')->set('connected', false);
      return $this->redirectToRoute('accueil');
    }

    return $this->render('entreprise.html.twig',[ 'entreprise' => $result->fetchAll(), 'nom' => $nom, 'prenom' => $prenom] );
  }
}