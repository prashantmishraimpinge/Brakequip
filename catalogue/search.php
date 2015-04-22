<?php $this->extend($extendDir . 'layout'); ?>

<a href="/catalogue/" class="fl" style="margin: 30px 0 0 10px;">&lt; Go Back to Catalogue</a>
<div class="bq-search" style="float: right; padding: 10px 10px 10px 40px; background: #f5f5f5; border-bottom: 1px solid #dddddd;">
    <form action="/catalogue/search" method="post" style="display: inline">
        Enter BQ Number &nbsp; <input type="text" name="bq_number" value="" class="input" /> <input type="submit" name="search" value="Search" />
    </form>
</div>

<div class="clear" style="height: 10px;"></div>

<div class="part">
<p style="font-size: 16px">Search on: <b><?php echo $_POST['bq_number'] ?></b> -- Found <?php echo $count ?> <?php echo ($count > 1 || $count == 0 ? 'categories' : 'category') ?></p>
<?php if ($count > 0): ?>
    Please select the category below:
    <div style="overflow-y: scroll; margin-right:5px; height: 200px; padding: 5px; border: 1px solid #ccc;">
        <ul style="list-style-type: none; padding: 5px;">
        <?php foreach ($results[0]['WebPartToCategory'] as $result): ?>
            <li><a href="/catalogue/?categoryId=<?php echo $result['web_category_id'] ?>"><?php echo WebCategoryTable::getParentCategories($result['web_category_id']) ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
<p>No results found.</p>

<?php endif; ?>


    <div class="cb" style="height: 20px"></div>
    
    <div class="fr" style="width:300px;">
        <a id="vechileRequestLink" href="" class="btn"><span>Can't find what you're looking for?</span></a><br />
        <a href="/catalogue/understand" class="btn" style="margin-left: 10px;" target="_blank"><span>Understanding our catalogue</span></a>
    </div>
            
    <div class="cb" style="height: 20px"></div>
</div>

<div id="vechileRequestDialog" style="display:none">
    <div id="vechileRequestResult">
        <strong>Can't find what you're looking for?</strong>
        <p>We're always trying to stay on the ball, so if you come across a vehicle that we don't have listed &amp; you think we should, let us know!</p>
    </div>
    <form id="vechileRequestForm" method="post" action="/catalogue/vechile-request">
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
                    <input id="vechileRequestSubmit" type="button" class="submit" name="submit" value="Submit" /></td>
            </tr>
        </table>
    </form>
</div>

<script>
    $(function() {
        $('#vechileRequestLink').click(function () {
            $("#vechileRequestDialog").dialog('open');
            return false;
        });
        $("#vechileRequestDialog").dialog({modal: true, width:600, autoOpen: false, title: 'Vechile Request'});
        
        $('#vechileRequestSubmit').click(function () {

            $.post('/catalogue/vechile-request', $('#vechileRequestForm').serialize(), function (data) {
                data = $.parseJSON(data);
                if (data.e != undefined) {
                    alert(data.e);
                    return false;
                }
                
                if (data.s != undefined) {
                    alert(data.s);
                    $("#vechileRequestDialog").dialog('close');
                    $('#vechileRequestForm input[type="text"], #vechileRequestForm textarea').val('');
                }
                return false;
            });
            
        });
    });
</script>