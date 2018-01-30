<!DOCTYPE html>
<html lang="ja">
<head>
    <title>TinyRetail</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="./img/favicon_64.gif" type="img/gif">
    <!-- Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css" rel="stylesheet" />

    <!-- Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="commons/css/materialize.min.css"  media="screen,projection"/>

    <!-- カレンダーCSS  -->
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/blitzer/jquery-ui.css" >
    <link type="text/css" rel="stylesheet" href="css/style.css"/>

    <!-- icon  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
<?php
/* livedoor weather Hack API */
/* Kyoto */
$url = "http://weather.livedoor.com/forecast/webservice/json/v1?city=260010";

/* Osaka */
//$url = "http://weather.livedoor.com/forecast/webservice/json/v1?city=270000";

/* Toyohashi */
//$url = "http://weather.livedoor.com/forecast/webservice/json/v1?city=230020";

/* Otsu */
//$url = "http://weather.livedoor.com/forecast/webservice/json/v1?city=250010";

// /* weather underground API */
// /* Kyoto */
// //$url_wu= "http://api.wunderground.com/api/1e884494f8533bbe/conditions/q/JP/Kyoto.json";

// /* Osaka */
// //$url_wu = "http://api.wunderground.com/api/1e884494f8533bbe/conditions/q/zmw:00000.36.47617.json";

// /* KyotoHistory */
// // $url_wu= "http://api.wunderground.com/api/1e884494f8533bbe/history_20171231/q/JP/Kyoto.json";

// $url_wu = "./history.json";
// $weather_wu = file_get_contents($url_wu, true);
// $weather_wu = json_decode($weather_wu, true);
// // $weatherData = $weather_wu['current_observation'];
// // echo $weather_wu['history']['observations'][7]['icon'];
// $img_wu = "http://icons.wxug.com/i/c/i/".$weather_wu['history']['observations'][7]['icon'].".gif";


/* 天気アイコンと文字を表示 */
$weather = file_get_contents($url, true);
$weather = json_decode($weather, true);
$img = $weather['forecasts'][0]['image']['url'];
$img = str_replace("http://weather.livedoor.com/img/icon","./img",$img);
$text = $weather['description']['text'];
?>
<div id="wrapper">
    <header>
        <!-- Nav -->
        <nav class="nav_color">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo center">TinyRetail</a>
            </div>
        </nav>
    </header>

        <!-- Main -->
  	<main>

    <div class="row">

        <div class="col m3 push-m9 s12">
            <div id="search" class="col s12 m12">
                <div class="card search-color">
                    <form id="form_dete" action="">
                        <div class="row">
                        <div class="input-field col s7">
                            <input type="text" id="datepicker" name="get_dete" value="" />
                            <label for="datepicker">検索日時</label>
                        </div>
                        <div class="searchBotton col s5">
                            <a class="btn-floating btn-large waves-effect waves-light search-btn-color searchBtn" onclick="myChart_UPDATE();"><i class="material-icons">sync</i></a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="weather" class="col s6 m12">
                <div class="card">
                    <div class="card-image">
                        <img class="responsive-img" src=<?php echo $img; ?> >
                        <p class="weather-text-content"><?php echo $text; ?></p>
                    </div>
                </div>
            </div>
            <div id="cnt-info" class="col s6 m12">
                <div class="card">
                    <div class="card-content">
                        <div class="ave-age relative">
                            <i class="material-icons" style="color: white;">face</i>
                            <p id="average_age"></p>
                        </div>
                        <div class="visitor_num relative">
                            <i class="material-icons" style="color: white;">people</i>
                            <p id="count"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <article id="favor" class="col m9 pull-m3 s12">
        <div class="card">
            <div class="card-content">
                <header class="card-header">
                    <h1 class="card-title">好感度分析</h1>
                    <p id="output-date">日付</p>
                </header>
                <div class="graph_box">
                    <div class="box">
                        <img id="weather-history-img" class="weather-history-img" src="./img/default.gif" >
                        <div id="weather-history-text" class="weather-history-text"></div>
                    </div>
                    <div class="box">
                        <div id="weather-history-atm" class="weather-history-text"></div>
                    </div>
                    <canvas id="graph_favor"></canvas>
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
<script id="data_db" src="./js/variable_assignment.js"></script>
<!--各種グラフの設定  -->
<script id="Graph_favor" src="js/graph_favor.js"></script>
<script id="Graph_sex" src="js/graph_sex.js"></script>
<script id="Graph_age" src="js/graph_age.js"></script>
<script id="Graph_facial_expression" src="js/graph_facial_expression.js"></script>
<!--グラフの更新  -->
<script type="text/javascript" src="js/update_graph.js"></script>

<!-- 雪を降らせる -->
<!--
<script type="text/javascript" src="commons/js/snowfall.jquery.js"></script>
<script>
    $(document).snowfall({
        // 雪の量 (数値)
        flakeCount : 100,
        // z-indexの値
        flakeIndex : "888",
        // 最小サイズ （数値）
        minSize : 5,
        // 最大サイズ（数値）
        maxSize : 10,
        // 最低速度（数値）
        minSpeed : 1,
        // 最高速度（数値）
        maxSpeed : 5,
        // 雪の形を丸にする（boolean）
        round : true,
        // 影をつける（boolean）
        shadow : false,
        // イメージを表示する
        image : "img/snow.png"
    });
</script>
-->

</body>
</html>
