
<?php
require 'inc/db.php';


$movieSelect = array();
$movieUpdate = array();
$errorList = array();

$stoList = array();
$catList = array();

//récupèration de toutes mes catégories
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

//récupèration de tous mes supports
$sqlSto ='
		SELECT *
		FROM storage
';
$stmtSto = $pdo->prepare($sqlSto);
if ($stmtSto->execute()) {
	$stoList = $stmtSto->fetchAll();
}else{
	print_r($stmtSto->errorInfo);
}

//recupérer les infos de la DB "movie"

if (!empty($_GET['mov_id'])) {
	$movieId = $_GET['mov_id'];

	$sql = '

	SELECT *, category.cat_id, cat_name, storage.sto_id, sto_name
	FROM movie
	LEFT OUTER JOIN category ON category.cat_id = movie.cat_id
	LEFT OUTER JOIN storage ON storage.sto_id = movie.sto_id
	WHERE mov_id = :movieId
	';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':movieId',$movieId);

	if ($stmt->execute()===false) {
		print_r($stmt->errorInfo());
	}
	else {
		$movieSelect = $stmt->fetch();
		//print_r($movieSelect).'<br/>';
	}
}

	// Si le formulaire a été soumis
if (!empty($_POST)) {
	//print_r($_POST);
	// Je récupère tous les champs du formulaires
	// si isset($_POST['mov_title']) == true alors récupère la valeur de $_POST['mov_title'], sinon, la valeur ''
	$title = isset($_POST['mov_title']) ? $_POST['mov_title'] : '';
	$category = isset($_POST['cat_id']) ? $_POST['cat_id'] : '';
	$cast = isset($_POST['mov_cast']) ? $_POST['mov_cast'] : '';
	$synopsis = isset($_POST['mov_synopsis']) ? $_POST['mov_synopsis'] : '';
	$originalTitle = isset($_POST['mov_original_title']) ? $_POST['mov_original_title'] : '';
	$path = isset($_POST['mov_path']) ? $_POST['mov_path'] : '';
	$image = isset($_POST['mov_image']) ? $_POST['mov_image'] : '';
	$storage = isset($_POST['sto_id']) ? $_POST['sto_id'] : '';

	//if (empty($errorList)) {
		//echo 'je peux modifier la DB<br />';

		//écrire la requête préparée "UPDATE" qui va modifier la fiche du film dans le tableau $movie[0], dans la base de données.

		$sql = "
			UPDATE movie
			SET mov_title=:title, cat_id=:category, mov_cast=:cast, mov_synopsis=:synopsis, mov_original_title=:originalTitle, mov_path=:piath, mov_image=:image, sto_id=:storage
			WHERE mov_id = :mov_id
			";
		$pdoStatement = $pdo->prepare ($sql);
		$pdoStatement->bindValue(':title',$title);
		$pdoStatement->bindValue(':category',$category);
		$pdoStatement->bindValue(':cast',$cast);
		$pdoStatement->bindValue(':synopsis',$synopsis);
		$pdoStatement->bindValue(':originalTitle',$originalTitle);
		$pdoStatement->bindValue(':piath',$path);
		$pdoStatement->bindValue(':image',$image);
		$pdoStatement->bindValue(':mov_id',$movieId);
		$pdoStatement->bindValue(':storage',$storage);
		
		if ($pdoStatement->execute()===false) {
			print_r($pdoStatement->errorInfo());
		}
		else{
			$movieUpdate = $pdoStatement->fetchAll();
			print_r($movieUpdate);
		echo "Fiche du film modifiée<br />";
		}
	//}
}
else {
	//print_r('champ manquant')
}

require 'inc/header.php';
require 'inc/menu.php';
require 'inc/update_view.php';
require 'inc/footer.php';

