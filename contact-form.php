<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'phpmailer/PHPMailerAutoload.php';


if (isset($_POST['inputName']) && isset($_POST['inputMessage'])) {

    //check if any of the inputs are empty
    
if (empty($_POST['inputName']) || empty($_POST['inputMessage'])) {
        $data = array('success' => false, 'message' => 'Пожалуйста, заполните форму полностью.');
        echo json_encode($data);
        exit;
    }


    //create an instance of PHPMailer
    $mail = new PHPMailer();
$mail->CharSet = 'utf-8';
ini_set('default_charset', 'UTF-8');
    $mail->From = $_POST['inputEmail'];
    $mail->FromName = $_POST['inputName'];
    $mail->AddAddress('feedback@goldfilled.com.ua'); //recipient 
    $mail->Subject = $_POST['inputSubject'];
    $mail->Body = "Имя: " . $_POST['inputName'] . "\r\n\r\nТелефон: " . $_POST['inputTel'] . "\r\n\r\nemail: " . $_POST['inputEmail'] . "\r\n\r\nСообщение: " . stripslashes($_POST['inputMessage']);

    if (isset($_POST['ref'])) {
        $mail->Body .= "\r\n\r\nRef: " . $_POST['ref'];
    }

    if(!$mail->send()) {
        $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        echo json_encode($data);
        exit;
    }

    $data = array('success' => true, 'message' => 'Thanks! We have received your message.');
    echo json_encode($data);

} else {

    $data = array('success' => false, 'message' => 'Пожалуйста, заполните форму полностью.');
    echo json_encode($data);

}

?>