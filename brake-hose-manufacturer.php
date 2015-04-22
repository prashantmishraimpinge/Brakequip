<?php $this->extend('layout') ?>
<?php $this->set('title', ($stateName ? $stateName.', ' : '').'View All Brake Hose Manufacturers') ?>
<?php $this->set('metaDescription', 'Brake hose Manufacturers in '.($stateName ? $stateName.', ' : '').'Australia.') ?>
<?php $this->set('metaKeywords', $stateName) ?>

<h2>View All Brake Hose Manufacturers</h2>

<div class="fl" style="margin-right: 35px; line-height: 20px;">
<?php $i = 0; ?>
<?php foreach ($states as $key => $state): ?>
    <?php $i++; ?>
    <a href="/brake-hose-manufacturer/<?php echo $key ?>"><?php echo $state ?></a><br />
    <?php if ($i == 4): ?>
    </div><div class="fl" style="margin-right: 35px; line-height: 20px;">
    <?php $i = 0; ?>
    <?php endif; ?>
<?php endforeach; ?>
</div>

<div class="clear" style="height: 20px"></div>

<?php if (isset($states[@$_REQUEST['state']])): ?>
    <h3 style="border-bottom: 2px dotted #999; padding-bottom:10px;"><?php echo $states[$_REQUEST['state']] ?></h3>
    <div class="clear"></div>
    
    <?php $i = 0; ?>
    <?php foreach ($results as $row): ?>
    <?php $row = $row['UserAddress'][0] ?>
    <?php $i++ ?>
        <?php $address = $row['address1'].' '.$row['address2'].$row['suburb'].' '.$row['state'].' '.$row['postcode'] ?>
        <div class="fl" style="width: 200px; margin-right: 40px;">
        <strong><a href="http://www.google.com/maps?q=<?php echo urlencode($address) ?>" target="_blank"><?php echo $row['name'] ?></a></strong><br />
        <?php echo $row['address1'].' '.$row['address2'] ?><br />
        <?php echo $row['suburb'] ?> <?php echo $row['state'] ?> <?php echo $row['postcode'] ?>
        <?php if (!empty($row['phone'])): ?>
        <br /><strong>Phone:</strong> <?php echo $row['phone'] ?>
        <?php endif; ?>
            <div style="height: 20px;"></div>
        </div>
        <?php if ($i == 2): ?>
        <div class="cb"></div>
        <?php $i = 0; ?>
        <?php endif; ?>
    <?php endforeach; ?>
        
<?php endif; ?>
