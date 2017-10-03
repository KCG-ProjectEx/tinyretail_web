<?php

require_once('ModelBase.php');

// DB接続情報設定 (本来はここに置くべきでは無い処理)
$connInfo = array(
    'host'     => 'localhost',
    'dbname'   => 'tinyretail',
    'dbuser'   => 'root',
    'password' => ''
);
ModelBase::setConnectionInfo($connInfo );


class Favor extends ModelBase
{
    protected $name = "hvc_p2";

    public function getList()
    {
        echo "in";
        $sql = sprintf('SELECT * FROM %s' , $this->name);
        $stmt = $this->pdoIns->query($sql);
        // $stmt->bindValue(':cart_id', $cartId);
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