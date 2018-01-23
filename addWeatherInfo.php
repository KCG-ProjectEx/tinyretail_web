<?php

    require_once('ModelBase.php');

    $connInfo = array(
        'host'     => 'localhost',
        'dbname'   => 'tinyretail',
        'dbuser'   => 'root',
        //'password' => 'mysql0001'
        'password' => ''
    );
    ModelBase::setConnectionInfo($connInfo);

    class Weather extends ModelBase{

        protected $name = "weather";

        public function json_safe_encode($data){
            return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        }

        public function insertWeatherInfo($Date,$Conds,$Url,$Icon){
            $params = array(
                'date' => $Date,
                'weather' => $Conds,
                'url' => $Url,
                'icon' => $Icon
            );
            $stmt = $this->insert($params);
            return $stmt;
        }
    }

    $weather = new Weather();
    $Date = $_GET['date'];

    /* weather underground API */
    /* Kyoto */
    $url_wu_tail_kyoto = "/q/JP/Kyoto.json";

    /* Osaka */
    $url_wu_tail_osaka = "/q/zmw:00000.36.47617.json";

    /* KyotoHistory */
    // $url_wu= "http://api.wunderground.com/api/1e884494f8533bbe/history_20171231/q/JP/Kyoto.json";

    // $weatherData = $weather_wu['current_observation'];
    // echo $weather_wu['history']['observations'][7]['icon'];
    // $img_wu = "http://icons.wxug.com/i/c/i/".$weather_wu['history']['observations'][7]['icon'].".gif";

    $url_wu = "http://api.wunderground.com/api/1e884494f8533bbe/history_".$Date.$url_wu_tail_kyoto;
    $weather_wu = file_get_contents($url_wu, true);
    $weather_wu = json_decode($weather_wu, true);
    if($weather_wu['history']['observations']==NULL){
        echo 0;
        return;
    }
    $date = $Date;
    $conds = $weather_wu['history']['observations'][4]['conds'];
    $url = $url_wu;
    $icon = "http://icons.wxug.com/i/c/i/".$weather_wu['history']['observations'][4]['icon'].".gif";
    $weather->insertWeatherInfo($date,$conds,$url,$icon);

    echo 1;
    return;
