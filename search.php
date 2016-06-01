<?php 

require 'inc/db.php';

//récupèration et vérification des données du form de l'index en GET
if(!empty($_GET['search']) && isset($_GET['search'])){
	$search = $_GET['search'];

	// tableau pour récupèrer mes données
	$searchList = array();

	//Lancement requête de lecture
	$sqlSearchResult = '
		SELECT mov_id, mov_title, mov_cast, mov_synopsis, mov_path, mov_original_title, mov_image
		FROM movie
		LEFT OUTER JOIN category ON  category.cat_id = movie.cat_id
		LEFT OUTER JOIN storage ON  storage.sto_id = movie.sto_id
		OR mov_title LIKE : recherche
		OR mov_original_title LIKE : recherche
		OR mov_synopsis LIKE : recherche
		OR mov_path LIKE : recherche
		OR mov_cast LIKE : recherche

	';

	//préparation de la requête et excecution
	$pdoStatement = $pdo->prepare($sqlSearchResult);

	$pdoStatement->bindValue('recherche', '%'.$search.'%');
	if($pdoStatement->execute() === false){
		print_r($pdo->errorInfo());
	}
	else if($pdoStatement->rowCount() > 0){
		$searchList = $pdoStatement->fetchAll();
		$nbRows = $pdoStatement->rowCount();
	}

}

require 'inc/header.php';
require 'inc/search_view.php';
require 'inc/footer.php';
