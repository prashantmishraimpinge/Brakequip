<?php
// Make sure they are logged in
if (!sessionIdAuth($_REQUEST['sessionId'])) {
    $result = array('error' => 'You are required to login to view part details');
    print toXml($result, 'result');
    exit;
}

// Make sure part id exists
$partId = $_REQUEST['partId'];
if ($partId == 0) {
    $result = array('error' => 'Invalid part number');
    print toXml($result, 'result');
    exit;
}

// Make sure part id exists
if (!$part = WebPartTable::getInstance()->findOneByIdAndWebsiteDisplay($partId, true)) {
    $result = array('error' => 'Invalid part number');
    print toXml($result, 'result');
    exit; 
}
$part->cut_hose_at = $part->cut_hose_at.'mm';

$part = $part->toArray();

foreach ($part as $key => $value) {
    if (substr($key, -6) == "length" || substr($key, -7) == "fitting") {
        if (empty($value)) {
            $part[$key] = 'N/A';
        }
        else {
            if (substr($key, -6) == "length") {
                $part[$key] = $value.'mm';
            }
        }
    }
}

$categoryId = (int) $_REQUEST['categoryId'];
if ($categoryId > 0) 
{
    if ($category = WebCategoryTable::getInstance()->find($categoryId))
    {        
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

        $categoriesString = array();
        foreach ($breadcrumbs as $result) {
            $categoriesString[] = $result['name'];
        }
        $part['category'] = implode(' > ', $categoriesString);

        $categories = Doctrine_Query::create()->from('WebCategory')->where('parent_web_category_id = ?', $category->parent_web_category_id)->orderBy('sort_order ASC')->execute();
        $categoryList = array();
        foreach ($categories as $categoryObj) {
            $i++;
            $categoryList[] = array('label' => $categoryObj->name, 'data' => $categoryObj->id); 
        };
        $part['categoryList'] = $categoryList;

    }
}

if ($userSession = UserSessionsTable::getInstance()->findOneBySession($_REQUEST['sessionId'])) {
    if ($user = UsersTable::getInstance()->find($userSession->user_id)) {
        $part['username'] = $user->username;
    }
}
$part['url'] = WEBSITE_URL;
print toXml($part, 'part');
exit;
?>
