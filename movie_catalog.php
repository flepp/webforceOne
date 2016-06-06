<?php

	require 'inc/db.php';

	$movieList = array();

	$nbPerPage = 4;
	$currentOff = 0;
	$currentPage = 1;
	
	if (array_key_exists('page', $_GET)) { // équivaut à isset($_GET['page'])

		$currentPage = intval($_GET['page']);
		$currentOff = ($currentPage-1) * $nbPerPage;
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

		$dateMaj = isset($_GET['tri_date']) ? $_GET['tri_date'] : '';

		if (!empty($dateMaj)) {
			
			$sql .= " ORDER BY mov_date_update ".$dateMaj;

		}

		$sql.=' LIMIT :offset,:nbPerPage';

		$pdoStatement = $pdo->prepare($sql);
		
		$pdoStatement->bindValue(':offset', $currentOff, PDO::PARAM_INT);
		$pdoStatement->bindValue(':nbPerPage',$nbPerPage, PDO::PARAM_INT);

		if($pdoStatement->execute() === false){

			print_r($pdoStatement->errorInfo());
		}

		else if ($pdoStatement->rowCount() > 0){

			$movieList = $pdoStatement->fetchAll();
		}

$catalogList = array();

if(!empty($_GET['cat_id'])){
	$catID = $_GET['cat_id'];
	$sql ='
		SELECT mov_id, mov_title, mov_cast, mov_synopsis, mov_path, mov_original_title, mov_image, cat_name, sto_name, mov_date_creation
		FROM movie
		LEFT OUTER JOIN category ON  category.cat_id = movie.cat_id
		LEFT OUTER JOIN storage ON  storage.sto_id = movie.sto_id
		WHERE category.cat_id = :catId
	';

$pdoStatement = $pdo->prepare($sql);
$pdoStatement->bindValue(':catId', $catID);

	if($pdoStatement->execute() === false){
		print_r($pdoStatement->errorInfo());
	}
	else if($pdoStatement->rowCount() > 0){
		$catalogList = $pdoStatement->fetchAll();
		//print_r($catalogList);
	}else{
		echo "Cette categorie ne contient pas encore de film";
	}
}


require 'inc/header.php';
require 'inc/menu.php';
require 'inc/movie_catalog_view.php';
require 'inc/footer.php';