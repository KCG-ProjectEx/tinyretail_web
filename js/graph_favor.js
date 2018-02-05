var ctx = document.getElementById("graph_favor");

var myChart_favor = new Chart(ctx, {
responsive : true,
type: 'bar',
data: {
    labels: label_timeline,
    datasets:[
    {
        label: '好感度',
        data: ary_timeline_favor,
        type: 'line',
        fill: false,
        borderColor: "#ff4081",
        backgroundColor: "#FFF",
        yAxisID:"y-axis-1",
    },{
        label: '気温',
        data: ary_timeline_temp,
        type: 'line',
        fill: false,
        borderColor: "#689f38",
        backgroundColor: "#FFF",
        pointBorderColor: "#33691e",
        yAxisID:"y-axis-2",
    },{
        label: '気圧',
        data: ary_timeline_atm,
        type: 'line',
        fill: false,
        borderColor: "#CBCDFB",
        backgroundColor: "#FFF",
        pointBorderColor: "#BDBDFB",
        yAxisID:"y-axis-3",
    },{
        label: '平均年齢',
        type: 'line',
        fill: false,
        backgroundColor: "#5C2A86",
        borderColor: "rgba(255,255,255,0)",
        data: ary_timeline_ageAverage,
        yAxisID:"y-axis-4",
    },{
        label: 'men',
        type: 'bar',
        backgroundColor: "#9fa8da",
        data:ary_timeline_men
    },{
        label: 'women',
        type: 'bar',
        backgroundColor: "#ef9a9a",
        data:ary_timeline_women
    }
]},
    //オプションの設定
    options: {
        //軸の設定
        scales: {
            xAxes: [{
                //stacked: true, //積み上げ棒グラフにする設定
                categoryPercentage:0.7, //棒グラフの太さ
                barPercentage:0.9 //棒グラフの全体の幅
            },{
                id:"y-axis-1"
            },{
                id:"y-axis-2"
            },{
                id:"y-axis-3"
            }],
            yAxes: [{
                // stacked: true, //積み上げ棒グラフにする設定
                position: "right", //目盛りを右へ
                display:false,
                //目盛りの設定
                ticks: {
                    beginAtZero:true, //開始値を0にする
                    max: 300,
                    min: 0,
                    stepSize: 10
                }
            },{
                position: "right", //目盛りを右へ
                id:"y-axis-1",
                display:true, //目盛りの表示・非表示
                ticks:{
                    //beginAtZero:true,
                    max: 50,
                    min: -50,
                    stepSize: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return value + "%";
                    }
                }
            },{
                id:"y-axis-2",
                position: "left", //目盛りを左へ
                ticks:{
                    beginAtZero:true,
                    max: 45,
                    min: -5,
                    stepSize: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return value + "℃";
                    }
                }
            },{
                id:"y-axis-3",
                display:false,
                ticks:{
                    max: 1200,
                    min: 500,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return value + "Pa";
                    }
                }
            },{
                id:"y-axis-4",
                display:false,
                ticks:{
                    max: 100,
                    min: 0,
                }
            }]
        },legend: { //ラベルの表示
            // display: false, //false : 非表示
            position: 'bottom',
            labels: {
                boxWidth: 12
            }
        }
    }
});
