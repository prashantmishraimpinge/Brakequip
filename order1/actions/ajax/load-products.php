<?php
$category = $_REQUEST['category'];
// Include shopping cart 
require_once(_DIR_CLASSES.'ShoppingCart.class.php');

$cart = new ShoppingCart();
?>

<?php foreach (OrderProductsTable::getProductsByCategory($category) as $product): ?>
    <div class="row mod" onmouseover="this.style.background = '#f6f6f6'" onmouseout="this.style.background = '#fff'">
        <div class="col1"><?php echo $product->part_number ?></div>
        <div class="col2"><?php echo $product->description ?></div>
        <div class="col3">$<?php echo $product->price ?></div>
        <div class="col4"><input id="qty-<?php echo $product->id ?>" type="text" name="qty" class="qty" value="<?php echo ($cart->getQty($product->id) ? $cart->getQty($product->id) : '') ?>" autocomplete="off" /></div>
        <div class="cb"></div>
    </div>
<?php endforeach; ?>
                                    