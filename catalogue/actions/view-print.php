<?php
auth('redirect');

$id = (int) $_REQUEST['id'];
$categoryId = (int) $_REQUEST['categoryId'];

if ($id == 0 || $categoryId == 0) {
    header('Location: /applications');
    exit;
}

// Get part
$part = Doctrine_Query::create()->from('WebPart wp')->innerJoin('wp.WebPartToCategory wc')->where("web_category_id = ? AND ill_number != ''", $categoryId)->fetchOne();

if ($part) {
        preg_match("/[A-Z]*/", $part->bq_number, $matches);
        $partAlpha = $matches[0];
        $partNumber2 = $part->bq_number;
        preg_match_all("{(\d+-*)}", $partNumber2, $matches2);
        $partNumber = implode("", $matches2[0]);
}

// Get category
$category = WebCategoryTable::getInstance()->find($categoryId);

$breadcrumbs = array();
if ($category) {
    $breadcrumbs[] = array('id' => $category->id, 'name' => $category->name, 'type' => $category->web_category_type_id);
    $breadcrumbId = $category->parent_web_category_id;

    while ($breadcrumbId > 0) {
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
?>
