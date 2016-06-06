<form action="" method="post">
	<fieldset>
		<legend>Infos du film</legend>

		<img height="240px" width="180px" src="<?= $movieSelect['mov_image']?>">
		<h2>
			Titre : <?= $movieSelect['mov_title'] ?>
		</h2>
		<br />
		<h3>
			Titre original : <?= $movieSelect['mov_original_title'] ?>
		</h3>
		<br />

		<div>
			Genre : <?= $movieSelect['cat_name'] ?>
		</div>
		<br />
		<div>
			Acteurs : <?= $movieSelect['mov_cast'] ?>
		</div>
		<br />
		<div>
			Descritption : <?= $movieSelect['mov_synopsis'] ?>
		</div>
		<br />
		<div>
			Chemin : <?= $movieSelect['mov_path'] ?>
		</div>
		<br>
		<div>
			Support de stockage : <?= $movieSelect['sto_name'] ?>
		</div>
		<br />
	</fieldset>
</form>
