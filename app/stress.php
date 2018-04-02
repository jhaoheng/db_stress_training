<?php  
use Phalcon\Db\Adapter\Pdo\Mysql;

/*
use phalcon mysql
 */
function stress_1($db){
  $connection = new Mysql(
    array(
        "host"      => $db["host"],
        "port"      => $db["port"],
        "username"  => $db["username"],
        "password"  => $db["password"],
        "dbname"    => $db["dbname"],
        'charset'   => $db["charset"]
    )
  );
  $connection->connect();
  $r = $connection->fetchAll("select * from users");
  print_r($r);
}

/*
use mysqli
 */
function stress_2($db){
  $servername = $db["host"];
  $username = $db["username"];
  $password = $db["password"];
  $dbname = $db["dbname"];
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 

  $sql = "SELECT * FROM users";
  $result = $conn->query($sql);
  $r = mysqli_fetch_all($result, MYSQLI_ASSOC);
  print_r($r);
}

/*
use class & phalcon mysql
 */
function stress_3(){
  $mysql = new Mysql_Manager;
  $r = $mysql->fetchAll("select * from users", []);
  var_dump($r);
}

/*
use di to get phalcon mysql
 */
function stress_4($app){
  $conn = $app->di->get("mysql");
  $r = $conn->fetchAll("select * from users", 
    \Phalcon\Db::FETCH_ASSOC,
    []
  );
  print_r($r);
}

$database = (array)$app->config->database;

// stress_1($database);

// stress_2($database);

// stress_3();

stress_4($app);




?>