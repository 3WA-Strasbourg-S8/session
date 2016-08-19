<?php
session_start();
$error = '';
$page = 'home';
$access = ["home", "login", "register", "logout"];
if (isset($_GET['page']) && in_array($_GET['page'], $access))
	$page = $_GET['page'];
$accessTraitement = ["login", "register", "logout"];
if (in_array($page, $accessTraitement))
	require('apps/traitement_'.$page.'.php');
require('apps/skel.php');
?>