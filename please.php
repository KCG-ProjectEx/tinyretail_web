<?php

require_once('ModelBase.php');

// DB接続情報設定 (本来はここに置くべきでは無い処理)
$connInfo = array(
    'host'     => 'localhost',
    'dbname'   => 'tinyretail',
    'dbuser'   => 'root',
    'password' => 'mysql0001'
    //'password' => ''
);
ModelBase::setConnectionInfo($connInfo );

class Favor extends ModelBase
{
    protected $name = "hvc_p2";
    protected $sensor_name = " indoor_sensor_node";
    protected $mic_name = "julius";
    protected $weather_name = "weather";

    public function getList($Time, $Date, $SexId)
    {
        $sql = sprintf('SELECT date,count(sex_id) as count FROM %s WHERE (date=:Date) and (time like :Time) and (sex_id=:SexId)' , $this->name);
        // $sql = sprintf('SELECT date,count(sex_id) as count FROM %s WHERE (date=:Date) and (time like :Time) and (sex_id=:SexId) AND stabilization = 1' , $this->name);
        $params = array(
            'Date' => $Date,
            'Time' => $Time,
            'SexId' => $SexId
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }

    public function getAvgAge($Date)
    {
        $sql = sprintf('SELECT avg(age) FROM %s WHERE (date=:Date)' , $this->name);
        $params = array(
            'Date' => $Date
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }

    public function getAvgAgeTime($Time,$Date)
    {
        $sql = sprintf('SELECT avg(age) FROM %s WHERE (date=:Date) AND (time like :Time)' , $this->name);
        $params = array(
            'Date' => $Date,
            'Time' => $Time
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }

    public function getListAge($Date)
    {
//        $sql = sprintf('SELECT age FROM %s WHERE (date=:Date) AND stabilization = 1' , $this->name);
        $sql = sprintf('SELECT age FROM %s WHERE (date=:Date)' , $this->name);
        $params = array(
            'Date' => $Date
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }

    public function getCurPerson($Date){
//        $sql = sprintf('SELECT count(date) as cnt FROM %s WHERE (date=:Date) AND stabilization = 1' , $this->name);
        $sql = sprintf('SELECT count(date) as cnt FROM %s WHERE (date=:Date)' , $this->name);
        $params = array(
            'Date' => $Date
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }

    public function getSensorList($Time,$Date)
    {
        $sql = sprintf('SELECT avg(temperature) as tmp, max(atm) as atm FROM %s WHERE (date=:Date) and (time like :Time)',$this->sensor_name );
        $params = array(
            'Date' => $Date,
            'Time' => $Time
        );
        $stmt = $this->query($sql,$params);
        return $stmt;
    }

    public function getPojinega($Time,$Date)
    {
        $sql = sprintf('SELECT favor AS pojinega FROM %s WHERE (date=:Date) AND (time like :Time) AND favor_score > 0.95 AND favor <> "neutral" AND sentence <> "。"',$this->mic_name );
        $params = array(
            'Date' => $Date,
            'Time' => $Time
        );
        $stmt = $this->query($sql,$params);
        return $stmt;
    }

    public function getEmotion($Date)
    {
//        $sql = sprintf('SELECT neutral,happiness,surprise,anger,sadness FROM %s WHERE (date=:Date) AND stabilization = 1', $this->name);
        $sql = sprintf('SELECT neutral,happiness,surprise,anger,sadness FROM %s WHERE (date=:Date)', $this->name);
        $params = array(
            'Date' => $Date
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }

    public function getFavorAvg($Time,$Date)
    {
//        $sql = sprintf('SELECT avg(emotion + cast(surprise AS SIGNED) + cast(sadness as SIGNED) ) as favor_data FROM %s WHERE (date=:Date) AND (time like :Time) AND stabilization = 1' , $this->name);
//        $sql = sprintf('SELECT avg(emotion + cast(sadness as SIGNED) + cast(anger as SIGNED)) as favor_data FROM %s WHERE (date=:Date) AND (time like :Time)' , $this->name);
        $sql = sprintf('SELECT avg((emotion + cast(neutral as SIGNED) + cast(surprise as SIGNED)) * (cast(face_size as SIGNED) * 0.005)) as favor_data FROM %s WHERE (date=:Date) AND (time like :Time)' , $this->name);
//        $sql = sprintf('SELECT avg(emotion) as favor_data FROM %s WHERE (date=:Date) AND (time like :Time)' , $this->name);
        $params = array(
            'Date' => $Date,
            'Time' => $Time
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }

    public function getWeatherData($Date)
    {
        $sql = sprintf('SELECT weather,icon FROM %s WHERE (date=:Date)' , $this->weather_name);
        $params = array(
            'Date' => $Date
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }

    public function getHappyData($Time,$Date)
    {
        $sql = sprintf('SELECT happiness FROM %s WHERE (date=:Date) AND (time like :Time)' , $this->name);
        $params = array(
            'Date' => $Date,
            'Time' => $Time
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }

    public function json_safe_encode($data){
        return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }
}
$favor = new Favor();

$Date = $_GET['date'];

for ($Time = 10; $Time <= 20; $Time++) { // 10:00-20:00台のデータ取得
    $men[] = $favor->getList($Time."%", $Date, "1");
    $women[] = $favor->getList($Time."%", $Date, "2");
    $sensor[] = $favor->getSensorList($Time."%",$Date);
    $favor_data[] = $favor->getFavorAvg($Time."%",$Date);
    $pojinega[] = $favor->getPojinega($Time."%",$Date);
    $happy[] = $favor->getHappyData($Time."%",$Date);
    $aveAge[] = $favor->getAvgAgeTime($Time."%",$Date);
}
for ($i=0; $i < 11; $i++) {
    $basic_datas[] = array(
        'time' => (string)($i+10),
        'men' => (string)$men[$i][0]['count'],
        'ladies' => (string)$women[$i][0]['count'],
        'tmp' => (string)$sensor[$i][0]['tmp'],
        'atm' => (string)$sensor[$i][0]['atm'],
        'favor_data' => (string)$favor_data[$i][0]['favor_data'],
        'pojinega' => $pojinega[$i],
        'happy' => $happy[$i],
        'ave_age' => $aveAge[$i]
    );
}

$listAge = $favor->getListAge($Date);

$ary_age = array(0,0,0,0,0,0,0,0,0,0);
foreach($listAge as $value){
    $ary_age[ round($value['age']/10) ] += 1;
}
$border = 10;
$listEmotion = $favor->getEmotion($Date);
$ary_facial_expression = array(0,0,0,0,0);
foreach ($listEmotion as $value) {
  if (intval($value['neutral']) >= $border){
    $ary_facial_expression[0]++;
  }
  if (intval($value['happiness']) >= $border){
    $ary_facial_expression[1]++;
  }
  if (intval($value['surprise']) >= $border){
    $ary_facial_expression[2]++;
  }
  if (intval($value['anger']) >= $border){
    $ary_facial_expression[3]++;
  }
  if (intval($value['sadness']) >= $border){
    $ary_facial_expression[4]++;
  }
}

$age = $favor->getAvgAge($Date);
$People = $favor->getCurPerson($Date);
$weather = $favor->getWeatherData($Date);
$favorData = array(
    'date' => $Date,
    'age' => $age,
    'cnt' => $People,
    $basic_datas,
    $ary_age,
    $ary_facial_expression,
    'weather' => $weather
);

echo $favor->json_safe_encode($favorData);
?>
