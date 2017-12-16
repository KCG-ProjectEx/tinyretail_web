<!DOCTYPE html>
<html lang="ja";>
<head>
  <meta charset="utf-8">
</head>
<body>

<?php

function is_json($string){
    return is_string($string) && is_array(json_decode($string,true)) ? true : false;
}

$json_data = file_get_contents('php://input','r');
if(is_json($json_data)){
  $json_data_d = json_decode($json_data,true);
}
$get_type = $_GET['iam'];

$dsn = "mysql:host=localhost;dbname=tinyretail;charset=utf8"; // Database name
$user = "root";           // Databese User Name
$password = "mysql0001";        // Database Password
$dbh = new PDO($dsn, $user, $password); // Database Connect (Make object)

switch ($get_type) {
  case 'sensor':
//    $sql = "INSERT INTO indoor_sensor_node (date, time, temperature, humidity, illuminance, atm, booth_id) VALUES (curdate(), curtime(), :temperature, :humidity, :illuminance, :atm, :booth_id)";
    $sql = "INSERT INTO indoor_sensor_node (date, time, temperature, humidity, illuminance) VALUES (curdate(), curtime(), :temperature, :humidity, :illuminance)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':temperature', $json_data_d['temperature'], PDO::PARAM_INT);
    $stmt->bindValue(':humidity', $json_data_d['humidity'], PDO::PARAM_INT);
    $stmt->bindValue(':illuminance', $json_data_d['illuminance'], PDO::PARAM_INT);
//    $stmt->bindValue(':atm', $json_data_d['atm'], PDO::PARAM_INT);
//    $stmt->bindValue(':booth_id', $json_data_d['booth_id'], PDO::PARAM_INT);
    break;

  case 'camera':
    $sql = "INSERT INTO hvc_p2 (date, time, camera_id, sex_id, age, neutral, happiness, surprise, anger, sadness, face_x, face_y, face_size, face_rbd, stabilization, emotion) VALUES (curdate(), curtime(), :camera_id, :sex_id, :age, :neutral, :happiness, :surprise, :anger, :sadness, :face_x, :face_y, :face_size, :face_rbd, :stabilization, :emotion)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':camera_id', $json_data_d['camera_id'], PDO::PARAM_INT);
    $stmt->bindValue(':sex_id', $json_data_d['sex_id'], PDO::PARAM_INT);
    $stmt->bindValue(':age', $json_data_d['age'], PDO::PARAM_INT);
    $stmt->bindValue(':neutral', $json_data_d['neutral'], PDO::PARAM_INT);
    $stmt->bindValue(':happiness', $json_data_d['happiness'], PDO::PARAM_INT);
    $stmt->bindValue(':surprise', $json_data_d['surprise'], PDO::PARAM_INT);
    $stmt->bindValue(':anger', $json_data_d['anger'], PDO::PARAM_INT);
    $stmt->bindValue(':sadness', $json_data_d['sadness'], PDO::PARAM_INT);
    $stmt->bindValue(':face_x', $json_data_d['face_x'], PDO::PARAM_INT);
    $stmt->bindValue(':face_y', $json_data_d['face_y'], PDO::PARAM_INT);
    $stmt->bindValue(':face_size', $json_data_d['face_size'], PDO::PARAM_INT);
    $stmt->bindValue(':face_rbd', $json_data_d['face_rbd'], PDO::PARAM_INT);
    $stmt->bindValue(':stabilization', $json_data_d['stabilization'], PDO::PARAM_INT);
    $stmt->bindValue(':emotion', $json_data_d['emotion'], PDO::PARAM_INT);    
    break;

  case 'julius':
    $sql = "INSERT INTO julius (date, time, mic_id, sentence, is_poji, favor) VALUES (curdate(), curtime(), :mic_id, :sentence, :is_poji, :favor)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':mic_id', $json_data_d['mic_id'], PDO::PARAM_INT);
    $stmt->bindValue(':sentence', $json_data_d['sentence'], PDO::PARAM_STR);
    $stmt->bindValue(':is_poji', $json_data_d['is_poji'], PDO::PARAM_INT); 
    $stmt->bindValue(':favor', $json_data_d['favor'], PDO::PARAM_STR[10]);

    break;

  default:
    break;
}

try{

  $stmt->execute();

}catch (PDOException $e){
  print('Error:'.$e->getMessage());
  die();
}

$dbh = null;

?>
</body>
</html>
