<?php
namespace Fellipe\Classes;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// For tests
// $_POST['name'] = 'Fellipe Sanches';
// $_POST['email'] = 'fellipes@yahoo.com.br';
// $_POST['phone'] = '21123456789';
// $_POST['message'] = 'a message';

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/phpmailer/phpmailer/src/Exception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/phpmailer/phpmailer/src/SMTP.php';

require_once 'Classes/Forms.php';
require_once 'Classes/FormsValidation.php';
require_once 'Classes/Files.php';
require_once 'Classes/Messages.php';
require_once 'Classes/Templates.php';

// Include the general config file
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/general_config.php';

// Include the mail config file
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/mail_config.php';

// Initial definitions
$messages_file = $_SERVER['DOCUMENT_ROOT'] . '/config/messages.json';
$messages = new Messages($messages_file);

// Form obj
$form = new Forms('main_form_contact');
$form->generateAttributes($_POST, $_FILES);
$form->response_message = $messages->email_sent_successfully;

// Form Validations obj
$form_validation = new FormsValidation();
($form_validation->hasBlankFields($form->all) === false) ? null : $form->response_message = $messages->has_blank_fields;
($form_validation->hasInvalidEmail($form->email) === false) ? null : $form->response_message = $messages->has_invalid_email;
($form_validation->hasInvalidPhone($form->phone) === false) ? null : $form->response_message = $messages->has_invalid_phone;
($form_validation->hasNoAttachment($form->attachment) === false) ? null : $form->response_message = $messages->has_no_attachment;
($form_validation->hasInvalidAttachmentType($form->attachment, $allowed_types) === false) ? null : $form->response_message = $messages->has_invalid_attachment_type;

// File obj
$attachment = new Files($form->attachment);
(($attachment->saved_file_size / 1024) <= 500) ? null : ($form->response_message = $messages->has_invalid_attachment_size) && ($form_validation->error = true);
// Check for errors reported before proceeding
($form_validation->error === false) ? $attachment->uploadFile($upload_dir) : null;

// Include the database config file
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db_config.php';

// Check for errors reported before proceeding
if ($form_validation->error === false) {
    try
    {
        // Insert form data in the database 
        $insert = $db->query(
            "INSERT INTO form_data (
                name, 
                email, 
                phone, 
                file_name, 
                message, 
                client_ip_address, 
                proxied_ip_address) 
            VALUES (
                '{$form->name}',
                '{$form->email}',
                '{$form->phone}',
                '{$attachment->saved_file_url}',
                '{$form->message}',
                '{$form->client_ip_address}',
                '{$form->client_proxied_ip_address}')"
        );
    }
    catch (Exception $e)
    {
        $form->response_message = $messages->sending_failed;
        $form_validation->error = true;
    }    
}

// Check for errors reported before proceeding
if ($form_validation->error === false) {

    try
    {
        //Templates obj
        $template_dir = $_SERVER['DOCUMENT_ROOT'] . '/templates/mail.tpl';
        $mail_body = new Templates;
        $mail_body->renderTemplate(
            $template_dir, array(
                'name' => $form->name, 
                'email' => $form->email, 
                'phone' => $form->phone, 
                'saved_file_name' => $attachment->saved_file_name, 
                'message' => $form->message
            )
        );

        // E-mail obj
        $mail = new PHPMailer(true);

        // From mail_config file
        $mail->isSMTP();
        $mail->SMTPAuth = $mail_smtp_auth;
        $mail->Username = $mail_username;
        $mail->Password = $mail_password;
        $mail->SMTPSecure = $mail_smtp_secure;
        $mail->Host = $mail_host;
        $mail->Port = $mail_port;
        $mail->setFrom($mail_username, "Remetente");
        $mail->addAddress("{$form->email}", "{$form->name}");
        // Message content
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->Subject = "Não responda - Cópia do formulário enviado em {$_SERVER['SERVER_NAME']}";
        $mail->Body    = $mail_body->template_rendered;
        $mail->AltBody = strip_tags($mail_body->template_rendered);
        // Send...
        $mail->send();
    }
    catch (Exception $e)
    {
        $form->response_message = $messages->sending_failed;
        $form_validation->error = true;
        // log $mail->ErrorInfo";
    }
}

// Return response to js
$response = array( 
    'error' => $form_validation->error, 
    'message' => $form->response_message
); 

echo json_encode($response);