<?php $this->extend($extendDir.'layout'); ?>
<?php $this->start('subnav') ?>
    <?php require_once _DIR_ROOT.'/templates/loggedInSubNav.php' ?>
<?php $this->stop() ?>

<div class="mod">
    <a href="/download.php?file=assets/gallery/brakequip_logo.jpg" class="fl">Download BrakeQuip Logo</a>
    <ul class="links">
        <li><a href="rubber-hoses" onclick="$('#braided_hoses').hide(); $('#rubber_hoses').show(); $('.links a').removeClass('selected'); $(this).addClass('selected'); return false;">rubber hoses</a></li>
        <li><a href="braided-hoses" onclick="$('#rubber_hoses').hide(); $('#braided_hoses').show(); $('.links a').removeClass('selected'); $(this).addClass('selected'); return false;">braided hoses</a></li>
    </ul>
</div>

<div id="gallery" class="mod" style="margin-left:100px;">
        <div id="rubber_hoses" style="display: none;">
        <div style="margin: 10px 0;">Click the thumbnail to view the hi-res image, or click the download button to save!</div>
        <?php
        $photos = array();
        $mainDir = "/assets/gallery/rubberhose/";
        $dir = $mainDir."thumbs/";
        if (is_dir(_DIR_ROOT.$dir)) {
            if ($dh = opendir(_DIR_ROOT.$dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file == "." || $file == "..") {
                        continue;
                    }
                    $photos[] = $file;
                }
                closedir($dh);
            }
        }
        
        if (count($photos) > 0) {
            sort($photos);
            $i=0;
            foreach ($photos as $file)
            {
                ?>
                <div class="image">
                    <a href="<?php echo $mainDir.$file ?>" target="_blank"><img class="file" src="<?php echo $dir.$file ?>" border="0" /></a> 
                    <div class="dl"><a href="/download.php?file=<?php echo substr($mainDir.$file, 1) ?>"><img src="/assets/images/download_btn.gif" /></a></div>
                </div>
                <?php
                $i++;
                if ($i == 5) {
                    #echo "<br />";
                    $i=0;
                }
            }
        }
        ?>
        </div>
    
    <div id="braided_hoses" style="display: none">
        <div style="margin: 10px 0;">Click the thumbnail to view the hi-res image, or click the download button to save!</div>
        <?php
        $photos = array();
        $mainDir = "/assets/gallery/braidedhose/hires/";
        $dir = $mainDir."thumbs/";
        if (is_dir(_DIR_ROOT.$dir)) {
            if ($dh = opendir(_DIR_ROOT.$dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file == "." || $file == "..") {
                        continue;
                    }
                    $photos[] = $file;
                }
                closedir($dh);
            }
        }

        if (count($photos) > 0) {
            sort($photos);
            $i=0;
            foreach ($photos as $file)
            {
                ?>
                <div class="image">
                    <a href="<?php echo $mainDir.$file ?>" target="_blank"><img class="file" src="<?php echo $dir.$file ?>" border="0" /></a> 
                    <div class="dl"><a href="/download.php?file=<?php echo substr($mainDir.$file, 1) ?>"><img src="/assets/images/download_btn.gif" /></a></div>
                </div>
                <?php
                $i++;
                if ($i == 5) {
                    #echo "<br />";
                    $i=0;
                }
            }
        }
        ?>
        </div>
</div>
