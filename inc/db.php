<?php 
	try {
		$dsn = 'mysql:dbname=DBB;host=localhost;';
		$pdo = new PDO($dsn, 'pseudo', 'pass');
	} catch (Exception $e) {
		echo 'Error: ' $e->getmessage();
	}
 ?>