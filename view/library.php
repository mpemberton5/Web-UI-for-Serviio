<form method="post" action="" name="library">
    <input type="hidden" name="tab" value="library">
    <br>
    <fieldset>
        <legend align="left">&nbsp; <a href="#" onclick="return switchLibSection('sharedfolders')"><span id="sharedfolders" style="font-weight:bold;"><?php echo tr('tab_folders_repositories_panel','Shared folders')?></span></a> |
        <a href="#" onclick="return switchLibSection('onlinesources')"><span id="onlinesources" ><?php echo tr('tab_online_sources_repositories_panel','Online Sources')?></span></a> &nbsp;</legend>
        <div id="sharedfoldersHolder" style="display:block">

            <?php echo tr('tab_folders_description','Select folders that you want to monitor for media files. Also select type of media files to be shared for each folder. The library can be automatically monitored for new additions and updates to currently shared files.')?><br>
            <br>
            <table>
                <tr valign="top">
                    <td>
                        <table width="100%" id="libraryTableFolders">
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
                    </td>
                    <td width="100">
                        <input type="button" name="addlocal" value="<?php echo tr('tab_folders_button_add_local','Add local...')?>" onclick="localPath='';return GB_showCenter('Add local path', '../../afb/index.php',500,500,addLibLocalPath);">
                        <br>
                        <input type="button" name="addpath" value="<?php echo tr('tab_folders_button_add_remote','Add path...')?>" onclick="addLibRow('libraryTableFolders',null)">
                        <br>
                        <input type="button" name="remove" value="<?php echo tr('button_remove','Remove')?>" onclick="if(confirm('Are you sure you want to remove selected folders')) { deleteLibRow('libraryTableFolders'); }">
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
                    <td>
                        <table width="100%" id="libraryTableOnlineSources">
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
                    </td>
                    <td width="100">
                        <input type="button" name="add_os" value="<?php echo tr('button_add','Add')?>" onclick="onlineFeedType='';sourceURL='';mediaType='';thumbnailURL='';posted='';displayName='';return GB_showCenter('Add online source', '../../nos/new.php',300,550,addLibOnlineSource);">
                        <br>
                        <input type="button" name="remove_os" value="<?php echo tr('button_remove','Remove')?>" onclick="if(confirm('Are you sure you want to remove selected online source?')) { deleteLibRow('libraryTableOnlineSources'); }">
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
    </fieldset>
    <div align="right">
        <input type="submit" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')">
        <input type="submit" name="save" value="<?php echo tr('button_save','Save')?>" />
    </div>
</form>
