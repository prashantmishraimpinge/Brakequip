<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
    <head>
        <script language="javascript" type="text/javascript" src="/assets/js/jquery.js"></script>
        <script language="javascript" type="text/javascript" src="/assets/js/global.js?v1"></script>
        <script language="javascript" type="text/javascript" src="/assets/js/member.js?v1"></script>
        <script type="text/javascript" src="/assets/js/swfobject.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/catalogue.css?v1" charset="utf-8" /> 
        <title>View Product, BrakeQuip Australia</title>
        
        <style>
            html, body {
                margin:0;
                padding:0;
                min-width: 1250px;
                width:expression(document.body.clientWidth < 1250 ? "1250px": "auto" );
                height:100%;
            }
			@media print{@page {size: landscape}}
        </style>
    </head>
    
    <body id="body">
        <style type="text/css" media="screen"> 
            object:focus { outline:none; }
            #flashContent { display:none; }
        </style>

        <script type="text/javascript">
            // For version detection, set to min. required Flash Player version, or 0 (or 0.0.0), for no version detection. 
            var swfVersionStr = "10.2.0";
            // To use express install, set to playerProductInstall.swf, otherwise the empty string. 
            var xiSwfUrlStr = "/assets/catalogue/playerProductInstall.swf?<?php echo time() ?>";
            var flashvars = {};
            var params = {};
            params.quality = "high";
            params.bgcolor = "#ffffff";
            params.allowscriptaccess = "sameDomain";
            params.allowfullscreen = "true";
            params.menu = "false";
            params.flashVars = 'baseUrl=<?php echo WEBSITE_URL ?>&session=<?php echo session_id() ?>&partId=<?php echo $part->id ?>&categoryId=<?php echo $category->id ?><?php echo (isset($_GET['print']) ? "&printPage=true" : "") ?>';
            var attributes = {};
            attributes.id = "partViewLarge";
            attributes.name = "partViewLarge";
            attributes.align = "middle";
            attributes.menu = "false";
            swfobject.embedSWF(
            "/assets/catalogue/partViewLarge.swf?<?php echo time() ?>", "flashContent", 
            "100%", "100%", 
            swfVersionStr, xiSwfUrlStr, 
            flashvars, params, attributes);
            // JavaScript enabled so display the flashContent div in case it is not replaced with a swf object.
            swfobject.createCSS("#flashContent", "display:block;text-align:left;");
        </script>

    
        <div id="flashContent">
            <p>
                To view this page ensure that Adobe Flash Player version 
                10.2.0 or greater is installed. 
            </p>
            <script type="text/javascript"> 
                var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://"); 
                document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='" 
                                + pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" ); 
            </script> 
        </div>
        
        <noscript>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" id="partViewLarge">
                <param name="movie" value="/assets/catalogue/partViewLarge.swf" />
                <param name="quality" value="high" />
                <param name="bgcolor" value="#ffffff" />
                <param name="allowScriptAccess" value="sameDomain" />
                <param name="allowFullScreen" value="true" />
		<param name="flashVars" value="baseUrl=<?php echo WEBSITE_URL ?>&session=<?php echo session_id() ?>&partId=<?php echo $part->id ?>&categoryId=<?php echo $category->id ?><?php echo (isset($_GET['print']) ? "&printPage=true" : "") ?>" />
                <!--[if !IE]>-->
                <object type="application/x-shockwave-flash" data="/assets/catalogue/partViewLarge.swf" width="100%" height="100%">
                    <param name="quality" value="high" />
                    <param name="bgcolor" value="#ffffff" />
                    <param name="allowScriptAccess" value="sameDomain" />
                    <param name="allowFullScreen" value="true" />
                <!--<![endif]-->
                <!--[if gte IE 6]>-->
                    <p> 
                        Either scripts and active content are not permitted to run or Adobe Flash Player version
                        10.2.0 or greater is not installed.
                    </p>
                <!--<![endif]-->
                    <a href="http://www.adobe.com/go/getflashplayer">
                        <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash Player" />
                    </a>
                <!--[if !IE]>-->
                </object>
                <!--<![endif]-->
            </object>
        </noscript> 
    </body>
</html>