<?php
function subval_sort($a, $subkey) {
    foreach ($a as $k => $v) {
        $b[$k] = strtolower($v[$subkey]);
    }
    asort($b, SORT_NUMERIC);
    foreach ($b as $key => $val) {
        $c[] = $a[$key];
    }
    return $c;
}

function get_data($url)
{
  $ch = curl_init();
  $timeout = 10;
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}


// Get parameters from URL
$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = @$_GET["radius"];
$fromRadius = (isset($_GET["fromRadius"]) && !empty($_GET["fromRadius"]) ? (int) $_GET["fromRadius"] : false);
$toRadius = (isset($_GET["toRadius"]) && !empty($_GET["toRadius"]) ? (int) $_GET["toRadius"] : false);
$fromAddress = $_GET['address'];

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);


$q = Doctrine_Query::create()->from('UserAddress ua')->innerJoin('ua.Users u WITH u.distributor = 1');
$q->select("*, ua.id as id, ( 3959 * acos( cos( radians('".$center_lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$center_lng."') ) + sin( radians('".$center_lat."') ) * sin( radians( lat ) ) ) ) AS distance");
//$q->select("*, ua.id as id, ( 6371 * acos( cos( radians('".$center_lat."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('".$center_lng."') ) + sin( radians('".$center_lat."') ) * sin( radians( lat ) ) ) ) AS distance");
$q->addWhere("address_type = 'delivery' AND lat != '0.000000' AND u.deleted = 0");
$q->orderBy('distance ASC');

if ($fromRadius || $toRadius) {
        if ($fromRadius) {
            $q->addHaving('distance >= ?', $fromRadius);
        }
        if ($toRadius) {
            $q->addHaving('distance <= ?', $toRadius);
        }
} else {        
        $q->addHaving('distance < ?', $radius);
}


$result = $q->fetchArray();

header("Content-type: text/xml");

// Run through results, and calculate distance from google
$results = array();
$overLimit = false;
foreach ($result as $row) {

    foreach ($row as $k => $r) {
        $row[$k] = trim($r);
    }

    $address = ucwords((!empty($row['address1']) ? $row['address1'] . ' ' : '') . (!empty($row['address2']) ? $row['address2'] . ' ' : '') . $row['suburb'] . ' ' . $row['state'] . ' ' . $row['postcode']);
    $row['address'] = $address;
    // Want to get actual distance from directions.
    
    $distance = (float) $row['distance'];
    if (!$overLimit) {
        $json = get_data("http://maps.googleapis.com/maps/api/directions/json?origin=" . urlencode($fromAddress) . "&destination=" . str_replace(' ', '+', $address) . "&sensor=false");
        $data = json_decode(utf8_encode($json), true);
        if (strtoupper($data['status']) == 'OVER_QUERY_LIMIT') {
            $overLimit = true;
        } elseif (strtoupper($data['status']) == 'OK' && isset($data['routes'][0]['legs'][0]['distance']['text'])) {
            $distance = (float) $data['routes'][0]['legs'][0]['distance']['text'];
        }
    }
    $row['distance'] = $distance;
    $results[] = $row;
}

if ($results) {
    // Sort by distance
    $results = subval_sort($results, 'distance');
}

foreach ($results as $row) {
  
  // Skip distance if more than radius
  $distance = (float) $row['distance'];
  if ($toRadius) {
      if (($distance-$toRadius) > $toRadius) {
        continue;
      }
  }
  elseif ($distance > $radius) {
      continue;
  }
    
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("id", strtoupper($row['id']));
  $newnode->setAttribute("name", strtoupper($row['name']));
  $newnode->setAttribute("address", trim($row['address']));
  $newnode->setAttribute("address1", ucwords(strtolower($row['address1'])));
  $newnode->setAttribute("address2", ucwords(strtolower($row['address2'])));
  $newnode->setAttribute("suburb", ucwords(strtolower($row['suburb'])));
  $newnode->setAttribute("state", ucwords(strtolower($row['state'])));
  $newnode->setAttribute("postcode", $row['postcode']);
  $newnode->setAttribute("phone", $row['phone']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("distance", $row['distance'] . 'km');
}

echo $dom->saveXML();
exit;
?>