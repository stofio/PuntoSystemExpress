<?php

$string = file_get_contents($_SERVER['DOCUMENT_ROOT']."/commissions.json");
$json_a = json_decode($string,true)['commissions'];

var_dump($json_a);

// foreach ($json_a as $key => $value){
//   echo  $key . ':' . $value;
// }

?>