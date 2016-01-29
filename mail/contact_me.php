<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
// Create the email and send the message
$to = 'vadmak@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website orderForm:  $name";
$email_body = 
'<html>
<head>
 <title>Вы получили новое сообщение website order form.</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
</head>
 <body>
 	<h1>Подробности заказа:</h1>
 	<div class="row">
 		<div class="col-xs-4">
 			<h2>Name: </h2>'. $name . '</div><div class="col-xs-4"><h2>eMail: </h2>'. $email_address . '</div><div class="col-xs-4"><h2>Phone: </h2>' . $phone . 
 	'</div></div><div class="row"><div class="col-xs-12">'.
 	$message.
 	'</div></div></body>
 </html>';
// Для отправки HTML-письма должен быть установлен заголовок Content-type
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 	
$headers .= "From: noreply@goldfilled.com.ua\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>