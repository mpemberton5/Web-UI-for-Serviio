<form method="post" action="" id="remoteform">
<input type="hidden" name="tab" value="remote">
<br />
<?php echo tr('tab_remote_choose_settings','Choose your settings for remote access to your files.')?>
<br />
<ul id="rmtSecurityTab" class="shadetabs">
    <li><a href="#" rel="rmt1" class="selected"><?php echo tr('tab_remote_security','Security')?></a></li>
</ul>
<div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
    <div id="rmt1" class="tabcontent">
        <br>
        <?php echo tr('tab_remote_user_password','User Password:')?>
        <input type="password" id="userPasswd" name="userPasswd" size="40" value="<?php echo $rmtAccess['remoteUserPassword']?>">
        <br>
    </div>
</div>

<br>

<ul id="rmtDeliveryQualityTab" class="shadetabs">
    <li><a href="#" rel="rmt2" class="selected"><?php echo tr('tab_remote_content_delivery','Content Delivery')?></a></li>
</ul>
<div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
    <div id="rmt2" class="tabcontent">
        <br>
        <?php echo tr('tab_remote_preferred_delivery_quality','Preferred delivery quality:')?>
        <select id="deliveryQuality" name="deliveryQuality">
            <option value="LOW"<?php echo $rmtAccess['preferredRemoteDeliveryQuality']=="LOW"?" selected":""?>>Low</option>
            <option value="MEDIUM"<?php echo $rmtAccess['preferredRemoteDeliveryQuality']=="MEDIUM"?" selected":""?>>Medium</option>
            <option value="ORIGINAL"<?php echo $rmtAccess['preferredRemoteDeliveryQuality']=="ORIGINAL"?" selected":""?>>Original</option>
        </select>
        <br>
    </div>
</div>

<div style="float: left;">
    <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>:23424/mediabrowser/" target="_blank">Open MediaBrowser</a>
</div>
<div align="right" style="float: right;">
    <span id="savingMsg" class="savingMsg"></span>
    <input type="submit" id="reset" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')">
    <input type="submit" id="submit" name="save" value="<?php echo tr('button_save','Save')?>" />
</div>
<br />
</form>
