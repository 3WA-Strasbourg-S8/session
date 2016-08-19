<?php
// ETAPE 1 - Vérification de la présence des paramètres $_POST
if (isset($_POST['email'], $_POST['password']))
{
	// ETAPE 2 - Vérification du contenu des paramètres
	$email = $_POST['email'];
	$password = $_POST['password'];
	if (empty($email))
		$error = "Email incorrect";
	else if (empty($password))
		$error = "Password incorrect";
	else
	{
		// ETAPE 3 - Traitement avec le JSON
		$json = file_get_contents('users.json');
		$list = json_decode($json, true);
		$count = 0;
		$max = sizeof($list);
		while ($count < $max)
		{
			$user = $list[$count];
			if ($user['email'] == $email)
			{
				if ($user['password'] == $password)
				{
					$_SESSION['login'] = $user['login'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['gender'] = $user['gender'];
					// ETAPE 4 - Redirection en cas de succès
					header("Location: index.php");
					exit;
				}
				else
					$error = 'Incorrect Password';
			}
			$count++;
		}
		$error = 'Incorrect Email';
	}
}
?>