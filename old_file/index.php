<!DOCTYPE html>
<html lang="ja";>
<head>
	<meta charset="utf-8">
	<title>php data view</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/status_style.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

	<script src="js/react.js"></script>
	<script src="js/react-dom.js"></script>
	<script src="js/JSXTransformer.js"></script>
	<script src="jsx/app.js" type="text/jsx"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.34/browser.min.js"></script>

	<div id="test">

	</div>

	<h1> test data view </h1>

	<p>Show Database</p>

  <!-- React Write -->

<?php
//phpinfo();
$dsn = 'mysql:dbname=kcg_pro34_database;host=localhost';	// Database name
$user = 'kcgpro34user';																		// Databese User Name
$password = 'pro34';																			// Database Password

date_default_timezone_set('Asia/Tokyo');
echo date("Y-m-d G:i:s");
echo ("<br />");

	try{
		$dbh = new PDO($dsn, $user, $password);								//	Database Connect (Make object)
		$sql = 'select * from data_group';

		foreach ($dbh->query($sql) as $row) {

			print($row['id'].' , ');
			print($row['sex'].' , ');
			print($row['age'].' , ');
			print($row['datetime'].' , ');
			print($row['pickuptime']);
			print('<br />');
		}

	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}

$dbh = null;
echo ("<div id='post_data_output'>");
echo $_POST["post_data"];
echo ("</class>");
?>

</body>
</html>
