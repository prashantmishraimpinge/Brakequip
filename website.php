<?php $this->extend($extendDir.'layout') ?>
<?php $this->set('title', 'Submit your Website') ?>
<?php $this->set('metaDescription', 'Submit your Website') ?>

<h2>Submit your Website</h2>

<?
// If the submit button has been hit, send mail
if (isset($_POST['submit']))
{
    // Check required fields arnt empty
    $requiredFields = array( 'name', 'acc', 'bname', 'email', 'website');
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
			$headers="From: $_POST[email]\r\n";
			$headers.="MIME-Version: 1.0\r\n";
			$headers.="Content-Type: text/html; charset=ISO-8859-1\r\n";
			$body="
                <font size=\"1\" color=\"#000000\">
                <table border=\"0\" cellpadding=\"6\" cellspacing=\"0\">
                <tr>
                <td>Business name:</td><td> $_POST[bname]<br /></td></tr>
                <tr>
                <td>Account Number:</td><td> $_POST[acc]<br /></td></tr>                
                <tr>
                <td>Name:</td><td>$_POST[name]<br /></td></tr>
                <tr>
                <td>Email:</td><td> $_POST[email]<br /></td></tr>
                <tr>
                <td>Website:</td><td> $_POST[website]<br /></td></tr>    
                </table></font>";
                mail("daniel@brakequip.com.au", "Manufacturers Website submission", $body,$headers);
                $formComplete = true;
    }
}

?>
<?php if (isset($formComplete)): ?>
<h2>Thank-you</h2>Your website address has been received.<br /><br />
P.S - If you find yourself thinking that the Online Applications could do with a new feature we'd love to hear your ideas. Give Daniel a call on (03) 8586 2500 to see what's possible.
<?php else: ?>
<?php if (isset($error)): ?>
<font color=red><?php echo $error ?></font>
<?php endif; ?>


<div id="contact-choice">
		<span>We're always striving to ensure BrakeQuip Brake Hose manufacturers are easily found and easily contactable by anyone that needs a replacement rubber or braided brake hose when searching online. When we were recently contacted with a request to add a website field functionality to the Brake Hose Manufacturers search on the website we thought it was a great idea. <br><br>
		To take advantage of this new feature and to boulster your online presence all you need to do is fill in the short form below and we'll do the rest.</span>
</div>

<div id="contact">
<form method="post">
<ul>
<li><input class="input" type="TEXT" name="name" size=30 value="<?php echo @$_POST['name'] ?>" placeholder="Your Name*" /></li>
<li><input class="input" type="TEXT" name="bname" size=30 value="<?php echo @$_POST['bname'] ?>" placeholder="Business Name*" /></li>
<li><input class="input" type="TEXT" name="acc" size=30 value="<?php echo @$_POST['acc'] ?>" placeholder="Account Number*" /></li>
<li><input class="input" type="email" name="email" size=30 value="<?php echo @$_POST['email'] ?>" placeholder="E-mail*" /></li>
<li><input class="input" type="text" name="website" size=30 value="<?php echo @$_POST['website'] ?>" placeholder="Website*" /></li>
<li><input type="submit" class="btn red" name="submit" value="Submit" />
</form>
</ul>
</div>
<?php endif; ?>

