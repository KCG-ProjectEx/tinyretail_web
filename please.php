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

        $sexId = '1';

        $sql = sprintf('SELECT date,time,:sexId FROM %s' , $this->name);
        $stmt = $this->pdoIns->query($sql);
        $stmt->bindValue(':sexId', $sexId);
        $rows = $stmt->fetchAll();
        return $rows;
    }
}
$favor = new Favor();
$ret = $favor->getList();

echo "<pre>";
var_dump($ret);
echo "</pre>";
?>