<?php 
	require 'inc/db.php';

	$movieList = array();

	/*$storageList = array(
		
		1 => 'USB'
	);

	$categoryList = array(
		
		1 => 'Science Fiction'
	);*/

	$catArray = array();

	$sqlCat = '

		SELECT
			cat_name
		FROM
			category
		INNER JOIN
			movie ON movie.cat_id = category.cat_id
	'
	;

	$catStmt = $pdo->query($sqlCat);

	if ($catStmt === false) {

		print_r($pdo->errorInfo());
	}

	else {

		//echo 'Categories Selected';
		//print_r($catStmt->fetch());
		$catArray = $catStmt->fetch();
	}

	$sql = '
		SELECT 
			mov_id,
			mov_title,
			mov_original_title,
			mov_cast,
			mov_synopsis,
			mov_path,
			mov_image,
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
		$chemin = isset($_POST['moviePath']) ? $_POST['moviePath'] : '';
		$image = isset($_POST['movieImg']) ? $_POST['movieImg'] : '';
		$storage = isset($_POST['storage']) ? $_POST['storage'] : '';
		$category = isset($_POST['category']) ? $_POST['category'] : '';


		if (empty($titre)) {
			$errorList[] = 'Le titre est vide';
		}
		if (empty($titreOg)) {
			$errorList[] = 'Le titre original est vide';
		}
		if (empty($cast)) {
			$errorList[] = 'Le cast est vide';
		}
		if (empty($resume)) {
			$errorList[] = 'Le resumé est vide';
		}
		if (empty($chemin)) {
			$errorList[] = 'Le chemin n\'est pas spécifié';
		}
		if (empty($image)) {
			$errorList[] = 'Il n\'y a pas d\'image';
		}
		/*if (empty($creation)) {
			$errorList[] = 'La date de création est vide';
		}
		if (empty($maj)) {
			$errorList[] = 'La date de modification est vide';
		}*/
		

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
						mov_image,
						mov_date_creation,
						mov_date_update,
						sto_id,
						cat_id	

					)
					VALUES
					(
						:title,
						:ogTitle,
						:cast,
						:synopsis,
						:path,
						:image,
						NOW(),
						NOW(),
						:storage,
						:category
					)
				'

			;

			$pdoStatement = $pdo->prepare($sqlIns);
			$pdoStatement->bindValue(':title', $titre);
			$pdoStatement->bindValue(':ogTitle', $titreOg);
			$pdoStatement->bindValue(':cast', $cast);
			$pdoStatement->bindValue(':synopsis', $resume);
			$pdoStatement->bindValue(':path', $chemin);
			$pdoStatement->bindValue(':image', $image);
			$pdoStatement->bindValue(':storage', $storage);
			$pdoStatement->bindValue(':category', $category);



			if($pdoStatement->execute() === false){

				print_r($pdo->errorInfo());
			}

			else if ($pdoStatement->rowCount() > 0){

				echo 'Film ajouté à la base de données !';
	
			}
		}

		// Sinon, afficher le contenu du tableau $errorList dans view.php

	}

 	require 'inc/header.php';
 	require 'inc/menu.php';
	require 'inc/add_view.php';
 	require 'inc/footer.php';
?>