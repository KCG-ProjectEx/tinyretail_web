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
        label: 'men',
        type: 'bar',
        backgroundColor: "#9fa8da",
        data:ary_timeline_men
    },{
        label: 'ladies',
        type: 'bar',
        backgroundColor: "#ef9a9a",
        data:ary_timeline_ladies
    },{
        label: 'unknown',
        type: 'bar',
        backgroundColor: "#bdbdbd",
        data:ary_timeline_unknown
    }
]},
    //オプションの設定
    options: {
        //軸の設定
        scales: {
            xAxes: [{
                // stacked: true, //積み上げ棒グラフにする設定
                categoryPercentage:0.7, //棒グラフの太さ
                barPercentage:0.9 //棒グラフの全体の幅
            },{
                id:"y-axis-1"
            },{
                id:"y-axis-2"
            }],
            yAxes: [{
                // stacked: true, //積み上げ棒グラフにする設定
                position: "right", //目盛りを右へ                
                //目盛りの設定
                ticks: {
                    beginAtZero:true, //開始値を0にする
                    max: 100,
                    min: 0,
                    stepSize: 20,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return value + "%";
                    }
                }
            },{
                id:"y-axis-1",
                display:false, //目盛りの表示・非表示
                ticks:{
                    beginAtZero:true, 
                    max: 100,
                    min: 0,
                    stepSize: 20,
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