<?php
// ETAPE 1 - Vérification de la présence des paramètres $_POST
if (isset($_POST['email'], $_POST['login'], $_POST['birthdate'], $_POST['password1'], $_POST['password2']))
{
	// ETAPE 2 - Vérification du contenu des paramètres
	$email = $_POST['email'];
	$login = $_POST['login'];
	$birthdate = explode('-', $_POST['birthdate']);
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	if (!isset($_POST['gender']))
		$error = "Incorrect Gender";
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		$error = "Incorrect Email";
	else if (strlen($login) < 4)
		$error = "Login too short (< 4)";
	else if (strlen($login) > 16)
		$error = "Login too long (> 16)";
	else if (strlen($password1) < 6)
		$error = "Password too short (< 6)";
	else if (strlen($password1) > 32)
		$error = "Password too long (> 32)";
	else if ($password1 != $password2)
		$error = "Password don't match";
	else if ($password1 != $password2)
		$error = "Password don't match";
	else if (!checkdate($birthdate[1], $birthdate[2], $birthdate[0]))
		$error = "Incorrect Birthdate";
	else
	{
		$gender = $_POST['gender'];
		$user = [
			"email"=>$email,
			"login"=>$login,
			"password"=>$password1,
			"birthdate"=>$birthdate,
			"gender"=>$gender
		];
		// ETAPE 3 - Traitement avec le JSON
		$json = file_get_contents('users.json');
		$list = json_decode($json, true);
		$list[] = $user;
		$json = json_encode($list);
		file_put_contents('users.json', $json);
		// ETAPE 4 - Redirection en cas de succès
		header("Location: index.php?page=login");
		exit;
	}
}
?>