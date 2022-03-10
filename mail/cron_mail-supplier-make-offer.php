<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create sql connection
$servername = "localhost";
$username = "root";
$password = "";
$db = "punto_express";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);




$INTERVAL_MINUTES = 3; //min


//select active requests that now-created < 10min
$sql = 'SELECT * FROM requests WHERE requests.created > (NOW() - INTERVAL ' . $INTERVAL_MINUTES . ' MINUTE) AND is_manual = 0';
$resultRequests = mysqli_query($conn, $sql); 

$sql2 = 'SELECT userid, email, contact_email FROM users WHERE roleidfk = 1'; //select suppliers
$resultSuppliers = mysqli_query($conn, $sql2); 



//for each requests in last 10 min (interval)
while($request = mysqli_fetch_array($resultRequests)) {
  
  //calculate time that offer is live
  $time_needs_to_pass = $INTERVAL_MINUTES * 60 - 59; // sec, 
  $now = time();
  $created = strtotime($request["created"]);
  $time_passed = $now - $created; //seconds

  //CRON JOB NEEDS TO BE EVERY 2 MINS
  $sql3 = 'SELECT offer_useridfk FROM offers WHERE requestidfk = ' . $request['id'];
  $resultIds = mysqli_query($conn, $sql3); 
  var_dump('PASSEED');
  $offerersIds = [];
  while($id = mysqli_fetch_array($resultIds)) {    
    array_push($offerersIds, $id[0]);
  }

  
  //foreach supplier, if he didnt make an offer to request, send email
  while( $supplier = mysqli_fetch_array($resultSuppliers) ) {
    
    //if supplier didnt send the offer
    if( !in_array($supplier['userid'] , $offerersIds) && $time_passed > $time_needs_to_pass) {
      $email = $supplier['contact_email'] == "" ? $supplier['email'] : $supplier['contact_email'];
      //sendReminderEmail('schibuolanicholas@gmail.com', $request);
      sendReminderEmail('stofio@live.com', $request);
      return;
      //sendReminderEmail($email, $request);
    }

  }


}


function sendReminderEmail($supplierEmail, $request) {

  $mail = new PHPMailer(true);
  $mail->CharSet = 'UTF-8';
  $mail->IsSMTP();
  $mail->Mailer = "smtp";

  $mail->SMTPDebug  = 2;  
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "ssl";
  $mail->Port       = 465;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "puntosystemexpress@gmail.com";
  $mail->Password   = "ookylxsyngyyoxqp"; // google App Password


  $mail->IsHTML(true);
  $mail->SetFrom("puntosystemexpress@gmail.com", "Punto System Express");
  $mail->AddAddress($supplierEmail);
  //$mail->AddReplyTo("puntosystemexpress@gmail.com", "reply-to-name");
  //$mail->AddCC("mail@gmail.com", "cc-recipient-name");
  $mail->Subject = "Make your best offer for ID #" . $request['id'];
  
  
  /**
   * template
   */ 
  $template = file_get_contents('cron_mail-tmp-supplier-make-offer.html');  
  foreach($request as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
  }
  
  $content = $template;
  

  $mail->MsgHTML($content); 
  if(!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
  } else {
    echo "Email sent successfully";
  }
}










?>