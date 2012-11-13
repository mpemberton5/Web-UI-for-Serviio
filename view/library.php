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
            <table>
                <tr valign="top">
                    <td>
                        <table width="100%" id="libraryTableFolders" name="libraryTableFolders">
                            <thead align="center">
                                <th width="20">&nbsp;</th>
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
                                    <input type="checkbox" name="chk" value="<?php echo $id?>">
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
                    <td width="100">
                        <input type="button" id="addFolder" name="addFolder" value="<?php echo tr('tab_folders_button_add_local','Add local...')?>">
                        <input type="button" name="addpath" value="<?php echo tr('tab_folders_button_add_remote','Add path...')?>" onclick="addLibRow('libraryTableFolders',null)">
                        <input type="button" name="remove" value="<?php echo tr('button_remove','Remove Selected')?>" onclick="if(confirm('Are you sure you want to remove selected folders')) { deleteLibRow('libraryTableFolders'); }">
                    </td>
                </tr>
            </table>
            <br>
            <input type="checkbox" name="searchupdates" value="1"<?php echo $serviio->searchForUpdates=="true"?" checked":""?>> <?php echo tr('tab_folders_search_for_files_updates','Search for updates of currently shared files')?>
            <br>
            <input type="checkbox" name="addhidden" value="1"<?php echo $serviio->searchHiddenFiles=="true"?" checked":""?>> <?php echo tr('tab_folders_include_hidden','Include hidden files')?>
        </div>

        <div id="libtab2" class="tabcontent">
            <?php echo tr('tab_online_sources_description','Define online source that you would like to access. Online sources are constantly monitored for updates and cached for a period of time. It might take a moment for new sources to appear on your device.')?><br>
            <br>
            <table>
                <tr valign="top">
                    <td>
                        <table width="100%" id="libraryTableOnlineSources" name="libraryTableOnlineSources">
                            <thead align="center">
                                <th width="20">&nbsp;</th>
                                <th align="center" width="100"><?php echo tr('tab_online_sources_repository_table_refresh','Refresh')?></th>
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
                                    <input type="checkbox" name="chk" value="<?php echo $id?>">
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
                    <td width="100">
                        <input type="button" id="add_os" name="add_os" value="<?php echo tr('button_add','Add')?>" />
                        <br>
                        <input type="button" id="add_serviidb" name="add_serviidb" value="<?php echo tr('button_add_Serviidb','Add from ServiiDB')?>" />
                        <br>
                        <input type="button" id="edit_os" name="edit_os" value="<?php echo tr('button_edit','Edit')?>" />
                        <br>
                        <input type="button" name="remove_os" value="<?php echo tr('button_remove','Remove')?>" onclick="if(confirm('Are you sure you want to remove selected online source?')) { deleteLibRow('libraryTableOnlineSources'); }">
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

    <ul id="librarystatustabs" class="shadetabs">
    <li><a href="#" rel="libstab1" class="selected">Library Status</a></li>
    </ul>
    <div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
        <div id="libstab1" class="tabcontent">
            <input type="checkbox" name="autoupdate" value="1"<?php echo $serviio->automaticLibraryUpdate=="true"?" checked":""?>> <?php echo tr('tab_folders_automatic_update','Keep library automatically updated')?>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            Refresh interval (minutes): <input type="text" name="minutes" value="<?php echo $serviio->automaticLibraryUpdateInterval ?>" maxlength="3" size="3">
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="submit" id="refresh" name="refresh" value="<?php echo tr('tab_folders_button_refresh_library','Force refresh')?>" />
            <span id="forceRefreshMsg" class="forceRefreshMsg"></span>
        </div>
    </div>

    <div align="right">
        <span id="savingMsg" class="savingMsg"></span>
        <input type="submit" id="reset" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')">
        <input type="submit" id="submit" name="save" value="<?php echo tr('button_save','Save')?>" />
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
<table id="t1" width="100%" class="display noblink">
<thead>
    <tr>
        <th>Index</th>
        <th>Numeric</th>
        <th>Text</th>
        <th>Currency</th>
        <th>Date</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>0</td>
        <td>469</td>
        <td>Bill</td>
        <td>$74.04</td>
        <td>2015-06-09</td>
    </tr>
    <tr class="alternate">
        <td>1</td>
        <td>726.9</td>
        <td>Joe</td>
        <td>$40.34</td>
        <td>2013-09-05</td>
    </tr>
    <tr>
        <td>2</td>
        <td>2.1</td>
        <td>Bob</td>
        <td>$54.14</td>
        <td>2014-07-14</td>
    </tr>
    <tr class="alternate">
        <td>3</td>
        <td>99.5</td>
        <td>Matt</td>
        <td>$43.04</td>
        <td>2013-07-07</td>
    </tr>
    <tr>
        <td>4</td>
        <td>371.4</td>
        <td>Bill</td>
        <td>$35.14</td>
        <td>2013-11-10</td>
    </tr>
    <tr class="alternate">
        <td>5</td>
        <td>227.8</td>
        <td>Joe</td>
        <td>$62.44</td>
        <td>2013-06-27</td>
    </tr>
    <tr>
        <td>6</td>
        <td>490.1</td>
        <td>Bob</td>
        <td>$58.24</td>
        <td>2015-06-14</td>
    </tr>
    <tr class="alternate">
        <td>7</td>
        <td>206.9</td>
        <td>Matt</td>
        <td>$13.64</td>
        <td>2014-01-02</td>
    </tr>
    <tr>
        <td>8</td>
        <td>575.6</td>
        <td>Bill</td>
        <td>$57.14</td>
        <td>2015-02-10</td>
    </tr>
    <tr class="alternate">
        <td>9</td>
        <td>383.2</td>
        <td>Joe</td>
        <td>$5.53</td>
        <td>2013-12-01</td>
    </tr>
    <tr>
        <td>10</td>
        <td>876.5</td>
        <td>Bob</td>
        <td>$52.44</td>
        <td>2013-02-03</td>
    </tr>
    <tr class="alternate">
        <td>11</td>
        <td>737.8</td>
        <td>Matt</td>
        <td>$25.14</td>
        <td>2014-05-15</td>
    </tr>
    <tr>
        <td>12</td>
        <td>44.4</td>
        <td>Bill</td>
        <td>$25.34</td>
        <td>2012-11-29</td>
    </tr>
    <tr class="alternate">
        <td>13</td>
        <td>620.3</td>
        <td>Joe</td>
        <td>$35.34</td>
        <td>2014-04-11</td>
    </tr>
    <tr>
        <td>14</td>
        <td>875</td>
        <td>Bob</td>
        <td>$72.44</td>
        <td>2015-05-22</td>
    </tr>
    <tr class="alternate">
        <td>15</td>
        <td>238.7</td>
        <td>Matt</td>
        <td>$95.24</td>
        <td>2014-03-13</td>
    </tr>
    <tr>
        <td>16</td>
        <td>484.2</td>
        <td>Bill</td>
        <td>$44.24</td>
        <td>2012-11-15</td>
    </tr>
    <tr class="alternate">
        <td>17</td>
        <td>349.5</td>
        <td>Joe</td>
        <td>$64.84</td>
        <td>2013-04-21</td>
    </tr>
    <tr>
        <td>18</td>
        <td>758.8</td>
        <td>Bob</td>
        <td>$22.44</td>
        <td>2015-02-12</td>
    </tr>
    <tr class="alternate">
        <td>19</td>
        <td>517</td>
        <td>Matt</td>
        <td>$60.74</td>
        <td>2015-04-16</td>
    </tr>
    <tr>
        <td>20</td>
        <td>898.2</td>
        <td>Bill</td>
        <td>$48.44</td>
        <td>2013-10-13</td>
    </tr>
    <tr class="alternate">
        <td>21</td>
        <td>19.4</td>
        <td>Joe</td>
        <td>$22.14</td>
        <td>2014-07-30</td>
    </tr>
    <tr>
        <td>22</td>
        <td>543.4</td>
        <td>Bob</td>
        <td>$26.64</td>
        <td>2015-05-19</td>
    </tr>
    <tr class="alternate">
        <td>23</td>
        <td>608.2</td>
        <td>Matt</td>
        <td>$88.64</td>
        <td>2013-04-30</td>
    </tr>
    <tr>
        <td>24</td>
        <td>103.1</td>
        <td>Bill</td>
        <td>$76.14</td>
        <td>2015-08-16</td>
    </tr>
    <tr class="alternate">
        <td>25</td>
        <td>948.7</td>
        <td>Joe</td>
        <td>$100.05</td>
        <td>2015-06-20</td>
    </tr>
    <tr>
        <td>26</td>
        <td>418.5</td>
        <td>Bob</td>
        <td>$48.44</td>
        <td>2013-09-12</td>
    </tr>
    <tr class="alternate">
        <td>27</td>
        <td>470.7</td>
        <td>Matt</td>
        <td>$83.34</td>
        <td>2015-10-03</td>
    </tr>
    <tr>
        <td>28</td>
        <td>659.1</td>
        <td>Bill</td>
        <td>$59.24</td>
        <td>2013-04-18</td>
    </tr>
    <tr class="alternate">
        <td>29</td>
        <td>418.8</td>
        <td>Joe</td>
        <td>$10.94</td>
        <td>2015-03-21</td>
    </tr>
    <tr>
        <td>30</td>
        <td>233.6</td>
        <td>Bob</td>
        <td>$0.73</td>
        <td>2013-08-01</td>
    </tr>
    <tr class="alternate">
        <td>31</td>
        <td>572.5</td>
        <td>Matt</td>
        <td>$2.63</td>
        <td>2014-04-14</td>
    </tr>
    <tr>
        <td>32</td>
        <td>162.4</td>
        <td>Bill</td>
        <td>$57.04</td>
        <td>2015-02-16</td>
    </tr>
    <tr class="alternate">
        <td>33</td>
        <td>5.4</td>
        <td>Joe</td>
        <td>$17.84</td>
        <td>2014-10-07</td>
    </tr>
    <tr>
        <td>34</td>
        <td>200.9</td>
        <td>Bob</td>
        <td>$28.14</td>
        <td>2014-01-03</td>
    </tr>
    <tr class="alternate">
        <td>35</td>
        <td>120.3</td>
        <td>Matt</td>
        <td>$23.04</td>
        <td>2014-01-03</td>
    </tr>
    <tr>
        <td>36</td>
        <td>991.3</td>
        <td>Bill</td>
        <td>$64.84</td>
        <td>2015-07-17</td>
    </tr>
    <tr class="alternate">
        <td>37</td>
        <td>303.9</td>
        <td>Joe</td>
        <td>$11.94</td>
        <td>2015-01-04</td>
    </tr>
    <tr>
        <td>38</td>
        <td>265</td>
        <td>Bob</td>
        <td>$77.84</td>
        <td>2013-09-19</td>
    </tr>
    <tr class="alternate">
        <td>39</td>
        <td>450.2</td>
        <td>Matt</td>
        <td>$19.64</td>
        <td>2014-01-23</td>
    </tr>
    <tr>
        <td>40</td>
        <td>242.5</td>
        <td>Bill</td>
        <td>$43.04</td>
        <td>2014-02-01</td>
    </tr>
    <tr class="alternate">
        <td>41</td>
        <td>518.5</td>
        <td>Joe</td>
        <td>$0.23</td>
        <td>2014-03-03</td>
    </tr>
    <tr>
        <td>42</td>
        <td>15.8</td>
        <td>Bob</td>
        <td>$16.54</td>
        <td>2012-10-21</td>
    </tr>
    <tr class="alternate">
        <td>43</td>
        <td>779</td>
        <td>Matt</td>
        <td>$17.04</td>
        <td>2013-05-15</td>
    </tr>
    <tr>
        <td>44</td>
        <td>428.1</td>
        <td>Bill</td>
        <td>$37.14</td>
        <td>2014-04-05</td>
    </tr>
    <tr class="alternate">
        <td>45</td>
        <td>838.2</td>
        <td>Joe</td>
        <td>$49.14</td>
        <td>2014-12-27</td>
    </tr>
    <tr>
        <td>46</td>
        <td>247.9</td>
        <td>Bob</td>
        <td>$48.34</td>
        <td>2013-11-15</td>
    </tr>
    <tr class="alternate">
        <td>47</td>
        <td>141.4</td>
        <td>Matt</td>
        <td>$78.64</td>
        <td>2014-04-01</td>
    </tr>
    <tr>
        <td>48</td>
        <td>868.1</td>
        <td>Bill</td>
        <td>$5.13</td>
        <td>2013-07-18</td>
    </tr>
    <tr class="alternate">
        <td>49</td>
        <td>186.8</td>
        <td>Joe</td>
        <td>$50.14</td>
        <td>2014-03-02</td>
    </tr>
    <tr>
        <td>50</td>
        <td>614.4</td>
        <td>Bob</td>
        <td>$74.44</td>
        <td>2015-07-13</td>
    </tr>
    <tr class="alternate">
        <td>51</td>
        <td>49.1</td>
        <td>Matt</td>
        <td>$26.24</td>
        <td>2015-07-16</td>
    </tr>
    <tr>
        <td>52</td>
        <td>510.3</td>
        <td>Bill</td>
        <td>$27.84</td>
        <td>2012-11-21</td>
    </tr>
    <tr class="alternate">
        <td>53</td>
        <td>541.2</td>
        <td>Joe</td>
        <td>$5.73</td>
        <td>2013-06-06</td>
    </tr>
    <tr>
        <td>54</td>
        <td>750.1</td>
        <td>Bob</td>
        <td>$48.54</td>
        <td>2014-08-10</td>
    </tr>
    <tr class="alternate">
        <td>55</td>
        <td>239.9</td>
        <td>Matt</td>
        <td>$32.34</td>
        <td>2012-12-29</td>
    </tr>
    <tr>
        <td>56</td>
        <td>959.4</td>
        <td>Bill</td>
        <td>$57.14</td>
        <td>2014-07-11</td>
    </tr>
    <tr class="alternate">
        <td>57</td>
        <td>327</td>
        <td>Joe</td>
        <td>$71.24</td>
        <td>2013-11-05</td>
    </tr>
    <tr>
        <td>58</td>
        <td>813.3</td>
        <td>Bob</td>
        <td>$58.14</td>
        <td>2014-01-04</td>
    </tr>
    <tr class="alternate">
        <td>59</td>
        <td>77.4</td>
        <td>Matt</td>
        <td>$76.74</td>
        <td>2015-08-07</td>
    </tr>
    <tr>
        <td>60</td>
        <td>538</td>
        <td>Bill</td>
        <td>$38.24</td>
        <td>2014-10-15</td>
    </tr>
    <tr class="alternate">
        <td>61</td>
        <td>428.5</td>
        <td>Joe</td>
        <td>$43.14</td>
        <td>2015-08-14</td>
    </tr>
    <tr>
        <td>62</td>
        <td>321.5</td>
        <td>Bob</td>
        <td>$94.14</td>
        <td>2013-05-01</td>
    </tr>
    <tr class="alternate">
        <td>63</td>
        <td>379.3</td>
        <td>Matt</td>
        <td>$48.24</td>
        <td>2013-07-06</td>
    </tr>
    <tr>
        <td>64</td>
        <td>607.3</td>
        <td>Bill</td>
        <td>$23.24</td>
        <td>2015-01-18</td>
    </tr>
    <tr class="alternate">
        <td>65</td>
        <td>206.5</td>
        <td>Joe</td>
        <td>$47.24</td>
        <td>2012-11-26</td>
    </tr>
    <tr>
        <td>66</td>
        <td>296.9</td>
        <td>Bob</td>
        <td>$43.14</td>
        <td>2014-09-18</td>
    </tr>
    <tr class="alternate">
        <td>67</td>
        <td>869.8</td>
        <td>Matt</td>
        <td>$75.84</td>
        <td>2013-10-20</td>
    </tr>
    <tr>
        <td>68</td>
        <td>229.2</td>
        <td>Bill</td>
        <td>$57.24</td>
        <td>2015-08-23</td>
    </tr>
    <tr class="alternate">
        <td>69</td>
        <td>639.8</td>
        <td>Joe</td>
        <td>$64.94</td>
        <td>2014-11-27</td>
    </tr>
    <tr>
        <td>70</td>
        <td>552</td>
        <td>Bob</td>
        <td>$18.74</td>
        <td>2012-12-11</td>
    </tr>
    <tr class="alternate">
        <td>71</td>
        <td>208.1</td>
        <td>Matt</td>
        <td>$61.54</td>
        <td>2014-04-24</td>
    </tr>
    <tr>
        <td>72</td>
        <td>126.5</td>
        <td>Bill</td>
        <td>$93.74</td>
        <td>2014-02-15</td>
    </tr>
    <tr class="alternate">
        <td>73</td>
        <td>323</td>
        <td>Joe</td>
        <td>$31.64</td>
        <td>2015-08-27</td>
    </tr>
    <tr>
        <td>74</td>
        <td>576.6</td>
        <td>Bob</td>
        <td>$92.34</td>
        <td>2013-03-21</td>
    </tr>
    <tr class="alternate">
        <td>75</td>
        <td>315.3</td>
        <td>Matt</td>
        <td>$13.04</td>
        <td>2014-09-18</td>
    </tr>
    <tr>
        <td>76</td>
        <td>377.3</td>
        <td>Bill</td>
        <td>$42.64</td>
        <td>2012-11-29</td>
    </tr>
    <tr class="alternate">
        <td>77</td>
        <td>10.4</td>
        <td>Joe</td>
        <td>$29.64</td>
        <td>2015-04-26</td>
    </tr>
    <tr>
        <td>78</td>
        <td>356.1</td>
        <td>Bob</td>
        <td>$52.54</td>
        <td>2013-12-16</td>
    </tr>
    <tr class="alternate">
        <td>79</td>
        <td>282.3</td>
        <td>Matt</td>
        <td>$16.54</td>
        <td>2012-11-05</td>
    </tr>
    <tr>
        <td>80</td>
        <td>975.8</td>
        <td>Bill</td>
        <td>$71.74</td>
        <td>2013-06-09</td>
    </tr>
    <tr class="alternate">
        <td>81</td>
        <td>51</td>
        <td>Joe</td>
        <td>$92.54</td>
        <td>2015-05-22</td>
    </tr>
    <tr>
        <td>82</td>
        <td>557</td>
        <td>Bob</td>
        <td>$5.23</td>
        <td>2015-03-10</td>
    </tr>
    <tr class="alternate">
        <td>83</td>
        <td>4</td>
        <td>Matt</td>
        <td>$37.54</td>
        <td>2013-01-07</td>
    </tr>
    <tr>
        <td>84</td>
        <td>933.1</td>
        <td>Bill</td>
        <td>$95.14</td>
        <td>2012-10-10</td>
    </tr>
    <tr class="alternate">
        <td>85</td>
        <td>94.5</td>
        <td>Joe</td>
        <td>$26.64</td>
        <td>2013-03-09</td>
    </tr>
    <tr>
        <td>86</td>
        <td>727.8</td>
        <td>Bob</td>
        <td>$64.34</td>
        <td>2014-07-16</td>
    </tr>
    <tr class="alternate">
        <td>87</td>
        <td>792.6</td>
        <td>Matt</td>
        <td>$65.44</td>
        <td>2015-06-24</td>
    </tr>
    <tr>
        <td>88</td>
        <td>615.6</td>
        <td>Bill</td>
        <td>$1.03</td>
        <td>2013-12-22</td>
    </tr>
    <tr class="alternate">
        <td>89</td>
        <td>10.2</td>
        <td>Joe</td>
        <td>$29.24</td>
        <td>2014-07-01</td>
    </tr>
    <tr>
        <td>90</td>
        <td>53.7</td>
        <td>Bob</td>
        <td>$26.84</td>
        <td>2013-08-07</td>
    </tr>
    <tr class="alternate">
        <td>91</td>
        <td>284.1</td>
        <td>Matt</td>
        <td>$31.94</td>
        <td>2013-05-13</td>
    </tr>
    <tr>
        <td>92</td>
        <td>129.6</td>
        <td>Bill</td>
        <td>$87.64</td>
        <td>2013-07-11</td>
    </tr>
    <tr class="alternate">
        <td>93</td>
        <td>911.9</td>
        <td>Joe</td>
        <td>$88.04</td>
        <td>2014-09-18</td>
    </tr>
    <tr>
        <td>94</td>
        <td>10.2</td>
        <td>Bob</td>
        <td>$81.34</td>
        <td>2014-07-23</td>
    </tr>
    <tr class="alternate">
        <td>95</td>
        <td>31.7</td>
        <td>Matt</td>
        <td>$90.74</td>
        <td>2015-05-27</td>
    </tr>
    <tr>
        <td>96</td>
        <td>182.8</td>
        <td>Bill</td>
        <td>$63.54</td>
        <td>2014-04-10</td>
    </tr>
    <tr class="alternate">
        <td>97</td>
        <td>760.5</td>
        <td>Joe</td>
        <td>$42.84</td>
        <td>2013-03-05</td>
    </tr>
    <tr>
        <td>98</td>
        <td>634.4</td>
        <td>Bob</td>
        <td>$4.33</td>
        <td>2013-03-17</td>
    </tr>
    <tr class="alternate">
        <td>99</td>
        <td>33.7</td>
        <td>Matt</td>
        <td>$5.33</td>
        <td>2014-02-18</td>
    </tr>
    <tr>
        <td>100</td>
        <td>598.1</td>
        <td>Bill</td>
        <td>$10.74</td>
        <td>2014-12-25</td>
    </tr>
    <tr class="alternate">
        <td>101</td>
        <td>879.7</td>
        <td>Joe</td>
        <td>$39.14</td>
        <td>2012-10-28</td>
    </tr>
    <tr>
        <td>102</td>
        <td>86.4</td>
        <td>Bob</td>
        <td>$52.14</td>
        <td>2015-08-07</td>
    </tr>
    <tr class="alternate">
        <td>103</td>
        <td>344.7</td>
        <td>Matt</td>
        <td>$43.34</td>
        <td>2015-03-21</td>
    </tr>
    <tr>
        <td>104</td>
        <td>977.4</td>
        <td>Bill</td>
        <td>$44.34</td>
        <td>2014-08-17</td>
    </tr>
</tbody>
</table>
        </form>
    </fieldset>
</div>
