<?php 

require 'inc/db.php';

//initialisation de mon tableau pour y stocker une liste de mes derniers films entrés en BD d'où ORDER BY mov_date_creation DESC et une limite de 5 éléments
//ce tableau aura pour utilité de remplir les champs img et a dans ma div imgLink
$listMovie = array();
$sql = '
	SELECT *
	FROM movie
	ORDER BY mov_date_creation DESC
	LIMIT 5;
';
$stmt = $pdo->prepare($sql);
if($stmt->execute() === false){
	print_r($pdo->errorInfo());
}else{
	$listMovie = $stmt->fetchAll();
	//print_r($listMovie); 

}

// préparation de requete pour récupèrer les les noms des catégories et le nombre de film que contient une catégorie, pour cela je fais une jointure entre les tables ayant un champ en commun en l'occurence ici cat_id présent dans movie et category, je limite enfin le résulat à 4 éléments en affichage
$listCat = array();
$sql1 ='
	SELECT COUNT(*) AS nb_movie, category.cat_id,
	  category.cat_name
	FROM
	  movie
	INNER JOIN
	  category ON category.cat_id = movie.cat_id
	GROUP BY
	  category.cat_id,
	  category.cat_name
	 LIMIT 4
	';
$pdostmt = $pdo->prepare($sql1);
if($pdostmt->execute() === false){
	print_r($pdostmt->errorInfo());
}
else{
	$listCat = $pdostmt->fetchAll();
	//print_r($listCat); 
}

?>



<?php 
	require 'inc/header.php';
	require 'inc/menu.php';
	require 'inc/index_view.php';
	require 'inc/footer.php'; 
?>
