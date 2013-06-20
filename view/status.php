<form id="statusform" method="post" action="" accept-charset="utf-8">
	<input type="hidden" name="tab" value="status">
	<input type="hidden" id="process" name="process" value="">

<br>
<ul id="serverstatustab" class="shadetabs">
    <li><a href="#" rel="svrstat1" class="selected"><?php echo tr('tab_status_server_status','Server Status')?></a></li>
</ul>
<div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
    <div id="svrstat1" class="tabcontent">
        <?php echo tr('tab_status_description','Start/Stop the UPnP/DLNA server. The actual Serviio process is not affected.')?><br>
        <br>
        <input type="submit" name="start" id="start" value="<?php echo tr('button_start_server','Start server')?>" <?php echo $startDisabled?> onclick="return confirm('<?php echo tr('status_message_start_server','Are you sure you want to start the server?')?>');" class="ui-button ui-widget ui-state-default ui-corner-all btn-small" />
        <input type="submit" name="stop" id="stop" value="<?php echo tr('button_stop_server','Stop server')?>" <?php echo $stopDisabled?> onclick="return confirm('<?php echo tr('status_message_stop_server','Are you sure you want to stop the server?')?>');" class="ui-button ui-widget ui-state-default ui-corner-all btn-small" />
    </div>
</div>

<ul id="rendererprofiletab" class="shadetabs">
    <li><a href="#" rel="rendprof1" class="selected"><?php echo tr('tab_status_renderer_profile','Renderer Profile')?></a></li>
</ul>
<div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
    <div id="rendprof1" class="tabcontent">
<?php echo tr('tab_status_profile_overview','Select an appropriate rendering device profile. It will affect how Serviio communicates with the device. Particular devices may require a particular communication protocol.')?><br>
<br>
<table>
<tr valign="top">
    <td><table id="rendererTable">
    <thead>
        <th width="20">&nbsp;</th>
        <th width="20">&nbsp;</th>
        <th width="100"><?php echo tr('tab_status_renderer_table_ipaddress','IP Address')?></th>
        <th width="200"><?php echo tr('tab_status_renderer_table_device_name','Device Name')?></th>
        <th width="50"><?php echo tr('tab_status_renderer_table_enabled','Enabled')?></th>
        <th width="50"><?php echo tr('tab_status_renderer_table_access','Access')?></th>
        <th><?php echo tr('tab_status_renderer_table_profile','Profile')?></th>
    </thead>
    <?php $ctr=1; foreach ($statusResponse["renderers"] as $id=>$renderer) { ?>
    <tr <?php echo $ctr%2?'':'class="odd"'?>>
        <td>
            <input type="checkbox" name="chk" value="<?php echo $id?>">
            <input type="hidden" id="enabled_<?php echo $id?>" name="enabled_<?php echo $id?>" value="<?php echo $renderer[4]?>">
            <input type="hidden" name="renderer_<?php echo $id?>" value="<?php echo $id?>">
            <input type="hidden" name="name_<?php echo $id?>" value="<?php echo $renderer[1]?>">
            <input type="hidden" name="ipAddress_<?php echo $id?>" value="<?php echo $renderer[0]?>">
        </td>
        <td><?php echo status_icon($renderer[3])?></td>
        <td><?php echo $renderer[0]?></td>
        <td><?php echo $renderer[1]?></td>

        <td>
            <div class="os_switch" id="enabled_<?php echo $id?>" style="cursor: pointer; ">
                <div class="iphone_switch_container" style="height:27px; width:94px; position: relative; overflow: hidden">
                    <img class="iphone_switch" style="height: 27px; width: 94px; background-image: url(images/iphone_switch_16.png); background-position: 0px 50%; " src="images/iphone_switch_container_off.png">
                </div>
            </div>
        </td>

        <td><select name="access_<?php echo $id?>" <?php echo ($serviio->licenseEdition=="PRO"?'':'disabled="disabled" title="Enabled with PRO License"')?>>
		<?php foreach ($accesses as $key=>$val) { ?>
			<option value="<?php echo $key?>"<?php echo $key==$renderer[5]?" selected":""?>><?php echo $val?></option>
		<?php } ?>
        </select></td>
        <td><select name="profile_<?php echo $id?>">
        <?php foreach ($profiles as $key=>$val) { ?>
            <option value="<?php echo $key?>"<?php echo $key==$renderer[2]?" selected":""?>><?php echo $val?></option>
        <?php } ?>
        </select></td>
    </tr>
    <?php $ctr+=1; ?>
    <?php } ?>
    </table><td>
    <td width="100">
<input type="submit" name="refresh" value="<?php echo tr('button_refresh','Refresh')?>" class="ui-button ui-widget ui-state-default ui-corner-all btn-small" />
<br>
<input type="button" name="remove" value="<?php echo tr('button_remove','Remove')?>" onclick="if(confirm('<?php echo tr('status_message_remove_renderers','Are you sure you want to remove selected renderers?')?>')) { deleteProfileRow('rendererTable'); }" class="ui-button ui-widget ui-state-default ui-corner-all btn-small" />
    </td>
</tr>
</table>
<script type="text/javascript">
<!--
var profiles = new Array();
<?php foreach ($profiles as $key=>$val) { ?>
profiles['<?php echo $key?>'] = '<?php echo $val?>';
<?php } ?>
// -->
</script>
    </div>
</div>

<ul id="networksettingtab" class="shadetabs">
<li><a href="#" rel="netset1" class="selected"><?php echo tr('tab_status_network_settings','Network Settings')?></a></li>
</ul>
<div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
    <div id="netset1" class="tabcontent">
		<?php echo tr('tab_status_bound_ip_address','Bound IP address')?>:&nbsp;
		<!--<input type="text" name="ip" value="<?php echo $statusResponse["ip"]?>" maxlength="16">-->
		<select name="bound_nic">
			<?php foreach ($interfaces as $key=>$val) { ?>
			<option value="<?php echo $key?>"<?php echo $key==$statusResponse["boundNICName"]?" selected":""?>><?php echo $val?></option>
			<?php } ?>
		</select>
    </div>
</div>




<div align="right">
<span id="savingMsg" class="savingMsg"></span>
<input type="submit" id="reset" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('<?php echo tr('status_message_reset','Are you sure you want to reset changes?')?>')" class="ui-button ui-widget ui-state-default ui-corner-all btn-small" />
<input type="submit" id="submit" name="save" value="<?php echo tr('button_save','Save')?>" class="ui-button ui-widget ui-state-default ui-corner-all btn-small" />
</div>
</form>
