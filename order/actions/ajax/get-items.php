<?php 
// Include shopping cart 
require_once(_DIR_CLASSES.'ShoppingCart.class.php');
$cart = new ShoppingCart();
?>                
<?php foreach ($cart->getItems() as $item): ?>
    <ul id="cart-<?php echo $item['id'] ?>" class="mod" onmouseover="this.style.background = '#f6f6f6'" onmouseout="this.style.background = '#fff'">
        <li class="col1"><a href="" class="delete"><img src="/assets/images/delete.gif" title="Delete Item from Cart" /></a></li>
        <li class="col2"><?php echo $item['part'] ?></li>
        <li class="col3">x <?php echo $item['qty'] ?></li>
        <li class="col4">$<?php echo $cart->getPrice($item['id']) ?></li>
        <div class="cb"></div>
    </ul>
<?php endforeach; ?>