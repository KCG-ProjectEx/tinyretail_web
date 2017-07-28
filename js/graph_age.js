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
    }
});

