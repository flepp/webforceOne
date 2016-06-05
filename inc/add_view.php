<<<<<<< HEAD
=======
<?= join('<br>', $errorList) ?>
<form action="" method="post">
	<fieldset>
		<legend>Ajout de Film</legend>
		<input type="text" name="movieTitle" value="" placeholder="Titre"><br />
		<input type="text" name="movieOgTitle" value="" placeholder="Titre original"><br />
		<input type="text" name="movieCast" value="" placeholder="Cast"><br />
		<input type="text" name="movieSynopsis" value="" placeholder="Resumé"><br />
		<input type="text" name="moviePath" value="" placeholder="Chemin"><br />
		<input type="text" name="movieImg" value="" placeholder="Image"><br />
		Support :<br />
		<select name="storage">
			<option value="0">choisissez :</option>
			<?php foreach ($storageList as $key=>$value) :?>
				<option value="<?= $key ?>"><?= $value ?></option>
			<?php endforeach; ?>
		</select><br />
		Catégorie :<br />
		<select name="category">
			<option value="0">choisissez :</option>
			<?php foreach ($categoryList as $key=>$value) :?>
				<option value="<?= $key ?>"><?= $value ?></option>
			<?php endforeach; ?>
		</select><br />
		<button type="submit"> Ajouter </button>
	</fieldset>
</form>
>>>>>>> refs/heads/branch-michel
