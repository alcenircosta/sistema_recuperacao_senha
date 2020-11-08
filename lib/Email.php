<?php
require_once ('vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email{

 public $mail;
 private $host = 'smtp.gmail.com';
 private $username = 'aallcenir.9000@gmail.com';
 private $password = 'kni>3azvb?';

//  RecipientEmail, RecipientName, Subject, Body
public function send_email($RecipientEmail, $Subject, $Body){
    $this->mail = new PHPMailer();
try {
    $this->mail->isSMTP();                                            // Send using SMTP
    $this->mail->Host       = $this->host;                    // Set the SMTP server to send through
    $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $this->mail->SMTPSecure   = 'ssl';                               
    $this->mail->Username   = $this->username;                     // SMTP username
    $this->mail->Password   = $this->password;                               // SMTP password
    $this->mail->Port       = 465;             
    $this->mail->Charset = 'UTF-8';

    //Recipients
    $this->mail->setFrom('aallcenir.9000@gmail.com', 'Alcenir');
    $this->mail->addAddress($RecipientEmail);     // Add a recipient
    $this->mail->addReplyTo('aallcenir.9000@gmail.com', 'Alcenir');

    // Content
    $this->mail->isHTML(true);                                  // Set email format to HTML
    $this->mail->Subject = $Subject;
    $this->mail->Body    = $Body;
    $this->mail->AltBody = strip_tags($Body);

    if($this->mail->send()){
        return true;
    }else{
        return false;
    }
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
}

}
}

    // echo "Enviar email<br/>";
  // $email = new Email();
  // $recipientEmail = 'alcenir.1994@gmail.com';
  // $recipientName = 'Teste';
  // $subject = "Teste Classe PHPMailer";
  // $body = "<h1>Texto com tags <i>HTML</i></h1>";
  // $email->send_email($recipientEmail,$recipientName,$subject,$body);


?>