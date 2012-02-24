<form id="statusform" method="post" action="">
<input type="hidden" name="tab" value="status">

<br>
<ul id="serverstatustab" class="shadetabs">
<li><a href="#" rel="svrstat1" class="selected"><?php echo tr('tab_status_server_status','Server Status')?></a></li>
</ul>
<div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
    <div id="svrstat1" class="tabcontent">
        <?php echo tr('tab_status_description1','Start/Stop the UPnP/DLNA server. The actual Serviio process is not affected.')?><br>
        <br>
        <input type="submit" name="start" id="start" value="<?php echo tr('tab_status_button_start_server','Start server')?>" <?php echo $startDisabled?> onclick="return confirm('Are you sure you want to start the server');">
        <input type="submit" name="stop" id="stop" value="<?php echo tr('tab_status_button_stop_server','Stop server')?>" <?php echo $stopDisabled?> onclick="return confirm('Are you sure you want to stop the server');">
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
    <!--
		<td width="20" align="center"><img src="images/bullet_red.png" alt="<?php echo tr('button_remove','Remove')?>"></td>
        -->
	    <th width="20">&nbsp;</th>
	    <th width="20">&nbsp;</th>
	    <th width="100"><?php echo tr('tab_status_renderer_table_ipaddress','IP Address')?></th>
	    <th width="200"><?php echo tr('tab_status_renderer_table_device_name','Device Name')?></th>
	    <th><?php echo tr('tab_status_renderer_table_profile','Profile')?></th>
	</thead>
<?php foreach ($statusResponse["renderers"] as $id=>$renderer) { ?>
	<tr>
		<td><input type="hidden" name="renderer_<?php echo $id?>" value="<?php echo $id?>"><input type="checkbox" name="chk" value="<?php echo $id?>"><input type="hidden" name="name_<?php echo $id?>" value="<?php echo $renderer[1]?>"><input type="hidden" name="ipAddress_<?php echo $id?>" value="<?php echo $renderer[0]?>"></td>
	    <td><?php echo status_icon($renderer[3])?></td>	
	    <td><?php echo $renderer[0]?></td>	
	    <td><?php echo $renderer[1]?></td>	
	    <td><select name="profile_<?php echo $id?>">
<?php foreach ($profiles as $key=>$val) { ?>
<option value="<?php echo $key?>"<?php echo $key==$renderer[2]?" selected":""?>><?php echo $val?></option>
<?php } ?>
</select></td>	
	</tr>
<?php } ?>	
	</table><td>
    <td width="100">
<input type="submit" name="refresh" value="Refresh">  
<br>                                                                                                                                                                     
<input type="button" name="addRenderer" value="  Add  " onclick="addProfileRow('rendererTable',null,null)">
<br>                                                                                                                                                                     
<input type="button" name="remove" value="Remove" onclick="if(confirm('Are you sure you want to remove selected renderers')) { deleteProfileRow('rendererTable'); }">     
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
<?php echo tr('tab_status_bound_ip_address','Bound IP address (leave empty for default):')?> 
<input type="text" name="ip" value="<?php echo $statusResponse["ip"]?>" maxlength="16">
    </div>
</div>


<div align="right">
<span id="savingMsg" class="savingMsg"></span>
<input type="submit" id="reset" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')">
<input type="submit" id="submit" class="button" name="save" value="<?php echo tr('button_save','Save')?>" />
</div>
</form>
