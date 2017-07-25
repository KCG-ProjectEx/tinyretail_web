var ctx = document.getElementById("secondGraphCanvas");

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['0-9','10-19','20-29','30-39','40-49','50-59','60-69','70-79','80-89','90-99'],
      datasets:[{
        backgroundColor: [
          "#ECBB00",
          "#A17A40",
          "#0087AF",
          "#EB6100",
          "#16902E",
          "#AC4188",
          "#00479B",
          "#A7A799",
          "#B8C760",
          "#000000"
        ],
        data:agearray
      }]
    },
    options: {
      scales: {
        yAxes: [
         {
          tick: {
            scaleShowLabels : false,
            beginAtZero: true
          }
         }
        ]
      }
    }
});

