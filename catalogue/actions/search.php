<?php
// Search for BQ Number
$q = Doctrine_Query::create()->from('WebPart wp')->innerJoin('wp.WebPartToCategory wptc')->where('UPPER(wp.bq_number) = ?', $_POST['bq_number'])
        ->groupBy('wptc.web_category_id');
$count = $q->count();



$results = $q->fetchArray();

?>
