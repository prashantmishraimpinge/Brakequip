<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <meta name="description" content="<?php echo ($this->get('metaDescription') ? $this->get('metaDescription') . ' ' : '') ?>Brake Hose Manufacturing Systems. Stainless steel and rubber brake hose manufacturing systems for all vehicles." /> 
        <meta name="keywords" content="<?php echo ($this->get('metaKeywords') ? $this->get('metaKeywords') . ', ' : '') ?>brake hose, brake hose Manufacturing, rubber hoses, braided hoses, brake, brakequip, australia" /> 
        <title><?php echo ($this->get('title') ? $this->get('title') . ', ' : '') ?>Brake Hose Manufacturing Systems, BrakeQuip Australia</title>
        
        <meta name="language" content="English" /> 
        <meta name="google-site-verification" content="KkT2BTpaOl_J6FYcNyV_OrhiOT_zMb5OWDWO1bYTZig" /> 

        <script language="javascript" type="text/javascript" src="/assets/js/jquery.js?v<?php echo time() ?>"></script> 
        <script language="javascript" type="text/javascript" src="/assets/js/global.js?v<?php echo time() ?>"></script>
        <script language="javascript" type="text/javascript" src="/assets/js/jquery-ui.js?v1"></script>

        <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/screen.css?0.3" charset="utf-8" /> 
        <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/blitzer/jquery-ui.css" charset="utf-8" /> 

    </head> 

    <body>
        <div id="container">
            <div id="topNav">
                    <?php 
                    $ignorePages = array('applications');
                    $ignoreModules = array('catalogue', 'gallery', 'order', 'pictorial');
                    ?>
                <?php if (in_array($page, $ignorePages) || in_array($modules, $ignoreModules)): ?>
                <?php if (isset($_SESSION['userId'])): ?>
                <div style="z-index:-10;position:absolute;margin-left:60px;width:820px;text-align:center;line-height:38px;color:#fff;font-size:18px;"><?php echo $_SESSION['name'] ?></div>
                <?php endif; ?>
                <?php endif; ?>
                <h1 style="line-height:12px;;"><?php if (isset($_SESSION['userId'])): ?>
                    <a href="/applications">Return to Applications</a> &nbsp; | &nbsp; <a href="/logout">Logout</a>
                    <?php else: ?>
                    Brake Hose Manufacturing Systems &amp; replacement brake hoses
                    <?php endif; ?>
                </h1>
                <ul>
                    <?php 
                    $ignorePages = array('applications');
                    $ignoreModules = array('catalogue', 'gallery', 'order', 'pictorial');
                    ?>
                    <?php if (!in_array($page, $ignorePages) && !in_array($modules, $ignoreModules)): ?>
                    <li><a href="/" class="home<?php echo (empty($modules) && $page == "index" ? ' selected' : '') ?>"><img src="/assets/images/homeIcon.png" /></a></li>
                    <li><a href="/find-manufacturer"<?php echo (empty($modules) && $page == "find-manufacturer" ? ' class="selected"' : '') ?>>find a manufacturer</a></li>
                    <li><a href="/rubber-brake-hose"<?php echo (empty($modules) && $page == "rubber-brake-hose" ? ' class="selected"' : '') ?>>rubber</a></li>
                    <li><a href="/braided-brake-hose"<?php echo (empty($modules) && $page == "braided-brake-hose" ? ' class="selected"' : '') ?>>braided</a></li>
                    <?php endif; ?>
                    <li><a href="/contact"<?php echo (empty($modules) && $page == "contact" ? ' class="selected"' : '') ?>>contact</a></li>
                </ul>
            </div>
            <div id="innerCotainer">
                <div id="mainTop" class="mod">
                    <a href="/"><img src="/assets/images/brakequip-logo.png" alt="Brake Hose Manufacturing Systems, BrakeQuip Australia" title="Brake Hose Manufacturing Systems, BrakeQuip Australia" /></a>
                    <?php if (!$this->output('subnav')): ?>
                    <?php endif; ?>
                    <div class="cb"></div>
                </div>
                
                <div id="content" class="mod">
                    <?php echo $this->get('content') ?>
                    <div class="cb"></div>
                </div>
            </div>
        </div>
        <div id="footer">
            <ul class="mod">
            <?php if (!in_array($page, $ignorePages) && !in_array($modules, $ignoreModules)): ?>
                <li><a href="/">home</a></li>
                <li><a href="/manufacturers/">become a brake hose manufacturer</a></li>
                <li><a href="/rubber-brake-hose">rubber</a></li>
                <li><a href="/braided-brake-hose">braided</a></li>
                <li><a href="/contact">contact</a></li>
                <li><a href="/manufacturers/faq">faq</a></li>
                <li><a href="/manufacturers/how-it-works">see how it works</a></li>
                <li><a href="/sitemap">sitemap</a></li>
            <?php endif; ?>
            </ul>
            <div class="cb"></div>
            Copyright &copy; <?php echo date('Y') ?> BrakeQuip Australia. All rights reserved.<br />
            Specialists in Brake Hose Manufacturing Systems
            
        </div>
        <?php if (!$this->output('disclaimer')): ?>
        <?php endif; ?>
        
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-35746447-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>
    </body>
</html>