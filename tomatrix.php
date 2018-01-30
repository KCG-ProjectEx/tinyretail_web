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
class Tomatrix extends ModelBase
{
    protected $name = "julius";
    public function getFavor()
    {
        $sql = sprintf("SELECT favor FROM %s order by date desc limit 1", $this->name);
        $stmt = $this->query($sql);
        return $stmt;
    }
}
    $tomatrix = new Tomatrix();
    $row = $tomatrix->getFavor();
    $str = $row[0]['favor'];
//    var_dump($str);
    if($str == "positive"){
        echo 'w';
    }elseif($str == "negative"){
        echo 'q';
    }elseif($str == "null"){
        echo 's';
    }else{
        echo 'b';
    }