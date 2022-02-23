<?php

$minComm = $_POST['min_commission']; //euro
$molPerc = $_POST['mol_perc']; //%

$json = array('min_commission' => $minComm, 'mol_perc' => $molPerc);

$commissionsStr = json_encode($json,true);

$fp = fopen($_SERVER['DOCUMENT_ROOT']."/commissions_default.json", 'w');
fwrite($fp, $commissionsStr);
fclose($fp);

?>