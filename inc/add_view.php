<p>I'm add view</p>

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
		<input type="text" name="movieDateCr" value="" placeholder="Date création"><br />
		<input type="text" name="movieDateUpdt" value="" placeholder="Date mise à jour"><br />
		<button type="submit"> Ajouter </button>
	</fieldset>
</form>