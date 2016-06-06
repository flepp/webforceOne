<?php 

require 'inc/db.php';


//------------------------------------------------RECHERCHE SIMPLE------------------------------------------------------------------

//récupèration et vérification des données du form de l'index en GET
if(!empty($_GET['search']) && isset($_GET['search'])){

	$search = strip_tags($_GET['search']);


	// tableau pour récupèrer mes données
	$searchList = array();

	//requete pour récupèrer tous les éléments de mes tables en BD grace à mes jointures afin de donner un résultat de recherche plus fourni
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
//Conservation des données saisies dans notre fichier txt
	$handle = fopen("txt/file.txt", "a");

	if ($handle) {
		// Maintenant, je peux écrire dans mon fichier
		fwrite($handle, $search.PHP_EOL);
		fclose($handle);
	}
// je récupère le contenu de mon fichier dans un tableau
	//$handleContent = file_get_contents($handle);
	print_r($handle[1]);
}
//-------------------------------------------------------FIN RECHERCHE SIMPLE--------------------------------------------

//requete pour récupèrer tous les éléments de mes tables en BD grace à mes jointures afin de remplir les champs html de ma recherche spécifique
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
//------------------------------------------------RECHERCHE SPECIFIQUE------------------------------------------------


//récupèration et vérification des données du form de l'index en GET
$formTwoValid = false;
$catSearch ='';
$titleSearch ='';
$actorSearch ='';
$stoSearch ='';
$dateSearch ='';

//si on a au moins un champs non vide après validation du formulaire, on aura un form valide et on pourra lancer une requête après vérification des GET
if(!empty($_GET['catSearch']) || !empty($_GET['titleSearch']) || !empty($_GET['actorSearch']) || !empty($_GET['stoSearch']) || !empty($_GET['dateSearch'])){
	$formTwoValid = true;
	//print_r($_GET);

	//tableau pour récupèrer mes données
	$searchList3 = array();

	$sqlSearchResultAff = '
		SELECT mov_id, mov_title, mov_cast, mov_synopsis, mov_path, mov_original_title, mov_image, cat_name, sto_name, mov_date_creation, mov_cast
		FROM movie
		LEFT OUTER JOIN category ON  category.cat_id = movie.cat_id
		LEFT OUTER JOIN storage ON  storage.sto_id = movie.sto_id
		WHERE 1=1
	';

	//Partie la plus importante du code de recherche spécifique!!!! 
	//A chaque fois qu'un champs est rempli et valide, on rajoute une instruction supplémentaire à notre précédente requête SQL pour encore mieux spécifier la 
	//la recherche. Si le champs n'est pas renseigné, il ne sera pas dans la requête.
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

	//Même principe que pour la concaténation des valeurs renseignés dans la requête sql, si un champs est valide, on fait un bind
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
require 'inc/menu.php';
require 'inc/search_view.php';
require 'inc/footer.php';
