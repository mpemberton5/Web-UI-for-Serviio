<form method="post" action="" id="libraryform" name="library" accept-charset="utf-8">
    <input type="hidden" name="tab" value="library">
    <input type="hidden" id="process" name="process" value="">
    <br>

    <ul id="librarytabs" class="shadetabs">
    <li><a href="#" rel="libtab1" class="selected">Shared Folders</a></li>
    <li><a href="#" rel="libtab2">Online Sources</a></li>
    </ul>
    <div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">

        <div id="libtab1" class="tabcontent">
            <?php echo tr('tab_folders_description','Select folders that you want to monitor for media files. Also select type of media files to be shared for each folder. The library can be automatically monitored for new additions and updates to currently shared files.')?><br>
            <br>
            <div style="padding-left: 3px;">
                <button type="button" id="addFolder" name="addFolder" class="ui-button ui-widget ui-state-default ui-corner-all btn-small">
                    <?php echo tr('tab_folders_button_add_local','Add local...')?>
                </button>&nbsp;&nbsp;
                <button type="button" id="addPath" name="addPath" class="ui-button ui-widget ui-state-default ui-corner-all btn-small">
                    <?php echo tr('tab_folders_button_add_remote','Add path...')?>
                </button>&nbsp;&nbsp;<!-- onclick="addLibRow('libraryTableFolders',null)">-->
                <button type="button" id="removeFolder" name="removeFolder" class="ui-button ui-widget ui-state-default ui-corner-all btn-small">
                    <?php echo tr('button_remove','Remove Selected')?>
                </button> <!--onclick="if(confirm('Are you sure you want to remove selected folders')) { deleteLibRow('libraryTableFolders'); }">-->
            </div>
            <table>
                <tr valign="top">
                    <td>
                        <table width="100%" id="libraryTableFolders" name="libraryTableFolders">
                            <thead align="center">
                                <th width="0">&nbsp;</th>
                                <th align="left" width="400"><?php echo tr('tab_folders_repository_table_folder','Folder')?></th>
                                <th width="50"><?php echo tr('tab_folders_repository_table_access','Access')?></th>
                                <th align="center" width="30"><img src="images/film.png" alt="<?php echo tr('tab_folders_repository_table_share_video','Share video files')?>" title="<?php echo tr('tab_folders_repository_table_share_video','Share video files')?>"></th>
                                <th align="center" width="30"><img src="images/music-beam.png" alt="<?php echo tr('tab_folders_repository_table_share_audio','Share audio files')?>" title="<?php echo tr('tab_folders_repository_table_share_audio','Share audio files')?>"></th>
                                <th align="center" width="30"><img src="images/camera-black.png" alt="<?php echo tr('tab_folders_repository_table_share_images','Share image files')?>" title="<?php echo tr('tab_folders_repository_table_share_images','Share image files')?>"></th>
                                <th align="center" width="30"><img src="images/document-attribute-m.png" alt="<?php echo tr('tab_folders_repository_table_retrieve_descriptive_metadata','Retrieve descriptive metadata')?>" title="<?php echo tr('tab_folders_repository_table_retrieve_descriptive_metadata','Retrieve descriptive metadata')?>"></th>
                                <th align="center" width="30"><img src="images/arrow-circle.png" alt="<?php echo tr('tab_folders_repository_table_scan_for_update','Scan for file additions and updates')?>" title="<?php echo tr('tab_folders_repository_table_scan_for_update','Scan for file additions and updates')?>"></th>
                            </thead>
                            <tbody>
                            <?php $ctr = 1; $midA = 1; foreach ($repo[0] as $id=>$entry) { if ($id>$midA) { $midA = $id; } ?>
                            <tr align="center" <?php echo $ctr%2?'':'class="odd"'?>>
                                <td>
                                    <input type="hidden" name="folder_<?php echo $id?>" value="<?php echo $id?>">
                                    <input type="hidden" name="name_<?php echo $id?>" value="<?php echo $entry[0]?>">
                                </td>
                                <td align="left"><?php echo $entry[0]?></td>

                                <td><select name="access_<?php echo $id?>" <?php echo ($serviio->licenseEdition=="PRO"?'':'disabled="disabled" title="Enabled with PRO License"')?>>
                                    <?php $accesses = array("1"=>"Full","2"=>"Limited"); ?>
                                    <?php foreach ($accesses as $key=>$val) { ?>
                                    <option value="<?php echo $key?>"<?php echo $key==max($entry[4])?" selected":""?>><?php echo $val?></option>
                                    <?php } ?>
                                </select></td>

                                <?php for ($i=0;$i<count($types);$i++) { $type = $types[$i]; ?>
                                <td><input type="checkbox" name="<?php echo $type."_".$id?>" value="1"<?php echo array_search($type,$entry[1])===false?"":" checked"?>></td>
                                <?php } ?>
                                <td><input type="checkbox" name="ONLINE_<?php echo $id?>" value="1"<?php echo $entry[2]=="false"?"":" checked"?>></td>
                                <td><input type="checkbox" name="SCAN_<?php echo $id?>" value="1"<?php echo $entry[3]=="false"?"":" checked"?>></td>
                            </tr>
                            <?php $ctr += 1; ?>
                            <?php } ?>
                            </tbody>
                        </table>
                        <input type="hidden" id="lastFId" name="lastFId" value="<?php echo $midA?>">
                    </td>
                </tr>
            </table>
            <br>
            <input type="checkbox" name="searchupdates" value="1"<?php echo $serviio->searchForUpdates=="true"?" checked":""?>> <?php echo tr('tab_folders_search_for_files_updates','Search for updates of currently shared files')?>
            <br>
            <input type="checkbox" name="addhidden" value="1"<?php echo $serviio->searchHiddenFiles=="true"?" checked":""?>> <?php echo tr('tab_folders_include_hidden','Include hidden files')?>
            <br>
            <br>

            <ul id="librarystatustabs" class="shadetabs">
            <li><a href="#" rel="libstab1" class="selected">Library Status</a></li>
            </ul>
            <div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
                <div id="libstab1" class="tabcontent">
                    <input type="checkbox" name="autoupdate" value="1"<?php echo $serviio->automaticLibraryUpdate=="true"?" checked":""?>> <?php echo tr('tab_folders_automatic_update','Keep library automatically updated')?>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    Refresh interval (minutes): <input type="text" name="minutes" value="<?php echo $serviio->automaticLibraryUpdateInterval ?>" maxlength="3" size="3">
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <input type="submit" id="refresh" name="refresh" value="<?php echo tr('tab_folders_button_refresh_library','Force refresh')?>" class="ui-button ui-widget ui-state-default ui-corner-all btn-small" />
                    <span id="forceRefreshMsg" class="forceRefreshMsg"></span>
                </div>
            </div>

        </div>

        <div id="libtab2" class="tabcontent">
            <?php echo tr('tab_online_sources_description','Define online source that you would like to access. Online sources are constantly monitored for updates and cached for a period of time. It might take a moment for new sources to appear on your device.')?><br>
            <br>
            <div style="padding-left: 3px;">
                <button type="button" id="add_os" name="add_os" class="ui-button ui-widget ui-state-default ui-corner-all btn-small">
                    <?php echo tr('button_add','Add')?>
                </button>&nbsp;&nbsp;
                <button type="button" id="add_serviidb" name="add_serviidb" class="ui-button ui-widget ui-state-default ui-corner-all btn-small">
                    <?php echo tr('button_add_Serviidb','Add from ServiiDB')?>
                </button>&nbsp;&nbsp;
                <button type="button" id="edit_os" name="edit_os" class="ui-button ui-widget ui-state-default ui-corner-all btn-small">
                    <?php echo tr('button_edit','Edit')?>
                </button>&nbsp;&nbsp;
                <button type="button" id="removeOnlineSource" name="removeOnlineSource" class="ui-button ui-widget ui-state-default ui-corner-all btn-small">
                    <?php echo tr('button_remove','Remove')?>
                </button><!--" onclick="if(confirm('Are you sure you want to remove selected online source?')) { deleteLibRow('libraryTableOnlineSources'); }">-->
            </div>
            <table>
                <tr valign="top">
                    <td>
                        <table width="100%" id="libraryTableOnlineSources" name="libraryTableOnlineSources">
                            <thead align="center">
                                <th width="0">&nbsp;</th>
                                <th align="center" width="80"><?php echo tr('tab_online_sources_repository_table_refresh','Refresh')?></th>
                                <th align="center" width="100"><?php echo tr('tab_online_sources_repository_table_enabled','Enabled')?></th>
                                <th align="left" width="100"><?php echo tr('tab_online_sources_repository_table_type','Type')?></th>
                                <th width="50"><?php echo tr('tab_online_sources_repository_table_access','Access')?></th>
                                <th align="left" width="400"><?php echo tr('tab_online_sources_repository_table_url','Name / URL')?></th>
                                <th align="center" width="80"><?php echo tr('tab_online_source_repository_table_mediatype','Media Type')?></th>
                            </thead>
                            <tbody>
                            <?php $ctr = 1; $midB = 1; foreach ($repo[1] as $id=>$entry) { if ($id>$midB) { $midB = $id; } ?>
                            <tr align="center" <?php echo $ctr%2?'':'class="odd"'?>>
                                <td>
                                    <input type="hidden" name="onlinesource_<?php echo $id?>" value="<?php echo $id?>">
                                    <input type="hidden" id="os_type_<?php echo $id?>" name="os_type_<?php echo $id?>" value="<?php echo $entry[0]?>">
                                    <input type="hidden" id="os_url_<?php echo $id?>" name="os_url_<?php echo $id?>" value="<?php echo $entry[1]?>">
                                    <input type="hidden" id="os_media_<?php echo $id?>" name="os_media_<?php echo $id?>" value="<?php echo $entry[2]?>">
                                    <input type="hidden" id="os_thumb_<?php echo $id?>" name="os_thumb_<?php echo $id?>" value="<?php echo $entry[3]?>">
                                    <input type="hidden" id="os_name_<?php echo $id?>" name="os_name_<?php echo $id?>" value="<?php echo $entry[4]?>">
                                    <input type="hidden" id="os_stat_<?php echo $id?>" name="os_stat_<?php echo $id?>" value="<?php echo $entry[5]?>">
                                </td>
                                <td align="center" ><a style="background-color: yellow;" class="refresh-link" os_no="<?php echo $id?>" href="">&nbsp;Refresh&nbsp;</a></td>
                                <td>
                                    <div class="os_switch" id="os_switch_<?php echo $id?>" style="cursor: pointer; ">
                                        <div class="iphone_switch_container" style="height:27px; width:94px; position: relative; overflow: hidden">
                                            <img class="iphone_switch" style="height: 27px; width: 94px; background-image: url(images/iphone_switch_16.png); background-position: 0px 50%; " src="images/iphone_switch_container_off.png">
                                        </div>
                                    </div>
                                </td>
                                <td align="left"><span id="os_type_v_<?php echo $id?>" name="os_type_v_<?php echo $id?>"><?php echo $entry[0]?></span></td>
                                <td><select name="os_access_<?php echo $id?>" <?php echo ($serviio->licenseEdition=="PRO"?'':'disabled="disabled" title="Enabled with PRO License"')?>>
                                    <?php $accesses = array("1"=>"Full","2"=>"Limited"); ?>
                                    <?php foreach ($accesses as $key=>$val) { ?>
                                    <option value="<?php echo $key?>"<?php echo $key==max($entry[6])?" selected":""?>><?php echo $val?></option>
                                    <?php } ?>
                                </select></td>

                                <td align="left"><span id="os_name_v_<?php echo $id?>" name="os_name_v_<?php echo $id?>" title="<?php echo $entry[1]?>"><?php echo $entry[4]==""?$entry[1]:$entry[4]?></span></td>

                                <td style="vertical-align: top;" width="30"><span id="os_media_v_<?php echo $id?>">
                                    <?php if ($entry[2] == "VIDEO") {?>
                                        <img src="images/film.png" alt="<?php echo tr('tab_online_sources_repository_table_share_video','Video')?>">&nbsp;<?php echo tr('tab_online_sources_repository_table_share_video','Video')?>
                                    <?php } else if ($entry[2] == "AUDIO") {?>
                                        <img src="images/music-beam.png" alt="<?php echo tr('tab_online_sources_repository_table_share_audio','Audio')?>">&nbsp;<?php echo tr('tab_online_sources_repository_table_share_audio','Audio')?>
                                    <?php } else if ($entry[2] == "IMAGE") {?>
                                        <img src="images/camera-black.png" alt="<?php echo tr('tab_online_sources_repository_table_share_images','Image')?>">&nbsp;<?php echo tr('tab_online_sources_repository_table_share_images','Image')?>
                                    <?php } ?>
                                </span></td>

                            </tr>
                            <?php $ctr += 1; ?>
                            <?php } ?>
                            <?php /* screen - Enter detail of online source
                                Enter details of the required online source. Select the source type, enter URL of the
                                source and pick type of media the source provides.

                                Source type: Online RSS/Atom feed (onlineFeedType)
                                Source URL: (textbox)             (sourceURL)
                                Display Name: (textbox)           (repositoryName)
                                Media type: Video / Audio / Image (mediaType)
                                Thumbnail URL: (textbox readonly) (thumbnailURL)

                                <?php for ($i=0;$i<count($types);$i++) { $type = $types[$i]; ?>
                                <td><input type="radio" name="os_<?php echo $id?>" value="<?php echo $type?>"<?php echo $type===$entry[2]?" checked":""?>></td>
                                <?php } ?>
                            */?>
                            </tbody>
                        </table>
                        <input type="hidden" id="lastOSId" name="lastOSId" value="<?php echo $midB?>">
                    </td>
                </tr>
            </table>
            <br>
            <table>
                <tr><td>
                    <?php echo tr('tab_online_sources_max_num_feed_items_to_retrieve','Max. number of feed items to retrieve:')?>
                </td><td>
                    <select name="maxfeeditems">
                        <option value="-1"<?php echo $serviio->maxNumberOfItemsForOnlineFeeds=="-1"?" selected":""?>>Unlimited</option>
                        <option value="10"<?php echo $serviio->maxNumberOfItemsForOnlineFeeds=="10"?" selected":""?>>10</option>
                        <option value="20"<?php echo $serviio->maxNumberOfItemsForOnlineFeeds=="20"?" selected":""?>>20</option>
                        <option value="30"<?php echo $serviio->maxNumberOfItemsForOnlineFeeds=="30"?" selected":""?>>30</option>
                        <option value="40"<?php echo $serviio->maxNumberOfItemsForOnlineFeeds=="40"?" selected":""?>>40</option>
                        <option value="50"<?php echo $serviio->maxNumberOfItemsForOnlineFeeds=="50"?" selected":""?>>50</option>
                    </select>
                </td></tr>
                <tr><td>
                    <?php echo tr('tab_online_sources_feed_expiry_interval','Feed Expiry Interval (hours):')?>
                </td><td>
                    <input type="text" name="feedexpiry" value="<?php echo $serviio->onlineFeedExpiryInterval?>" maxlength="5" size="5">
                </td></tr>
                <tr><td>
                    <?php echo tr('tab_online_sources_preferred_online_content_quality','Preferred online content quality:')?>
                </td><td>
                    <select name="onlinequality">
                        <option value="LOW"<?php echo $serviio->onlineContentPreferredQuality=="LOW"?" selected":""?>>Low</option>
                        <option value="MEDIUM"<?php echo $serviio->onlineContentPreferredQuality=="MEDIUM"?" selected":""?>>Medium</option>
                        <option value="HIGH"<?php echo $serviio->onlineContentPreferredQuality=="HIGH"?" selected":""?>>High</option>
                    </select>
                </td></tr>
            </table>
        </div>
    </div>

    <div align="right">
        <span id="savingMsg" class="savingMsg"></span>
        <input type="submit" id="reset" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')" class="ui-button ui-widget ui-state-default ui-corner-all btn-small" />
        <input type="submit" id="submit" name="save" value="<?php echo tr('button_save','Save')?>" class="ui-button ui-widget ui-state-default ui-corner-all btn-small" />
    </div>
</form>

<div id="dialog-form" title="Select Folder">
    <form accept-charset="utf-8">
        <fieldset>
            <label for="selValue">Selected Folder:</label><input type="text" id="selValue" name="selValue" readonly="readonly" size="70" />
            <div id="smallbrowser"></div>
        </fieldset>
    </form>
</div>
<div id="Add_OS_Item" title="Add Online Source">
    <fieldset>
        <?php echo tr('new_online_source_description','Enter details of the required online source. Select the source type, enter URL of the source and pick type of media the source provides.')?>
        <br>
        <br>
        <form accept-charset="utf-8">
            <table>
            <tr>
                <td><?php echo tr('new_online_source_enabled','Enabled:')?></td>
                <td><input type="checkbox" id="newEnabled" name="newEnabled" /></td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_type','Source type:')?></td>
                <td>
                    <select id="newOnlineFeedType" name="newOnlineFeedType">
                        <option value="FEED" SELECTED>Online RSS/Atom feed</option>
                        <option value="LIVE_STREAM">Live Stream</option>
                        <option value="WEB_RESOURCE">Other Web Resources</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_url','Source URL:')?></td>
                <td><input type="text" id="newSourceURL" name="newSourceURL" size="60" /></td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_name','Display Name:')?></td>
                <td><input type="text" id="newName" name="newName" size="60" /></td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_media_type','Media Type:')?></td>
                <td><input type="radio" id="newMediaType" name="newMediaType" value="VIDEO" /> Video
                    <input type="radio" id="newMediaType" name="newMediaType" value="AUDIO" /> Audio
                    <input type="radio" id="newMediaType" name="newMediaType" value="IMAGE" /> Image
                </td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_thumbnail_url','Thumbnail URL:')?></td>
                <td><input type="text" id="newThumbnailURL" name="newThumbnailURL" size="60" /></td>
            </tr>
        </table>
        </form>
    </fieldset>
</div>
<div id="Edit_OS_Item" title="Edit Online Source">
    <fieldset>
        <?php echo tr('new_online_source_description','Enter details of the required online source. Select the source type, enter URL of the source and pick type of media the source provides.')?>
        <br>
        <br>
        <form accept-charset="utf-8">
            <input type="hidden" id="osID" name="osID" />
            <table>
            <tr>
                <td><?php echo tr('new_online_source_type','Source type:')?></td>
                <td>
                    <select id="editOnlineFeedType" name="editOnlineFeedType">
                        <option value="FEED" SELECTED>Online RSS/Atom feed</option>
                        <option value="LIVE_STREAM">Live Stream</option>
                        <option value="WEB_RESOURCE">Other Web Resources</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_url','Source URL:')?></td>
                <td><input type="text" id="editSourceURL" name="editSourceURL" size="60" /></td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_name','Display Name:')?></td>
                <td><input type="text" id="editName" name="editName" size="60" /></td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_media_type','Media Type:')?></td>
                <td><input type="radio" id="editMediaType" name="editMediaType" value="VIDEO" /> Video
                    <input type="radio" id="editMediaType" name="editMediaType" value="AUDIO" /> Audio
                    <input type="radio" id="editMediaType" name="editMediaType" value="IMAGE" /> Image
                </td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_thumbnail_url','Thumbnail URL:')?></td>
                <td><input type="text" id="editThumbnailURL" name="editThumbnailURL" size="60" /></td>
            </tr>
        </table>
        </form>
    </fieldset>
</div>
<div id="Add_Serviidb_Item" title="Add Online Source from ServiiDB">
<div id="testtest"></div>
<table id="t1" width="100%" class="display noblink">
<thead>
    <tr>
        <th>Name</th>
        <th>Region</th>
        <th>URL</th>
        <th>MediaType</th>
        <th>ResourceType</th>
        <th>plugin</th>
        <th>language</th>
        <th>nid</th>
        <th>resolution</th>
        <th>quality</th>
        <th>reliability</th>
        <th>installCount</th>
    </tr>
</thead>
<tbody>
</tbody>
</table>
        </form>
    </fieldset>
</div>
<div id="dialog-remove-library" style="display: none;" title="Remove selected Folder?">
    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>This will remove the selected folder. Are you sure?</p>
</div>

