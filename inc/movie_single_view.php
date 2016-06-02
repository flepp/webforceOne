<form action="" method="">
	<fieldset>
		<legend>Infos du film</legend>
		<img height="240px" width="180px" src="<?= $movieSelect['mov_image']?>">
		<input type="text" name="mov_title" value="<?= $movieSelect['mov_title'] ?>"/><br />
		<input type="text" name="cat_id" value="<?= $movieSelect['cat_name']?>"/><br />
		<input type="text" name="mov_cast" value="<?= $movieSelect['mov_cast'] ?>"/><br />
		<input type="text" name="mov_synopsis" value="<?= $movieSelect['mov_synopsis'] ?>"/><br />
		<input type="text" name="mov_path" value="<?= $movieSelect['mov_path']?>"/><br />
		<input type="text" name="mov_original_title" value="<?= $movieSelect['mov_original_title'] ?>"/><br />
		<input type="text" name="mov_image" value="<?= $movieSelect['mov_image']?>"/><br />
	</fieldset>
</form>
