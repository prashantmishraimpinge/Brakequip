<?php


$q = Doctrine_Query::create()->from('UserAddress ua')
        ->innerJoin('ua.Users u WITH u.distributor = 1')
        ->where("address_type = 'delivery' AND lat != '0.000000' AND lat IS NOT NULL AND u.deleted = 0");

$results = $q->fetchArray();

$json = array();
foreach ($results as $result)
{
    if (empty($result['address1'])) {
        continue;
    }
    $row = array(
        'id' => $result['id'],
        'name' => $result['name'],
        'address' => $result['address1'],
        'address2' => $result['address2'],
        'city' => $result['suburb'],
        'state' => $result['state'],
        'postal' => $result['postcode'],
        'phone' => $result['phone'],
        'lat' => $result['lat'],
        'lng' => $result['lng'],
        'website' => $result['website']
    );
    $json[] = $row;
}

    print json_encode($json);
exit;

?>