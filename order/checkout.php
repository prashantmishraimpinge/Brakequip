<?php $this->extend($extendDir . 'layout'); ?>
<h2>Order Summary</h2>

<form id="submitForm" action="/order/submit" method="post">
<div class="mod">
    <div class="detailPanel">
        <h3>Invoice to</h3>
        <div>
            <?php if ($invoiceAddress): ?>
                <?php echo $invoiceAddress->name ?><br />
                <?php echo nl2br($invoiceAddress->getAddress()) ?>
            <?php else: ?>
            Unknown
            <?php endif; ?>
        </div>
    </div>
    <div class="detailPanel">
        <h3>Shipping to</h3>
        <div>
            <textarea name="deliveryAddress" onchange="updateAddress(this)" style="width:183px; height:50px;"><?php echo $deliveryAddressString ?></textarea>
        </div>
    </div>
    <div class="detailPanel">
        <h3>Details</h3>
        <div>
            <table cellspacing="0" cellpadding="0">
                <tr valign="top">
                    <th>Ordered by</th>
                    <td><?php echo $order['ordered_by'] ?></td>
                </tr>
                <tr valign="top">
                    <th>Ship via</th>
                    <td>
                        <?php if ($order['shipping'] != 'Other'): ?>
                            <?php echo $order['shipping'] ?>
                        <?php else: ?>
                            <?php echo $order['shipping_other'] ?>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="detailPanel">
        <h3>Comments</h3>
        <div>
            <textarea name="comments" style="width:98%; height:54px"></textarea>
        </div>
    </div>
    <div class="cb"></div>
</div>

<div id="partsOrdered">
        <div id="cartTotal"><?php echo $cart->getTotalWeight() ?>kg / $<?php echo $cart->getTotalPrice() ?></div>
    <h3>Parts Ordered</h3>
    <div class="fl" style="border-right:1px dotted #ccc; padding-right:20px;">
        <table cellspacing="0" cellpadding="0">
            <tr>
                <th style="width:200px;">Part #</th>
                <th style="width:100px;">Unit Price</th>
                <th style="width:60px;">Qty</th>
                <th style="width:100px;">Sub Total</th>
            </tr>
            <?php foreach ($cart->getItems() as $item): ?>
            <tr>
                <td><?php echo $item['part'] ?></td>
                <td>$<?php echo $item['price'] ?></td>
                <td><?php echo $item['qty'] ?></td>
                <td>$<?php echo $cart->getPrice($item['id']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="fl" style="padding-left:20px;">
        <div class="mod" style="padding-bottom:20px;">
            <input id="submitOrderBtn" type="submit" name="submit" value="Process My Order" class="submitOrder fl" onclick="disabledonbeforeunload=true;"/>
            <div class="fl">
                <input type="button" name="edit" value="Edit Order" class="editorderButton" onclick="location.href = '/order/'; return false;" onclick="disabledConfirm_exit=true;" />
                <input type="button" name="cancel" value="Cancel Order" class="orderButton" onclick="if (confirm('Are you sure you want to cancel this order?')) { location.href = '/order/cancel'; } return false;" />
            </div>
            <div class="cb"></div>
        </div>
        <small>All prices are plus GST & freight (if applicable)</small>
    </div>
</div>
</form>

<div id="stopCreditDialog" style="display: none">
    <?php include('stopCreditTerms.php'); ?>
    <p><input type="button" name="agree" value="I Agree" onclick="$('#stopCreditDialog').dialog('close'); $('#submitForm').unbind('submit'); $('#submitOrderBtn').click();" /> <input type="button" name="close" value="Cancel" onclick="$('#stopCreditDialog').dialog('close'); return false;" /></p>
</div>

<script>
    $(function() {
        $("#stopCreditDialog").dialog({modal: true, width:500, autoOpen: false});
        
        <?php if ($user->stop_credit == 1): ?>
        $('#submitForm').submit(function () {
            $("#stopCreditDialog").dialog('open');
            return false;
        });
        <?php endif; ?>
    });
</script>
<script>
// window.onbeforeunload = function(){
//   return 'You have not yet processed your order.';
// };
</script>