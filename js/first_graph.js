
var ctx = document.getElementById("firstGraphCanvas");

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [dataheadmen,dataheadladies,dataheadunknown],
        datasets: [{
            data: [datamen,dataladies,dataunknown],
            backgroundColor: [
                'rgba(66, 96, 45, 0.2)',
                'rgba(255, 177, 27, 0.2)',
                'rgba(180, 165, 130, 0.2)'
            ],
            borderColor: [
                'rgba(66, 96, 45, 1)',
                'rgba(255, 177, 27, 1)',
                'rgba(180, 165, 130, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
