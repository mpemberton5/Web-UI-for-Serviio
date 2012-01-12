<form method="post" action="?" name="transcoding">
<input type="hidden" name="tab" value="transcoding">
<?php echo tr('tab_transcoding_general_description','When enabled, transcoding enables you to play media files that would not normally be playable by your device. Transcoding only works with a specific Renderer Profile (not the Generic DLNA profile).')?><br>
<br>
<input type="checkbox" name="transcoding" value="1"<?php echo $serviio->transcodingEnabled=="true"?" checked":""?>> <?php echo tr('tab_transcoding_enable_transcoding','Enable transcoding')?><br>
<br>
<fieldset>
<legend><?php echo tr('tab_transcoding_general_settings','General settings')?></legend>
<table>
<tr><td><?php echo tr('tab_transcoding_folder_location','Transcoded files location:')?></td>
<td><input type="text" name="location" size="40" value="<?php echo $serviio->transcodingFolderLocation?>"></td>
<td><input type="button" name="browse" value="<?php echo tr('tab_transcoding_select_folder','Browse...')?>" onclick="localPath='';return GB_showCenter('<?php echo tr('tab_transcoding_folder_location','Transcoded files location:')?>', '../../afb/index.php',500,500,addLocalPath);"></td></tr>
<tr><td><?php echo tr('tab_transcoding_threads','Number of CPU cores to use')?></td>
<td><select name="cores">
<?php for ($i=1;$i<=$serviio->numberOfCPUCores;$i++) { ?>
<option value="<?php echo $i?>"<?php echo $i==$serviio->threadsNumber?" selected":""?>><?php echo $i?></option>
<?php } ?>
</select></td><td>&nbsp;</td></tr>
</table>
</fieldset>
<script type="text/javascript">
<!--
var localPath = '';
function addLocalPath() {
    if (localPath==null || localPath=='') {
	return;
    }
    if (confirm('Change transcoded files location from "' + document.transcoding.location.value + '" to "' + localPath + '"?')) {
	document.transcoding.location.value = localPath;
    }
}
function populateDirectory(dir) {
    localPath = dir;
}
// -->
</script>
<br>
<fieldset>
<legend><?php echo tr('tab_transcoding_video_settings','Video settings')?></legend>
<input type="checkbox" name="quality" value="1"<?php echo $serviio->bestVideoQuality=="true"?" checked":""?>> <?php echo tr('tab_transcoding_produce_best_quality','Produce the best video quality')?><br><br>
<?php echo tr('tab_transcoding_audio_channels','Audio channels')?>
<input type="radio" name="audio" value="original"<?php echo $serviio->audioDownmixing=="true"?"":" checked"?>> <?php echo tr('tab_transcoding_audio_channels_original','Keep original')?>
<input type="radio" name="audio" value="downmix"<?php echo $serviio->audioDownmixing=="true"?" checked":""?>> <?php echo tr('tab_transcoding_audio_channels_stereo','Downmix to stereo')?>
</fieldset>
<div align="right">
<input type="submit" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')">
<input type="submit" name="save" value="<?php echo tr('button_save','Save')?>" />
</div>
</form>
