<?php
require_once _DIR_ROOT.'/include/classes/swift_mailer/swift_required.php';

$transport = Swift_MailTransport::newInstance();
$mailer = Swift_Mailer::newInstance($transport);

//Pass it as a parameter when you create the message
$message = Swift_Message::newInstance();
$message->setFrom(array('daniel@brakequip.com.au' => 'BrakeQuip Australia'));
$message->setReplyTo(array('daniel@brakequip.com.au'));
$message->setTo(array('daniel@brakequip.com.au'));
$message->setSubject("HOSE INACCURANCY REPORT");

$part = WebPartTable::getInstance()->find($_POST['partId']);
$user = UserAddressTable::getAddress($_SESSION['userId'], 'invoice');

// Get HTML Body
ob_start();
require_once _DIR_ROOT.'/templates/emails/hose-inaccurancy.html';
$htmlBody = ob_get_contents();
ob_end_clean();

// Get TEXT Body
ob_start();
require_once _DIR_ROOT.'/templates/emails/hose-inaccurancy.txt';
$textBody = ob_get_contents();
ob_end_clean();

// Set HTML body
$message->setBody($htmlBody, 'text/html');

// Set Text body
$message->addPart($textBody, 'text/plain');

// send mail
$mailer->send($message);

echo "good";

exit;
?>