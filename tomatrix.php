
<?php
    $prev_time=0;
    $prev_favor="null";
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
    protected $camera_name="hvc_p2";

    public function getFavor()
    {
        $sql = sprintf("SELECT favor FROM %s order by date desc limit 1", $this->name);
        $stmt = $this->query($sql);
        return $stmt;
    }
    public function hvctime()
    {
        $sql = sprintf("SELECT time FROM %s order by date desc limit 1", $this->camera_name);
        $stmt = $this->query($sql);
        return $stmt;
    }
}

    $tomatrix = new Tomatrix();

    $row = $tomatrix->getFavor();
    $str = $row[0]['favor'];
    
    //hvc from time
    $camera_row =$tomatrix->hvctime();
    $camera_str=$camera_row[0]['time'];
    
    var_dump($camera_str);
    
    if($camera_str<$prev_time+30 && $str !=  $prev_favor){
        $prev_time=$camera_str;
        $str=$prev_str;
//    var_dump($str);
        if($str == "positive"){
            echo 'w';
        }elseif($str == "negative"){
            echo 'c';
        }elseif($str == "null"){
            echo 's';
        }else{
            echo 'b';
        }
    }else{
        echo 'b';

    }

