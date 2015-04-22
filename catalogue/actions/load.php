<?php
// Auth user
auth('redirect');
if ($modules == "catalogue"): ?>
    <?php $this->start('disclaimer') ?>
    <div class="disclaimer">
        <p>All images and information are copyright to Brakequip Australia and may not be used without prior written consent from the company.</p>
        
        <p><a href="/catalogue/disclaimer" target="_blank">Disclaimer</a> | <a href="/terms.pdf" target="_blank">Terms & Conditions</a></p>
    </div>
    <?php $this->stop(); ?>
<?php endif; ?>
    
<?php if ($page != 'view-image' && $page != 'view-print' && $page != 'view-large'): ?>
<script language="javascript" type="text/javascript" src="/assets/js/member.js?v2"></script>
<?php $this->start('subnav') ?>
    <?php require_once _DIR_ROOT.'/templates/loggedInSubNav.php' ?>
<?php $this->stop() ?>
<link rel="stylesheet" type="text/css" media="screen" href="/assets/css/catalogue.css?v2" charset="utf-8" /> 
<script language="javascript" type="text/javascript" src="/assets/js/jquery.hotkeys-0.7.9.js"></script>
<script language="javascript" type="text/javascript" src="/assets/js/catalogue.js?v2"></script>
<?php endif; ?>