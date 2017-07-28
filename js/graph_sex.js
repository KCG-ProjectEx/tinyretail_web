
var ctx = document.getElementById("graph_sex");

var myChart_sex = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["men","ladies","unknown"],
        datasets: [{
            backgroundColor: [
                'rgba(0, 229, 103, 0.2)',
                'rgba(255, 177, 27, 0.2)',
                'rgba(180, 165, 130, 0.2)'
            ],
            borderColor: [
                'rgba(66, 96, 45, 1)',
                'rgba(255, 177, 27, 1)',
                'rgba(180, 165, 130, 1)'
            ],
            borderWidth: 1,
            hoverBackgroundColor: [
                'rgba(0, 229, 103, 0.3)',
                'rgba(255, 177, 27, 0.3)',
                'rgba(180, 165, 130, 0.3)'
            ],
            data: [data_men,data_ladies,data_unknown]
        }]
    }
});
