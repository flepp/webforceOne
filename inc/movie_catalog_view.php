<table border="1">
	<thead>
		<tr>
			<td> Titre</td>
			<td> Titre Original</td>
			<td> Genre</td>
			<td> Synopsis</td>
			<td> Couverture</td>
		</tr>
	</thead>

	<tbody>
		<?php foreach($catalogList as $currentSearch) : ?>
			<tr>
				<!-- Lien vers la page movie_single.php pour renseigner l'id de mon film afin de l'afficher sur sa page unique -->
				<td><a href="movie_single.php?mov_id=<?= $currentSearch['mov_id']?>"><?= $currentSearch['mov_title'] ?></a></td>
				<td><?= $currentSearch['mov_original_title'] ?></td>
				<td><?= $currentSearch['cat_name'] ?></td>
				<td><?= $currentSearch['mov_synopsis'] ?></td>
				<td><img style="height: 100px" src="<?= $currentSearch['mov_image'] ?>"></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>