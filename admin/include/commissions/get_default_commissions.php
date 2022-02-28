<?php
/**
 * ADMIN page with requests to approve
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


//get json file 
$jsonString = file_get_contents($_SERVER['DOCUMENT_ROOT']."/commissions_default.json");
$commissionsArr = json_decode($jsonString,true);


//DEFAULTS
$minComm = $commissionsArr['min_commission']; //euro
$margin = $commissionsArr['margin']; //euro
$molPerc = $commissionsArr['mol_perc']; //%



?>