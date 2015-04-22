<?php $this->extend($extendDir.'layout') ?>
<?php $this->set('title', 'Contact BrakeQuip') ?>
<?php $this->set('metaDescription', 'Contact BrakeQuip') ?>

<h2>Contact BrakeQuip</h2>

<div id="contact-choice">
	<h3>Enquiry type</h3>
	<span class="btn default" style="margin:20px 20px 20px 0;">Becoming a brake hose manufacturer</span>
	<a href="general-enquiry" class="btn red">I just have a general enquiry</a>
</div>

<?
// If the submit button has been hit, send mail
if (isset($_POST['submit']))
{
    // Check required fields arnt empty
    $requiredFields = array( 'name', 'bname', 'phone', 'email', 'address', 'suburb', 'state', 'pcode', 'usebh', 'suppliers');
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
                <td>Phone number:</td><td> $_POST[phone]<br /></td></tr>
                <tr>
                <td>Email:</td><td> $_POST[email]<br /></td></tr>
                <tr>
                <td>Postal Address:</td><td> $_POST[address], $_POST[suburb]<br />
                $_POST[state], $_POST[pcode]<br /></td></tr>

                <tr>
                <td colspan=\"2\"><i><b>Tell us about your business</b></i></td></tr>
                <tr>
                <td>Business name:</td><td> $_POST[bname]<br /></td></tr>
                <tr>
                <td>Do they use <br />Brake Hoses:</td><td> $_POST[usebh]<br /></td></tr>
                <tr>
                <td>Their suppliers:</td><td> $_POST[suppliers]<br /></td></tr>
				<tr>
				<td colspan=\"2\"><i><b>Company type</b></i></td></tr>
				<tr><td>";
			foreach($_POST as $k => $v) {
				/* If post is a checkbox */
				if(substr($k,0,2) == "c_") {
					if(!empty($v))
						$body.="$v<br />";
								}
							}
				$body.="</td>
				</tr>
                </table></font>";
                mail("john@brakequip.com.au", "Interested in becoming a manufacturer", $body,$headers);
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
<div id="dvd">
<li><input class="input" type="TEXT" name="address" size=30 value="<?php echo @$_POST['address'] ?>" placeholder="Street Address *" /></li>
<li><input class="input" type="TEXT" name="suburb" size=30 value="<?php echo @$_POST['suburb'] ?>" placeholder="Suburb *" /></li>
<li><input class="input" type="TEXT" name="state" size=30 value="<?php echo @$_POST['state'] ?>" placeholder="State *" /></li>
<li><input class="input" type="TEXT" name="pcode" size=30 value="<?php echo @$_POST['pcode'] ?>" placeholder="Postcode *" /></li>
<li><input name="usebh" type="text" class="input" value="<?php echo @$_POST['usebh'] ?>" size="30" placeholder="How often do you use brake hoses? *" /></li>
<li><input name="suppliers" type="text" class="input" value="<?php echo @$_POST['suppliers'] ?>" size="30" placeholder="Current brake hose suppliers *" /></li>
<li><label style="display: block; width: 100%; margin-bottom: 10px;">Type of business (required field)</label>
			<ul id="typeof">
				<li><label>Spare parts</label><input type="checkbox" name="c_spareparts" value="Spare Parts" /></li>
				<li><label>Brake repair specialist</label><input type="checkbox" name="c_repair" value="Brake repair specialist" /></li>
				<li><label>Hydraulic shop</label><input type="checkbox" name="c_hydraulic" value="Hydraulic shop" /></li>
				<li><label>General workshop</label><input type="checkbox" name="c_general" value="General workshop" /></li>
				<li><label>Remanufacturer</label><input type="checkbox" name="c_remanufacturer" value="Remanufacturer" /></li>
				<li><label>Wholesale distributor</label><input type="checkbox" name="c_wholesaler" value="Wholesale distributor" /></li>
				<li><label>Home mechanic</label><input type="checkbox" name="c_home" value="Home mechanic" /></li>
				<li><label>Franchise group</label><input type="checkbox" name="c_franchise" value="Franchise group" /></li>
				<li><label>Other</label><input type="checkbox" name="c_other" value="Other" /></li>
			</ul>
</li>
</div>

<li><input type="submit" class="btn red" name="submit" value="SEND" />
</form></li>
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