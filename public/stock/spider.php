<?php 



$url = 'http://nufm.dfcfw.com/EM_Finance2014NumericApplication/JS.aspx?cb=jQuery112409565291025728165_1557262222980&type=CT&token=4f1862fc3b5e77c150a2b985b12db0fd&sty=FCOIATC&js=({data:[(x)],recordsFiltered:(tot)})&cmd=C._A&st=(ChangePercent)&sr=-1&p=1&ps=9999999&_=1557262222990';
$content = file_get_contents($url);

$content = substr($content,strpos($content, '(')+1,-1);
$content = str_replace("data","\"data\"",$content);
$content = str_replace("recordsFiltered","\"recordsFiltered\"",$content);
$content = json_decode($content,true);
// var_dump($content);





// $dbHost = "127.0.0.1:3307";
// $dbName = "liuhe";
// $dbUser = "root";
// $dbPass = "123456";

// new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);


include_once('dao/DBUtil.php');


// 
$datas = $content["data"];

// var_dump($datas);
foreach ($datas as $val) {
    $d = explode(",",$val);
    $inserts = ["code"=>$d[1],"name"=>$d[2]];
    $db->insert("stock", $inserts);
//     echo $d[0],",",$d[1],",",$d[2],"<br/>";
}

echo "over";


//$r = $db->select("ball","where 1=1");
//var_dump($r);





?>