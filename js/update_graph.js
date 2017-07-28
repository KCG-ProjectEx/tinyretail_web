function myChart_UPDATE()
{
    // id=output　タグへのエレメントを取得
    target = document.getElementById("output");
    // 受け取った日付データを表示する(ここから日付データを使ってください)
    target.innerText = document.forms.form_dete.get_dete.value;

    for(i=0;i<5;i++){
        for(j=0;j<12;j++){
            // グラフデータを更新
            myChart_favor.data.datasets[i].data[j] = Math.round(Math.random()*45);
        }
    }
    myChart_favor.update(); // グラフの再描画

}

// フォームにカレンダーの表示 (id="datepicker"で使用可能)
$(function() {
    $("#datepicker").datepicker();
    $("#datepicker").datepicker("option", "buttonImageOnly", true);
});