<div class="container">
	<p class="intro-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	<form method="get" action="search.php" class="search-bar">
		<input type="text" name="search" placeholder="Recherche"></input>
		<button type="submit">ok</button>
	</form>
	<ul class="index-categories">
		<?php foreach($listCat as $key => $value) : ?>
		<li><a href="movie_catalog.php?cat_id=<?= $value['cat_id']?>"><?= $value['cat_name'] ?>(<?= $value['nb_movie'] ?>)</a></li>
		<?php endforeach; ?>
	</ul>
	<div class="index-link-container">
		<?php foreach($listMovie as $currentSearch) : ?>
		<div class="imgLink">
			<img  src="<?= $currentSearch['mov_image'] ?>">
			<a href="movie_single.php?mov_id=<?= $currentSearch['mov_id']?>"><?= $currentSearch['mov_title'] ?></a>
		</div>
		<?php endforeach; ?>
	</div>
</div>