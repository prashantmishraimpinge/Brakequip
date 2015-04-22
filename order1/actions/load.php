<?php
// Auth user
auth('redirect');

// If they are not allowed to view order section, redirect to catalogue
if (@!$_SESSION['allowOrder']) {
    header('Location: /applications');
}

// Include shopping cart 
require_once(_DIR_CLASSES.'ShoppingCart.class.php');

$cart = new ShoppingCart();

// Get user info
$user = UsersTable::getInstance()->find($_SESSION['userId']);


?>
<?php $this->start('subnav') ?>
    <?php require_once _DIR_ROOT.'/templates/loggedInSubNav.php' ?>
<?php $this->stop() ?>
<script language="javascript" type="text/javascript" src="/assets/js/member.js?v3"></script>
<link rel="stylesheet" type="text/css" media="screen" href="/assets/css/order.css?v1" charset="utf-8" /> 