
<?php
    $dsn = "mysql:host=localhost;dbname=tinyretail;charset=utf8"; // Database name
    $user = "root";           // Databese User Name
    $password = "mysql0001";        // Database Password
    $dbh = new PDO($dsn, $user, $password);

    $sql= "SELECT * FROM julius order by desc limit 1";
    $result = mysql_query($sql);
    
    while($row = mysql_fetch_assoc($result)){
        $str = $row['favor'];
    }
    $result->close();
    if(strcmp($str,"positive")){
        echo 'w';
    }elseif(strcmp($str,"negativce")){
        echo 'c';
    }elseif(strcmp($str,"null")){
        echo 's';
    }else{
        echo 'b';
    }
?> 
