<SCRIPT type="text/javascript" language="javascript" src="js/Math.uuid.js"></SCRIPT>
<SCRIPT type="text/javascript" language="javascript">
<!--
function addRow(tableID,ipAddress, name) {

    if (ipAddress==null || ipAddress=='') {
        ipAddress = prompt('Please enter renderer IP address');
        if (ipAddress==null || ipAddress=='') {
            alert('Invalid IP address');
            return;
        }
    }

    if (name==null || name=='') {
        name = prompt('Please enter renderer name');
        if (name==null || name=='') {
            alert('Invalid name');
            return;
        }
    }
    var id = Math.uuid();

    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    row.align = 'left';

    var cell1 = row.insertCell(0);
		cell1.align = 'left';
    var element1 = document.createElement("input");
    element1.type = "hidden";
    element1.name = "renderer_"+id;
    element1.value = id;
    cell1.appendChild(element1);
    var element2 = document.createElement("input");
    element2.type = "checkbox";
    element2.name = "chk";
    element2.value = id;
    cell1.appendChild(element2);
    var element3 = document.createElement("input");
    element3.type = "hidden";
    element3.name = "ipAddress_"+id;
    element3.value = ipAddress;
    cell1.appendChild(element3);
    var element4 = document.createElement("input");
    element4.type = "hidden";
    element4.name = "name_"+id;
    element4.value = name;
    cell1.appendChild(element4);


    var cell2 = row.insertCell(1);
    cell2.innerHTML = "<img src='images/bullet_orange.png' alt='UNKNOWN'>";

    var cell3 = row.insertCell(2);
    var element5 = document.createElement("div");
    element5.innerHTML = ipAddress;
    cell3.appendChild(element5);

    var cell4 = row.insertCell(3);
    var element6 = document.createElement("div");
    element6.innerHTML = name;
    cell4.appendChild(element6);

    var cell5 = row.insertCell(4);
    var element6 = document.createElement("select");
    element6.name = "profile_"+id;
    var key;
    for (key in profiles) {
        element6.options[element6.options.length] = new Option(profiles[key],key);
    }
    element6.value = 1;
    cell5.appendChild(element6);
}

function deleteRow(tableID) {
    try {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    var deleted = false;
    
    for(var i=1; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[1];
        if(null != chkbox && true == chkbox.checked) {
            table.deleteRow(i);
            rowCount--;
            i--;
            deleted = true;
        }

    }
    if (deleted) {
        // OK
    } else {
        alert('Please select renderers with the Rem. column');
    }
    }catch(e) {
        alert(e);
    }
}

// -->
</SCRIPT>
<form method="post" action="">
<input type="hidden" name="tab" value="status">

<br>
<ul id="serverstatustab" class="shadetabs">
<li><a href="#" rel="svrstat1" class="selected"><?php echo tr('tab_status_server_status','Server Status')?></a></li>
</ul>
<div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
    <div id="svrstat1" class="tabcontent">
        <?php echo tr('tab_status_description','Below is the status of the UPnP/DLNA server. Feel free to start/stop the server. The actual Serviio process is not affected.')?><br>
        <br>
        <?php echo tr('tab_status_server_status','Server Status')?>: <?php echo $statusText?><br>
        <br>
        <input type="submit" name="start" value="<?php echo tr('tab_status_button_start_server','Start server')?>" <?php echo $startDisabled?> onclick="return confirm('Are you sure you want to start the server');">
        <input type="submit" name="stop" value="<?php echo tr('tab_status_button_stop_server','Stop server')?>" <?php echo $stopDisabled?> onclick="return confirm('Are you sure you want to stop the server');">
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
<input type="button" name="addRenderer" value="  Add  " onclick="addRow('rendererTable',null,null)">
<br>                                                                                                                                                                     
<input type="button" name="remove" value="Remove" onclick="if(confirm('Are you sure you want to remove selected renderers')) { deleteRow('rendererTable'); }">     
    </td>
</tr>
</table>
<input type="hidden" name="lastId" value="<?php echo $mid?>">
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
<input type="submit" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')">
<input type="submit" name="save" value="<?php echo tr('button_save','Save')?>" />
</div>
</form>
