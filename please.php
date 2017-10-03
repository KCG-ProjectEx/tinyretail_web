<?php

require_once('ModelBase.php');

// DB接続情報設定 (本来はここに置くべきでは無い処理)
$connInfo = array(
    'host'     => 'localhost',
    'dbname'   => 'tinyretail',
    'dbuser'   => 'root',
    'password' => 'mysql0001'
);
ModelBase::setConnectionInfo($connInfo );


class Favor extends ModelBase
{
    protected $name = "hvc_p2";

    public function getList($Time, $Date, $SexId)
    {

        $sql = sprintf('SELECT date,count(sex_id) as count FROM %s WHERE (date=:Date) and (time like :Time) and (sex_id=:SexId)' , $this->name);
        $params = array(
            'Date' => $Date,
            'Time' => $Time,
            'SexId' => $SexId
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }
}
$favor = new Favor();


$Date = $_GET['date'];

for ($Time=8; $Time <= 19; $Time++) { // 8:00-19:00のデータ取得
    $men[] = $favor->getList($Time."%", $Date, "1");
    $women[] = $favor->getList($Time."%", $Date, "2");
    $unknown[] = $favor->getList($Time."%", $Date, "3");
}


for ($i=0; $i <= 12 ; $i++) { 
    $xxx = array(
        'time' => ($i+8),
        'men' => (string)$men[$i][0]['count'],
        'ladies' => (string)$women[$i][0]['count'],
        'unknown' => (string)$unknown[$i][0]['count'],
    );
}
$favorDate = array(
    'date' => $Date,
    $xxx
);

echo "<h1>ather</h1>";
echo "<pre>";
var_dump($favorDate);
echo "</pre>";


echo "<h1>men</h1>";
echo "<pre>";
var_dump($men);
echo "</pre>";

echo "<h1>women</h1>";
echo "<pre>";
var_dump($women);
echo "</pre>";

echo "<h1>unknown</h1>";
echo "<pre>";
var_dump($unknown);
echo "</pre>";
?>