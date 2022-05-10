<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

class ModificationController extends AbstractController
{

    /**
     * @Route("Modification", name="modification", methods={"POST", "GET"})
     */

    function modificationAction(Request $request, ManagerRegistry $doctrine)
    {
        
        try {
            //récupération des données de l'entreprise
            $Id = intval($_GET['SelectedEnt']);                                
            $stmt = $doctrine->getConnection()->prepare('CALL PS_Recuperation_EntrepriseId(:IdEntreprise)'); //PS_Recuperation_EntrepriseId
            $stmt->bindValue(':IdEntreprise', $Id); //bindValue pour une valeur
            $result = $stmt->execute(); //execution de la requete
            $stmtOpt = $doctrine->getConnection()->prepare('SELECT id, opt_libelle from entreprise_option');
            $resultOpt = $stmtOpt->execute();
            
            return $this->render('modifEntreprise.html.twig',[ 'entreprise' => $result->fetchAll(), 'opt' => $resultOpt->fetchAll()] ); //affichage de la page de modification

        }
        catch (Exception $e) {
            try {
                //récupération des données de l'utilisateur
                $Id = $request->request->get('Id');
                $stmt = $doctrine->getConnection()->prepare('CALL PS_Recuperation_UtilisateurId(:IdUtilisateur)'); //PS_Recuperation_UtilisateurId
                $stmt->bindValue(':IdUtilisateur', $Id); //bindValue pour une valeur
                $result = $stmt->execute();  //execution de la requete
                return $this->render('modifUtilisateur.html.twig',[ 'utilisateur' => $result->fetchAll()] ); //affichage de la page de modification

            }
            catch (Exception $e) {
                
                //récupération des données du tuteur
                $Id = $request->request->get('Id');
                $stmt = $doctrine->getConnection()->prepare('CALL PS_Recuperation_TuteurId(:IdTuteur)'); //PS_Recuperation_TuteurId
                $stmt->bindValue(':IdTuteur', $Id); //bindValue pour une valeur
                $result = $stmt->execute();   //execution de la requete
                return $this->render('modifTuteur.html.twig',[ 'tuteur' => $result->fetchAll()] ); //affichage de la page de modification

            }
        }   
    }
}
