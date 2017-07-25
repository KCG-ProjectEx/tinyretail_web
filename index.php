<!DOCTYPE html>
<html lang='ja'>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="assets/css/main.css" rel="stylesheet" />
  <noscript><link href="assets/css/noscript.css" rel="stylesheet" /></noscript>

  <title>Project Ex TinyRetail Test</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

<!--  <script src="js/react.js"></script> -->
<!--  <script src="js/react-dom.js"></script> -->
  <script src="js/JSXTransformer.js"></script>
  <script src="jsx/app.js" type="text/jsx"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.34/browser.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

</head>
<body>
<?php

$dsn = 'mysql:dbname=tinyretail;host=localhost;charset=utf8';
$user = 'root';
$pass = 'mysql0001';
$age_array = array(0,0,0,0,0,0,0,0,0,0);

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
    $age_array[round($row['age']/10)] += 1;
    $age_avarage = $age_avarage + $row['age'];
    $count++;
  }

  $sql = 'SELECT * FROM hvc_p2';
  foreach ($dbh->query($sql,PDO::FETCH_ASSOC) as $row) {
    $happy += $row['happiness'];
    $sad += $row['sadness'];
  }


}catch (PDOException $e){
    print('Error:'.$e->Message());
    die();
}

$dbh = null;
$age_avarage = $age_avarage / $count;
$encoded_age = json_encode($age_array);
?>
<script>
  var agearray = JSON.parse('<?php echo $encoded_age?>');
  var dataheadmen = "men";
  var datamen = "<?php echo json_encode($count_men); ?>";
  var dataheadladies = "ladies";
  var dataladies = "<?php echo json_encode($count_ladies); ?>";
  var dataheadunknown = "unknown";
  var dataunknown = "<?php echo json_encode($count_other); ?>";
</script>

<div id="wrapper">
    <!-- Nav -->
    <nav id="nav">
      <a href="#maingraph" class="icon fa-user-circle"><span>Guestcount</span></a>
      <a href="#subgraph_0" class="icon fa-area-chart"><span>Age</span></a>
      <a href="#subgraph_1" class="icon fa-user-circle"><span>Guestcount</span></a>
      <a href="#subgraph_2" class="icon fa-area-chart"><span>Age</span></a>
      <!-- <a href="#" class="icon "><span>Twitter</span></a> -->
    </nav>
    <!-- Main -->
  	<div id="main">
      <!-- Me -->
      <article id="maingraph" class="panel">
        <header>
          <h1>来店者数</h1>
        </header>
        <div id="graph_1">
          <canvas id="firstGraphCanvas"></canvas>
          <script id="firstGraph" src="js/first_graph.js"></script>
        </div>
      </article>
      <!-- Work -->
      <article id="subgraph_0" class="panel">
        <header>
          <h1>年齢分布</h1>
        </header>
        <div id="graph_2">
          <canvas id="secondGraphCanvas"></canvas>
          <script id="secondGraph" src="js/second_graph.js"></script>
        </div>
      </article>
    </div>
     <!-- Footer -->
  	<div id="footer">
  	</div>
</div>
<!-- Scripts -->
	<!-- <script src="assets/js/jquery.min.js"></script> -->
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/skel-viewport.min.js"></script>
	<script src="assets/js/util.js"></script>
	<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
	<script src="assets/js/main.js"></script>
</body>
</html>
