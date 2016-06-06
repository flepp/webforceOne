<?php  
require 'inc/db.php';

//récupèration de la liste des catégories
$catList = array();

$sqlCat ='
		SELECT *
		FROM category
';
$stmtCat = $pdo->prepare($sqlCat);
if ($stmtCat->execute()) {
	$catList = $stmtCat->fetchAll();
}else{
	print_r($stmtCat->errorInfo);
}
//création d'une catégorie
$formValid = false;

//vérification des données entrées
if(!empty($_POST['catPost']) && isset($_POST['catPost'])){
	$categoryPost = $_POST['catPost'];
	if (strlen(strip_tags(trim($categoryPost))) > 4) {
		$formValid = true;
	}else{
		echo 'Paramètre invalide!! Reessayer SVP';
	}
}
//vérification si données existe en BD

if ($formValid == true) {
	
	$sqlVerif = '
		SELECT *
		FROM category
		WHERE cat_name = :categoryBind
	';
	$stmt = $pdo->prepare($sqlVerif);
	$stmt->bindValue(':categoryBind', $categoryPost);

	if($stmt->execute() === false){
		print_r($stmt->errorInfo);
	}else if($stmt->rowCount()>0){
			echo "Ce genre/catégorie existe déjà!!!";
	}else{
		//j'insère
		$sqlInsert ='
			INSERT INTO category (cat_name, cat_date_creation, cat_date_update)
			 VALUES (:insertionCat, NOW(), NOW())
		';
		$pdostmt = $pdo->prepare($sqlInsert);
		$pdostmt->bindValue(':insertionCat', $categoryPost);
		if($pdostmt->execute() === false){
			print_r($pdostmt->errorInfo());
		}else if($pdostmt->rowCount()>0){
				echo "Insertion effectué!!!";
		}
	}
}








require 'inc/header.php';
require 'inc/menu.php';
require 'inc/category_view.php';
require 'inc/footer.php';