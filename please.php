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

    public function getList($Time, $Date)
    {

        $sql = sprintf('SELECT date,time,sex_id FROM %s WHERE (date=:Date) and (time like :Time)' , $this->name);
        $params = array(
            'Date' => $Date,
            'Time' => $Time
        );
        $stmt = $this->query($sql, $params);
        return $stmt;
    }
}
$favor = new Favor();


$Date = $_GET['date'];

$Time = "16";

$ret = $favor->getList($Time."%", $Date);

echo "<pre>";
var_dump($ret);
echo "</pre>";
?>