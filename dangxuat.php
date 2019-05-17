<?php
session_start();
session_destroy();
 
	if (isset($_COOKIE['is_login']))
		setcookie('is_login', $_SESSION['NAME'], time() - (3600),'/');
header('location:index.php');

?>