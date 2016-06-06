<form action="" method="post">
	<fieldset>
		<legend>Modifier les infos du film</legend>
		<label>Nom du film:</label><br/>
		<input type="text" name="mov_title" value="<?= $movieSelect['mov_title'] ?>"/><br />
		<label>Genre du film:</label><br/>
		<select name="cat_id">
			<option value="<?= $movieSelect['cat_id']?>">Genre Actuel: <?= $movieSelect['cat_name']?></option>
		    <?php foreach ($catList as $key => $value) :?>
		    <option value="<?= $value['cat_id'] ?>"><?= $value['cat_name'] ?></option>
		    <?php endforeach; ?>
		</select><br />
		<label>Cast du film:</label><br/>
		<input type="text" name="mov_cast" value="<?= $movieSelect['mov_cast'] ?>"/><br />
		<label>Synopsis du film:</label><br/>
		<input type="text" name="mov_synopsis" value="<?= $movieSelect['mov_synopsis'] ?>"/><br />
		<label>Chemin vers film:</label><br/>
		<input type="text" name="mov_path" value="<?= $movieSelect['mov_path']?>"/><br />
		<label>Titre original du film:</label><br/>
		<input type="text" name="mov_original_title" value="<?= $movieSelect['mov_original_title'] ?>"/><br />
		<label>Type de stockage du film:</label><br/>
		<select name="sto_id">
			<option value="<?= $movieSelect['sto_id']?>">Support Actuel: <?= $movieSelect['sto_name']?></option>
		    <?php foreach ($stoList as $key => $value) :?>
		    <option value="<?= $value['sto_id'] ?>"><?= $value['sto_name'] ?></option>
		    <?php endforeach; ?>
		</select><br />

		<label>Image du film:</label><br/>
		<input type="text" name="mov_image" value="<?= $movieSelect['mov_image']?>"/><br/><br/>
		<img height="120px" width="85px" src="<?= $movieSelect['mov_image']?>"><br/><br/>
		<input type="submit" value="Valider">
	</fieldset>
</form>
