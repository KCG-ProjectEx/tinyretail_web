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

    public function getList($Time, $Date, $SexId)
    {
        $sql = sprintf('SELECT date,count(sex_id) as count FROM %s WHERE (date=:Date) and (time like :Time) and (sex_id=:SexId) and stabilization = 1' , $this->name);
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
        $sql = sprintf('SELECT avg(age) FROM %s WHERE (date=:Date) and stabilization = 1' , $this->name);
        $params = array(
            'Date' => $Date
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }

    public function getListAge($Date)
    {
        $sql = sprintf('SELECT age FROM %s WHERE (date=:Date) and stabilization = 1' , $this->name);
        $params = array(
            'Date' => $Date
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }

    public function getCurPerson($Date){
        $sql = sprintf('SELECT count(date) from %s WHERE (date=:Date) and stabilization = 1' , $this->name);
        $params = array(
            'Date' => $Date
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }
    public function getSensorList($Time,$Date)
    {
        $sql = sprintf('SELECT avg(temperature) as tmp FROM %s WHERE (date=:Date) and (time like :Time)',$this->sensor_name );
        $params = array(
            'Date' => $Date,
            'Time' => $Time
        );
        $stmt = $this->query($sql,$params);
        return $stmt;
    }

    public function json_safe_encode($data){
        return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }
}
$favor = new Favor();

$Date = $_GET['date'];

for ($Time=8; $Time <= 19; $Time++) { // 8:00-19:00のデータ取得
    $men[] = $favor->getList($Time."%", $Date, "1");
    $women[] = $favor->getList($Time."%", $Date, "2");
    $unknown[] = $favor->getList($Time."%", $Date, "3");
    $tmp[] = $favor->getSensorList($Time."%",$Date);
}

for ($i=0; $i < 12 ; $i++) {
    $xxx[] = array(
        'time' => (string)($i+8),
        'men' => (string)$men[$i][0]['count'],
        'ladies' => (string)$women[$i][0]['count'],
        'unknown' => (string)$unknown[$i][0]['count'],
        'tmp' =>(string)$tmp[$i][0]['tmp']
    );
}

$listAge = $favor->getListAge($Date);
$ary_age = array(0,0,0,0,0,0,0,0,0,0);
foreach($listAge as $value){
    $ary_age[ round($value['age']/10) ] += 1;
}

$age = $favor->getAvgAge($Date);
$People = $favor->getCurPerson($Date);

$favorDate = array(
    'date' => $Date,
    'age' => $age,
    'cnt' => $People,
    $xxx,
    $ary_age
);

echo $favor->json_safe_encode($favorDate);

// echo "<h1>ather</h1>";
// echo "<pre>";
// var_dump($favorDate);
// echo "</pre>";


// echo "<h1>men</h1>";
// echo "<pre>";
// var_dump($men);
// echo "</pre>";

// echo "<h1>women</h1>";
// echo "<pre>";
// var_dump($women);
// echo "</pre>";

// echo "<h1>unknown</h1>";
// echo "<pre>";
// var_dump($unknown);
// echo "</pre>";
?>
