<!DOCTYPE html>
<html lang='ja'>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Project Ex TinyRetail Test</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/status_style.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script src="js/JSXTransformer.js"></script>
  <script src="jsx/app.js" type="text/jsx"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.34/browser.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

</head>
<?php

function is_json($string){
    return is_string($string) && is_array(json_decode($string,true)) ? true : false;
}
$get_type = $_GET['iam'];

// switch ($get_type) {
//   case "sensor":
//     echo('sensor');
//     echo('<br>');
//     break;
//   case "camera":
//     echo('camera');
//     echo('<br>');
//     break;
//   case "julius":
//     echo('julius');
//     echo('<br>');
//     break;
//   default:
//     echo('<br>');
//     break;
// }

$json_data = file_get_contents('php://input','r');

if(is_json($json_data)){
$json_data_d = json_decode($json_data,true);
}
echo("text : ");
var_dump($json_data);
echo("<br>");

echo("json : ");
var_dump($json_data_d);
echo("<br>");

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
      $sql =  "INSERT INTO test (name,value) VALUES (:name,:value)";
      break;

    default:
      $sql =  "INSERT INTO test (name,value) VALUES (:name,:value)";
      break;
  }
  $stmt = $dbh->prepare($sql);

  foreach($json_data_d as $name => $values){
  $param = array(':name' => $name,':value' => $values);
  $stmt->execute($param);
  }

  $sql = 'SELECT * FROM test';
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
