<!DOCTYPE html>
<html lang="jp">
<head>
    <title>Project Ex TinyRetail Test</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="commons/css/materialize.min.css"  media="screen,projection"/>  

    <!--chart.js  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

    <!--materialize js  -->
    <script type="text/javascript" src="commons/js/materialize.min.js"></script>      

    <!--jquery  -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous">
    </script>

    <!--jquery UI  -->
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>

    <!-- jsの変数初期化 -->
    <script type="text/javascript" src="js/variable_assignment.js"></script>
    <!--グラフの更新  -->
    <script type="text/javascript" src="js/update_graph.js"></script>    

    <!--カレンダーCSS  -->
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/blitzer/jquery-ui.css" >
</head>

<body>


    <!-- Nav -->
    <nav>
      <a href="#maingraph"><span>Guestcount</span></a>
      <a href="#subgraph_0"><span>Age</span></a>
      <a href="#subgraph_1"><span>Guestcount</span></a>
      <a href="#subgraph_2"><span>Age</span></a>
      <!-- <a href="#" class="icon "><span>Twitter</span></a> -->
    </nav>

        <!-- Main -->
  	<main>

         <article>
            <header>
            <h1>性別分布</h1>
            </header>
            <div>
                <canvas id="graph_sex"></canvas> 
                <script id="Graph_sex" src="js/graph_sex.js"></script> 
            </div>
        </article>

        <article>
            <header>
            <h1>年齢分布</h1>
            </header>
            <div>
                <canvas id="graph_age"></canvas>  
                <script id="Graph_age" src="js/graph_age.js"></script>  
            </div>
        </article>

        <article>
            <header>
            <h1>表情数</h1>
            </header>
            <div>
                <canvas id="graph_facial_expression"></canvas>  
                <script id="Graph_facial_expression" src="js/graph_facial_expression.js"></script>  
            </div>
        </article> 

        <article>
            <form id="form_dete" action="">
                <input type="text" id="datepicker" name="get_dete" value="" /> 
                <input class="waves-effect waves-light btn" type="button" value="更新" onclick="myChart_UPDATE();" />
            </form>  
            <div id="output"></div>

            <header>
            <h1>好感度分析</h1>
            </header>
            <div>
                <canvas id="graph_favor"></canvas>  
                <script id="Graph_favor" src="js/graph_favor.js"></script>  
            </div>
        </article>

    </main>


</body>
</html>