
<h1>Gestion des catégories</h1>
<!-- Menu deroulant des categories -->
<form action="" method="get">
	<select name="cat_id">
		<option value="0">ajout d'une catégorie</option>
		<!-- Je fais le remplissage du menu deroulant -->
		<?php foreach ($allCategoriesList as $currentCategory) : ?>
		<option value="<?= $currentCategory['cat_id']; ?>"<?= $currentId == $currentCategory['cat_id']?>><?= $currentCategory['cat_name']; ?></option>
		<?php endforeach; ?>
	</select>
	<input type="submit" value="OK"/>
</form>

<form action="" method="post">
	<fieldset>
		<input type="hidden" name="cat_id" value="<?= $currentId; ?>"/><br />
		<table>
			<tr>
				<td>Nom catégorie:</td>
				<td><input type="text" name="cat_name" value="<?= $categoryName; ?>"/></td>
			</tr>
		</table>
		<button type="submit">Valider</button>
	</fieldset>
</form>

