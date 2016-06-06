<form action="" method="post">
	<input type="text" name="jsonMovie" placeholder="Chercher un film"> <br/><br/>
	<button type="submit">JSON</button>
</form>
<br/>
<br/>
<br/>

<form action="" method="post">
	<fieldset>
		<legend>Ajout de Film</legend>
		<input type="text" name="movieTitle" value="<?php if(isset($decode['Title'])){echo $decode['Title'];} ?>" placeholder="Titre"><br />
		<input type="text" name="movieOgTitle" value="<?php if(isset($decode['Title'])){echo $decode['Title'];} ?>" placeholder="Titre original"><br />
		<input type="text" name="movieCast" value="<?php if(isset($decode['Actors'])){echo $decode['Actors'];} ?>" placeholder="Cast"><br />
		<input type="text" name="movieSynopsis" value="<?php if(isset($decode['Plot'])){echo $decode['Plot'];} ?>" placeholder="Resumé"><br />
		<input type="text" name="moviePath" value="" placeholder="Chemin"><br />
		<input type="text" name="movieImg" value="<?php if(isset($decode['Poster'])){echo $decode['Poster'];} ?>" placeholder="Image"><br />
		Support :<br />
		<select name="storage">
			<option value="0">choisissez :</option>
			<?php foreach ($stoArray as $key=>$value) :?>
				<option value="<?= $key ?>"><?= $value['sto_name'] ?></option>
			<?php endforeach; ?>
		</select><br />
		Catégorie :<br />
		<select name="category">
			<option value="0">choisissez :</option>
			<?php foreach ($catArray as $key=>$value) :?>
				<option value="<?= $key ?>"><?= $value['cat_name'] ?></option>

			<?php endforeach; ?>
		</select><br />
		<button type="submit"> Ajouter </button><br /><br />
		<?= join('<br>', $errorList) ?>
	</fieldset>
</form>

