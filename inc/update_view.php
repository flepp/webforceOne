<?php

require 'header.php';
require 'footer.php';

?>
<form action="" method="post">
	<fieldset>
		<legend>Modifier les infos du film</legend>
		<input type="text" name="mov_title" value="" placeholder="$Title" /><br />
		<input type="text" name="mov_cast" value="" placeholder="$Cast" /><br />
		<input type="text" name="mov_synopsis" value="" placeholder="$Synopsis" /><br />
		<input type="text" name="mov_original_title" value="" placeholder="$OriginalTitle" /><br />
		<input type="submit" value="Valider">
	</fieldset>
</form>

