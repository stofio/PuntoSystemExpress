<?php

$minComm = $_POST['min_commission']; //euro
$margin = $_POST['margin']; //euro
$molPerc = $_POST['mol_perc']; //%

$json = array('min_commission' => $minComm, 'mol_perc' => $molPerc, 'margin' => $margin);

$commissionsStr = json_encode($json,true);

$fp = fopen($_SERVER['DOCUMENT_ROOT']."/commissions_default.json", 'w');
fwrite($fp, $commissionsStr);
fclose($fp);

?>