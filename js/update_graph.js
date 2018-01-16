function myChart_UPDATE()
{
    // id=output-date　タグへのエレメントを取得
    var target = document.getElementById("output-date");
    // 受け取った日付データを表示する(ここから日付データを使ってください)
    target.innerText = document.forms.form_dete.get_dete.value;

    var date = target.innerText.split( '/' ).join( '-' );
    var datas = JSON.parse(getCurrentDateData(date));
console.log(datas.weather);
    myChart_sex.data.datasets[0].data = [0,0,0];
    var positiveWords = 0;
    var negativeWords = 0;
    for(i=0;i<12;i++){    
        var favor_tmp = 0;
        // グラフデータを更新
        if(datas[0][i]["favor_data"] === ""){
            //NULL時は0(neutral)
            favor_tmp = 0;
        }else{
            favor_tmp = (parseInt(datas[0][i]["favor_data"]) / 100 ) * 50;
        }
        /* 2018/01/16 juliusのネガポジ判定用ロジック追加 */
        datas[0][i]["pojinega"].forEach( function( value ) {
            if(value.pojinega === "positive" && favor_tmp < 50){
                positiveWords++;
                favor_tmp++;
            }
            if(value.pojinega === "negative" && favor_tmp > -50){
                negativeWords++;
                favor_tmp--;
            }
        });
        myChart_favor.data.datasets[0].data[i] = favor_tmp;
        myChart_favor.data.datasets[1].data[i] = datas[0][i]["tmp"];
        myChart_favor.data.datasets[2].data[i] = datas[0][i]["men"];
        myChart_favor.data.datasets[3].data[i] = datas[0][i]["ladies"];
        myChart_sex.data.datasets[0].data[0] = parseInt(myChart_sex.data.datasets[0].data[0]) + parseInt(datas[0][i]["men"]);
        myChart_sex.data.datasets[0].data[1] = parseInt(myChart_sex.data.datasets[0].data[1]) + parseInt(datas[0][i]["ladies"]);
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

// 指定日のデータを取ってくる
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
