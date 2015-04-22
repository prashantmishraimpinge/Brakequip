<?php
if (!isset($_SESSION['galleryAgree'])) {
    header("Location: /applications?galleryAgree");
    exit;
}
