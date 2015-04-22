<?php $this->extend($extendDir.'layout'); ?>

<?php if ($user): ?>
<script language="JavaScript">
	// Clear cookies
	eraseCookie('ordered_by');
        eraseCookie('order_no');
	eraseCookie('shipping');
	eraseCookie('shipping_other');
</script>
<meta http-equiv="Refresh" content="5; url=/applications" />

<h2>Login Successful - Please Wait</h2>
You are now being redirected to the BrakeQuip Electronic Applications.

<?php else: ?>

<h2>Login Fail</h2>
You have not followed the link correctly, or your access link to the catalogue has expired. Please try again.

<?php endif; ?>
