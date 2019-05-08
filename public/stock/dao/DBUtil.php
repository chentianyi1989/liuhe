<?php


// define('ONS_ROOT', dirname(__FILE__));
include_once('cls_mysql_config.php');
// include_once('cls_mysql.php');
// include_once('cls_dao.php');



$db = new mysql_db(DB_HOST, DB_USER, DB_PASSWD, DB_NAME ,DB_UT);

// $rows = $db->select("game_record", "where 1=1");
// print_r($rows);
// $data = [];
// $data["billNo"] = 2;
// $data["api_type"] = 2;
// $data["playerName"] = "playerName2";
// $data["name"] = "name2";
// $data["member_id"] = 2;

// $db->insert("game_record", $data);

// $rows = $db->select("game_record", "where 1=1");
// print_r($rows);
// $rs = array();     
// foreach($rows as $row) {
//     $rs[] = $row;      
// }   





class mysql_db {
    
    var $conn;
    
    function __construct($dbHost = '', $dbUser = '', $dbPass = '', $dbName = ''){
       
        $this->conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $this->conn->query('set names utf8;');
    }
    
    function insert($table,$inserts){
        $sql = "insert into ".DB_PREFIX."$table({keys}) values({values})";
        $keys = "";
        $values = "";
        foreach ($inserts as $key => $value)
        {
            $keys .= $key . ",";
            $values .= "'".$value."',";
        }
        $keys = substr($keys,0,strlen($keys)-1);
        $values = substr($values,0,strlen($values)-1);
        $sql = str_replace('{keys}',$keys,$sql);
        $sql = str_replace('{values}',$values,$sql);
        //echo "insert:$sql\n";
        $this->conn->exec($sql);
    }
    
    function select($table,$where="") {
        $sql = "select * from $table $where";
        return $this->query($sql);
    }
    
    function query($sql) {
        //echo "sql:$sql\n";
        $query = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $query;  
    }
}
?>