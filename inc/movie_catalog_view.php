<h1>Movie Catalog</h1>

<section>
	<form action="" method="get">
		<fieldset>
			<span>Tri par date</span>
			<select name="tri_date">
				<option value="ASC">ASC</option>
				<option value="DESC" <?= $dateMaj == 'DESC' ? ' selected="selected"' : '' ?> >DESC</option>
			</select>
			<input type="submit" value="OK" />
		</fieldset>
	</form>
	<br />
</section>

<div class="container">

	<p> Il y a <?php echo count($movieList); ?> résultat(s) sur cette page.</p>

	<table>
	<?php foreach ($movieList as $key => $value): ?>
		<tr>
			<td class="img-container"> <img src="<?= $value['mov_image']?>" alt=""> </td>
			<td>
				<table>
					<tr>
						<td> Anne de sortie : TBA</td>
					</tr>
					<tr>
						<td>
							<h3> 
								<?= '#'.$value['mov_id'].' '.$value['mov_title']?> 
							</h3> 
						</td>
					</tr>
					<tr>
						<td><?= $value['mov_synopsis']?></td>
					</tr>
				</table>
			</td>
			<td>
				<table>
					<tr>
						<td> <a href="movie_single.php?mov_id=<?= $value['mov_id']?>"> Details </a> </td>
					</tr>
					<tr>
						<td><a href="update.php?mov_id=<?= $value['mov_id']?>"> Modifier </a></td>
					</tr>
				</table>
			</td>
		</tr>
	<?php endforeach ?>
	</table>
	<?php
			
		if($currentPage !== 1) { 

	?>
			<a href="movie_catalog.php?page=<?=($currentPage-1) ?>">Précedent</a>

		<?php } ?>

			<a href="movie_catalog.php?page=<?=($currentPage+1) ?>">Suivant</a>

		
</div>