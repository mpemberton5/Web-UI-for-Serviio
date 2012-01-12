<SCRIPT type="text/javascript" language="javascript">
<!--
function switchSection(section) {
    document.getElementById('sharedfolders').style.fontWeight = 'normal';
    document.getElementById('onlinesources').style.fontWeight = 'normal';
    document.getElementById(section).style.fontWeight = 'bold';
    document.getElementById('sharedfoldersHolder').style.display = 'none';
    document.getElementById('onlinesourcesHolder').style.display = 'none';
    document.getElementById(section+'Holder').style.display = 'block';
    document.metadata.section.value = section;
    return false;
}

function addRow(tableID,path) {

    if (path==null || path=='') {
        path = prompt('Please enter folder path');
        if (path==null || path=='') {
            alert('Invalid path');
            return;
        }
    }
    var id = 1 + parseInt(maxFId);

    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    row.align = 'center';

    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "hidden";
    element1.name = "folder_"+id;
    element1.value = id;
    cell1.appendChild(element1);
    var element2 = document.createElement("input");
    element2.type = "checkbox";
    element2.name = "chk";
    element2.value = id;
    cell1.appendChild(element2);
    var element3 = document.createElement("input");
    element3.type = "hidden";
    element3.name = "name_"+id;
    element3.value = path;
    cell1.appendChild(element3);

    var cell2 = row.insertCell(1);
    cell2.innerHTML = path;
    cell2.align = 'left';

    var cell3 = row.insertCell(2);
    var element4 = document.createElement("input");
    element4.type = "checkbox";
    element4.name = "VIDEO_"+id;
    element4.value = 1;
    cell3.appendChild(element4);

    var cell4 = row.insertCell(3);
    var element5 = document.createElement("input");
    element5.type = "checkbox";
    element5.name = "AUDIO_"+id;
    element5.value = 1;
    cell4.appendChild(element5);

    var cell5 = row.insertCell(4);
    var element6 = document.createElement("input");
    element6.type = "checkbox";
    element6.name = "IMAGE_"+id;
    element6.value = 1;
    cell5.appendChild(element6);

    var cell6 = row.insertCell(5);
    var element7 = document.createElement("input");
    element7.type = "checkbox";
    element7.name = "ONLINE_"+id;
    element7.value = 1;
    element7.disabled = true;
    cell6.appendChild(element7);

    var cell7 = row.insertCell(6);
    var element8 = document.createElement("input");
    element8.type = "checkbox";
    element8.name = "SCAN_"+id;
    element8.value = 1;
    element8.checked = true;
    cell7.appendChild(element8);

    maxFId = id;
}

//addOSRow('libraryTableOnlineSources',onlineFeedType, sourceURL, mediaType, thumbnailURL, displayName, stat);
function addOSRow(tableID,onlineFT,sURL,mType,tURL,Dname,stat) {
    var id = 1 + parseInt(maxOSId);

    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    row.align = 'center';

    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "hidden";
    element1.name = "onlinesource_"+id;
    element1.value = 'new';
    cell1.appendChild(element1);
    var element2 = document.createElement("input");
    element2.type = "checkbox";
    element2.name = "chk";
    element2.value = id;
    cell1.appendChild(element2);
    var element3 = document.createElement("input");
    element3.type = "hidden";
    element3.name = "os_type_"+id;
    element3.value = onlineFeedType;
    cell1.appendChild(element3);
    var element4 = document.createElement("input");
    element4.type = "hidden";
    element4.name = "os_url_"+id;
    element4.value = sURL;
    cell1.appendChild(element4);
    var element5 = document.createElement("input");
    element5.type = "hidden";
    element5.name = "os_name_"+id;
    element5.value = Dname;
    cell1.appendChild(element5);

    var element6 = document.createElement("input");
    element6.type = "hidden";
    element6.name = "os_stat_"+id;
    element6.value = 'true';
    cell1.appendChild(element6);

    var cell2 = row.insertCell(1);
    if (Dname == "") {
        cell2.innerHTML = sURL;
    } else {
        cell2.innerHTML = Dname;
    }
    cell2.align = 'left';

    var cell3 = row.insertCell(2);
    var element4 = document.createElement("input");
    element4.type = "checkbox";
    element4.name = "os_VIDEO_"+id;
    element4.value = 1;
    cell3.appendChild(element4);
    if (mType == "VIDEO")
        element4.checked = "true";

    var cell4 = row.insertCell(3);
    var element5 = document.createElement("input");
    element5.type = "checkbox";
    element5.name = "os_AUDIO_"+id;
    element5.value = 1;
    cell4.appendChild(element5);
    if (mType == "AUDIO")
        element5.checked = "true";

    var cell5 = row.insertCell(4);
    var element6 = document.createElement("input");
    element6.type = "checkbox";
    element6.name = "os_IMAGE_"+id;
    element6.value = 1;
    cell5.appendChild(element6);
    if (mType == "IMAGE")
        element6.checked = "true";

    maxOSId = id;
}

function deleteRow(tableID) {
    try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        var deleted = false;

        for (var i=1; i<rowCount; i++) {
            cell = table.rows[i].cells[0];

            //loop according to the number of childNodes in the cell
            for (j=0; j<cell.childNodes.length; j++) {
                //if childNode type is CheckBox
                if (cell.childNodes[j].type =="checkbox") {
                    //assign the status of the Select All checkbox to the cell checkbox within the grid
                    if (cell.childNodes[j].checked == true) {
                        table.deleteRow(i);
                        rowCount--;
                        i--;
                        deleted = true;
                    }
                }
            }
        }
        if (deleted) {
            // OK
        } else {
            alert('ERROR: Online Source was not added');
        }
    } catch(e) {
        alert(e);
    }
}
// -->
</SCRIPT>
<form method="post" action="?" name="library">
<input type="hidden" name="tab" value="library">

<br>

<fieldset>
<legend align="center">&nbsp; <a href="#" onclick="return switchSection('sharedfolders')"><span id="sharedfolders" style="font-weight:bold;"><?php echo tr('tab_folders_repositories_panel','Shared folders')?></span></a> |
<a href="#" onclick="return switchSection('onlinesources')"><span id="onlinesources" ><?php echo tr('tab_online_sources_repositories_panel','Online Sources')?></span></a> &nbsp;</legend>
<div id="sharedfoldersHolder" style="display:block">

<?php echo tr('tab_folders_description','Select folders that you want to monitor for media files. Also select type of media files to be shared for each folder. The library can be automatically monitored for new additions and updates to currently shared files.')?><br>
<br>
<table>
<tr valign="top">
<td><table width="100%" id="libraryTableFolders">
    <tr align="center">
	<td width="20"><img src="images/bullet_red.png" alt="<?php echo tr('button_remove','Remove')?>"></td>
	<td align="left"><?php echo tr('tab_folders_respository_table_folder','Folder')?></td>
	<td width="20"><img src="images/film.png" alt="<?php echo tr('tab_folders_repository_table_share_video','Share video files')?>" title="<?php echo tr('tab_folders_repository_table_share_video','Share video files')?>"></td>
	<td width="20"><img src="images/music-beam.png" alt="<?php echo tr('tab_folders_repository_table_share_audio','Share audio files')?>" title="<?php echo tr('tab_folders_repository_table_share_audio','Share audio files')?>"></td>
	<td width="20"><img src="images/camera-black.png" alt="<?php echo tr('tab_folders_repository_table_share_images','Share image files')?>" title="<?php echo tr('tab_folders_repository_table_share_images','Share image files')?>"></td>
	<td width="20"><img src="images/document-attribute-m.png" alt="<?php echo tr('tab_folders_repository_table_retrieve_descriptive_metadata','Retrieve descriptive metadata')?>" title="<?php echo tr('tab_folders_repository_table_retrieve_descriptive_metadata','Retrieve descriptive metadata')?>"></td>
	<td width="20"><img src="images/arrow-circle.png" alt="<?php echo tr('tab_folders_repository_table_scan_for_update','Scan for file additions and updates')?>" title="<?php echo tr('tab_folders_repository_table_scan_for_update','Scan for file additions and updates')?>"></td>
    </tr>
<?php $midA = 1; foreach ($repo[0] as $id=>$entry) { if ($id>$midA) { $midA = $id; } ?>
    <tr align="center">
	<td>
        <input type="hidden" name="folder_<?php echo $id?>" value="<?php echo $id?>">
        <input type="checkbox" name="chk" value="<?php echo $id?>">
        <input type="hidden" name="name_<?php echo $id?>" value="<?php echo $entry[0]?>">
    </td>
	<td align="left"><?php echo $entry[0]?></td>
	<?php for ($i=0;$i<count($types);$i++) { $type = $types[$i]; ?>
	<td><input type="checkbox" name="<?php echo $type."_".$id?>" value="1"<?php echo array_search($type,$entry[1])===false?"":" checked"?>></td>
	<?php } ?>
	<td><input type="checkbox" name="ONLINE_<?php echo $id?>" value="1"<?php echo $entry[2]=="false"?"":" checked"?>></td>
	<td><input type="checkbox" name="SCAN_<?php echo $id?>" value="1"<?php echo $entry[3]=="false"?"":" checked"?>></td>
    </tr>
<?php } ?>
</table>
<input type="hidden" name="lastFId" value="<?php echo $midA?>">
<script type="text/javascript">
<!--
var maxFId = '<?php echo $midA?>';
var libraryPath = '';
function addLocalPath() {
    if (libraryPath==null || libraryPath=='') {
        alert('Invalid path');
        return;
    }
    if (confirm('Add path "' + libraryPath + '" to media library?')) {
        addRow('libraryTableFolders',libraryPath);
    }
}
function populateDirectory(dir) {
    libraryPath = dir;
}
// -->
</script>
</td>
<td width="100">
<input type="button" name="addlocal" value="<?php echo tr('tab_folders_button_add_local','Add local...')?>" onclick="libraryPath='';return GB_showCenter('Add local path', '../../afb/index.php',500,500,addLocalPath);">
<br>
<input type="button" name="addpath" value="<?php echo tr('tab_folders_button_add_remote','Add path...')?>" onclick="addRow('libraryTableFolders',null)">
<br>
<input type="button" name="remove" value="<?php echo tr('button_remove','Remove')?>" onclick="if(confirm('Are you sure you want to remove selected folders')) { deleteRow('libraryTableFolders'); }">
</td>
</tr>
</table>
<br>
<input type="checkbox" name="searchupdates" value="1"<?php echo $serviio->searchForUpdates=="true"?" checked":""?>> <?php echo tr('tab_folders_search_for_files_updates','Search for updates of currently shared files')?>
<br>
<input type="checkbox" name="addhidden" value="1"<?php echo $serviio->searchHiddenFiles=="true"?" checked":""?>> <?php echo tr('tab_folders_include_hidden','Include hidden files')?>
</div>

<div id="onlinesourcesHolder" style="display:none">
<?php echo tr('tab_online_sources_description','Define online source that you would like to access. Online sources are constantly monitored for updates and cached for a period of time. It might take a moment for new sources to appear on your device.')?><br>
<br>
<table>
<tr valign="top">
<td><table width="100%" id="libraryTableOnlineSources">
    <tr align="center">
	<td width="20"><img src="images/bullet_red.png" alt="<?php echo tr('button_remove','Remove')?>"></td>
	<td align="left"><?php echo tr('tab_online_sources_respository_table_url','Url')?></td>
	<td width="20"><img src="images/film.png" alt="<?php echo tr('tab_online_sources_repository_table_share_video','Video')?>" title="<?php echo tr('tab_online_sources_repository_table_share_video','Video')?>"></td>
	<td width="20"><img src="images/music-beam.png" alt="<?php echo tr('tab_online_sources_repository_table_share_audio','Audio')?>" title="<?php echo tr('tab_online_sources_repository_table_share_audio','Audio')?>"></td>
	<td width="20"><img src="images/camera-black.png" alt="<?php echo tr('tab_online_sources_repository_table_share_images','Image')?>" title="<?php echo tr('tab_online_sources_repository_table_share_images','Image')?>"></td>
    </tr>
<?php $midB = 1; foreach ($repo[1] as $id=>$entry) { if ($id>$midB) { $midB = $id; } ?>
    <tr align="center">
	<td>
        <input type="hidden" name="onlinesource_<?php echo $id?>" value="<?php echo $id?>">
        <input type="checkbox" name="chk" value="<?php echo $id?>">
        <input type="hidden" name="os_type_<?php echo $id?>" value="<?php echo $entry[0]?>">
        <input type="hidden" name="os_url_<?php echo $id?>" value="<?php echo $entry[1]?>">
        <input type="hidden" name="os_name_<?php echo $id?>" value="<?php echo $entry[4]?>">
        <input type="hidden" name="os_stat_<?php echo $id?>" value="<?php echo $entry[5]?>">
    </td>
	<td align="left"><?php echo $entry[4]==""?$entry[1]:$entry[4]?></td>

	<?php for ($i=0;$i<count($types);$i++) { $type = $types[$i]; ?>
	<td><input type="checkbox" name="os_<?php echo $type."_".$id?>" value="1"<?php echo $type===$entry[2]?" checked":""?>></td>
	<?php } ?>
    </tr>
<?php } ?>
<?php /* screen - Enter detail of online source
       Enter details of the required online source. Select the source type, enter URL of the
       source and pick type of media the source provides.

       Source type: Online RSS/Atom feed (onlineFeedType)
       Source URL: (textbox)             (sourceURL)
       Display Name: (textbox)           (repositoryName)
       Media type: Video / Audio / Image (mediaType)
       Thumbnail URL: (textbox readonly) (thumbnailURL)
       */?>
</table>
<input type="hidden" name="lastOSId" value="<?php echo $midB?>">
<script type="text/javascript">
<!--
var maxOSId = '<?php echo $midB?>';
var posted = '';
var onlineFeedType = '';
var sourceURL = '';
var mediaType = '';
var thumbnailURL = '';
var displayName = '';
var stat = '';
function addOnlineSource() {

    // only process if button clicked
    if (posted!='true') {
        return;
    }

    // process only if source URL was entered
    if (sourceURL==null || sourceURL=='') {
        alert('Invalid Source');
        return;
    }

    if (confirm('Add "' + sourceURL + '" to online sources?')) {
        addOSRow('libraryTableOnlineSources',onlineFeedType, sourceURL, mediaType, thumbnailURL, displayName, stat);
    }
}
function populateData(oft,surl,mt,turl,pst,name) {
    onlineFeedType = oft;
    sourceURL = surl;
    mediaType = mt;
    thumbnailURL = turl;
    posted = pst;
    displayName = name;
    stat = 'true';
}
// -->
</script>
</td>
<td width="100">
<input type="button" name="add_os" value="<?php echo tr('button_add','Add')?>" onclick="onlineFeedType='';sourceURL='';mediaType='';thumbnailURL='';posted='';displayName='';return GB_showCenter('Add online source', '../../nos/new.php',300,550,addOnlineSource);">
<br>
<input type="button" name="remove_os" value="<?php echo tr('button_remove','Remove')?>" onclick="if(confirm('Are you sure you want to remove selected online source?')) { deleteRow('libraryTableOnlineSources'); }">
</td>
</tr>
</table>
<br>
<?php echo tr('tab_online_sources_max_num_feed_items_to_retrieve','Max. number of feed items to retrieve:')?>
<select name="maxfeeditems">
  <option value="unlimited"<?php echo $serviio->maxNumberOfItemsForOnlineFeeds=="unlimited"?" selected":""?>>Unlimited</option>
  <option value="10"<?php echo $serviio->maxNumberOfItemsForOnlineFeeds=="10"?" selected":""?>>10</option>
  <option value="20"<?php echo $serviio->maxNumberOfItemsForOnlineFeeds=="20"?" selected":""?>>20</option>
  <option value="30"<?php echo $serviio->maxNumberOfItemsForOnlineFeeds=="30"?" selected":""?>>30</option>
  <option value="40"<?php echo $serviio->maxNumberOfItemsForOnlineFeeds=="40"?" selected":""?>>40</option>
  <option value="50"<?php echo $serviio->maxNumberOfItemsForOnlineFeeds=="50"?" selected":""?>>50</option>
</select>
<br>
<?php echo tr('tab_online_sources_feed_expiry_interval','Feed Expiry Interval (hours):')?>
<input type="text" name="feedexpiry" value="<?php echo $serviio->onlineFeedExpiryInterval?>" maxlength="5" size="5">
<br>
<?php echo tr('tab_online_sources_preferred_online_content_quality','Preferred online content quality:')?>
<select name="onlinequality">
  <option value="LOW"<?php echo $serviio->onlineContentPreferredQuality=="LOW"?" selected":""?>>Low</option>
  <option value="MEDIUM"<?php echo $serviio->onlineContentPreferredQuality=="MEDIUM"?" selected":""?>>Medium</option>
  <option value="HIGH"<?php echo $serviio->onlineContentPreferredQuality=="HIGH"?" selected":""?>>High</option>
</select>
</div>
</fieldset>

<br>
<fieldset>
<legend><?php echo tr('tab_folders_library_status_panel','Library refresh')?></legend>
<input type="checkbox" name="autoupdate" value="1"<?php echo $serviio->automaticLibraryUpdate=="true"?" checked":""?>> <?php echo tr('tab_folders_automatic_update','Keep library automatically updated')?>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
Refresh interval (minutes): <input type="text" name="minutes" value="<?php echo $serviio->automaticLibraryUpdateInterval?>" maxlength="3" size="3">
<br>
<input type="submit" name="force" value="<?php echo tr('tab_folders_button_refresh_library','Force refresh')?>" onclick="return confirm('Are you sure you want to force refresh?')">
<input type="button" name="showstatus" value="<?php echo tr('tab_folders_button_show_status','Show status')?>" onclick="alert('To Do...'); return false;">
</fieldset>
<div align="right">
<input type="submit" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')">
<input type="submit" name="save" value="<?php echo tr('button_save','Save')?>" />
</div>
</form>
