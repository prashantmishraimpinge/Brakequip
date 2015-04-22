<?php $this->extend($extendDir . 'layout'); ?>
<div id="catalogue">
    <?php if ($part): ?>
    <div class="mod">
        <div class="fl">
            <h2><?php echo $breadcrumbs[0]['name'].' '.$breadcrumbs[1]['name'] ?> - <?php echo $partAlpha ?><span><?php echo $partNumber ?></span></h2>
        </div>
        <div class="fr">
            <form action="/catalogue/search" method="post" style="display: inline">
                <input type="text" name="bq_number" value="Search BQ #" class="input default" /> 
            </form>
        </div>
        <div class="cb"></div>
    </div>
    <?php endif; ?>

    <div class="categoryBreadcrumb">
    <?php if (count($breadcrumbs) > 0): ?>
    <ul>
        <li><a href="/catalogue/" style="font-weight:bold;font-size:14px;">&lt; NEW SEARCH</a></li>
        <?php foreach ($breadcrumbs as $breadcrumb): $i++; ?>
        <li<?php echo ($breadcrumbCount == $i ? ' class="last"' : '') ?>><a href="/catalogue/?categoryId=<?php echo $breadcrumbs[($i - 2)]['id'] ?>"><?php echo $breadcrumb['name'] ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div style="clear: both"></div>
    <?php endif; ?>
    </div>

    <?php if ($categoryType): ?>
    <div class="dropdown-container mod">
        <div class="fl">
        <form action="/catalogue/" method="get">
            <p>Select <?php echo $categoryType->name ?></p>
            <select name="categoryId" onchange="$('#loading-categories').show(); this.form.submit();">
                <option value="">Please select</option>
                <?php foreach ($categories as $categoryResult): ?>
                <option value="<?php echo $categoryResult->id ?>"><?php echo stripslashes($categoryResult->name) ?></option>
                <?php endforeach; ?>
            </select> <span id="loading-categories" style="display: none;">Loading...</span>
            <a href="/catalogue/?categoryId=<?php echo $breadcrumbs[count($breadcrumbs)-2]['id'] ?>" class="backOneLevel" style="margin:10px 0;">Back one level</a>
        </form>
        </div>
        <div class="fr">
            <div class="bq-search">
                <form action="/catalogue/search" method="post" style="display: inline">
                    <p>Search BQ Number</p>
                    <input type="text" name="bq_number" value="" class="input" /> <input type="submit" name="search" value="Search" />
                </form>
            </div>
        </div>
        <div class="fr" style="font-size: 30px; margin: 12px 20px 0 0; color: #ccc;">
            OR
        </div>
        <div class="cb"></div>
    </div>
    <?php endif; ?>
	
    <?php if ($part && $countOfRows < $threshold): ?>
    <div id="part">
        <div class="toolbar mod">
            <a href="/catalogue/view-image?id=<?php echo $part->id ?>&categoryId=<?php echo $category->id ?>&print" target="_blank" class="print fr">Print this page</a>
            <form id="viewLargerImageLink" action="/catalogue/view-image?id=<?php echo $part->id ?>&categoryId=<?php echo $category->id ?>" method="post" target="_blank">
                <input type="submit" name="submit" value="Submit" style="display:none" />
            </form>
            <a href="/catalogue/?categoryId=<?php echo $breadcrumbs[count($breadcrumbs)-2]['id'] ?>" class="backOneLevel">Back one level</a>
            <form action="/catalogue/" method="get" style="display: block; margin-top: 4px; padding-left: 10px" class="fl">
                <select name="categoryId" onchange="this.form.submit();">
                    <?php foreach ($categories2 as $result): ?>
                    <option value="<?php echo $result->id ?>"<?php echo ($result->id == $categoryId ? ' selected' : '') ?>><?php echo stripslashes($result->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
            <div class="cb"></div>
        </div>
        

        <?php if ($part->website_display == 1): ?>

        <script type="text/javascript" src="/assets/js/swfobject.js"></script>
        <style type="text/css" media="screen"> 
            object:focus { outline:none; }
            #flashContent { display:none; }
        </style>

        <script type="text/javascript">
            // For version detection, set to min. required Flash Player version, or 0 (or 0.0.0), for no version detection. 
            var swfVersionStr = "10.2.0";
            // To use express install, set to playerProductInstall.swf, otherwise the empty string. 
            var xiSwfUrlStr = "/assets/catalogue/playerProductInstall.swf";
            var flashvars = {};
            var params = {};
            params.quality = "high";
            params.bgcolor = "#ffffff";
            params.allowscriptaccess = "sameDomain";
            params.allowfullscreen = "true";
            params.menu = "false";
            params.flashVars = 'baseUrl=<?php echo WEBSITE_URL ?>&session=<?php echo session_id() ?>&partId=<?php echo $part->id ?>&categoryId=<?php echo $category->id ?>';
            var attributes = {};
            attributes.id = "partView";
            attributes.name = "partView";
            attributes.align = "middle";
            attributes.menu = "false";
            swfobject.embedSWF(
            "/assets/catalogue/partView.swf", "flashContent", 
            "868", "<?php echo $objectHeight ?>", 
            swfVersionStr, xiSwfUrlStr, 
            flashvars, params, attributes);
            // JavaScript enabled so display the flashContent div in case it is not replaced with a swf object.
            swfobject.createCSS("#flashContent", "display:block;text-align:left;");
        </script>

    
        <div id="flashContent" style="height:<?php echo $objectHeight ?>px">
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
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="868" height="<?php echo $objectHeight ?>" id="partView">
                <param name="movie" value="/assets/catalogue/partView.swf" />
                <param name="quality" value="high" />
                <param name="bgcolor" value="#ffffff" />
                <param name="allowScriptAccess" value="sameDomain" />
                <param name="allowFullScreen" value="true" />
		<param name="flashVars" value="baseUrl=<?php echo WEBSITE_URL ?>&session=<?php echo session_id() ?>&partId=<?php echo $part->id ?>&categoryId=<?php echo $category->id ?>" />
                <!--[if !IE]>-->
                <object type="application/x-shockwave-flash" data="/assets/catalogue/partView.swf" width="868" height="<?php echo $objectHeight ?>">
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

        <div style="height:10px;"></div>

        <div class="mod">
            <div class="warning fl" style="width:540px;">
                IMPORTANT: WHEN MAKING STAINLESS STEEL BRAIDED HOSES - ADD 24mm TO CUT LENGTH. IF THE HOSE INCLUDES A CENTRE PIECE, 12mm IS THEN ADDED TO EACH END OF THE HOSE.
            </div>
            <div class="fr" style="line-height:14px;">
                <a id="vehicleRequestLink" href="" class="btn"><span>Can't find what you're looking for?</span></a>
                <div style="height:10px;"></div>
                <a id="hoseInaccuracyLink" href="" class="btn" style="margin-left: 10px;" target="_blank"><span>Report hose inaccuracy</span></a>
                <div style="height:10px;"></div>
                <a href="/catalogue/understand" class="btn" style="margin-left: 10px;" target="_blank"><span>Understanding our catalogue</span></a>
            </div>
            <div class="cb"></div>
        </div>
        
        
        <div id="hoseInaccuracyDialog" style="display:none">
            <p>You are about to report hose inaccuracy for the following part:</p>
            <p>
            <?php if (count($breadcrumbs) > 0): ?>
                <?php foreach ($breadcrumbs as $breadcrumb): $i++; ?>
                <?php $categoryString .= $breadcrumb['name'].' > '; ?>
                <?php endforeach; ?>
                <strong><?php echo $categoryString.' '.$part->bq_number ?></strong>
            <?php endif; ?>
            </p>
            
            <form id="inaccurancyForm" action="/catalogue/report-inaccurancy" method="post">
                <input type="hidden" name="category" value="<?php echo $categoryString ?>" />
                <input type="hidden" name="partId" value="<?php echo $part->id ?>" />
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <th>Your Name *</th>
                    </tr>
                    <tr>
                        <td><input id="yourname" type="text" name="name" value="" /></td>
                    </tr>
                    <tr>
                        <td height="10"></td>
                    </tr>
                    <tr>
                        <th>Why do you believe this is inaccurate? *</th>
                    </tr>
                    <tr>
                        <td><textarea id="reason" name="reason" style="width:100%;height:100px;"></textarea>
                    </tr>
                </table>
                <input id="hoseInaccurancySubmit" type="submit" class="submit" name="submit" value="Submit" />
            </form>
        </div>
        
        <script>
            $(function() {
                $('#hoseInaccuracyLink').click(function () {
                    $("#hoseInaccuracyDialog").dialog('open');
                    $('object').hide();
                    return false;
                });
                $("#hoseInaccuracyDialog").dialog({modal: true, width:600, autoOpen: false, title: 'Report Hose Inaccuracy',
                    open: function () {
                     $('object').css('visibility', 'hidden');   
                    },
                    beforeClose: function () {
                        $('object').css('visibility', 'visible');
                        $('object').show();
                    }
                });
                
                $('#hoseInaccurancySubmit').click(function () 
                {
                   // Make sure fields arn't blank
                   var blank = false;
                   $('input, textarea', $('#inaccurancyForm')).each(function (key, obj) {
                       if (obj.value == '') {
                           blank = true;
                           return;
                       }
                   });
                   
                   if (blank) {
                       alert('All fields are required to be filled in');
                       return false;
                   }
                    $.post('/catalogue/report-inaccurancy', $('#inaccurancyForm').serialize(), function (data) {
                        alert('Thank you for your input');
                        $("#hoseInaccuracyDialog").dialog('close');
                        $('#yourname').val('');
                        $('#reason').val('');
                    });
            
                   
                   return false;
                });
                
            });
        </script>
    
        <?php else: ?>
        <p>This hose is currently unavailable due to parts still being in production.</p>
        <?php endif; ?>

    </div>
    <?php endif; ?>
    <?php if ($part && $countOfRows >= $threshold): ?>
    <div id="part">
        <p style="font-weight: bold; font-size: 12px; margin-top:20px; text-align:center">Oops, you have reached the amount of hoses you can view for today. Please contact BrakeQuip if you require a hose specification.</p>
    </div>
    <?php endif; ?>
    <?php if (!$categoryType && !$part): ?>
    <div id="part">
        <p style="font-weight: bold; font-size: 12px">Unable to display part. BrakeQuip have been notified about this error and will attempt to fix the problem as soon as possible. Sorry for any inconvenience this may have caused.<br /><br /> Thank you.</p>	
        <a href="" id="vehicleRequestLink" class="btn"><span>Can't find what you're looking for?</span></a>
        <a href="/catalogue/understand" class="btn" style="margin-left: 10px;" target="_blank"><span>Understanding our catalogue</span></a>
    </div>
    <?php endif; ?>

    <div class="cb" style="height: 20px"></div>

</div>


<div id="vehicleRequestDialog" style="display:none">
    <div id="vehicleRequestResult">
        <strong>Can't find what you're looking for?</strong>
        <p>We're always trying to stay on the ball, so if you come across a vehicle that we don't have listed &amp; you think we should, let us know!</p>
    </div>
    <form id="vehicleRequestForm" method="post" action="/catalogue/vehicle-request">
        <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
                <td width="180">Name <FONT color="#ff0000">*</FONT></td>
                <td><input class="input" type="TEXT" name="name" size=30 value="<?= $_POST[name] ?>" /></td>
            </tr>
            <tr>
                <td> Make <FONT color="#ff0000">*</FONT></td>
                <td><input name="make" type="text" class="input" value="<?= $_POST[make] ?>" size="30" /></td>
            </tr>
            <tr>
                <td>Model <FONT color="#ff0000">*</FONT></td>
                <td><input class="input" type="text" name="model" size="30" value="<?= $_POST[model] ?>" /></td>
            </tr>
            <tr>
                <td>Sub Model</td>
                <td><input class="input" type="TEXT" name="submodel" size=30 value="<?= $_POST[submodel] ?>" /></td>
            </tr>
            <tr>
                <td>Year(s)</td>
                <td><input class="input" type="TEXT" name="year" size=30 value="<?= $_POST[year] ?>" /></td>
            </tr>
            <tr valign="top">
                <td>Anything else to add...</td>
                <td><textarea name="other" cols="30" class="input"><?= $_POST[other] ?>&nbsp;</textarea></td>
            </tr>    
            <tr>
                <td valign="top" align="center" colspan="2"><br />
                    <input id="vehicleRequestSubmit" type="button" class="submit" name="submit" value="Submit" /></td>
            </tr>
        </table>
    </form>
</div>

<script>
    $(function() {
        $('#vehicleRequestLink').click(function () {
            $("#vehicleRequestDialog").dialog('open');
            $('object').hide();
            return false;
        });
        $("#vehicleRequestDialog").dialog({modal: true, width:600, autoOpen: false, title: 'Vehicle Request',
            open: function () {
             $('object').css('visibility', 'hidden');   
            },
            beforeClose: function () {
                $('object').css('visibility', 'visible');
                $('object').show();
            }
        });
        
        $('#vehicleRequestSubmit').click(function () {

            $.post('/catalogue/vehicle-request', $('#vehicleRequestForm').serialize(), function (data) {
                data = $.parseJSON(data);
                if (data.e != undefined) {
                    alert(data.e);
                    return false;
                }
                
                if (data.s != undefined) {
                    alert(data.s);
                    $("#vehicleRequestDialog").dialog('close');
                    $('#vehicleRequestForm input[type="text"], #vehicleRequestForm textarea').val('');
                }
                return false;
            });
            
        });
    });
</script>
