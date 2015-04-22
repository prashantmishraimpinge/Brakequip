<?php $this->extend($extendDir.'layout'); ?>
<script>
    // Clear cookies
    eraseCookie('ordered-by');
    eraseCookie('shipping');
    eraseCookie('shipping-other');

    location.href = '/applications';
</script>