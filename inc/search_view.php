<!-- si mon formulaire spécifique est validé et est "true", dans ce cas je cache ma première recherche et grâce à ma requete j'affiche le résultat de la recherche spécifique -->
<?php if($formTwoValid === true) : ?>
	<!--  tableau d'affichage de ma recherche spécifique -->
	<?php if(isset($searchList3) && sizeof($searchList3) > 0) : ?>
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
				<?php foreach($searchList3 as $currentSearch) : ?>
					<tr>
						<!-- Lien vers la page movie_single.php pour renseigner l'id de mon film afin de l'afficher sur sa page unique -->
						<td><a href="movie_single.php?mov_id=<?= $currentSearch['mov_id']?>"><?= $currentSearch['mov_title'] ?></a></td>
						<td><?= $currentSearch['mov_original_title'] ?></td>
						<td><?= $currentSearch['cat_name'] ?></td>
						<td><?= $currentSearch['mov_synopsis'] ?></td>
						<td><img style="height: 100px" src="<?= $currentSearch['mov_image'] ?>"></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	<?php else :?>
	<p>Aucun film trouvé</p>
	<?php endif; ?>

<!-- affichage dans un tableau du formulaire de recherche classique -->
<?php else :?>
	<?php if(!empty($_GET['search'])) ?>
		<?php if(!isset($nbRows)) : ?>
			<p>Voici le résultat de votre recherche "<?= isset($search) ?>", il y a 0 élément trouvé !</p>
		<?php else: ?>
			<p>Voici le résultat de votre recherche "<?= isset($search) ?>", il y a <?= $nbRows ?> élément(s) trouvé(s) !</p>
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
						<!-- Lien vers la page movie_single.php pour renseigner l'id de mon film afin de l'afficher sur sa page unique -->
						<td><a href="movie_single.php?mov_id=<?= $currentSearch['mov_id']?>"><?= $currentSearch['mov_title'] ?></a></td>
						<td><?= $currentSearch['mov_original_title'] ?></td>
						<td><?= $currentSearch['cat_name'] ?></td>
						<td><?= $currentSearch['mov_synopsis'] ?></td>
						<td><img style="height: 100px" src="<?= $currentSearch['mov_image'] ?>"></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	<?php else :?>
	<p>Aucun film trouvé</p>
	<?php endif; ?>
<?php endif; ?>
<br/>
<br/>
<br/>
<br/>

<!-- formulaire de recherche spécifique -->
<h2>Recherche spécifique</h2>
<form method="get" action="search.php">
	<select  name="catSearch">
		<option value="">Genre</option>
		<?php foreach($searchList2 as $currentSearch) : ?>
		<option <?php if (($catSearch)==($currentSearch['cat_name'])) echo 'selected="selected"'; ?> value="<?= $currentSearch['cat_name'] ?>"><?= $currentSearch['cat_name'] ?></option>
		<?php endforeach; ?>
	</select>
	<input type="text" name="titleSearch" placeholder="titre" value="<?php if (isset($_GET['titleSearch'])){echo $_GET['titleSearch'];} ?>"></input>
	<input type="text" name="actorSearch" placeholder="Nom de l'acteur" value="<?php if (isset($_GET['actorSearch'])){echo $_GET['actorSearch'];} ?>"></input>
	<select name="stoSearch">
		<option value="">Support</option>
		<?php foreach($searchList2 as $currentSearch) : ?>
		<option <?php if (($stoSearch)==($currentSearch['sto_name'])) echo 'selected="selected"'; ?> value="<?= $currentSearch['sto_name'] ?>"><?= $currentSearch['sto_name'] ?></option>
		<?php endforeach; ?>
	</select>
	<select name="dateSearch">
		<option value="">Date d'ajout</option>
		<?php foreach($searchList2 as $currentSearch) : ?>
		<option <?php if (($dateSearch)==($currentSearch['mov_date_creation'])) echo 'selected="selected"'; ?> value="<?= $currentSearch['mov_date_creation'] ?>"><?= $currentSearch['mov_date_creation'] ?></option>
		<?php endforeach; ?>
	</select>
	<button type="submit">Rechercher</button>

</form>