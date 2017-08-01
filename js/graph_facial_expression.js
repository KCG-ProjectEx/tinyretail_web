var ctx = document.getElementById("graph_facial_expression");

var myChart_facial_expression = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["neutral","happiness","surprise","anger","sadness"],
    datasets:[{
      backgroundColor: [
        'rgba(236, 187, 0, 0.5)',
        'rgba(161, 122, 64, 0.5)',
        'rgba(0, 135, 175, 0.5)',
        'rgba(235, 97, 0, 0.5)',
        'rgba(22, 144, 46, 0.5)'
      ],
      data: ary_facial_expression,
      yAxisID:0
    }]
  },
  //オプションの設定
  options: {
    //軸の設定
    scales: {
      //縦軸の設定
      yAxes: [{
        //目盛りの設定
        ticks: {
          //開始値を0にする
          beginAtZero:true,
          maxTicksLimit:5 //目盛りの数
        }
      }]
    },legend: { //ラベルの表示
      display: false //false : 非表示
    }
  }
});