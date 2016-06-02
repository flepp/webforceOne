
<?php
	require 'inc/db.php';

	$nbPerPage = 4;
	$currentOff = 0;
	$currentPage = 1;

	if (array_key_exists('page', $_GET)) { // équivaut à isset($_GET['page'])

		$currentPage = intval($_GET['page']);
		$currentOff = ($currentPage-1) * $nbPerPage;
	}

	$sql = '
			SELECT 
			mov_id,
			mov_title,
			mov_original_title,
			mov_cast,
			mov_synopsis,
			mov_path,
			mov_image,
			mov_date_creation,
			mov_date_update 	
		FROM 
			movie
		LEFT OUTER JOIN
			category ON category.cat_id = movie.cat_id
		LEFT OUTER JOIN
			storage ON storage.sto_id = movie.sto_id
		LIMIT
			:offset,:nbPerPage
		'
		;

		$pdoStatement = $pdo->prepare($sql);
		
		$pdoStatement->bindValue(':nbPerPage',$nbPerPage, PDO::PARAM_INT);

		$pdoStatement->bindValue(':offset', $currentOff, PDO::PARAM_INT);

		if($pdoStatement->execute() === false){

			print_r($pdo->errorInfo());
		}

		else if ($pdoStatement->rowCount() > 0){

			$movieList = $pdoStatement->fetchAll();
		}
	
 	require 'inc/header.php';
 	require 'inc/menu.php';
	require 'inc/movie_catalog_view.php';
 	require 'inc/footer.php';
?>