<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Habilita a autenticação SMTP?
$mail_smtp_auth = true;



// Servidor de saída
//mail_host = 'smtp.gmail.com';
$mail_host = 'mail.fsanches.com';
//$mail_port = 587;
$mail_port = 587;

// Criptografia do envio SSL 
$mail_smtp_secure = 'tls';

// Conta para disparo de e-mails
$mail_username = 'temp-test-123@fsanches.com';
$mail_Password = 'temp-test-245!';

$mail = new PHPMailer(true);

try
{
    // Configurações do servidor
    $mail->isSMTP();        //Devine o uso de SMTP no envio
    $mail->SMTPAuth = $mail_smtp_auth;
    $mail->Username = $mail_username;
    $mail->Password = $mail_Password;
    $mail->SMTPSecure = $mail_smtp_secure;
    $mail->Host = $mail_host;
    $mail->Port = $mail_port;
    // Define o remetente
    $mail->setFrom('temp-test-123@fsanches.com', 'Nome do Remetente');
    // Define o destinatário
    $mail->addAddress('fellipes@yahoo.com.br', 'Destinatário');
    // Conteúdo da mensagem
    $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
    $mail->Subject = 'Assunto';
    $mail->Body    = 'Este é o corpo da mensagem <b>Olá em negrito!</b>';
    $mail->AltBody = 'Este é o cortpo da mensagem para clientes de e-mail que não reconhecem HTML';
    // Enviar
    $mail->send();
}
catch (Exception $e)
{
    $response['message'] = "A mensagem não pode ser enviada devido a uma falha. Por favor tente novamente mais tarde. {$mail->ErrorInfo}";
}
