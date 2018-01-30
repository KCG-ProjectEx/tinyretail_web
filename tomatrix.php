
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
    var_dump($row);
    $str = $row['favor'];

    if(strcmp($str,"positive")){
        echo 'w';
    }elseif(strcmp($str,"negative")){
        echo 'c';
    }elseif(strcmp($str,"null")){
        echo 's';
    }else{
        echo 'b';
    }

/*
    $dsn = "mysql:host=localhost;dbname=tinyretail;charset=utf8"; // Database name
    $user = "root";           // Databese User Name
    $password = "mysql0001";        // Database Password
    $dbh = new PDO($dsn, $user, $password);
    $sql= "SELECT * FROM julius order by desc limit 1";
    $stmt = $dbh->prepare($sql);

    while($row = mysql_fetch_assoc($result)){
        $str = $row['favor'];
    }
    var_dump($str);
    $result->close();
    if(strcmp($str,"positive")){
        echo 'w';
    }elseif(strcmp($str,"negative")){
        echo 'c';
    }elseif(strcmp($str,"null")){
        echo 's';
    }else{
        echo 'b';
    }
?> 
*/
