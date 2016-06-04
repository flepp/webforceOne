
<form action="" method="post">
	<fieldset>
		<legend>Modifier les infos du film</legend>
		<input type="text" name="mov_title" value="<?= $movieSelect['mov_title'] ?>"/><br />

		<select name="cat_id">
		    <?php foreach ($catSelect as $value) :?>
		    <option value="<?= $value['cat_id']?>">
		    	<?= $value['cat_name']?>
		    </option>
		    <?php endforeach; ?>
		</select><br />

		<input type="text" name="mov_cast" value="<?= $movieSelect['mov_cast'] ?>"/><br />
		<input type="text" name="mov_synopsis" value="<?= $movieSelect['mov_synopsis'] ?>"/><br />
		<input type="text" name="mov_path" value="<?= $movieSelect['mov_path']?>"/><br />
		<input type="text" name="mov_original_title" value="<?= $movieSelect['mov_original_title'] ?>"/><br />
		<input type="text" name="mov_image" value="<?= $movieSelect['mov_image']?>"/><br />
		<img height="120px" width="90px" src="<?= $movieSelect['mov_image']?>">
		<input type="submit" value="Valider">
	</fieldset>
</form>
