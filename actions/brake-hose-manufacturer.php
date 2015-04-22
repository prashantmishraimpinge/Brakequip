<?php

$states = array('VIC' => 'Victoria', 'NSW' => 'New South Wales', 'QLD' => 'Queensland', 'SA' => 'South Australia',
    'NT' => 'Northern Territory', 'WA' => 'Western Australia', 'TAS' => 'Tasmania', 'ACT' => 'Canberra', 'NZ' => 'New Zealand');

$results = false;
$stateName = false;
if (isset($states[@$_REQUEST['state']]))
{
    $state = $_REQUEST['state'];
    $stateName = $states[$state];
    
    $results = Doctrine_Query::create()->from('Users u')->innerJoin('u.UserAddress ua')->
            where("address_type = 'delivery' AND u.deleted = 0 AND u.distributor = 1 AND state = ?", $state)->fetchArray();
}
?>
