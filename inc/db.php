<?php 
	try {
		$dsn = 'mysql:dbname=webforceone_sql1;host=localhost;';
		$pdo = new PDO($dsn, 'root', 'blob');
	} catch (Exception $e) {
		echo 'Error: '.$e->getmessage();
	}
 ?>