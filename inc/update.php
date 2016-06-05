
<?php
require 'db.php';

$movieSelect = array();
$catSelect = array();
$movieUpdate = array();
$errorList = array();

//recupérer les infos de la DB "category"

//recupérer les infos de la DB "movie"
if (!empty($_GET['mov_id'])) {
	$movieId = $_GET['mov_id'];

	$sql = '
	SELECT *
	FROM movie
	LEFT OUTER JOIN category ON category.cat_id = movie.cat_id
	WHERE mov_id = :movieId
	';
	$movieEdit = $pdo->prepare($sql);
	$movieEdit->bindValue(':movieId',$movieId);

	if ($movieEdit->execute()===false) {
		print_r($movieEdit->errorInfo());
	}
	else {
		$movieSelect = $movieEdit->fetch();
		//print_r($movieSelect);
	}

	$sql1 = '
	SELECT cat_id
	FROM category
	';
	$categoryEdit = $pdo->prepare($sql1);

	if ($categoryEdit->execute()===false) {
	print_r($categoryEdit->errorInfo());
	}
	else {
		$catSelect = $categoryEdit->fetchAll();
		//print_r($catSelect);
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

		//if (empty($errorList)) {
			//echo 'je peux modifier la DB<br />';

			//écrire la requête préparée "UPDATE" qui va modifier la fiche du film dans le tableau $movie[0], dans la base de données.

			$sql = "
				UPDATE movie
				SET mov_title=:title, cat_id=:category, mov_cast=:cast, mov_synopsis=:synopsis, mov_original_title=:originalTitle, mov_path=:piath, mov_image=:image
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
}
require 'header.php';
require 'update_view.php';
require 'footer.php';
?>