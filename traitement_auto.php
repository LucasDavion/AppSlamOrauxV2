<?php
include "connexion_bd_gesoraux.php";

// Suppression de la table temporaire (au cas ou le programme est lancé plusieurs fois)
$sql=$bdd->query("DROP TABLE tabletempo");
// Création de la table temporaire 
$sql=$bdd->query("CREATE TABLE tabletempo as 
SELECT idUtilisateur, choixprofdemijournee.idDemiJournee AS idDemiJournee, idSalle, idPlage, demijournee.date, plage.nbMaxEleve
FROM choixprofdemijournee
JOIN demijournee ON idDemiJournee=demijournee.id
JOIN plagedemijournee ON plagedemijournee.idDemiJournee=demijournee.id
JOIN plage ON idPlage=plage.id");

 
// Select de tous les élèves passant les épreuves
try {
		$lesEnregs=$bdd->query("
			SELECT eleve.id, inscritBenef, derogation, division.libelle, section.libelle, utilisateur.id AS idProf, utilisateur.nom AS nomProf, passageepreuve.id as idEpreuve
			FROM passageepreuve 
			JOIN eleve ON idEleve=eleve.id 
			LEFT OUTER JOIN section ON idSection=section.id 
			JOIN division ON idDivision=division.id 
			LEFT OUTER JOIN utilisateur ON idProfChoix=utilisateur.id
			JOIN epreuve ON idEpreuve=epreuve.id
			JOIN discipline ON epreuve.idDiscipline=discipline.id
			JOIN natureepreuve ON idNatureEpreuve=natureepreuve.id
			WHERE derogation='N' AND inscritBenef='N' AND idProfAffecte is null AND idProfChoix is not null
			ORDER BY utilisateur.nom, natureepreuve.libelle");
} catch (PDOException $e) {
					die ("Err BDSelect : erreur de lecture table passageepreuve dans traitement_auto.php<br>Message d'erreur :" . $e->getMessage());
	}
if($lesEnregs->rowCount()==0){
	$msg="Aucun élève à sélectionner dans la base de données";
	header('Location:admin_traitement_auto.php?msg='.$msg);
} else {

	$nbEleveTot=$lesEnregs->rowCount();
	$nbEleveTrait=0;
	// Pour chaque élève on récupère le prof l'ayant choisi
	foreach ($lesEnregs as $enreg){
		
		$idProfChoix=$enreg->idProf;
		$nomProf=$enreg->nomProf;
		$idEpreuve = $enreg->idEpreuve;

		// Puis on récupère la première ligne de la tabletempo disponible pour ce prof
		$sql=$bdd->query("SELECT * FROM tabletempo WHERE idUtilisateur=$idProfChoix and nbMaxEleve > 0 limit 1");
		// On vérifie que le select retourne une ligne (ce qui est normalement toujours vrai)
		if($sql->rowCount()==0){
			$msg="</br>Le professeur $nomProf n'a plus de plage disponible";
			header('Location:admin_traitement_auto.php?msg='.$msg);

		// Si le select a retourné une ligne le traitement se poursuit
		} else {
			$sql = $sql->fetch();
			$idDemiJournee=$sql->idDemiJournee;
			$idSalle=$sql->idSalle;
			$idPlage=$sql->idPlage;
			echo $idProfChoix;
			// On insert ensuite ces informations dans la table passagepreuve 
			$sql=$bdd->query("UPDATE passageepreuve SET idProfAffecte=$idProfChoix, idSalle=$idSalle, idDemiJournee=$idDemiJournee, idPlage=$idPlage WHERE id = $idEpreuve");
			// On supprime la ligne traitée dans tabletempo
			$sql=$bdd->query("UPDATE tabletempo SET nbMaxEleve=nbMaxEleve-1 WHERE idUtilisateur=$idProfChoix AND idSalle=$idSalle AND idDemiJournee=$idDemiJournee AND idPlage=$idPlage");
			$nbEleveTrait++;
		}		
	}
	// On vérifie que le traitement a correctement été effectué
	if($nbEleveTot==$nbEleveTrait){
		$msg="Le traitement a bien été effectué : toutes les affectations ont eu lieu.";
		header('Location:admin_traitement_auto.php?msg='.$msg);

		// Si ce n'est pas le cas on affiche les élèves non affectés
	} else {
		try {
			$lesEnregs=$bdd->query("
				SELECT eleve.nom AS nomEleve, eleve.prenom AS prenomEleve, discipline.libelle AS discipline, natureepreuve.libelle AS natureepreuve, utilisateur.nom AS nomProf, utilisateur.prenom AS prenomProf, division.libelle as classe 
				FROM passageepreuve 
				JOIN epreuve ON idEpreuve=epreuve.id 
				JOIN discipline ON idDiscipline=discipline.id 
				JOIN natureepreuve ON idNatureEpreuve=natureepreuve.id 
				JOIN eleve ON idEleve=eleve.id 
				JOIN utilisateur ON idProfChoix = utilisateur.id 
				JOIN division ON idDivision = division.id 
				WHERE idProfAffecte is null order by nomProf ");
		} catch (PDOException $e) {
					die ("Err BDSelect : erreur de lecture table passageepreuve dans traitement_auto.php<br>Message d'erreur :" . $e->getMessage());
		}
		$msg="Le traitement a été effectué mais les élèves suivants n'ont pas été affectés : ";
		header('Location:admin_traitement_auto.php?msg='.$msg);

		foreach ($lesEnregs as $enreg){
			$nomEleve=$enreg->nomEleve;
			$prenomEleve=$enreg->prenomEleve;
			$discipline=$enreg->discipline;
			$natureepreuve=$enreg->natureepreuve;
			$nomProf=$enreg->nomProf;
			$prenomProf=$enreg->prenomProf;

		}
	}
}

?>