<!DOCTYPE html>
<html lang="ja";>
<head>
  <meta charset="utf-8">
  <title>dbsumbit</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/status_style.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<h1>connect test</h1>

<?php

function is_json($string){
    return is_string($string) && is_array(json_decode($string,true)) ? true : false;
}

$get_type = $_GET['iam'];

switch ($get_type) {
  case "sencer":
    $tbn_selecter = "esp32";
    break;
  case "camera":
    $tbn_selecter = "hvc_p2";
    break;
  case "julius":
    $tbn_selecter = "julius";
    break;
  case "sex":
    $tbn_selecter = "sex";
    break;
  default:
    $tbn_selecter = "item_info";
    break;
}


$json_data = file_get_contents('php://input','r');

if(is_json($json_data)){
$json_data_d = json_decode($json_data,true);
}

$dsn = "mysql:host=localhost;dbname=tinyretail;charset=utf8";	// Database name
$user = "root";						// Databese User Name
$password = "mysql0001";				// Database Password
$param = array();
try{

  $dbh = new PDO($dsn, $user, $password); // Database Connect (Make object)

  $sql =  "INSERT INTO $tbn_selecter (date,time,unique_id,mic_id,word_id) VALUES (:date,:time,:unique_id,:mic_id,:word_id)";
  $stmt = $dbh->prepare($sql);

  foreach($json_data_d as $key => $value){
  $param[$key] = $value;
  }
  $stmt->execute($param);
  $sql =  "SELECT * FROM $tbn_selecter";
  foreach ($dbh->query($sql,PDO::FETCH_ASSOC) as $row) {
    var_dump($row);
  }

echo ('<br>');
echo ('<br>');

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;

?>
</body>
</html>
