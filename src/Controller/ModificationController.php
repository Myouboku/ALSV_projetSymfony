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
            $Id = $request->request->get('Id');
            $stmt = $doctrine->getConnection()->prepare('CALL PS_Recuperation_EntrepriseId(:IdEntreprise);');
            $stmt->bindValue(':IdEntreprise', $Id);
            $result = $stmt->execute();   
        }
        catch (Exception $e) {
            try {
                $Id = $request->request->get('Id');
                $stmt = $doctrine->getConnection()->prepare('CALL PS_Recuperation_UtilisateurId(:IdUtilisateur);');
                $stmt->bindValue(':IdUtilisateur', $Id);
                $result = $stmt->execute();
            }
            catch (Exception $e) {
                $Id = $request->request->get('Id');
                $stmt = $doctrine->getConnection()->prepare('CALL PS_Recuperation_TuteurId(:IdTuteur);');
                $stmt->bindValue(':IdTuteur', $Id);
                $result = $stmt->execute();  
            }
        }   
    }
}
