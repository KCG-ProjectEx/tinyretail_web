/*
    *label*  :  グラフのラベル
    *data*   :  単一データ
    *ary*    :  配列データ
*/

var data_db = document.getElementById("data_db");

//年齢割合グラフ
var ary_age;

//性別割合グラフ
var data_men;
var data_women;

//表情数(neutral, happiness, surprise, anger, sadness)
var ary_facial_expression;

// 好感度グラフ
/* メモ(後で消す)　
    - ary_timeline_men : 時間毎の男性の割合
    - ary_timeline_women : 時間毎の女性の割合
    - ary_timeline_unknown : 時間毎の性別不明の割合
    - ary_timeline_temp : 時間毎の気温の変化
    - ary_timeline_favor : 時間毎の好感度の総合評価
*/
var label_timeline =
    [ "8:00", "9:00","10:00","11:00","12:00","13:00",
     "14:00","15:00","16:00","17:00","18:00","19:00"];
var ary_timeline_men = ["20","30","25","40","5","70","90","5","22","45","30","30"];
var ary_timeline_women = ["80","50","25","60","90","20","10","5","48","45","70","10"];
var ary_timeline_temp = ["26","26","27","28","30","34","35","33","30","28","26","25"];
var ary_timeline_atm = ["1023","1026","1027","1027","1028","1030","1034","1035","1033","1030","1028","1026"];
var ary_timeline_favor = ["0","0","0","0","0","0","0","0","0","0","0","0"];


// 自動初期設定(JavaScript)

//var today=new Date();
//var target = document.getElementById("output-date");
// 受け取った日付データを表示する(ここから日付データを使ってください)
//target.innerText = (today.getFullYear()) + "/" + (today.getMonth()+1) + "/" + (today.getDate());

//document.getElementById('datepicker').value = (today.getFullYear()) + "/" + (today.getMonth()+1) + "/" + (today.getDate());;
//myChart_favor.update(); // グラフの再描画
