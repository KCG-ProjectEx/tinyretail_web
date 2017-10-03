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

    public function getList()
    {
        $Time = "16%";
        $Date = "2017-09-12";

        $sql = sprintf('SELECT date,time,sex_id FROM %s WHERE (date=:Date) and (time like :Time)' , $this->name);
        $params = array(
            'Date' => $Date,
            'Time' => $Time
        );
        $stmt = $this->pdoIns->query($sql, $params);
        return $stmt;
    }
}
$favor = new Favor();
$ret = $favor->getList();

echo "<pre>";
var_dump($ret);
echo "</pre>";
?>