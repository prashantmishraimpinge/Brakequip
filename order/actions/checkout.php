<?php

// Make sure they have items in their cart
if (count($cart->getItems()) == 0) {
    header('Location: /order/');
    exit;
}
//print_r($_POST);
if (count($_POST) > 0) {
    $_SESSION['order'] = $_POST;
}
$order = $_SESSION['order'];

$deliveryAddressString = false;
if (isset($order['deliveryAddress'])) {
    $deliveryAddressString = $order['deliveryAddress'];
}

$invoiceAddress  = UserAddressTable::getAddress($_SESSION['userId'], 'invoice');

if (!$deliveryAddressString) {
    $deliveryAddress = UserAddressTable::getAddress($_SESSION['userId'], 'delivery');

    $deliveryAddressString = 'Unknown';
    if ($deliveryAddress) {
        $deliveryAddressString = $deliveryAddress->name."\n".$deliveryAddress->getAddress();
    }
}

?>
<script src="/assets/js/order.js?v1" type="text/javascript"></script>