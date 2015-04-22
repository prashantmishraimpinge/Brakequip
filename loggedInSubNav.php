<ul>
    <?php if ($_SESSION['allowOrder']): ?>
    <li><a href="/order/"<?php echo $modules == "order" ? ' class="selected"' : '' ?>>ordering</a></li>
    <?php endif; ?>
    <li><a href="/catalogue/"<?php echo $modules == "catalogue" ? ' class="selected"' : '' ?>>catalogue</a></li>
    <li><a href="/pictorial/"<?php echo $modules == "pictorial" ? ' class="selected"' : '' ?>>pictorial</a></li>
    <li><a href="/gallery/" class="galleryLink<?php echo $modules == "gallery" ? ' selected' : '' ?>">gallery</a></li>
</ul>

<?php if (!isset($_SESSION['galleryAgree'])): ?>
<script>
$(function () {
    $('#galleryAgreeDialog').dialog({modal: true, width:500, autoOpen: false, title: 'Gallery Terms and Conditions',
        open: function () {
         $('object').css('visibility', 'hidden');   
        },
        beforeClose: function () {
            $('object').css('visibility', 'visible');
        }
    });
            
    $('.galleryLink').click(function () {
        $('#galleryAgreeDialog').dialog('open');
        return false;
    });
    <?php if (isset($_GET['galleryAgree'])): ?>
        $('#galleryAgreeDialog').dialog('open');
    <?php endif; ?>
});
</script>

<div id="galleryAgreeDialog" style="display:none">
    <?php include('galleryTerms.php'); ?>
    <form action="/gallery/agree" method="post" style="display: inline">
        <p><input type="submit" name="agree" value="I Agree" class="submit" /> <input type="button" name="close" value="Cancel" onclick="$('#galleryAgreeDialog').dialog('close');" class="submit" /></p>
    </form>
</div>
<?php endif; ?>