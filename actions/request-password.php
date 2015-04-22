<?php

if (!empty($_REQUEST['username']))
{
    // Check if user exists
    $deleted = 0;
    if (!$user = UsersTable::getUserByUsername($_REQUEST['username'], $deleted)) {
        $result = array('e' => 'Invalid username');
        echo json_encode($result);
        exit;
    }
    
    if ($user['deleted']) {
        $result = array('e' => 'Invalid username');
        echo json_encode($result);
        exit;
    }
    
    $businessName = $user->username;
    if ($address = UserAddressTable::getAddress($user->id, 'invoice')) {
        $businessName = $address->name;
    }
    
    // Delete any previous passwords
    Doctrine_Query::create()->delete('UserPasswords')->where('user_id = ?', $user->id)->execute();

    // Create a new password for the user
    srand(time() * 999999999 * time());
    $newPassword = md5(time() . rand(0, 999999999));

    // insert into database
    $userPassword = new UserPasswords();
    $userPassword->user_id = $user->id;
    $userPassword->pass = new Doctrine_Expression("ENCODE('".$newPassword."', '".ENCRYPT_PASS."')");
    $userPassword->date_added = date('Y-m-d H:i:s');
    $userPassword->save();

    // send an email to user
    $loginUrl = WEBSITE_URL . "login/" . $newPassword;
    $newLoginUrl = 'http://www.brakequip.com.au/login/' . $newPassword;


    require_once 'include//classes/swift_mailer/swift_required.php';

    try {
        $transport = Swift_MailTransport::newInstance();
        //$transport = Swift_SmtpTransport::newInstance('mail.optusnet.com.au', 25);
        //$transport = Swift_SmtpTransport::newInstance('mail.brakequip.com.au', 25)->setUsername('daniel+brakequip.com.au')->setPassword('22011986');
        $mailer = Swift_Mailer::newInstance($transport);

        //Pass it as a parameter when you create the message
        $message = Swift_Message::newInstance();
        $message->setFrom(array('daniel@brakequip.com.au' => 'BrakeQuip Australia'));
        $message->setReplyTo(array('daniel@brakequip.com.au'));
        $message->setTo(array($user->email));
        $message->setSubject("BrakeQuip Online Applications - Login");

        // Get HTML Body
        $htmlBody = file_get_contents("templates/emails/login-email.html");

        $brakeQuipLogo = $message->embed(Swift_Image::fromPath("assets/images/brakequip-logo.png"));
        $chrome = $message->embed(Swift_Image::fromPath("assets/images/email/chrome.png"));
        $flashIE = $message->embed(Swift_Image::fromPath("assets/images/email/flash-ie.png"));
        $flashFF = $message->embed(Swift_Image::fromPath("assets/images/email/flash-ff.png"));
        $loginImage = $message->embed(Swift_Image::fromPath("assets/images/take-me-to.png"));
        //$brakeQuipOld = $message->embed(Swift_Image::fromPath("assets/images/email/brakequipOld.jpg"));
        //$brakeQuipNew = $message->embed(Swift_Image::fromPath("assets/images/email/brakequipNew.jpg"));
        
        // Replace vars
        $htmlBody = str_replace("\$nick", $user->username, $htmlBody);
        $htmlBody = str_replace("\$businessName", $businessName, $htmlBody);
        $htmlBody = str_replace("\$loginUrl", $loginUrl, $htmlBody);
        $htmlBody = str_replace("\$newLoginUrl", $newLoginUrl, $htmlBody);
        
        $htmlBody = str_replace("\$brakeQuipLogo", $brakeQuipLogo, $htmlBody);
        $htmlBody = str_replace("\$loginImage", $loginImage, $htmlBody);
        $htmlBody = str_replace("\$chromeImage", $chrome, $htmlBody);
        $htmlBody = str_replace("\$flashIEImage", $flashIE, $htmlBody);
        $htmlBody = str_replace("\$flashFFImage", $flashFF, $htmlBody);

        // Get TEXT Body
        $textBody = file_get_contents("templates/emails/login-email.txt");
        // Replace vars
        $textBody = str_replace("\$nick", $user->username, $textBody);
        $textBody = str_replace("\$businessName", $businessName, $textBody);
        $textBody = str_replace("\$loginUrl", $loginUrl, $textBody);
        $textBody = str_replace("\$newLoginUrl", $newLoginUrl, $textBody);

        // Set HTML body
        $message->setBody($htmlBody, 'text/html');

        // Set Text body
        $message->addPart($textBody, 'text/plain');

        // Send mail
        $mailer->send($message);
        
        $result = array('s' => 'Please check your email');
        echo json_encode($result);
        exit;

    } catch (Exception $e) {
        $error =  "Online Applications are currently offline. Please bare with us while we perform maintainance. Feel free to call us should you have any queries.";
        $result = array('e' => $error);
        echo json_encode($result);
        exit;
    }
}
?>
