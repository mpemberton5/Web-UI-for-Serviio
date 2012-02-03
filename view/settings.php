<form method="post" action="">
<input type="hidden" name="tab" value="settings">
<fieldset>
<legend><?php echo tr('tab_console_settings','Console settings')?></legend>
<?php echo tr('tab_console_settings_languages_description','Select preferred language of the Console (needs Console restart).')?>
<br>
<select name="language">
<?php foreach ($languages as $key=>$val) { ?>
<option value="<?php echo $key?>"<?php echo $key==$language?" selected":""?>><?php echo $val?></option>
<?php } ?>
</select>
</fieldset>
<br>
<div align="right">
<input type="submit" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')">
<input type="submit" name="save" value="<?php echo tr('button_save','Save')?>" />
</div>
</form>
