<?php if($formTwoValid === true) : ?>
	<p>Voici le résultat trouvé !</p>
<?php else :?>
	<?php if(!empty($_GET['search'])) ?>
		<?php if(!isset($nbRows)) : ?>
			<p>Voici le résultat de votre recherche "<?= $search ?>", il y a 0 élément trouvé !</p>
		<?php else: ?>
			<p>Voici le résultat de votre recherche "<?= $search ?>", il y a <?= $nbRows ?> élément(s) trouvé(s) !</p>
		<?php endif; ?>

	<?php if(isset($searchList) && sizeof($searchList) > 0) : ?>
		<table border="1">
			<thead>
				<tr>
					<td> Titre</td>
					<td> Titre Original</td>
					<td> Genre</td>
					<td> Synopsis</td>
					<td> Couverture</td>
				</tr>
			</thead>

			<tbody>
				<?php foreach($searchList as $currentSearch) : ?>
					<tr>
						<td><a href="movie_single_view.php?mov_id=<?= $currentSearch['mov_id']?>"><?= $currentSearch['mov_title'] ?></a></td>
						<td><?= $currentSearch['mov_original_title'] ?></td>
						<td><?= $currentSearch['cat_name'] ?></td>
						<td><?= $currentSearch['mov_synopsis'] ?></td>
						<td><img style="height: 100px" src="<?= $currentSearch['mov_image'] ?>"></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	<?php else :?>
	aucun film
	<?php endif; ?>
<?php endif; ?>
<br/>
<br/>
<br/>
<br/>

<h2>Recherche spécifique</h2>
<form method="get" action="search.php">
	<select  name="catSearch">
		<option value="">Genre</option>
		<?php foreach($searchList2 as $currentSearch) : ?>
		<option name="catSearch" value="<?= $currentSearch['cat_name'] ?>"><?= $currentSearch['cat_name'] ?></option>
		<?php endforeach; ?>
	</select>
	<input type="text" name="titleSearch" placeholder="titre"></input>
	<input type="text" name="actorSearch" placeholder="Nom de l'acteur"></input>
	<select name="stoSearch">
		<option value="">Support</option>
		<?php foreach($searchList2 as $currentSearch) : ?>
		<option value="<?= $currentSearch['sto_name'] ?>"><?= $currentSearch['sto_name'] ?></option>
		<?php endforeach; ?>
	</select>
	<select name="dateSearch">
		<option value="">Date d'ajout</option>
		<?php foreach($searchList2 as $currentSearch) : ?>
		<option value="<?= $currentSearch['mov_date_creation'] ?>"><?= $currentSearch['mov_date_creation'] ?></option>
		<?php endforeach; ?>
	</select>
	<button type="submit">Rechercher</button>

</form>





<br/>
<br/>
<br/>
<br/>


