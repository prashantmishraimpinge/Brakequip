<?php
require_once _DIR_ROOT.'/include/classes/swift_mailer/swift_required.php';

$requiredFields = array('name', 'make', 'model');
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $result = array('e' => 'Please do not leave required fields blank');
        echo json_encode($result);
        exit;
    }
}


$transport = Swift_MailTransport::newInstance();
$mailer = Swift_Mailer::newInstance($transport);

//Pass it as a parameter when you create the message
$message = Swift_Message::newInstance();
$message->setFrom(array('daniel@brakequip.com.au' => 'BrakeQuip Australia'));
$message->setReplyTo(array('daniel@brakequip.com.au'));
$message->setTo(array('daniel@brakequip.com.au'));
$message->setSubject("VEHICLE REQUEST FOR CATALOGUE");

// Get HTML Body
ob_start();
require_once _DIR_ROOT.'/templates/emails/request-vechile.html';
$htmlBody = ob_get_contents();
ob_end_clean();

// Get TEXT Body
ob_start();
require_once _DIR_ROOT.'/templates/emails/request-vechile.txt';
$textBody = ob_get_contents();
ob_end_clean();

// Set HTML body
$message->setBody($htmlBody, 'text/html');

// Set Text body
$message->addPart($textBody, 'text/plain');


$result = array('s' => 'Thank you for your request');
echo json_encode($result);

// Send mail
$mailer->send($message);

exit;
?>