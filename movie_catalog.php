<?php 
require 'inc/db.php';

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
require 'inc/movie_catalog_view.php';
require 'inc/footer.php';