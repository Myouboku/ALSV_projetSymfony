<?php

namespace App\Controller;

use App\Entity\Profil;
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
        // SECTION Entreprises
        if (isset($_GET['SelectedEnt'])) {
            $Id = intval($_GET['SelectedEnt']);

            // récupération des données de l'entreprise                                            
            $stmt = $doctrine->getConnection()->prepare('CALL PS_Recuperation_EntrepriseId(:IdEntreprise)'); //PS_Recuperation_EntrepriseId                
            $stmt->bindValue(':IdEntreprise', $Id);

            // récupération de la liste des options
            $stmtOpt = $doctrine->getConnection()->prepare('CALL PS_Recuperation_Option(:IdEntr)'); //PS_Recuperation_Option  
            $stmtOpt->bindValue(':IdEntr', $Id);

            // récupération de la liste des tuteurs
            $stmtPer = $doctrine->getConnection()->prepare('CALL PS_Recuperation_Tuteur_Entreprise(:IdEntr)'); //PS_Recuperation_Tuteur  
            $stmtPer->bindValue(':IdEntr', $Id);

            // exécution et fetch de la requête de récupération des données de l'entreprise
            $result = $stmt->execute();
            $result = $result->fetchAll();
            $stmt = null;
            // close mysql connection

            // exécution et fetch de la requête de récupération des options 
            $resultOpt = $stmtOpt->execute();
            $resultOpt = $resultOpt->fetchAll();
            $stmtOpt = null;

            // exécution et fetch de la requête de récupération des tuteurs 
            $resultPer = $stmtPer->execute();
            $resultPer = $resultPer->fetchAll();
            $stmtPer = null;

            // affichage
            return $this->render('modifEntreprise.html.twig', ['entreprise' => $result, 'personne' => $resultPer, 'opt' => $resultOpt]); //affichage de la page de modification
        }
        // !SECTION

        // SECTION Tuteurs
        if (isset($_GET['SelectedPer'])) {
            $Id = intval($_GET['SelectedPer']);

            // récupération des données des tuteurs
            $stmt = $doctrine->getConnection()->prepare('CALL PS_Recuperation_TuteurId(:IdTuteur)'); // PS_Recuperation_TuteurId
            $stmt->bindValue(':IdTuteur', $Id);

            // récupération de la liste des profils sauf celui du tuteur selectionné
            $stmt1 = $doctrine->getConnection()->prepare('CALL PS_Recuperation_Profil(:IdTuteur)'); // PS_Recuperation_Profil
            $stmt1->bindValue(':IdTuteur', $Id);

            // récupération de la liste des fonctions sauf celui du tuteur selectionné
            $stmt2 = $doctrine->getConnection()->prepare('CALL PS_Recuperation_Fonction(:IdTuteur)'); // PS_Recup_Fonction
            $stmt2->bindValue(':IdTuteur', $Id);

            // exécution et fetch de la requête de récupération des données de l'entreprise
            $result = $stmt->execute();
            $result = $result->fetchAll();
            // close mysql connection
            $stmt = null;

            // exécution et fetch de la requête de récupération des profils 
            $resultProfils = $stmt1->execute();
            $resultProfils = $resultProfils->fetchAll();
            $stmt1 = null;

            // exécution et fetch de la requête de récupération des fonctions
            $resultFonctions = $stmt2->execute();
            $resultFonctions = $resultFonctions->fetchAll();
            $stmt2 = null;

            // affichage
            return $this->render('modifTuteur.html.twig', ['tuteur' => $result, 'profil' => $resultProfils, 'fonction' => $resultFonctions]); // affichage de la page de modification
        }
        // !SECTION

        // SECTION Utilisateurs
        if (isset($_GET['SelectedUser'])) {
            $Id = intval($_GET['SelectedUser']);
            //Récupération des données de l'utilisateur
            $stmtUSER = $doctrine->getConnection()->prepare('CALL PS_Recuperation_UtilisateurId(:IdUser)'); // PS_Recuperation_UserId
            $stmtUSER->bindValue(':IdUser', $Id);

            // exécution et fetch de la requête de récupération des données de l'utilisateur
            $resultUSER = $stmtUSER->execute();
            $resultUser = $resultUSER->fetchAll();
            // close mysql connection
            $stmt = null;

            // affichage
            return $this->render('modifUtilisateur.html.twig', ['utilisateur' => $resultUser]); // affichage de la page de modification

        }
        // !SECTION
    }
}
