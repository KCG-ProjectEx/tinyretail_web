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
        // $Time = "16%";
        // $Date = "2017-09-12";

        $sql = sprintf('SELECT date,time,sex_id FROM %s WHERE (date="2017-09-12") and (time like "16:%%")' , $this->name);
        echo $sql;
        // $stmt = $this->pdoIns->query($sql);
        // $stmt->bindValue(':Date', $Date);
        // $stmt->bindValue(':Time', $Time);
        // $rows = $stmt->fetchAll();
        return $rows;
    }
}
$favor = new Favor();
$ret = $favor->getList();

echo "<pre>";
var_dump($ret);
echo "</pre>";
?>