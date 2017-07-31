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