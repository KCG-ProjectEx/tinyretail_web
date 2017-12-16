function myChart_UPDATE()
{
    // id=output-date　タグへのエレメントを取得
    var target = document.getElementById("output-date");
    // 受け取った日付データを表示する(ここから日付データを使ってください)
    target.innerText = document.forms.form_dete.get_dete.value;

    var date = target.innerText.split( '/' ).join( '-' );

    var datas = JSON.parse(getCurrentDateData(date));
    myChart_sex.data.datasets[0].data = [0,0,0];
console.log(datas);
    for(i=0;i<12;i++){
        // グラフデータを更新
        if(datas[0][i]["favor_data"] === ""){
            myChart_favor.data.datasets[0].data[i] = 0;
        }else{
            myChart_favor.data.datasets[0].data[i] = ((datas[0][i]["favor_data"] + 100) / 200 ) * 50;
        }
        myChart_favor.data.datasets[1].data[i] = datas[0][i]["tmp"];
        myChart_favor.data.datasets[2].data[i] = datas[0][i]["men"];
        myChart_favor.data.datasets[3].data[i] = datas[0][i]["ladies"];
        myChart_favor.data.datasets[4].data[i] = datas[0][i]["unknown"];
        myChart_sex.data.datasets[0].data[0] = parseInt(myChart_sex.data.datasets[0].data[0]) + parseInt(datas[0][i]["men"]);
        myChart_sex.data.datasets[0].data[1] = parseInt(myChart_sex.data.datasets[0].data[1]) + parseInt(datas[0][i]["ladies"]);
        myChart_sex.data.datasets[0].data[2] = parseInt(myChart_sex.data.datasets[0].data[2]) + parseInt(datas[0][i]["unknown"]);
    }
    myChart_age.data.datasets[0].data = datas[1];
    myChart_facial_expression.data.datasets[0].data = datas[2];

    myChart_age.update();
    myChart_facial_expression.update();
    myChart_sex.update();
    myChart_favor.update(); // グラフの再描画
    document.getElementById('average_age').textContent = Math.round(datas.age[0][0]*10)/10;
    document.getElementById('count').textContent = datas.cnt[0][0];
}

// フォームにカレンダーの表示 (id="datepicker"で使用可能)
$(function() {
    $("#datepicker").datepicker();
    $("#datepicker").datepicker("option", "buttonImageOnly", true);
});

function getCurrentDateData ( currentDate ){
    var datas = $.ajax({
        type: 'GET',
        url: 'please.php',
        async: false,
        data: {
          date: currentDate,
        }
    }).responseText;
    return datas;
}

var today = new Date();
document.getElementById('datepicker').value = (today.getFullYear()) + "/" + (today.getMonth()+1) + "/" + (today.getDate());
myChart_UPDATE(); // グラフの再描画
