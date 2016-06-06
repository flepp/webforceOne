<h1>Voici la liste de toutes les catégories</h1>
<?php foreach($catList as $key => $value) : ?>
<p><a href="movie_catalog.php?cat_id=<?= $value['cat_id'] ?>"><?=$value['cat_name'] ?></a></p>
<?php  endforeach; ?>
<br/>
<br/>
<br/>
<h2>Ajouter une catégorie</h2>
<form method="post" action="">
<input type="text" name="catPost" placeholder="Nouveau genre"></input> 

</form>