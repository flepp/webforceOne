<?php 
	require 'inc/db.php';

	$movieList = array();
	$stoArray = array();
	$catArray = array();

	$sqlSto = '

		SELECT *
		FROM storage
		
	'
	;

	$stoStmt = $pdo->query($sqlSto);

	if ($stoStmt === false) {
		print_r($pdo->errorInfo());
	}

	else {

		//echo 'Categories Selected';
		$stoArray = $stoStmt->fetchAll(); //ATTENTION
		//print_r($catArray);
	}

	$sqlCat = '

		SELECT *
		FROM category
	'
	;



	$catStmt = $pdo->query($sqlCat);

	if ($catStmt === false) {

		print_r($pdo->errorInfo());
	}

	else {

		//echo 'Categories Selected';
		$catArray = $catStmt->fetchAll(); //ATTENTION
		//print_r($catArray);
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

		//print_r($_POST);

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


			$test = array();

			if($pdoStatement->execute() === false){

				print_r($pdo->errorInfo());
			}

			else if ($pdoStatement->rowCount() > 0){
				$test = $pdoStatement->fetchAll();
				//print_r($test);

				echo 'Film ajouté à la base de données !';
			}
		}

		// Sinon, afficher le contenu du tableau $errorList dans view.php

	}

//------------------------------------------------JSON///API OMDB------------------------------------
	// &&isset($_POST['jsonMovie'])
if(!empty($_POST['jsonMovie'])){
	$var = strip_tags( $_POST['jsonMovie']);
	$var2 = str_replace(' ', '+', $var);
	$formValidJson = false;

	$url = file_get_contents('http://www.omdbapi.com/?t='.$var2.'&y=&plot=short&r=json');
	$decode = json_decode($url, true);
	if(sizeof($decode) > 2){
		$formValidJson = true;
		//echo sizeof($decode);
		//print_r($decode);
	}else{
		echo 'Film non trouvé';
		$decode = Array
(
    ['Title'] => '',
    ['Year'] => '',
    ['Rated'] => '',
    ['Released'] => '',
    ['Runtime'] => '',
    ['Genre'] => '',
    ['Director'] => '',
    ['Writer'] => '',
    ['Actors'] => '',
    ['Plot'] => '',
    ['Language'] => '',
    ['Country'] => '',
    ['Awards'] => '',
    ['Poster'] => '',
    ['Metascore'] => '',
    ['imdbRating'] => '',
    ['imdbVotes'] => '',
    ['imdbID'] => '',
    ['Type'] => '',
    ['Response'] => ''
);
	}
	
}
 	require 'inc/header.php';
	require 'inc/add_view.php';
 	require 'inc/footer.php';

?>

