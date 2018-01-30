
var ctx = document.getElementById("graph_sex");

var myChart_sex = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["men","women"],
        datasets: [{
            backgroundColor: [
                "#9fa8da",
                "#ef9a9a",
            ],
            borderWidth: 10,
            hoverBorderWidth: 0,
            data: [data_men,data_women]
        }]
    },
    //オプションの設定
    options: {
        legend: { //ラベルの表示
            // display: false //false : 非表示
            position: 'top',
            labels: {
                boxWidth: 12,
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
