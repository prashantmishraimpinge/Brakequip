<?php $this->extend($extendDir.'layout'); ?>
<?php $this->start('subnav') ?>
    <?php require_once _DIR_ROOT.'/templates/loggedInSubNav.php' ?>
<?php $this->stop() ?>

<script language="javascript" type="text/javascript" src="/assets/js/member.js"></script>

<style>
    .col {
        float:left;
        width:200px;
        padding-left:35px;
    }
</style>

<h2>Applications</h2>

    <?php if ($_SESSION['allowOrder']): ?>
        <div class="col" style="padding-left: 100px">
            <a href="/order/"><img src="/assets/images/btn_ordering.jpg" border="0" /></a>
            <div class="comment">
                <img src="/assets/images/open_comment.gif" /><br />
                <p>BrakeQuip's 'live' 24/7 online ordering is simple to use.<br /> It shows you a running cost together with your order's weight as you're placing it. Its user friendly design makes online ordering a cinch!</p>
                <img src="/assets/images/close_comment.gif" align="right" />
            </div>
        </div>
    <?php else: ?>
        <div class="col" style="padding: 0px; width: 50px;">&nbsp;</div>
    <?php endif; ?>
        
        
    <div class="col">
        <a href="/catalogue/"><img src="/assets/images/btn_application.jpg" border="0" /></a>
        <div class="comment">
            <img src="/assets/images/open_comment.gif" /><br />
            <p>Our online catalogue details the exact build data required for building your customers hoses.<br /> This includes: Hose images, detailed build data and a very handy description for the assembly of the hose.</p>
            <img src="/assets/images/close_comment.gif" align="right" />
        </div>
    </div>

    <div class="col">
        <a href="/pictorial/"><img src="/assets/images/btn_pictorial.jpg" border="0" /></a>
        <div class="comment">
            <img src="/assets/images/open_comment.gif" /><br />
            <p>Don't have your catalogue handy? Not to worry, our up-to-date version is always online. You can get all the information you need as well as zoom in and print the images or, just check you're ordering the right fitting.</p>
            <img src="/assets/images/close_comment.gif" align="right" />
        </div>
    </div>

    <?php if ($_SESSION['allowOrder']): ?>
    <div class="cb" style="height: 20px;"></div>
    <?php endif; ?>
        
    <div class="col" style="<?php echo $_SESSION['allowOrder'] ? 'padding-left: 338px;' : '' ?>">
        <a class="galleryLink" href="/gallery/" id="galleryLink"><img src="/assets/images/btn_gallery.jpg" border="0" /></a>
        <div class="comment">
            <img src="/assets/images/open_comment.gif" /><br />
            <p>We have gone to the effort to have some professional photos taken of some common brake hoses. These rubber and braided hose pictures are freely available for you to use for your own marketing material.</p>
            <img src="/assets/images/close_comment.gif" align="right" />
        </div>
    </div>
        
    <div class="cb"></div>

    
    <?php if (!isset($_SESSION['galleryAgree']) || isset($_SESSION['galleryNotAgree'])): ?>
                    
        <div id="box" style="display: none">
            <?php include('templates/galleryTerms.php'); ?>
            <form action="galleryAgree" method="post" style="display: inline">
                <p><input type="submit" name="agree" value="I Agree" /> <input type="button" name="close" value="Cancel" onclick="closeBox()" /></p>
            </form>
        </div>
    <?php endif; ?>
    
    <script>
<?php if (isset($_SESSION['galleryNotAgree'])): ?>
            showBox();
    <?php unset($_SESSION['galleryNotAgree']); ?>
<?php else: ?>
    <?php if (!isset($_SESSION['galleryAgree'])): ?>
                    $('galleryLink').onclick = function () {
                        showBox();
                        return false;
                    }
    <?php endif; ?>
<?php endif; ?>
    </script>