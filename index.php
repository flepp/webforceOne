<?php 
require 'inc/header.php';
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

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>


<form method="get" action="search.php">
	<input type="text" name="search" placeholder="Recherche"></input>
	<button type="submit">ok</button>
</form>

<ul>
	<?php foreach($listCat as $key => $value) : ?>
	<li><a href="movie_catalog.php?cat_id=<?= $value['cat_id']?>"><?= $value['cat_name'] ?>(<?= $value['nb_movie'] ?>)</a></li>
	<?php endforeach; ?>
</ul>
<?php foreach($listMovie as $currentSearch) : ?>
<div class="imgLink">
	<img style="height: 100px" src="<?= $currentSearch['mov_image'] ?>">
	<a href="movie_single.php?mov_id=<?= $currentSearch['mov_id']?>"><?= $currentSearch['mov_title'] ?></a>
</div>
<?php endforeach; ?>

<?php require 'inc/footer.php'; ?>


