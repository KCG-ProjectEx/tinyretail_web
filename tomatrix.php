
<?php
require_once('ModelBase.php');

// DB接続情報設定 (本来はここに置くべきでは無い処理)
$connInfo = array(
    'host'     => 'localhost',
    'dbname'   => 'tinyretail',
    'dbuser'   => 'root',
    //'password' => 'mysql0001'
    'password' => ''
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
        $sql = sprintf("SELECT date,time FROM %s order by date desc limit 1", $this->camera_name);
        $stmt = $this->query($sql);
        return $stmt;
    }
}

    $tomatrix = new Tomatrix();

    $prev_time = time();
    $row = $tomatrix->getFavor();
    $str = $row[0]['favor'];
    
    //hvc from time
    $camera_row = $tomatrix->hvctime();
    $camera_str = strtotime($camera_row[0]['date'].$camera_row[0]['time']);

    // var_dump($camera_str);
    // $camera_str += 30;    
    // var_dump($prev_time);

    if($camera_str + 30 < $prev_time){
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

