<!DOCTYPE html>
<html lang="ja";>
<head>
	<meta charset="utf-8">
	<title>db sumbit</title>
</head>
<body>
  <h1>db submit</h1>

<?php
$dsn = 'mysql:dbname=kcg_pro34_database;host=localhost';	// Database name
$user = 'kcgpro34user';																		// Databese User Name
$password = 'pro34';																			// Database Password
$dbh = new PDO($dsn, $user, $password);							 // Database Connect (Make object)
