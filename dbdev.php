<?php

function is_json($string){
    return is_string($string) && is_array(json_decode($string,true)) ? true : false;
}
$get_type = $_GET['iam'];
$json_data = file_get_contents('php://input','r');

if(is_json($json_data)){
$json_data_d = json_decode($json_data,true);
}

$dsn = 'mysql:dbname=dev;host=localhost;charset=utf8';
$user = 'root';
$pass = 'mysql0001';

try{
  $dbh = new PDO($dsn,$user,$pass);

  switch ($get_type) {
    case 'sensor':
      $sql =  "INSERT INTO test (name,value) VALUES (:name,:value)";
      break;

    case 'camera':
      $sql =  "INSERT INTO test_camera (name,value) VALUES (:name,:value)";
      break;

    case 'julius':
      $sql =  "INSERT INTO test_julius (name,value) VALUES (:name,:value)";
      break;

    default:
      $sql =  "INSERT INTO test (name,value,text) VALUES (:name,:value,:text)";
      break;
  }
  $stmt = $dbh->prepare($sql);

var_dump($json_data_d);

  foreach($json_data_d as $name => $values){
  $param = array(':name' => $name,':value' => $values);
  $stmt->execute($param);
  }

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;

