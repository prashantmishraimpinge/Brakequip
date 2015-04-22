<?php 
if (!isset($_POST['type'])) {
    exit;
}

if ($_POST['type'] == 'search') {
    $fields = array('location', 'radius', 'total');
}
else {
    $fields = array('id');
}

foreach ($fields as $field) 
{
    // If no set, don't record
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        exit;
    }
    // trim and escape
    $_POST[$field] = trim(mysql_escape_string($_POST[$field]));
}

if ($_POST['type'] == 'search') {
    $search = new DistributorSearch();
    $search->location = $_POST['location'];
    $search->radius = $_POST['radius'];
    $search->total_results = $_POST['total_results'];
    $search->created_at = date('Y-m-d H:i:s');
    $search->save();
}
elseif ($_POST['type'] == 'click') {
    $stat = new DistributorStats();
    $stat->user_address_id = $_POST['id'];
    $stat->created_at = date('Y-m-d H:i:s');
    $stat->save();
}
exit;
?>