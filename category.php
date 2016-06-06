
<?php
// Je me connecte à la BD webforceone_sql1
require 'inc/db.php';
// Je soumis le formulaire
if (!empty($_POST)) {
	print_r($_POST);
	// Je récupère les données en POST
	$categoryId = isset ($_POST['cat_id']) ? intval($_POST['cat_id']) : 0;
	$categoryName = isset ($_POST['cat_name']) ? trim($_POST['cat_name']) : '';
	// Je teste s'il y a des modifications par rapport au table "category"
	if ($categoryId > 0) {
		// Je fais une requete UPDATE du table "category"
		$sql = '
			UPDATE category
			SET cat_name = :cat_name,
				cat_date_update = NOW()
			WHERE cat_id = :cat_id
		';
		// Je récupère la requete UPDATE preparée
		$pdoStatement = $pdo->prepare($sql);
		echo 'votre requete UPDATE est preparée<br>';
	}
	else { // Si $categoryId =< 0
		// Je fais une requete INSERT dans le table "category"
		$sql = '
			INSERT INTO category (cat_name, cat_date_creation, cat_date_update)
			VALUES (:cat_name, NOW(), NOW())
		';
		// Je récupère la requete INSERT preparée
		$pdoStatement = $pdo->prepare($sql);
		echo 'votre requete INSERT est preparée<br>';
	}
	// Je fais le bindValue pour la requete UPDATE et INSERT
	$pdoStatement->bindValue(':cat_id', $categoryId, PDO::PARAM_INT);
	$pdoStatement->bindValue(':cat_name', $categoryName, PDO::PARAM_STRING);
	// J'execute la requete UPDATE ou INSERT (par rapport au besoin)
	if($pdoStatement->execute() === false) {
		print_r($pdoStatement->errorInfo());
	}
	// Je change la location apres une modification
	else if($categoryId > 0) {
		header('Location: ? cat_id='.$categoryId);
		exit;
	}
	// Je change la location apres un ajout
	else {
		// Je recupere le nouveau id du table "category"
		$categoryId = $pdo->lastInsertId(); // fonction qui renvoie l'id de la dernière ligne insérée, ou la dernière valeur d'un objet de séquence
		header('Location: ? cat_id='.$categoryId);
		exit;
	}
}
// J'initialise les variables suivantes
$currentId = 0;
$categoryName = '';
$existentCategoriesList = array();
$allCategoriesList = array();
// Je récupère les categories deja existantes dans le table "category" du BD et pour ca je fais une requete SELECT pour ce table
$sql = '
	SELECT cat_id, cat_name
	FROM category
';
	$pdoStatement = $pdo->query($sql);
	if ($pdoStatement->rowCount() > 0) {
		$existentCategoriesList = $pdoStatement->fetchAll();
	}
	return $existentCategoriesList;
// Je récupère (en GET) toutes les categories pour les afficher dans le menu deroulant du table "category" et pour ca je fais une requete SELECT dans le table "category"
if (isset($_GET['cat_id'])) {
	$currentId = intval($_GET['cat_id']);
	$sql = '
		SELECT cat_id, cat_name
		FROM category
		WHERE cat_id = :cat_id
		LIMIT 1
	';
	// Je récupère la requete SELECT preparée
		$pdoStatement = $pdo->prepare($sql);
		// Je fais le bindValue pour la requete SELECT
		$pdoStatement->bindValue(':cat_id', $currentId, PDO::PARAM_INT);
		if ($pdoStatement->execute()) {
			$allCategoriesList = $pdoStatement->fetch();
			$categoryName = $allCategoriesList['cat_name'];
		}
}
// Je fais appel aux autres fichiers pour afficher la page
require 'inc/header.php';
require 'inc/menu.php';
require 'inc/category_view.php';
require 'inc/footer.php';
?>

