
<?php  
require 'inc/db.php';

$formValid = false;

if(!empty($_GET['mov_id'])){
	$myId = $_GET['mov_id'];
	$movieList = array();

	$sql = '

		SELECT mov_id, mov_title, mov_cast, mov_synopsis, mov_path, mov_original_title, mov_image, cat_name, sto_name, mov_date_creation, mov_cast
		FROM movie
		LEFT OUTER JOIN category ON  category.cat_id = movie.cat_id
		LEFT OUTER JOIN storage ON  storage.sto_id = movie.sto_id
		WHERE mov_id = :movID

	';

	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':movID', $myId, PDO::PARAM_INT);

	if($stmt->execute() === false){
		print_r($stmt->errorInfo());
	}
	else{
		if($stmt->rowCount() > 0){
			$movieList = $stmt->fetch();
			$formValid = true;
			//print_r($movieList);
		}
		else{
			echo "Ce film n'existe pas dans notre Base de Données!";
		}
	}

}

require 'inc/header.php';
require 'inc/movie_single_view.php';
require 'inc/footer.php';
