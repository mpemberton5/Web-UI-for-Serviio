<script type="text/javascript" language="javascript">
<!--
function switchSection(section) {
    document.getElementById('video').style.fontWeight = 'normal';
    document.getElementById('audio').style.fontWeight = 'normal';
    document.getElementById(section).style.fontWeight = 'bold';
    document.getElementById('videoHolder').style.display = 'none';
    document.getElementById('audioHolder').style.display = 'none';
    document.getElementById(section+'Holder').style.display = 'block';
    document.metadata.section.value = section;
    return false;
}
// -->
</script>
<form method="post" action="?" name="metadata">
<input type="hidden" name="tab" value="metadata">
<input type="hidden" name="section" value="<?php echo $section?>">
<?php echo tr('tab_metadata_description','Media files metadata is constantly monitored and stored. By default all embedded metadata (tags) are extracted from media files. Please select additional extracting methods.')?><br>
<br>
<fieldset>
<legend align="center">&nbsp; <a href="#" onclick="return switchSection('video')"><span id="video" <?php echo $section!="audio"?'style="font-weight:bold;"':''?>><?php echo tr('file_type_video','Video')?></span></a> | 
<a href="#" onclick="return switchSection('audio')"><span id="audio" <?php echo $section=="audio"?'style="font-weight:bold;"':''?>><?php echo tr('file_type_audio','Audio')?></span></a> &nbsp;</legend>
<div id="videoHolder" style="display:<?php echo $section!='audio'?'block':'none'?>">
<input type="checkbox" name="thumbnails" value="1"<?php echo $serviio->videoGenerateLocalThumbnailEnabled=="true"?" checked":""?>> <?php echo tr('tab_metadata_video_enable_local_thumbnail','Generate thumbnails for local videos')?><br>
<input type="checkbox" name="cover_search" value="1"<?php echo $serviio->videoLocalArtExtractorEnabled=="true"?" checked":""?>> <?php echo tr('tab_metadata_video_local_poster','Look for a local DVD cover image or poster (e.g. dvdcover.jpg, movie.jpg, etc.)')?><br>
<br>
<fieldset>
<legend><?php echo tr('tab_metadata_descriptive_metadata','Descriptive metadata')?></legend>
<?php echo tr('tab_metadata_descriptive_metadata_description','Serviio includes various ways to retrieve descriptive metadata of your video files. Please pick one or select \'No descriptive metadata\' from the drop-down box.')?>
<br>
<select name="online_sources">
<?php foreach ($descriptiveMetadataExtractors as $key=>$val) { ?>
<option value="<?php echo $key?>"<?php echo $key==$serviio->descriptiveMetadataExtractor?" selected":""?>><?php echo $val?></option>
<?php } ?>
</select>
<br>
<input type="checkbox" name="download_cover" value="1"<?php echo $serviio->videoOnlineArtExtractorEnabled=="true"?" checked":""?>> <?php echo tr('tab_metadata_video_online_retrieve_poster','Retrieve DVD cover image or poster if available')?><br>
<div align="center"><input type="submit" name="rescan" value="<?php echo tr('tab_metadata_button_force_video_metadata','Rescan video metadata')?>" onclick="return confirm('Are you sure you want to force rescan video metadata?')"></div>
<br>
<?php echo tr('tab_metadata_metadata_languages_description','Some metadata extractors enable retrieving metadata in a certain language. Select the preferred language.')?><br>
<select name="metadata_language">
<?php foreach ($browsingCategoriesLanguages as $key=>$val) { ?>
<option value="<?php echo $key?>"<?php echo $key==$serviio->metadataLanguage?" selected":""?>><?php echo $val?></option>
<?php } ?>
</select> &nbsp; <input type="checkbox" name="orig_title" value="1"<?php echo $serviio->retrieveOriginalTitle=="true"?" checked":""?>> <?php echo tr('tab_metadata_video_use_original_title','Use original title')?>
</fieldset>
</div>
<div id="audioHolder" style="display:<?php echo $section=='audio'?'block':'none'?>">
<input type="checkbox" name="audio_cover" value="1"<?php echo $serviio->audioLocalArtExtractorEnabled=="true"?" checked":""?>> 
<?php echo tr('tab_metadata_audio_local_art','Look for a local album art image (e.g. folder.jpg, cover.jpg, front_cover.jpg, etc.)')?>
</fieldset>
</div>
</fieldset>
<div align="right">
<input type="submit" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')">
<input type="submit" name="save" value="<?php echo tr('button_save','Save')?>" />
</div>
</form>
