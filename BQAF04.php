<?php $this->extend($extendDir.'layout') ?>
<?php $this->set('title', 'Pictorial Catalogue') ?>
<?php $this->set('metaDescription', 'BrakeQuips Pictorial Catalogue') ?>
<h2>Pictorial Catalogue</h2>
<script type="text/javascript" src="newfrontpictorialdir/js/swfobject.js"></script>
<script type="text/javascript" src="newfrontpictorialdir/js/flippingbook.js?<?php echo rand(99,999999) ?>"></script>
<script type="text/javascript" src="newfrontpictorialdir/js/bookSettings.js?<?php echo rand(99,999999) ?>"></script>
<style>
	#fbMenu img {
		padding-right: 2px;
	}
</style>

	<div id="fbContainer">
    	<a class="altlink" href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"><div id="altmsg">Download Adobe Flash Player.</div></a>
    </div>
	<div style="text-align: center;">
   	<div id="fbFooter" style="text-align: center; margin: 0pt auto; width: 730px;">
		<div id="fbContents" style="margin-bottom: 5px;">
			<div class="fl">
   				<select id="fbContentsMenu" name="fbContentsMenu"></select>
			</div>
			<div class="fr">
				<span class="fbPaginationMinor">p.&nbsp;</span>
				<span id="fbCurrentPages">1</span>
				<span id="fbTotalPages" class="fbPaginationMinor"></span>
			</div>
		</div>
		<div id="fbMenu" class="cb" style="padding-top: 5px;">
			<div class="fl">
				<img src="newfrontpictorialdir/img/btn_zoom.gif" border="0" id="fbZoomButton" /><img src="newfrontpictorialdir/img/btn_print.gif" border="0" id="fbPrintButton" /><!-- <img src="../front-pictorial/img/btn_pdf.gif" border="0" id="fbDownloadButton" /> -->
			</div>
			<div class="fr">
				<img src="newfrontpictorialdir/img/btn_back.gif" border="0" id="fbBackButton" /><img src="newfrontpictorialdir/img/btn_next.gif" border="0" id="fbForwardButton" />
			</div>
		</div>
	</div>
	</div>
    <div class="cb"></div>