<?php
if (count($cart->getItems()) == 0) {
    header("Location: /applications");
    exit;
}

if (!isset($_SESSION['order'])) {
    header('Location: /applications');
    exit;
}

$order = $_SESSION['order'];

// Add comment to order array
$order['comments'] = $_POST['comments'];

// Get delivery address
$deliveryAddressString = false;
if (isset($_POST['deliveryAddress'])) {
    $deliveryAddressString = $_POST['deliveryAddress'];
}

$invoiceAddress  = UserAddressTable::getAddress($_SESSION['userId'], 'invoice');

if (!$deliveryAddressString) {
    $deliveryAddress = UserAddressTable::getAddress($_SESSION['userId'], 'delivery');

    $deliveryAddressString = 'Unknown';
    if ($deliveryAddress) {
        $deliveryAddressString = $deliveryAddress->name."\n".$deliveryAddress->getAddress();
    }
}

$order['shipping_to'] = $deliveryAddressString;

$userId = $_SESSION['userId'];

// Check for order id
if (empty($order['order_no'])) {
    $order['order_no'] = OrdersTable::getRandomOrderNumber();
}

// Get last order number used
$lastOrderNo = SettingsTable::getSetting('last_order_id');

// Submit order
$newOrder = new Orders();


$newOrder->user_id = $userId;
$newOrder->shipping_to = $order['shipping_to'];
$newOrder->order_by = $order['ordered_by'];
$newOrder->ease_order_no = ($lastOrderNo + 1);
$newOrder->order_no = $order['order_no'];
if (strtoupper($order['shipping']) == 'OTHER') {
    $newOrder->ship_via = $order['shipping_other'];
} else {
    $newOrder->ship_via = $order['shipping'];
}
$newOrder->cost = $cart->getTotalPrice();
$newOrder->weight = $cart->getTotalWeight();
$newOrder->date_added = date('Y-m-d H:i:s');
$newOrder->status = 'S'; // Submitted
$newOrder->save();

$orderResult = ($newOrder->id > 0);

// Save order
if ($orderResult) 
{
    // Add order details
    foreach ($cart->getItems() as $item) {
        $detail = new OrderDetails();
        $detail->order_id = $newOrder->id;
        $detail->order_product_id = $item['id'];
        $detail->qty = $item['qty'];
        $detail->price = $item['price'];
        $detail->weight = $item['weight'];
        $detail->save();
        
        // Remove stock 
        Doctrine_Query::create()->update('OrderProducts')->set('stock', '(stock - '.$item['qty'].')')->where('id = ?', $item['id'])->execute();        
    }

    // Update last order number used
    Doctrine_Query::create()->update('Settings')->set('value', "'" . ($lastOrderNo + 1) . "'")->where('name = ?', 'last_order_id')->execute();
    
    $order['lastOrderNo'] = $lastOrderNo;
    
    // Write order detail file
    OrdersTable::writeToFile($user, $order);
    
    $cart->reset();
}

?>
