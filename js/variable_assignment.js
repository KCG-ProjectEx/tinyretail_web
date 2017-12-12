/*
    *label*  :  グラフのラベル
    *data*   :  単一データ
    *ary*    :  配列データ
*/

var data_db = document.getElementById("data_db");

//年齢割合グラフ
var ary_age = JSON.parse(data_db.getAttribute('data-ary-age'));
// var ary_age = ["10","1","2","3","4","5","6","7"];

//性別割合グラフ
var data_men = JSON.parse(data_db.getAttribute('data-men'));
var data_ladies = JSON.parse(data_db.getAttribute('data-ladies'));
var data_unknown = JSON.parse(data_db.getAttribute('data-unknown'));
// var data_men = "15";
// var data_ladies = "20";
// var data_unknown = "30";

//表情数(neutral, happiness, surprise, anger, sadness)
var ary_facial_expression = JSON.parse(data_db.getAttribute('data-ary-facial-expression'));
// var ary_facial_expression = ["20","30","25","40","5"];

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
var ary_timeline_ladies = ["80","50","25","60","90","20","10","5","48","45","70","10"];
var ary_timeline_unknown = ["0","20","50","0","5","10","0","90","30","10","0","60"];
var ary_timeline_temp = ["26","26","27","28","30","34","35","33","30","28","26","25"];
var ary_timeline_favor = ["80","70","80","67","40","50","70","80","90","60","50","60"];


// 自動初期設定(JavaScript)

//var today=new Date();
//var target = document.getElementById("output-date");
// 受け取った日付データを表示する(ここから日付データを使ってください)
//target.innerText = (today.getFullYear()) + "/" + (today.getMonth()+1) + "/" + (today.getDate());

//document.getElementById('datepicker').value = (today.getFullYear()) + "/" + (today.getMonth()+1) + "/" + (today.getDate());;
//myChart_favor.update(); // グラフの再描画
