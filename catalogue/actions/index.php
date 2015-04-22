<?php

$categoryId = (int) $_REQUEST['categoryId'];
$category = false;
if ($categoryId > 0) {
    $category = WebCategoryTable::getInstance()->find($categoryId);
}

if ($category)
{
    $parentCategory = $category;
    
    // Get categories
    $categories = Doctrine_Query::create()->from('WebCategory')->where('parent_web_category_id = ? AND hidden = ?', array($categoryId, false))->orderBy('sort_order ASC')->execute();

    // get category type
    $categoryType = WebCategoryTypeTable::getInstance()->find($parentCategory->sibling_web_category_type_id);
    
} 
else
{
    // Get first level of category type
    $categoryType = WebCategoryTypeTable::getInstance()->find(1);

    // Get categories
    $categories = Doctrine_Query::create()->from('WebCategory')->where('parent_web_category_id = ? AND hidden = ?', array(0, false))->orderBy('sort_order ASC')->execute();
}

// If no category type, then check for product
$part = false;
if (!$categoryType) {
    $part = Doctrine_Query::create()->from('WebPart wp')->innerJoin('wp.WebPartToCategory')->where("web_category_id = ? AND ill_number != ''", $categoryId)->fetchOne();
}

$breadcrumbs = array();
if ($category) {
    $breadcrumbs[] = array('id' => $category->id, 'name' => $category->name, 'type' => $category->web_category_type_id);
    $breadcrumbId = $category->parent_web_category_id;

    while ($breadcrumbId > 0)
    {
        $breadcrumb = WebCategoryTable::getInstance()->find($breadcrumbId);
        if (!$breadcrumb) {
            break;
        }
        $breadcrumbId = $breadcrumb->parent_web_category_id;
        if ($breadcrumbId == 0) {
            $breadcrumbId = $breadcrumb->id;
            $breadcrumb = WebCategoryTable::getInstance()->find($breadcrumbId);
            $breadcrumbs[] = array('id' => $breadcrumb->id, 'name' => $breadcrumb->name, 'type' => $breadcrumb->web_category_type_id);
            break;
        }
        $breadcrumbs[] = array('id' => $breadcrumb->id, 'name' => $breadcrumb->name, 'type' => $breadcrumb->web_category_type_id);
    }
    $breadcrumbs = array_reverse($breadcrumbs);
}
$breadcrumbCount = count($breadcrumbs);
$categoriesString = array();
foreach ($breadcrumbs as $result) {
    $categoriesString[] = $result['name'];
    $webCategories[$result['id']]['str'] = implode(' > ', $categoriesString);
    $webCategories[$result['id']]['type'] = $result['type'];
}
$categoriesString = implode(' > ', $categoriesString);

reset($breadcrumbs);

$categories2 = array();
if (!$categoryType) {
    // Get sibling categories
    $categories2 = Doctrine_Query::create()->from('WebCategory')->where('parent_web_category_id = ? AND hidden = ?', array($breadcrumbs[count($breadcrumbs) - 2]['id'], false))->orderBy('sort_order ASC')->execute();
}


if ($part) {
        preg_match("/[A-Z]*/", $part->bq_number, $matches);
        $partAlpha = $matches[0];
        $partNumber2 = $part->bq_number;
        preg_match_all("{(\d+-*)}", $partNumber2, $matches2);
        $partNumber = implode("", $matches2[0]);
        
        $imageSize = getimagesize(_DIR_ROOT.'/products/'.$part->ill_number.'_s.jpg');
        $height = $imageSize[1];
        $objectHeight = $height + 240;


	// get number of hits by a user in a day.
 	$userID = $_SESSION['userId'];
	$date = date('Y-m-d');
	$viewCount = Doctrine_Query::create()->select('COUNT(p.id)')->from('PartView p')->where('user_id = ? AND DATE(created_at) = ?', array($userID, $date));
	$viewArray = $viewCount->fetchArray();
	$countOfRows = $viewArray[0]['COUNT'];
	// end code

	// get threshold settings and emails stored in the database.
	$restriction = Doctrine_Query::create()->select('s.VALUE')->from('Settings s')->where('ID = ?', 4);
        $resdata = $restriction->fetchArray();

	// get user threshold limit.
	$userID = $_SESSION['userId'];
	$restrictionUser = Doctrine_Query::create()->select('u.THRESHOLD')->from('Users u')->where('ID = ?', $userID);
        $resdataUser = $restrictionUser->fetchArray();
	$userThreshold = $resdataUser[0]['threshold'];
	# get decoded json data.
        $dataUse = json_decode($resdata[0]['value'],true);
        # make an emails string.
        $emailsArray = $dataUse['emails'];
        # set threshold.
        $threshold = $dataUse['threshold'];
	// end

	$threshold = ($userThreshold == 0)?$threshold:$userThreshold;

	// send an email to admins to notify about the problem.
        $hosename = $breadcrumbs[0]['name'].' '.$breadcrumbs[1]['name']. " - " .$partAlpha.$partNumber;
        $breadcrumbmail = array();
	foreach ($breadcrumbs as $breadcrumb):
        $breadcrumbmail[] = $breadcrumb['name'];
        endforeach;
	$breadcrumbfinal = implode(' > ',$breadcrumbmail);
        $breadcrumbfinalFooter = implode(' ',$breadcrumbmail);
	$fullpathofhose = $breadcrumb;
        
        // t save data in hose view to send in email in footer
        $hosenamefooter = $partAlpha.$partNumber;
        $useridfooter = $_SESSION['userId'];
        $breadcumbfooter = $breadcrumbfinalFooter;
        
        
          // get stored data of view for the day
         $getUserHoseDataArray = array();
         $getUserHoseData = Doctrine_Query::create()->select('H.part_number, H.breadcrumb, H.datetime')->from('UserHose H')->where('user_id = ? and DATE(datetime) = ?', array($useridfooter,$date));
         $getUserHoseDataArray = $getUserHoseData->fetchArray();
         $htmltoday = "No data found.";
         if(count($getUserHoseDataArray) > 0) {
         $htmltoday = '';
         foreach($getUserHoseDataArray as $value) {
             $time = date("h.i A", strtotime($value['datetime']));
             $htmltoday .= "<span style='font-size:12px; padding: 5px 0 5px 0;'>- ".$value['part_number']." || ".$value['breadcrumb']." || ".$time."</span><hr>";
         }
         }
          // end
        // end
        
        
        
	if($countOfRows >= $threshold) {
	
	require_once 'include//classes/swift_mailer/swift_required.php';
        $transport = Swift_MailTransport::newInstance();
        //$transport = Swift_SmtpTransport::newInstance('mail.optusnet.com.au', 25);
        //$transport = Swift_SmtpTransport::newInstance('mail.brakequip.com.au', 25)->setUsername('daniel+brakequip.com.au')->setPassword('22011986');
        $mailer = Swift_Mailer::newInstance($transport);

        //Pass it as a parameter when you create the message
        $message = Swift_Message::newInstance();
        $message->setFrom(array('daniel@brakequip.com.au' => 'BrakeQuip Australia'));
        $message->setReplyTo(array('daniel@brakequip.com.au'));
        $message->setTo($emailsArray);
	$user = $_SESSION['user'];
	$name = $_SESSION['name'];
	$account = $_SESSION['user_logins_id'];
	$time = date('d/m/Y H:i:s');
	
	
        $message->setSubject("BrakeQuip - Excess usage notification");

        // Get HTML Body
        $htmlBody = file_get_contents("templates/emails/email-alert.html");

        $brakeQuipLogo = $message->embed(Swift_Image::fromPath("assets/images/brakequip-logo.png"));

        // Replace vars
        $htmlBody = str_replace("\$admin", 'Admin', $htmlBody);
		$htmlBody = str_replace("\$account", $account, $htmlBody);
		$htmlBody = str_replace("\$name", $name, $htmlBody);
        $htmlBody = str_replace("\$user", $user, $htmlBody);
		$htmlBody = str_replace("\$time", $time, $htmlBody);
		$htmlBody = str_replace("\$hosename", $hosename, $htmlBody);
		$htmlBody = str_replace("\$fullhosepath", $breadcrumbfinal, $htmlBody);
        $htmlBody = str_replace("\$fullhosetoday", $htmltoday, $htmlBody);
        $htmlBody = str_replace("\$brakeQuipLogo", $brakeQuipLogo, $htmlBody);

        // Set HTML body
        $message->setBody($htmlBody, 'text/html');

        // Send mail
        $mailer->send($message);
	// end
	}
}

$excludeFromStats = unserialize(EXLUDE_FROM_STATS);

// Add view category stat
if (!in_array($_SESSION['user'], $excludeFromStats))
{
    if ($categoryId > 0 && $category->sibling_web_category_type_id == 0) {
        $categoryView = new CategoryView();
        $categoryView->user_logins_id = $_SESSION['user_logins_id'];
        $categoryView->created_at = date('Y-m-d H:i:s');
        $categoryView->save();
        
        foreach ($webCategories as $webCategoryId => $webCategory) {
            $categoryViewGroup = new CategoryViewGroup();
            $categoryViewGroup->category_view_id = $categoryView->id;
            $categoryViewGroup->web_category_type_id = $webCategory['type'];
            $categoryViewGroup->web_category_id = $webCategoryId;
            $categoryViewGroup->category_string = $webCategory['str'];
            $categoryViewGroup->created_at = date('Y-m-d H:i:s');
            $categoryViewGroup->save();
        }
    }
    // If part exists, add view part stat
    if ($part) {
	if($countOfRows < $threshold) {
        $partView = new PartView();
        $partView->web_part_id = $part->id;
        $partView->category_view_id = $categoryViewId;
        $partView->user_logins_id = $_SESSION['user_logins_id'];
        $partView->created_at = date("Y-m-d H:i:s");
	$partView->user_id = $_SESSION['userId'];
        $partView->save();
        
        
        $UserHose = new UserHose();
        $UserHose->user_id = $useridfooter;
        $UserHose->part_number = $hosenamefooter;
        $UserHose->breadcrumb = $breadcumbfooter;
        $UserHose->save();
        
	}
    }
}
?>
