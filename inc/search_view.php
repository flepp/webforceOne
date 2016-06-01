<?php if(!empty($_GET['search'])) ?>
	<?php if(!isset($nbRows)) : ?>
		<p>Voici le résultat de votre recherche "<?= $search ?>", il y a 0 élément trouvé !</p>
	<?php else: ?>
		<p>Voici le résultat de votre recherche "<?= $search ?>", il y a <?= $nbRows ?> élément(s) trouvé(s) !</p>
	<?php endif; ?>
<?php endif ?>



 