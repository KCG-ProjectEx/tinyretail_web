<!DOCTYPE html>
<html lang="ja";>
<head>
	<meta charset="utf-8">
	<title> post php </title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
<h1> post test </h1>

<form action="index.php" method="post">

	<div class="form-group">
		<label for="ExampleText">InputText</label>
		<p><input type="text" name="post_data" class="form-control"></p>
	</div>
	<input type="submit" name="postsend" value="postsend">
</form>

<?php

?>
<script>

</script>
</body>
</html>
