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

  switch ($get_type) {
    case 'sensor':
      $sql =  "INSERT INTO test (name,value) VALUES (:name,:value)";
      break;

    case 'camera':
      $sql =  "INSERT INTO $tbn_selecter (date, time, camera_id, sex_id, age, neutral, happiness, surprise, anger, sadness, emotion) VALUES (current_date(), current_time(), :camera_id, :sex_id, :age, :neutral, :happiness, :surprise, :anger, :sadness, :emotion)";
      break;

    case 'julius':
      $sql =  "INSERT INTO $tbn_selecter (date, time, mic_id, word_id, word_rbd) VALUES (current_date(), current_time(), :mic_id, :word_id, :word_rbd)";
      break;

    default:
      $sql =  "INSERT INTO test (name,value) VALUES (:name,:value)";
      break;
  }
  $stmt = $dbh->prepare($sql);
  foreach($json_data_d as $key => $value){
  $param[$key] = $value;
  }
  $stmt->execute($param);
  }

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;
