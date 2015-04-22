<?php

$q = Doctrine_Query::create()->from('UserAddress ua')
        ->innerJoin('ua.Users u WITH u.distributor = 1')
        ->where("address_type = 'delivery' AND lat != '0.000000' AND lat IS NOT NULL AND u.deleted = 0");

$results = $q->fetchArray();

