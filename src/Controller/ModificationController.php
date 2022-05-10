<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine;

class ModificationController extends AbstractController
{

    /**
     * @Route("Modification", name="modification", methods={"POST", "GET"})
     */

    function modificationAction(Request $request, ManagerRegistry $doctrine)
    {
        if ($_GET['SelectedEnt']) {
            $Id = intval($_GET['SelectedEnt']);
            
            //récupération des données de l'entreprise                                            
            $stmt = $doctrine->getConnection()->prepare('CALL PS_Recuperation_EntrepriseId(:IdEntreprise)'); //PS_Recuperation_EntrepriseId                
            $stmt->bindValue(':IdEntreprise', $Id);
            
            // récupération de la liste des options
            $stmtOpt = $doctrine->getConnection()->prepare('CALL PS_Recuperation_Option(:IdEntr)'); //PS_Recuperation_Option  
            $stmtOpt->bindValue(':IdEntr', $Id);

            // exécution et fetch de la requête de récupération des données de l'entreprise
            $result = $stmt->execute();            
            $result = $result->fetchAll();
            // close mysql connection
            $stmt = null;

            // exécution et fetch de la requête de récupération des options 
            $resultOpt = $stmtOpt->execute(); 
            $resultOpt = $resultOpt->fetchAll(); 
            $stmtOpt = null;  

            // affichage
            return $this->render('modifEntreprise.html.twig', ['entreprise' => $result, 'opt' => $resultOpt]); //affichage de la page de modification
        }
    }
}
