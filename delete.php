<?php

	require 'inc/db.php';

	$sqlDel = '
				DELETE FROM
					movie
				WHERE
					mov_id ='.$_POST['movie']
				;

	$stmtDel = $pdo->exec($sqlDel);

	echo 'Film '.$_POST['movie'].' supprimé de la liste';

 ?>

 <br/>

 <a href="movie_catalog.php">Retour à la liste</a>



