
<?php
require 'inc/db.php';
require 'inc/update_view.php';


$errorList = array();
//premiere methode
if (!empty($_GET['mov_id'])) {
	$movieId = $_GET['mov_id'];

	$sql = '
	SELECT mov_title
	FROM movie
	WHERE mov_id = :movieId
	';
	$movieEdit = $pdo->prepare($sql);
	$movieEdit->bindValue(':movieId',$movieId);
	$movieEdit->execute();

	if (empty($movieEdit)) {
		$errorList[] = 'Pas de film!';
	}
	$movieSelect = $movieEdit->fetchAll();

	print_r($movieSelect);
	exit;
	
/*****************/

	// Si le formulaire a été soumis
	if (!empty($_POST)) {
		// Je récupère tous les champs du formulaires
		// si isset($_POST['mov_title']) == true alors récupère la valeur de $_POST['mov_title'], sinon, la valeur ''
		$Title = isset($_POST['mov_title']) ? $_POST['mov_title'] : '';
		$Cast = isset($_POST['mov_cast']) ? $_POST['mov_cast'] : '';
		$Synopsis = isset($_POST['mov_synopsis']) ? $_POST['mov_synopsis'] : '';
		$OriginalTitle = isset($_POST['mov_original_title']) ? $_POST['mov_original_title'] : '';

		if (empty($errorList)) {
			echo 'je peux modifier la DB<br />';

			//écrire la requête préparée "UPDATE" qui va modifier la fiche du film dans le tableau $movie[0], dans la base de données.

			$movieUpdate = $pdo->prepare("UPDATE movie (mov_title, mov_cast, mov_synopsis, mov_original_title) VALUES (:Title, :Cast, :Synopsis, :OriginalTitle)");

			$movieUpdate->bindValue(':Title',$Title);
			$movieUpdate->bindValue(':Cast',$Cast);
			$movieUpdate->bindValue(':Synopsis',$Synopsis);
			$movieUpdate->bindValue(':OriginalTitle',$OriginalTitle);
			
			$movieUpdate->execute();
			echo "Fiche du film modifiée<br />";
		}
	}
}

?>