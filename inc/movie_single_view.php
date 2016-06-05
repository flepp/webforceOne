<form action="" method="">
	<fieldset>
		<legend>Infos du film</legend>
		<img height="240px" width="180px" src="<?= $movieSelect['mov_image']?>">
		<h2>
			<?= $movieSelect['mov_title'] ?>
		</h2>
		<br />
		<h3>
			<?= $movieSelect['mov_original_title'] ?>
		</h3>
		<br />
		<div>
			<?= $movieSelect['cat_name'] ?>
		</div>
		<br />
		<div>
			<?= $movieSelect['mov_cast'] ?>
		</div>
		<br />
		<div>
			<?= $movieSelect['mov_synopsis'] ?>
		</div>
		<br />
		<div>
			<?= $movieSelect['mov_path'] ?>
		</div>
		<br />
	</fieldset>
</form>
