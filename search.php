<?php 

require 'inc/db.php';

$sql = '
	SELECT mov_id, mov_title, mov_cast, mov_synopsis, mov_path, mov_original_title, mov_image, cat_name, sto_name, mov_date_creation
			FROM movie
			LEFT OUTER JOIN category ON  category.cat_id = movie.cat_id
			LEFT OUTER JOIN storage ON  storage.sto_id = movie.sto_id
';
$pdoStatement = $pdo->prepare($sql);

	if($pdoStatement->execute() === false){
		print_r($pdo->errorInfo());
	}
	else if($pdoStatement->rowCount() > 0){
		$searchList2 = $pdoStatement->fetchAll();
	}


//récupèration et vérification des données du form de l'index en GET
if(!empty($_GET['search']) && isset($_GET['search'])){
	$search = $_GET['search'];

	// tableau pour récupèrer mes données
	$searchList = array();

	//Lancement requête de lecture
	$sqlSearchResult = '
		SELECT mov_id, mov_title, mov_cast, mov_synopsis, mov_path, mov_original_title, mov_image, cat_name, sto_name, mov_date_creation
		FROM movie
		LEFT OUTER JOIN category ON  category.cat_id = movie.cat_id
		LEFT OUTER JOIN storage ON  storage.sto_id = movie.sto_id
		WHERE mov_title LIKE :recherche
		OR mov_original_title LIKE :recherche
		OR mov_synopsis LIKE :recherche
		OR mov_path LIKE :recherche
		OR mov_cast LIKE :recherche

	';

	//préparation de la requête et excecution
	$pdoStatement = $pdo->prepare($sqlSearchResult);

	$pdoStatement->bindValue(':recherche', '%'.$search.'%');
	if($pdoStatement->execute() === false){
		print_r($pdo->errorInfo());
	}
	else if($pdoStatement->rowCount() > 0){
		$searchList = $pdoStatement->fetchAll();
		//print_r($searchList);
		$nbRows = $pdoStatement->rowCount();
	}

}



//récupèration et vérification des données du form de l'index en GET
$formTwoValid = false;
$catSearch ='';
$titleSearch ='';
$actorSearch ='';
$stoSearch ='';
$dateSearch ='';

if(!empty($_GET['catSearch']) || !empty($_GET['titleSearch']) || !empty($_GET['actorSearch']) || !empty($_GET['stoSearch']) || !empty($_GET['dateSearch'])){
	$formTwoValid = true;

	//tableau pour récupèrer mes données
	$searchList3 = array();

	$sqlSearchResultAff = '
		SELECT mov_id, mov_title, mov_cast, mov_synopsis, mov_path, mov_original_title, mov_image, cat_name, sto_name, mov_date_creation, mov_cast
		FROM movie
		LEFT OUTER JOIN category ON  category.cat_id = movie.cat_id
		LEFT OUTER JOIN storage ON  storage.sto_id = movie.sto_id
		WHERE 1=1
	';

	//print_r($_GET);
	if(!empty($_GET['catSearch'])){
		$catSearch = $_GET['catSearch'];
		$sqlSearchResultAff .= ' AND cat_name = :catsearch ';
	}
	if(!empty($_GET['titleSearch'])){
		$titleSearch = $_GET['titleSearch'];
		$sqlSearchResultAff .= ' AND mov_title LIKE :titlesearch ';
	}
	if(!empty($_GET['actorSearch'])){
		$actorSearch = $_GET['actorSearch'];
		$sqlSearchResultAff .= ' AND mov_cast LIKE :actorsearch ';
	}
	if(!empty($_GET['stoSearch'])){
		$stoSearch = $_GET['stoSearch'];
		$sqlSearchResultAff .= ' AND sto_name = :stosearch ';
	}
	if(!empty($_GET['dateSearch'])){
		$dateSearch = $_GET['dateSearch'];
		$sqlSearchResultAff .= ' AND mov_date_creation = :datesearch ';
	}


	//préparation de la requête et excecution
	$stmt = $pdo->prepare($sqlSearchResultAff);

	if(!empty($_GET['catSearch'])){
		$stmt->bindValue(':catsearch', $catSearch);
	}
	if(!empty($_GET['titleSearch'])){
		$stmt->bindValue(':titlesearch', '%'.$titleSearch.'%');
	}
	if(!empty($_GET['actorSearch'])){
		$stmt->bindValue(':actorsearch', '%'.$actorSearch.'%');
	}
	if(!empty($_GET['stoSearch'])){
		$stmt->bindValue(':stosearch', $stoSearch);
	}
	if(!empty($_GET['dateSearch'])){
		$stmt->bindValue(':datesearch', $dateSearch);
	}

	if($stmt->execute() === false){
		print_r($pdo->errorInfo());
	}
	else if($stmt->rowCount() > 0){
		$searchList3 = $stmt->fetchAll();
		//print_r($searchList3);
		//$nbRows = $stmt->rowCount();
	}

}


require 'inc/header.php';
require 'inc/search_view.php';
require 'inc/footer.php';
