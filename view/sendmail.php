<?php
require_once __DIR__.'/../model/SendMail.php';
$destinatario = "christian.berti961@gmail.com";
$subject = "Segnalazione n";
if(isset($_POST['user'])){
$user=$_POST['user'];
}
if(isset($_POST['messaggio'])){
$text = $_POST['messaggio'];
}
$sm = new SendMail($destinatario, $user, $text, $subject);

