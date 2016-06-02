<?php 
	try {
		$dsn = 'mysql:dbname=webforceone_sql1;host=192.168.210.84;';
		$pdo = new PDO($dsn, 'webforceone', 'webforce3');
	} catch (Exception $e) {
		echo 'Error: '.$e->getmessage();
	}
 ?>

