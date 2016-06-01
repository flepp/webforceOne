<?php 
	require 'inc/db.php';
 	require 'inc/header.php';

	$sql = '
		SELECT 
			mov_id,
			mov_title,
			mov_original_title,
			mov_cast,
			mov_synopsis,
			mov_path,
			mov_date_creation,
			mov_date_update 	
		FROM 
			movie
		LEFT OUTER JOIN
			category ON category.cat_id = movie.cat_id
		LEFT OUTER JOIN
			storage ON storage.sto_id = movie.sto_id
		'
	;

	$pdoStatement = $pdo->query($sql);

	$errorList=array();

	if(!empty($_POST)){

		print_r($_POST);

		$titre = isset($_POST['movieTitle']) ? $_POST['movieTitle'] : '';
		$titreOg = isset($_POST['movieOgTitle']) ? $_POST['movieOgTitle'] : '';
		$cast = isset($_POST['movieCast']) ? $_POST['movieCast'] : '';
		$resume = isset($_POST['movieSynopsis']) ? $_POST['movieSynopsis'] : '';
		$chemin = isset($_POST['moviePath']) ? intval($_POST['moviePath']) : '';
		$image = isset($_POST['movieImg']) ? intval($_POST['movieImg']) : '';


		if (empty($titre)) {
			$errorList[] = 'Le nom est vide';
		}
		if (empty($titreOg)) {
			$errorList[] = 'Le prénom est vide';
		}
		if (empty($cast)) {
			$errorList[] = 'L\'email est vide';
		}
		if (empty($resume)) {
			$errorList[] = 'La date de naissance est vide';
		}
		if (empty($chemin)) {
			$errorList[] = 'La ville est manquante';
		}
		if (empty($image)) {
			$errorList[] = 'La nationalité est manquante';
		}
		if (empty($creation)) {
			$errorList[] = 'Le statut est manquant';
		}
		if (empty($maj)) {
			$errorList[] = 'Le statut est manquant';
		}
		

		if (empty($errorList)) {
				

			$sqlIns =

				'
				INSERT INTO

						movie
					(	
						mov_title,
						mov_original_title,
						mov_cast,
						mov_synopsis,
						mov_path,
						mov_date_creation,
						mov_date_update 	

					)
					VALUES
					(
						:title,
						:ogTitle,
						:cast,
						:synopsis,
						:path,
						NOW()
						NOW()
					)
				'

			;

			$pdoStatement = $pdo->prepare($sqlIns);
			$pdoStatement->bindValue(':name', $nom);
			$pdoStatement->bindValue(':firstName', $prenom);
			$pdoStatement->bindValue(':mail', $mail);
			$pdoStatement->bindValue(':birth', $naissance);
			$pdoStatement->bindValue(':city', $ville);
			$pdoStatement->bindValue(':country', $countryID);
			$pdoStatement->bindValue(':status', $maritalID);
			$pdoStatement->bindValue(':sesID', $maritalID);

			if($pdoStatement->execute() === false){

				print_r($pdo->errorInfo());
			}

			else if ($pdoStatement->rowCount() > 0){

				echo 'Etudiant ajouté à la base de données !';
	
			}
		}

		// Sinon, afficher le contenu du tableau $errorList dans view.php

	}

 ?>

<?php
	require 'inc/add_view.php';
 	require 'inc/footer.php';
?>