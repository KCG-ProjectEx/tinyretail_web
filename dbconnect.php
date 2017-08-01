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

$json_data = file_get_contents('php://input','r');

if(is_json($json_data)){
$json_data_d = json_decode($json_data,true);
}
$get_type = $_GET['iam'];

switch ($get_type) {
  case "sencer":
    $tbn_selecter = "esp32";
    $sql =  "INSERT INTO $tbn_selecter (name,value) VALUES (:name,:value)";
    $keys = array();
    break;

  case "camera":
    $tbn_selecter = "hvc_p2";
    $sql =  "INSERT INTO $tbn_selecter (date, time, camera_id, sex_id, age, neutral, happiness, surprise, anger, sadness, emotion) VALUES (current_date(), current_time(), :camera_id, :sex_id, :age, :neutral, :happiness, :surprise, :anger, :sadness, :emotion)";
    $keys = array(':camera_id', ':sex_id', ':age', ':neutral', ':happiness', ':surprise', ':anger', ':sadness', ':emotion');
    break;

  case "julius":
    $tbn_selecter = "julius";
    $sql =  "INSERT INTO $tbn_selecter (date, time, mic_id, word_id, word_rbd) VALUES (current_date(), current_time(), :mic_id, :word_id, :word_rbd)";
    $keys = array(':mic_id', ':word_id', ':word_rbd');
    break;

  default:
    $sql =  "INSERT INTO $tbn_selecter (name,value) VALUES (:name,:value)";
    $tbn_selecter = "test";
    break;
}

$dsn = "mysql:host=localhost;dbname=tinyretail;charset=utf8"; // Database name
$user = "root";           // Databese User Name
$password = "mysql0001";        // Database Password
try{

  $dbh = new PDO($dsn, $user, $password); // Database Connect (Make object)
  $stmt = $dbh->prepare($sql);
  $param = array_combine($keys, $json_data_d);
  $stmt->execute($param);

}catch (PDOException $e){
  print('Error:'.$e->getMessage());
  die();
}

$dbh = null;

?>
</body>
</html>
