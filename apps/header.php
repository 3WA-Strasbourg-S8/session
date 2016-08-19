<?php
if (isset($_SESSION['email']))
	require('views/header_in.phtml');
else
	require('views/header.phtml');
?>