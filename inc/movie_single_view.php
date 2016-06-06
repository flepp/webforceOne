<form action="" method="" <?php if($formValid == false){ echo "hidden";} ?>>
	<fieldset>
		<legend>Infos du film</legend>
		<img height="240px" width="180px" src="<?= $movieList['mov_image']?>">
		<iframe width="420" height="315" src="<?= $movieList['mov_path'] ?>" frameborder="0" allowfullscreen></iframe>
		<h2>
			<?= $movieList['mov_title'] ?>
		</h2>
		<br />
		<h3>
			<?= $movieList['mov_original_title'] ?>
		</h3>
		<br />
		<div>
			<?= $movieList['cat_name'] ?>
		</div>
		<br />
		<div>
			<?= $movieList['mov_cast'] ?>
		</div>
		<br />
		<div>
			<?= $movieList['mov_synopsis'] ?>
		</div>
		<br />
		<br />
		<br />
		<a href="update.php?mov_id=<?= $movieList['mov_id'] ?>">MIS A JOUR</a>
	</fieldset>
</form>
