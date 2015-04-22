<?php $this->extend($extendDir . 'layout'); ?>

<?php if ($orderResult): ?>

<h2>Order Submitted</h2>

<p>Congratulations, you have successfully submitted your order.</p>

<p>For future reference your picking slip number is: <b><?php echo $newOrder->order_no ?></b></p>

<p><a href="/applications">&lt; Go Back to Applications</a></p>

<script>
	// Clear cookies
	eraseCookie('ordered_by');
        eraseCookie('order_no');
	eraseCookie('shipping');
	eraseCookie('shipping_other');
</script>

<?php else: ?>

<h2>There has been an error</h2>

Sorry we were unable to process your order at this time. Please notify BrakeQuip.

<?php endif; ?>
