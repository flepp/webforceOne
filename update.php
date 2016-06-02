<!DOCTYPE html>
<html>
<head>
	<title>Update Movie</title>
	<meta charset="utf-8">
</head>
<body>
	<pre>
<?php
require 'inc/db.php';
require 'update_view.php';

if (!empty($_GET['mov_id'])) {
	$Title = $_GET['mov_id'];

	$sql = '
	SELECT mov_title
	FROM movie
	WHERE mov_id = :movieId
	';
	$movieEdit = $pdo->prepare($sql);
	$movieEdit->execute();
	$movieEdit->fetchAll();

	// Si le formulaire a été soumis
	if (!empty($_POST)) {
		// Je récupère tous les champs du formulaires
		// si isset($_POST['mov_title']) == true alors récupère la valeur de $_POST['mov_title'], sinon, la valeur ''
		$Title = isset($_POST['mov_title']) ? $_POST['mov_title'] : '';
		$Cast = isset($_POST['mov_cast']) ? $_POST['mov_cast'] : '';
		$Synopsis = isset($_POST['mov_synopsis']) ? $_POST['mov_synopsis'] : '';
		$OriginalTitle = isset($_POST['mov_original_title']) ? $_POST['mov_original_title'] : '';

		if (empty($errorList)) {
			echo 'je peux modifier la DB<br />';

			//écrire la requête préparée "UPDATE" qui va modifier la fiche du film dans le tableau $movie[0], dans la base de données.

			$movieUpdate = $pdo->prepare("UPDATE movie (mov_title, mov_cast, mov_synopsis, mov_original_title) VALUES (:Title, :Cast, :Synopsis, :OriginalTitle)");

			$movieUpdate->bindValue(':Title',$Title);
			$movieUpdate->bindValue(':Cast',$Cast);
			$movieUpdate->bindValue(':Synopsis',$Synopsis);
			$movieUpdate->bindValue(':OriginalTitle',$OriginalTitle);
			
			$movieUpdate->execute();
			echo "Fiche du film modifiée<br />";
		}
	}
}

/*********************/

// Je récupère le token spécifié dans l'URL

	if (!empty($_GET['mov_id'])) {
	$Title = $_GET['mov_id'];

	$sql = '
	SELECT mov_title
	FROM movie
	WHERE mov_id = :movieId
	';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':token', $token);

	if ($stmt->execute()) {
		if ($stmt->rowCount() > 0) {
			// Formulaire soumis
			if (!empty($_POST)) {
				print_r($_POST);
				$password = isset($_POST['passwordToto']) ? trim($_POST['passwordToto']) : '';
				$password2 = isset($_POST['passwordToto2']) ? trim($_POST['passwordToto2']) : '';

				if (!empty($password)) {
					if ($password == $password2) {
						// Je récupère l'id
						$userInfos = $stmt->fetch();

						$sql = '
							UPDATE user
							SET usr_password = :password,
							usr_token = ""
							WHERE usr_id = :id
						';
						$stmt = $pdo->prepare($sql);
						$stmt->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
						$stmt->bindValue(':id', $userInfos['usr_id']);
						$stmt->execute();

						echo 'votre mot de passe a été modifié<br>';
					}
					else {
						echo 'Vos mots de passe sont différents<br>';
					}
				}
				else {
					echo 'mot de passe vide<br>';
				}
			}
			?>

	<form method="post" action="">
	<fieldset>
		<legend>User password change</legend>
		<input type="password" name="passwordToto" placeholder="Your password" value=""><br>
		<input type="password" name="passwordToto2" placeholder="Confirm your password" value=""><br>
		<input type="submit" value="Change">
	</fieldset>
	</form>
			<?php
		}
		else {
			echo 'Votre lien n\'est plus valable<br>';
		}
	}
}
else {
	// Redirection
	header('Location: login.php');
	exit;
}
?>