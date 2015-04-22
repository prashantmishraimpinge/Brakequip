<?php $this->extend($extendDir.'layout') ?>
<?php $this->set('title', 'Contact BrakeQuip') ?>
<?php $this->set('metaDescription', 'Contact BrakeQuip') ?>

<h2>Contact BrakeQuip</h2>

<div id="contact-choice">
	<h3>Enquiry type</h3>
	<a href="contact" class="btn red" style="margin:20px 20px 20px 0;">Becoming a brake hose manufacturer</a>
	<span class="btn default">I just have a general enquiry</span>
</div>

<?
// If the submit button has been hit, send mail
if (isset($_POST['submit']))
{
    // Check required fields arnt empty
    $requiredFields = array( 'name', 'bname', 'phone', 'email', 'enquiry');
    $error = false;
    foreach ($requiredFields as $field)
    {
        if (isset($_POST[$field]) && empty($_POST[$field])) {
            $error = "Please make sure the required fields are not empty.<br /><br />";
            break;
        }
    }

    // If no error, send mail
    if (!$error) {
			$headers="From: john@brakequip.com.au <$email>\r\n";
			$headers.="MIME-Version: 1.0\r\n";
			$headers.="Content-Type: text/html; charset=ISO-8859-1\r\n";
			$body="
                <font face=\"verdana\" size=\"1\" color=\"#000000\">
                <table border=\"0\" cellpadding=\"6\" cellspacing=\"0\">
                <tr>
                <td colspan=\"2\"><i><b>Personal Information</b></i></td></tr>
                <tr>
                <td>Name:</td><td>$_POST[name]<br /></td></tr>
                <tr>
                <td>Business Name:</td><td>$_POST[bname]<br /></td></tr>                
                <tr>
                <td>Phone number:</td><td> $_POST[phone]<br /></td></tr>
                <tr>
                <td>Email:</td><td> $_POST[email]<br /></td></tr>
				<tr>
                <td>General Enquiry:</td><td> $_POST[enquiry]<br /></td></tr>

                </table></font>";
                mail("john@brakequip.com.au", "BrakeQuip General Enquiry", $body,$headers);
                $formComplete = true;
    }
}

?>
<?php if (isset($formComplete)): ?>
<h2>Thank-you</h2>Your submission has been received. If required, we will be in contact with you shortly.<br />
<?php else: ?>
<?php if (isset($error)): ?>
<font color=red><?php echo $error ?></font>
<?php endif; ?>


<div id="contact">
<form method="post">
<ul>
<li><input class="input" type="TEXT" name="name" size=30 value="<?php echo @$_POST['name'] ?>" placeholder="Name *" /></li>
<li><input class="input" type="TEXT" name="bname" size=30 value="<?php echo @$_POST['bname'] ?>" placeholder="Business Name *" /></li>
<li><input class="input" type="TEXT" name="phone" size=30 value="<?php echo @$_POST['phone'] ?>" placeholder="Phone # *" /></li>
<li><input class="input" type="TEXT" name="email" size=30 value="<?php echo @$_POST['email'] ?>" placeholder="E-mail *" /></li>

<div id="">
<li><textarea class="input" name="enquiry" id="textarea" cols="40" rows="4" value="<?php echo @$_POST['enquiry'] ?>" placeholder="Your enquiry *"></textarea></li>
</div>


<li><input type="submit" class="btn red" name="submit" value="SEND" /></form></li>
</ul>
</div>

<div style="width:250px;margin:0 10px;padding:20px;background:#f2f2f2;border:1px solid #ccc;float: right;">
    <h3>Physical</h3>

    <strong>Address:</strong><br>
    40-42 Mills Road,<br>
    Braeside Vic 3195 <br>
    Australia<br>
    <br>
    <strong>Ph:</strong> <span style="margin-left:7px;">03 8586 2500</span><br>

    Fax: 03 8586 2510 (orders)<br>
    <span style="margin-left:30px;">03 8586 2520 (admin)</span><br>
        </div>
   </div>     

<?php endif; ?>
<script>
$(function() {
    $('#contact-select').change(function() {
        var option = $(this).find('option:selected');
        $('#dvd').toggle(option.hasClass('dvd'));
        $('#general').toggle(option.hasClass('general'));
    }).change();
});
</script>