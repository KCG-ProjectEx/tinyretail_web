<!DOCTYPE html>
<html lang="jp">
<head>
    <title>Project Ex TinyRetail Test</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css" rel="stylesheet" />

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="commons/css/materialize.min.css"  media="screen,projection"/>

    <!--カレンダーCSS  -->
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/blitzer/jquery-ui.css" >
    <link type="text/css" rel="stylesheet" href="css/style.css"/>

    <!--icon  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
<?php

$dsn = 'mysql:dbname=tinyretail;host=localhost;charset=utf8';
$user = 'root';
$pass = 'mysql0001';
$border = 1;
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
    if (intval($row['neutral']) >= $border){
      $ary_facial_expression[0]++;
    }
    if (intval($row['happiness']) >= $border){
      $ary_facial_expression[1]++;
    }
    if (intval($row['surprise']) >= $border){
      $ary_facial_expression[2]++;
    }
    if (intval($row['anger']) >= $border){
      $ary_facial_expression[3]++;
    }
    if (intval($row['sadness']) >= $border){
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
$encoded_facial = json_encode($ary_facial_expression);
?>
<script>
  var ary_facial_expression = "<?php echo json_encode($encoded_facial); ?>";
  var data_ary_age = "<?php echo json_encode($encoded_age); ?>";
  var data_men = "<?php echo json_encode($count_men); ?>";
  var data_ladies = "<?php echo json_encode($count_ladies); ?>";
  var data_unknown = "<?php echo json_encode($count_other); ?>";
  var ave_age = "<?php echo json_encode($ave_age); ?>";
  var cnt_entrance = "<?php echo json_encode($count); ?>";
</script>
<div id="wrapper">

    <header>
        <!-- Nav -->
        <nav class="blue darken-1">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo center">TinyRetail</a>
            </div>
        </nav>
    </header>

        <!-- Main -->
  	<main>

    <div class="row">

        <article id="favor" class="col s12 m9">
        <div class="card">
            <div class="card-content">
                <header class="card-header">
                    <h1 class="card-title">好感度分析</h1>
                    <p id="output-date">日付</p>
                </header>
                <div class="graph_box">
                    <canvas id="graph_favor"></canvas>
                </div>
            </div>

            <div class="card-action">
                <form id="form_dete" action="">
                    <div class="row">
                    <div class="input-field col s5">
                        <input type="text" id="datepicker" name="get_dete" value="" />
                        <label for="datepicker">検索日時</label>
                    </div>
                    <div class="input-field col s5">
                        <a class="waves-effect waves-light btn" onclick="myChart_UPDATE();">更新</a>
                    </div>
                    </div>
                </form>
            </div>
        </div>
        </article>

        <article id="weather" class="col s6 m3">
            <div class="card">
                <div class="card-image">
                    <img class="responsive-img" src="img/1.png">
                </div>
            </div>
        </article>

        <article id="cnt-info" class="col s6 m3">
            <div class="card">
                <div class="card-content">
                    <div class="ave-age relative">
                        <i class="material-icons">face</i>
                        <p>45</p>
                    </div>
                    <div class="visitor_num relative">
                        <i class="material-icons">people</i>
                        <p>55</p>
                    </div>
                </div>
            </div>
        </article>

        <article id="sex" class="col s12 m6">
        <div class="card">
            <div class="card-content">
                <header class="card-header">
                    <h1 class="card-title">性別分布</h1>
                </header>
                <div class="graph_box">
                    <canvas id="graph_sex"></canvas>
                </div>
            </div>
        </div>
        </article>

        <article id="age" class="col s12 m6">
        <div class="card">
            <div class="card-content">
                <header class="card-header">
                    <h1 class="card-title">年齢分布</h1>
                </header>
                <div class="graph_box">
                    <canvas id="graph_age"></canvas>
                </div>
            </div>
        </div>
        </article>

        <article id="facial_expression" class="col s12">
        <div class="card">
            <div class="card-content">
                <header class="card-header">
                    <h1 class="card-title">表情数</h1>
                </header>
                <div class="graph_box">
                    <canvas id="graph_facial_expression"></canvas>
                </div>
            </div>
        </div>
        </article>
    </div>

    </main>
</div> <!--wrapper  -->

<!--chart.js  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

<!--jquery  -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!--jquery UI  -->
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>

<!--materialize js  -->
<script type="text/javascript" src="commons/js/materialize.min.js"></script>

<!-- jsの変数初期化 -->
<script type="text/javascript" src="js/variable_assignment.js"></script>
<!--グラフの更新  -->
<script type="text/javascript" src="js/update_graph.js"></script>
<!--各種グラフの設定  -->
<script id="Graph_favor" src="js/graph_favor.js"></script>
<script id="Graph_sex" src="js/graph_sex.js"></script>
<script id="Graph_age" src="js/graph_age.js"></script>
<script id="Graph_facial_expression" src="js/graph_facial_expression.js"></script>

</body>
</html>
