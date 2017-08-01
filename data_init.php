<!DOCTYPE html>
<html lang='ja'>
<head>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php

$dsn = 'mysql:dbname=tinyretail;host=localhost;charset=utf8';
$user = 'root';
$pass = 'mysql0001';
$ary_age = array(0,0,0,0,0,0,0,0,0,0);
$ary_facial_expression = array(0,0,0,0,0);

try{

  $dbh = new PDO($dsn,$user,$pass);
  $sql = 'SELECT * FROM hvc_p2 INNER JOIN sex ON hvc_p2.sex_id = sex.sex_id';

  foreach ($dbh->query($sql,PDO::FETCH_ASSOC) as $row) {
    if($row['sex_val'] == '男'){
      $count_men++;
    }elseif($row['sex_val'] == '女'){
      $count_ladies++;
    }else{
      $count_other++;
    }
    $ary_age[round($row['age']/10)] += 1;
    $ave_age = $ave_age + $row['age'];
    $count++;
  }

  $sql = 'SELECT * FROM hvc_p2';
  foreach ($dbh->query($sql,PDO::FETCH_ASSOC) as $row) {
    if (key($row) == 'neutral'){
      $ary_facial_expression[0]++;
    } elseif (key($row) == 'happiness'){
      $ary_facial_expression[1]++;
    } elseif (key($row) == 'surprise'){
      $ary_facial_expression[2]++;
    } elseif (key($row) == 'anger') {
      $ary_facial_expression[3]++;
    } elseif (key($row) == 'sadness') {
      $ary_facial_expression[4]++;
    }
  }


}catch (PDOException $e){
    print('Error:'.$e->Message());
    die();
}

$dbh = null;
$ave_age = $ave_age / $count;
$encoded_age = json_encode($ave_age);
?>
<script>
  var ary_facial_expression = JSON.parse('<?php echo $ary_facial_expression ?>');
  var ary_age = JSON.parse('<?php echo $encoded_age ?>');
  var data_men = "<?php echo json_encode($count_men); ?>";
  var data_ladies = "<?php echo json_encode($count_ladies); ?>";
  var data_unknown = "<?php echo json_encode($count_other); ?>";
  var ave_age = "<?php echo json_encode($ave_age); ?>";
  var cnt_entrance = "<?php echo json_encode($count); ?>";
</script>
</body>
</html>
