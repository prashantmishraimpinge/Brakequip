<?php

if (isset($_GET['address'])) {
    $_SESSION['order']['deliveryAddress'] = $_GET['address'];
}

?>
