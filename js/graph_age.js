var ctx = document.getElementById("graph_age");

var myChart_age = new Chart(ctx, {
type: 'doughnut',
    data: {
        labels: ['0-9','10-19','20-29','30-39','40-49','50-59','60-69','70-79'],
        datasets: [{
            backgroundColor: [
                'rgba(236, 187, 0, 0.5)',
                'rgba(161, 122, 64, 0.5)',
                'rgba(0, 135, 175, 0.5)',
                'rgba(235, 97, 0, 0.5)',
                'rgba(22, 144, 46, 0.5)',
                'rgba(172, 65, 136, 0.5)',
                'rgba(0, 71, 155, 0.5)',
                'rgba(167, 167, 153, 0.5)'
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
