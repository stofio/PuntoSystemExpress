<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/mail/mail_settings.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


/**
 * template ($array_termin near inclusion)
 */
if($isManaul) { //IF MANUAL
    $template = file_get_contents( __DIR__ . '/tmp_admin_manual.html');  
    foreach($array_termin as $row => $value){
        $template = str_replace('{{ '.$row.' }}', $value, $template);
    }

    $colliHTML = '';
    $jsonColli = $array_termin["colli"];
    $colli = unserialize($jsonColli);
    //var_dump($colli['colli']);
    foreach ($colli['colli'] as $c) {
        $n = $c['name'];
        $we = $c['weight'];
        $le = $c['lenght'];
        $wi = $c['width'];
        $hi = $c['height'];
        $st = $c['stack'] == 1 ? '✓' : '✗';
        $colliHTML .= "<p style='font-size: 12px; line-height: 160%;'><b>$n</b> - [ Weight: $we Kg ], [ Lenght: $le cm ], [ Width: $wi cm ], [ Height: $hi cm ], [ Stackable: $st ]</p>";
        echo $colli . '<br>';
        
    }
    //append colli to tmp
    $template = str_replace('{{ colli_ship }}', $colliHTML, $template);
}
else { //IF NOT MANUAL
    $template = file_get_contents( __DIR__ . '/tmp_admin.html');  
    foreach($array_termin as $row => $value){
        $template = str_replace('{{ '.$row.' }}', $value, $template);
    }
}



/**
 * send email
 */
$to = $AdminEmail; //admin email
$ccArray = $ccAdminEmail;

$subject = "Waiting admin confirmation ID #" . $reqId;
$content = $template;


sendEmail($to, $subject, $content, $ccArray);

?>