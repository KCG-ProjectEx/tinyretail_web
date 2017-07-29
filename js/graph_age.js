var ctx = document.getElementById("graph_age");

var myChart_age = new Chart(ctx, {
type: 'doughnut',
    data: {
        labels: ['0-9','10-19','20-29','30-39','40-49','50-59','60-69','70-79'],
        datasets: [{
            backgroundColor: [
                "#ECBB00",
                "#A17A40",
                "#0087AF",
                "#EB6100",
                "#16902E",
                "#AC4188",
                "#00479B",
                "#A7A799"
            ],
            data: ary_age
        }]
    },
    //オプションの設定
    options: {
        legend: { //ラベルの表示
            // display: false, //false : 非表示
            position: 'top',
            labels: {
                boxWidth: 12,
                padding: 10
            }
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        }
    }
});
