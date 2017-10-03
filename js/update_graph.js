function myChart_UPDATE()
{
    // id=output-date　タグへのエレメントを取得
    var target = document.getElementById("output-date");
    // 受け取った日付データを表示する(ここから日付データを使ってください)
    target.innerText = document.forms.form_dete.get_dete.value;

//    var date = target.innerText.replace( ///g, '-' );
    var date = target.innerText.split( '/' ).join( '-' );

    var datas = getCurrentDateData(date);
    console.log(datas);
    myChart_favor.update(); // グラフの再描画
}

// フォームにカレンダーの表示 (id="datepicker"で使用可能)
$(function() {
    $("#datepicker").datepicker();
    $("#datepicker").datepicker("option", "buttonImageOnly", true);
});

function getCurrentDateData ( currentDate ){
    var datas = $.ajax({
        type: 'GET',
        url: 'please.php'
        dataType: 'text',
        async: false
        data: {
          date: currentDate,
        }
    }).responseText;
    return datas;
}
/*
for(i=0;i<5;i++){
    for(j=0;j<12;j++){
        // グラフデータを更新
        myChart_favor.data.datasets[i].data[j] = Math.round(Math.random()*45);
    }
}
*/
