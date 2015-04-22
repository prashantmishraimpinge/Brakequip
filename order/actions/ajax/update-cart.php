<?php
if (!isset($_GET['action'])) {
    exit;
}

// Include shopping cart 
require_once(_DIR_CLASSES.'ShoppingCart.class.php');

$cart = new ShoppingCart();

if ($_GET['action'] == 'add')
{
    // Make sure part exists
    if ($product = OrderProductsTable::getInstance()->find($_GET['id']))
    {
        // Make sure they have enough in stock
        if ($product->stock < $_GET['qty']) {
            $result = array('e' => 'Sorry! Stock unavailable for '.$product->part_number);
            echo json_encode($result);
            exit;
        }
        // Add item to cart
        $part = array('id' => $_GET['id'], 'part' => $product->part_number, 'description' => $product->description, 'qty' => $_GET['qty'], 'weight' => $product->weight, 'price' => $product->price); 
        $cart->addItem($part);

        $totalWeight = $cart->getTotalWeight();
        $totalPrice = $cart->getTotalPrice();

        $result = array('id' => $product->id,
                        'part' => $product->part_number,
                        'qty' => $_GET['qty'],
                        'price' => $cart->getPrice($product->id),
                        'totalPrice' => $totalPrice,
                        'totalWeight' => $totalWeight);

        echo json_encode($result);
    }
}
elseif ($_GET['action'] == 'delete') 
{
    $id = (int) $_GET['id'];
    $cart->deleteItem($id);
    
    $totalWeight = $cart->getTotalWeight();
    $totalPrice = $cart->getTotalPrice();
    
    $result = array(
        'totalPrice' => number_format($cart->getTotalPrice(), 2),
        'totalWeight' => $cart->getTotalWeight());

    echo json_encode($result);
}

?>
