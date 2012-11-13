<?php
set_time_limit(0);
include("config.php");
include("lib/RestRequest.inc.php");
include("lib/serviio.php");

if (isset($_COOKIE["language"]) && array_key_exists($_COOKIE["language"],$languages)) {
    $language = $_COOKIE["language"];
}

// initiate call to service
$serviio = new ServiioService($serviio_host,$serviio_port);

$appInfo = $serviio->getApplication();
$profiles = $serviio->getProfiles();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo tr('window_title','Serviio console')?> <?php echo $appInfo["version"]?></title>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">

<meta name="format-detection" content="telephone=no"/>
<meta name="format-detection" content="address=no"/>
<meta name="apple-mobile-web-app-capable" content="yes">

<link rel="apple-touch-icon" href="images/serviio.png">
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />

<SCRIPT type="text/javascript" src="js/Math.uuid.js"></SCRIPT>

<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery-ui.min.js" type="text/javascript"></script>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.ui.all.css" rel="stylesheet" type="text/css" />

<style>
    .ui-widget, .ui-widget button {
        font-family: Verdana,Arial,sans-serif;
        font-size: 0.8em;
    }
#t1 tr td { padding:10px }
.row-modified {
        background-color: #000 !important;
}
</style>

<script src="js/jquery.iphone-switch.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="css/ajaxtabs.css" />
<script type="text/javascript" src="js/ajaxtabs.js">
/***********************************************
 * * Ajax Tabs Content script v2.2- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
 * * This notice MUST stay intact for legal use
 * * Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
 * ***********************************************/
</script>

<link rel="stylesheet" type="text/css" href="css/tabcontent.css" />
<script type="text/javascript" src="js/tabcontent.js">
/***********************************************
 * * Tab Content script v2.2- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
 * * This notice MUST stay intact for legal use
 * * Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
 * ***********************************************/
</script>

<script src="tree/jquery_folder_tree/jquery.foldertree.js" type="text/javascript"></script>
<link href="tree/jquery_folder_tree/style.css" rel="stylesheet" type="text/css" />

<script src="js/DataTables-1.9.4/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<style type="text/css" title="currentStyle">
    @import "js/DataTables-1.9.4/media/css/demo_page.css";
    @import "js/DataTables-1.9.4/media/css/demo_table.css";
</style>


<SCRIPT type="text/javascript">
/* this is to make all browsers work nicely */
function serializeXmlNode(xmlNode) {
    if (typeof window.XMLSerializer != "undefined") {
        return (new window.XMLSerializer()).serializeToString(xmlNode);
    } else if (typeof xmlNode.xml != "undefined") {
        return xmlNode.xml;
    }
    return "";
}

function parseUrl(url) {
    var cleanURL = url.replace(/&/g, "\n");
    return cleanURL
}

function addLibRow(tableID,path,newid) {

    if (path==null || path=='') {
        path = prompt('Please enter folder path');
        if (path==null || path=='') {
            //alert('Invalid path');
            return;
        }
    }
    var id = newid;

    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    row.align = 'center';

    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "hidden";
    element1.name = "folder_"+id;
    element1.value = "new";
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
    var strLen = path.length;
    cell2.innerHTML = path.substring(0,strLen-1);
    cell2.align = 'left';

    var cell2a = row.insertCell(2);
    var element2a = document.createElement("select");
    element2a.name = "access_"+id;
    var option1 = document.createElement("option");
    option1.value = "1";
    option1.innerHTML = "Full";
    element2a.appendChild(option1);
    var option2 = document.createElement("option");
    option2.value = "2";
    option2.innerHTML = "Limited";                           
    element2a.appendChild(option2);
    element2a.selectedItem = "1";
    cell2a.appendChild(element2a);

    var cell3 = row.insertCell(3);
    var element4 = document.createElement("input");
    element4.type = "checkbox";
    element4.name = "VIDEO_"+id;
    element4.value = 1;
    cell3.appendChild(element4);

    var cell4 = row.insertCell(4);
    var element5 = document.createElement("input");
    element5.type = "checkbox";
    element5.name = "AUDIO_"+id;
    element5.value = 1;
    cell4.appendChild(element5);

    var cell5 = row.insertCell(5);
    var element6 = document.createElement("input");
    element6.type = "checkbox";
    element6.name = "IMAGE_"+id;
    element6.value = 1;
    cell5.appendChild(element6);

    var cell6 = row.insertCell(6);
    var element7 = document.createElement("input");
    element7.type = "checkbox";
    element7.name = "ONLINE_"+id;
    element7.value = 1;
    element7.disabled = true;
    cell6.appendChild(element7);

    var cell7 = row.insertCell(7);
    var element8 = document.createElement("input");
    element8.type = "checkbox";
    element8.name = "SCAN_"+id;
    element8.value = 1;
    element8.checked = true;
    cell7.appendChild(element8);

    maxFId = id;
}

function deleteLibRow(tableID) {
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
</SCRIPT>
<SCRIPT type="text/javascript">
<!--
function addProfileRow(tableID,ipAddress, name) {
    // load profiles
    var profiles = new Array();
    <?php foreach ($profiles as $key=>$val) { ?>
        profiles['<?php echo $key?>'] = '<?php echo $val?>';
    <?php } ?>

    if (ipAddress==null || ipAddress=='') {
        ipAddress = prompt('Please enter renderer IP address');
        if (ipAddress==null || ipAddress=='') {
            //alert('Invalid IP address');
            return;
        }
    }

    if (name==null || name=='') {
        name = prompt('Please enter renderer name');
        if (name==null || name=='') {
            //alert('Invalid name');
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

    var cell4 = row.insertCell(4);
    var element6 = document.createElement("div");
    element6.setAttribute('class', 'os_switch');
    element6.setAttribute('id', 'os_switch_'+id);
    element6.setAttribute('name', 'os_switch_'+id);
    var element6a = document.createElement("div");
    element6a.setAttribute('class', 'iphone_switch_container');
    element6a.setAttribute('style', 'height:16px; width:56px; position: relative; overflow: hidden;');
    var element6b = document.createElement("img");
    element6b.setAttribute('class', 'iphone_switch');
    element6b.setAttribute('style', 'height:16px; width:56px; background-image:url(images/iphone_switch_16.png); background-repeat:none; background-position:-31px');
    element6b.setAttribute('src', 'images/iphone_switch_container_off_16.png');
    element6a.appendChild(element6b);
    element6.appendChild(element6a);
    cell4.appendChild(element6);

    var cell2a = row.insertCell(5);
    var element2a = document.createElement("select");
    element2a.name = "access_"+id;
    var option1 = document.createElement("option");
    option1.value = "1";
    option1.innerHTML = "Full";
    element2a.appendChild(option1);
    var option2 = document.createElement("option");
    option2.value = "2";
    option2.innerHTML = "Limited";                           
    element2a.appendChild(option2);
    element2a.value = 1;
    cell2a.appendChild(element2a);

    var cell5 = row.insertCell(6);
    var element6 = document.createElement("select");
    element6.name = "profile_"+id;
    var key;
    for (key in profiles) {
        element6.options[element6.options.length] = new Option(profiles[key],key);
    }
    element6.value = 1;
    cell5.appendChild(element6);
}

function deleteProfileRow(tableID) {
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
    } catch(e) {
        alert(e);
    }
}

// -->
</SCRIPT>
</head>
<body bgcolor="#eeeeee">

<div id="pageHeader" class="headerOff">
    <div id="headerContent">
        <div id="optionBar">
            <div id="wuSites">
                <span><b>Server Status:</b><span id="svrs"></span></span>
                <span><b>Checking Updates:</b><span id="lucr"></span></span>
                <span><b>Checking Additions:</b><span id="lacr"></span></span>
                <span><b>Files Added:</b><span id="nofa"></span></span>
                <span><b>Last File Added:</b><span id="lafn"></span></span>
            </div>
        </div>
    </div>
</div>

<hr>
<script type="text/javascript">
$(document).ready(function(){

    CheckStatuses();

    var refreshID = setInterval(function() {
        CheckStatuses();
    },5000);

    function CheckStatuses() {
        $.getJSON("monitor.php", function(json){
            if (json.serverStatus == 'STARTED') {
                $("#svrs").html("<img src='images/bullet_green.png' title='running'>");
            } else {
                $("#svrs").html("<img src='images/bullet_red.png' title='not running'>");
            }
            if (json.libraryUpdatesCheckerRunning == 'true') {
                $("#lucr").html("<img src='images/bullet_green.png' title='running'>");
            } else {
                $("#lucr").html("<img src='images/bullet_red.png' title='not running'>");
            }
            if (json.libraryAdditionsCheckerRunning == 'true') {
                $("#lacr").html("<img src='images/bullet_green.png' title='running'>");
            } else {
                $("#lacr").html("<img src='images/bullet_red.png' title='not running'>");
            }
            $("#lafn").text(json.lastAddedFileName); 
            $("#nofa").text(json.numberOfAddedFiles); 
        });
    }
});
</script>

<?php
// Application version check
/* - temporarily disabled
$message = "";
if ($appInfo["version"]!=$version_req) {
    if ($message=="") {
        $message = "WARNING: There is a version mismatch between Serviio and Web UI. There may be a loss of functionality.";
    }
} elseif ($appInfo["updateVersionAvailable"] > $appInfo["version"] && $appInfo["updateVersionAvailable"] != "") {
    if ($message=="") {
        $message = "There is a new version of Serviio available - <a href='http://serviio.org'>Click Here</a>";
    }
}
if ($message!="") {
    ?>
<center><font color="red"><b><?php echo $message!=""?$message:""?></b></font></center>
<?php
}
*/
?>
<br />

<div style="padding-left: 10px;">
    <ul id="indextabs" class="shadetabs">
        <li><a href="content.php?tab=status" rel="indexcontainer" class="selected"><?php echo tr('tab_status','Status')?></a></li>
        <li><a href="content.php?tab=library" rel="indexcontainer"><?php echo tr('tab_folders','Library')?></a></li>
        <li><a href="content.php?tab=metadata" rel="indexcontainer"><?php echo tr('tab_metadata','Metadata')?></a></li>
        <li><a href="content.php?tab=transcoding" rel="indexcontainer"><?php echo tr('tab_transcoding','Transcoding')?></a></li>
        <li><a href="content.php?tab=presentation" rel="indexcontainer"><?php echo tr('tab_presentation','Presentation')?></a></li>
        <li><a href="content.php?tab=remote" rel="indexcontainer"><?php echo tr('tab_remote','Remote')?></a></li>
        <li><a href="content.php?tab=settings" rel="indexcontainer"><?php echo tr('tab_console_settings','Console Settings')?></a></li>
        <li><a href="content.php?tab=about" rel="indexcontainer"><?php echo tr('tab_about','About')?></a></li>
    </ul>

    <div id="indexdivcontainer" style="border:1px solid gray; width:97.5%; margin-bottom: 1em; padding: 10px">
    </div>
</div>

<script type="text/javascript">
var indexes=new ddajaxtabs("indextabs", "indexdivcontainer")
indexes.setpersist(true)
indexes.setselectedClassTarget("link") //"link" or "linkparent"
indexes.init()
indexes.onajaxpageload=function(pageurl) {
    //-------------------------------------------------------------------------
    if (pageurl.indexOf("content.php?tab=status")!=-1) {
        var ssTabs=new ddtabcontent("serverstatustab")
        ssTabs.setpersist(true)
        ssTabs.setselectedClassTarget("link") //"link" or "linkparent"
        ssTabs.init()
        var rpTabs=new ddtabcontent("rendererprofiletab")
        rpTabs.setpersist(true)
        rpTabs.setselectedClassTarget("link") //"link" or "linkparent"
        rpTabs.init()
        var nsTabs=new ddtabcontent("networksettingtab")
        nsTabs.setpersist(true)
        nsTabs.setselectedClassTarget("link") //"link" or "linkparent"
        nsTabs.init()
        $(document).ready(function(){

            $(".os_switch").each(function(i, domEle) {
                var itm = domEle.id.substring(8,55);
                var itm_def = "on";
                var itm_stat = $("#enabled_"+itm).val();
                if (itm_stat == "true") {
                    itm_def = "on";
                } else {
                    itm_def = "off";
                }
                $(this).iphoneSwitch(itm_def, 
                    function() {
                        //alert('on');
                        $("#enabled_"+itm).val('true');
                    },
                    function() {
                        //alert('off');
                        $("#enabled_"+itm).val('false');
                    },
                    {
                        switch_on_container_path: 'images/iphone_switch_container_off_16.png'
                    }
                );
            });

            $("#debugInfo").text("");
            $("#debugInfoDate").text("");
            $("#debugInfo2").text("");
            $("#debugInfo2Date").text("");
            var $form = $("#statusform");
            $("#submit").click(function(e) {
                $("#savingMsg").text("Saving...");
                $("#savingMsg").first().show();
                $("#debugInfo").text(parseUrl(decodeURIComponent($form.serialize())));
                $("#debugInfoDate").text(Date());
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'code/status1.php',
                    data: $form.serialize(),
                    dataType: 'xml',
                    timeout: 15000,
                    success: function(response) {
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(serializeXmlNode(response));
                        if ($(response).find("errorCode").text() == 0) {
                            $("#savingMsg").text("Saved!");
                            $("#savingMsg").delay(800).fadeOut("slow");
                        } else {
                            $("#savingMsg").text("Error saving data! (" + $(response).find("parameter").text() + ")");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert("Error: " + textStatus)
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(errorThrown);
                    }
                });
                return false;
            });
        });
        $("#start").click(function() {
                $("#debugInfoDate").text(Date());
                //e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'code/status2.php',
                    data: 'type=start',
                    dataType: 'xml',
                    timeout: 10000,
                    success: function(response) {
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(serializeXmlNode(response));
                        if ($(response).find("errorCode").text() == 0) {
                            $("#stop").removeAttr("disabled");
                            $("#start").attr("disabled", "disabled");
                        } else {
                            //$("#savingMsg").text("Error saving data! (" + $(response).find("parameter").text() + ")");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert("Error: " + textStatus)
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(errorThrown);
                    }
                });
                return false;
        });
        $("#stop").click(function() {
                $("#debugInfoDate").text(Date());
                //e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'code/status2.php',
                    data: 'type=stop',
                    dataType: 'xml',
                    timeout: 10000,
                    success: function(response) {
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(serializeXmlNode(response));
                        if ($(response).find("errorCode").text() == 0) {
                            $("#start").removeAttr("disabled");
                            $("#stop").attr("disabled", "disabled");
                        } else {
                            //$("#savingMsg").text("Error saving data! (" + $(response).find("parameter").text() + ")");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert("Error: " + textStatus)
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(errorThrown);
                    }
                });
                return false;
        });
    }
    //-------------------------------------------------------------------------
    if (pageurl.indexOf("content.php?tab=library")!=-1) {
        var libTabs=new ddtabcontent("librarytabs")
        libTabs.setpersist(false)
        libTabs.setselectedClassTarget("link") //"link" or "linkparent"
        libTabs.init()
        var libsTabs=new ddtabcontent("librarystatustabs")
        libsTabs.setpersist(true)
        libsTabs.setselectedClassTarget("link") //"link" or "linkparent"
        libsTabs.init()
        $(document).ready(function(){

            $(".os_switch").each(function(i, domEle) {
                var itm = domEle.id.substring(10,14);
                var itm_def = "on";
                var itm_stat = $("#os_stat_"+itm).val();
                if (itm_stat == "true") {
                    itm_def = "on";
                } else {
                    itm_def = "off";
                }
                $(this).iphoneSwitch(itm_def, 
                    function() {
                        //alert('on');
                        $("#os_stat_"+itm).val('true');
                    },
                    function() {
                        //alert('off');
                        $("#os_stat_"+itm).val('false');
                    },
                    {
                        switch_on_container_path: 'images/iphone_switch_container_off_16.png'
                    }
                );
            });

            $("#debugInfo").text("");
            $("#debugInfoDate").text("");
            $("#debugInfo2").text("");
            $("#debugInfo2Date").text("");
            var $form = $("#libraryform");
            $("#refresh").click(function(e) {
                $("#process").val("refresh");
                $("#savingMsg").text("Starting Refresh...");
                $("#savingMsg").first().show();
                $("#debugInfo").text(parseUrl(decodeURIComponent($form.serialize())));
                $("#debugInfoDate").text(Date());
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'code/library.php',
                    data: $form.serialize(),
                    dataType: 'xml',
                    timeout: 10000,
                    success: function(response) {
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(serializeXmlNode(response));
                        if ($(response).find("errorCode").text() == 0) {
                            $("#savingMsg").text("Started!");
                            $("#savingMsg").delay(800).fadeOut("slow");
                        } else {
                            $("#savingMsg").text("Error starting rescan! (" + $(response).find("parameter").text() + ")");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert("Error: " + textStatus)
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(errorThrown);
                    }
                });
                return false;
            });
            $("#submit").click(function(e) {
                $("#savingMsg").text("Saving...");
                $("#savingMsg").first().show();
                $("#debugInfo").text(parseUrl(decodeURIComponent($form.serialize())));
                $("#debugInfoDate").text(Date());
                $("#process").val("save");
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'code/library.php',
                    data: $form.serialize(),
                    dataType: 'xml',
                    timeout: 10000,
                    success: function(response) {
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(response);
                        $("#debugInfo2").text(serializeXmlNode(response));
                        if ($(response).find("errorCode").text() == 0) {
                            $("#savingMsg").text("Saved!");
                            $("#savingMsg").delay(800).fadeOut("slow");
                        } else {
                            $("#savingMsg").text("Error saving data! (" + $(response).find("parameter").text() + ")");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert("Error: " + textStatus)
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(errorThrown);
                    }
                });
                return false;
            });

            $("#smallbrowser").folderTree({
                root: '/',
                script: 'tree/jquery_folder_tree/jquery.foldertree.php',
                loadMessage: 'My loading message...'
            });
                
            $("#smallbrowser").click(function() {
                var tmp = $(".sel").attr('href');
                $("#selValue").val(tmp);
            });

            $("#dialog-form").dialog({
                autoOpen: false,
                height: 440,
                width: 500,
                modal: true,
                buttons: {
                    "Select Folder": function() {
                        var bValid = true;
                        var tmp = $(".sel").attr('href');
                        var nextID = parseInt($("#lastFId").val())+1;
                        $("#lastFId").val(nextID);
                        addLibRow("libraryTableFolders",tmp,nextID);
                        $(this).dialog("close");
                    },
                    Cancel: function() {
                        $(this).dialog("close");
                    }
                }
            });

            $("#addFolder").click(function(e) {
                e.preventDefault();
                $("#dialog-form").dialog("open");
                return false;
            });

            $("#Add_OS_Item").dialog({
                autoOpen: false,
                height: 380,
                width: 550,
                modal: true,
                buttons: {
                    "Add": function() {
                        var newID = 1 + parseInt($("#lastOSId").val());
                        $("#lastOSId").val(newID);

                        var srcImg = "";
                        var srcTxt = $('input:radio[name=newMediaType]:checked').val();
                        if (srcTxt == "VIDEO") {
                            srcImg = "images/film.png";
                        } else if (srcTxt == "AUDIO") {
                            srcImg = "images/music-beam.png";
                        } else if (srcTxt == "IMAGE") {
                            srcImg = "images/camera-black.png";
                        }
                        $("#libraryTableOnlineSources").find('tbody')
                            .append($('<tr>').attr('align', 'center')
                                .append($('<td>')
                                    .append($('<input>').attr('type', 'checkbox').attr('name', 'chk').attr('value', newID))
                                    .append($('<input>').attr('type', 'hidden').attr('name', 'onlinesource_'+newID).attr('value', 'new'))
                                    .append($('<input>').attr('type', 'hidden').attr('id', 'os_type_'+newID).attr('name', 'os_type_'+newID).attr('value', $("#newOnlineFeedType").val()))
                                    .append($('<input>').attr('type', 'hidden').attr('id', 'os_url_'+newID).attr('name', 'os_url_'+newID).attr('value', $("#newSourceURL").val()))
                                    .append($('<input>').attr('type', 'hidden').attr('id', 'os_media_'+newID).attr('name', 'os_media_'+newID).attr('value', $("input:radio[name=newMediaType]:checked").val()))
                                    .append($('<input>').attr('type', 'hidden').attr('id', 'os_thumb_'+newID).attr('name', 'os_thumb_'+newID).attr('value', $("#newThumbnailURL").val()))
                                    .append($('<input>').attr('type', 'hidden').attr('id', 'os_name_'+newID).attr('name', 'os_name_'+newID).attr('value', $("#newName").val()))
                                    .append($('<input>').attr('type', 'hidden').attr('id', 'os_stat_'+newID).attr('name', 'os_stat_'+newID).attr('value', ($("#newEnabled").attr('checked'))=="checked"?'true':''))
                                )
                                .append($('<td>')
                                    .append($('<span>')
                                        .html('&nbsp;New&nbsp;')
                                    )
                                )
                                .append($('<td>')
                                    .append($('<div>').attr('class', 'os_switch').attr('id', 'os_switch_'+newID).attr('name', 'os_switch_'+newID).attr('style', 'cursor: pointer;')
                                        .append($('<div>').attr('class', 'iphone_switch_container').attr('style', 'height:16px; width:56px; position: relative; overflow: hidden;')
                                            .append($('<img>')
                                                .attr('class', 'iphone_switch')
                                                .attr('style', 'height:16px; width:56px; background-image:url(images/iphone_switch_16.png); background-repeat:none; background-position:-31px')
                                                .attr('src', 'images/iphone_switch_container_off_16.png')
                                            )
                                        )
                                    )
                                )
                                .append($('<td>').attr('align', 'left')
                                    .append($('<span>')
                                        .attr('id', 'os_type_v_'+newID)
                                        .attr('name', 'os_type_v_'+newID)
                                        .text($("#newOnlineFeedType").val())
                                    )
                                )
                                .append($('<td>').attr('align', 'left')
                                    .append($('<select>')
                                        .attr('id', 'os_access_'+newID)
                                        .attr('name', 'os_access_'+newID)
                                        .append($('<option>')
                                            .attr('value', '1')
                                            .attr('selected', 'selected')
                                            .text('Full')
                                        )
                                        .append($('<option>')
                                            .attr('value', '2')
                                            .text('Limited')
                                        )
                                    )
                                )
                                .append($('<td>').attr('align', 'left')
                                    .append($('<span>')
                                        .attr('id', 'os_name_v_'+newID)
                                        .attr('name', 'os_name_v_'+newID)
                                        .attr('title', $("#newSourceURL").val())
                                        .text(($("#newName").val())?$("#newName").val():$("#newSourceURL").val())
                                    )
                                )
                                .append($('<td>').attr('style', 'vertical-align: top;').attr('width', '30')
                                    .append($('<span>').attr('id', 'os_media_v_'+newID).attr('name', 'os_media_v_'+newID)
                                        .append($('<img>').attr('src', srcImg).attr('alt', srcTxt))
                                        .append(' '+srcTxt)
                                    )
                                )
                            );

                            var swState = "off";
                            if ($("#newEnabled").attr('checked')) {
                                swState = "on";
                            }
                            $("#os_switch_"+newID).iphoneSwitch(swState,
                                function() {
                                    //alert('on');
                                    $("#os_stat_"+newID).val('true');
                                },
                                function() {
                                    //alert('off');
                                    $("#os_stat_"+newID).val('false');
                                },
                                {
                                    switch_on_container_path: 'images/iphone_switch_container_off_16.png'
                                }
                            );

                        $(this).dialog("close");
                    },
                    Cancel: function() {
                        $(this).dialog("close");
                    }
                }
            });

            $("#add_os").click(function(e) {
                e.preventDefault();
                // set defaults and clear fields
                $("#newEnabled").prop("checked", true);
                $("#newOnlineFeedType").val("FEED");
                $("#newSourceURL").val("");
                $("#newName").val("");
                $("[name=newMediaType]").filter("[value=VIDEO]").prop("checked",true);
                $("#newThumbnailURL").val("");
                $("#newThumbnailURL").attr('disabled', 'disabled');
                // open dialog box
                $("#Add_OS_Item").dialog("open");
                return false;
            });

            $("#Add_Serviidb_Item").dialog({
                autoOpen: false,
                height: 480,
                width: 550,
                modal: true,
                open: function(ev, ui) {
                    $(":focus", $(this)).blur();
                },
//                close: function(ev, ui) {
//                    $("#t1").remove();
//                },
//                show: {
//                    complete: function() {
//                    }
//                },
                buttons: {
                    "Add": function() {
                        $(this).dialog("close");
                    },
                    Cancel: function() {
                        $(this).dialog("close");
                    }
                }
            });

            $("#add_serviidb").click(function(e) {
                e.preventDefault();
                // set defaults and clear fields
                // open dialog boxs
                if (!($("#t1").hasClass("dataTable"))) {
                    oTable = $("#t1").dataTable({
                        "bLengthChange": false,
                        "iDisplayLength": 7,
                        "sPaginationType": "full_numbers"
                    });
                    $("#t1 tbody").click(function(event){
                        $(oTable.fnSettings().aoData).each(function () {
                            $(this.nTr).removeClass('row_selected');
                        });
                        $(event.target.parentNode).addClass('row_selected');
                    });
                }
                $("#Add_Serviidb_Item").dialog("open");

                return false;
            });

            $("#newOnlineFeedType").change(function () {
                if ($(this).val() == "LIVE_STREAM") {
                    $("#newThumbnailURL").removeAttr('disabled');
                    $("[name=newMediaType]").filter("[value=VIDEO]").prop("checked",true);
                    $("[name=newMediaType]").filter("[value=IMAGE]").attr('disabled', 'disabled');
                } else {
                    $("#newThumbnailURL").attr('disabled', 'disabled');
                    $("[name=newMediaType]").filter("[value=IMAGE]").removeAttr('disabled');
                }
            });

            $("#Edit_OS_Item").dialog({
                autoOpen: false,
                height: 480,
                width: 550,
                modal: true,
                buttons: {
                    "Save": function() {
                        var osID = $("#osID").val();
                        $("input[name=os_url_"+osID+"]").val($("#editSourceURL").val());
                        if ($("#editName").val()=="") {
                            $("#os_name_v_"+osID).text($("#editSourceURL").val());
                        } else {
                            $("#os_name_v_"+osID).text($("#editName").val());
                        }
                        $("#os_name_v_"+osID).attr('title', $("#editSourceURL").val());
                        $("#os_name_"+osID).val($("#editName").val());
                        $("#os_thumb_"+osID).val($("#editThumbnailURL").val());
                        $("#os_type_v_"+osID).text($("#editOnlineFeedType").val());
                        $("#os_type_"+osID).val($("#editOnlineFeedType").val());
                        var mType = $('input:radio[name=editMediaType]:checked').val();
                        var mRes = "";
                        if (mType == "VIDEO") {
                            mRes = "<img src='images/film.png' alt='Video'>&nbsp;Video";
                        } else if (mType == "AUDIO") {
                            mRes = "<img src='images/music-beam.png' alt='Audio'>&nbsp;Audio";
                        } else if (mType == "IMAGE") {
                            mRes = "<img src='images/camera-black.png' alt='Image'>&nbsp;Image";
                        }
                        $("#os_media_v_"+osID).html(mRes);
                        $("#os_media_"+osID).val(mType);
                        // now close the form
                        $(this).dialog("close");
                    },
                    Cancel: function() {
                        $(this).dialog("close");
                    }
                }
            });

            $("#edit_os").click(function(e) {
                e.preventDefault();

                var selCount = 0;
                var firstSelect = 0;
                $.each($("input[name='chk']:checked"), function() {
                    selCount += 1;
                    if (firstSelect == 0) {
                        firstSelect = $(this).attr('value');
                    }
                });

                if (selCount == 0) {
                    alert("No Item Selected");
                    return false;
                }

                // set defaults and clear fields
                //$("#osID").val($("input[name=onlinesource_"+firstSelect+"]").val());
                $("#osID").val(firstSelect);
                $("#editOnlineFeedType").val($("#os_type_"+firstSelect).val());
                $("#editSourceURL").val($("input[name=os_url_"+firstSelect+"]").val());
                $("#editName").val($("#os_name_"+firstSelect).val());
                $("#editThumbnailURL").val($("input[name=os_thumb_"+firstSelect+"]").val());
                $("[name=editMediaType]").filter("[value=" + $("input[name=os_media_"+firstSelect+"]").val() + "]").prop("checked",true);

                if ($("#editOnlineFeedType").val() == "LIVE_STREAM") {
                    $("#editThumbnailURL").removeAttr('disabled');
                } else {
                    $("#editThumbnailURL").attr('disabled', 'disabled');
                }

                // open dialog box
                $("#Edit_OS_Item").dialog("open");
                return false;
            });

            $("#editOnlineFeedType").change(function () {
                if ($(this).val() == "LIVE_STREAM") {
                    $("#editThumbnailURL").removeAttr('disabled');
                    $("[name=editMediaType]").filter("[value=VIDEO]").prop("checked",true);
                    $("[name=editMediaType]").filter("[value=IMAGE]").attr('disabled', 'disabled');
                } else {
                    $("#editThumbnailURL").attr('disabled', 'disabled');
                    $("[name=editMediaType]").filter("[value=IMAGE]").removeAttr('disabled');
                }
            });

            $(".refresh-link").click(function(e) {
                $("#process").val("OSrefresh");
                var os_no = "os_no=" + $(this).attr("os_no") + "&process=OSrefresh";
                $("#savingMsg").text("Starting Refresh...");
                $("#savingMsg").first().show();
                $("#debugInfo").text(parseUrl(decodeURIComponent(os_no)));
                $("#debugInfoDate").text(Date());
                //e.preventDefault();
                $.ajax({
                    type: 'POST',
                    data: os_no,
                    url: 'code/library.php',
                    dataType: 'xml',
                    timeout: 10000,
                    success: function(response) {
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(serializeXmlNode(response));
                        if ($(response).find("errorCode").text() == 0) {
                            $("#savingMsg").text("Started!");
                            $("#savingMsg").delay(800).fadeOut("slow");
                        } else {
                            $("#savingMsg").text("Error starting rescan! (" + $(response).find("errorCode").text() + ")");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert("Error: " + textStatus)
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(errorThrown);
                    }
                });
                return false;
            });

        });
    }
    //-------------------------------------------------------------------------
    if (pageurl.indexOf("content.php?tab=metadata")!=-1) {
        var libTabs=new ddtabcontent("metadatatabs")
        libTabs.setpersist(false)
        libTabs.setselectedClassTarget("link") //"link" or "linkparent"
        libTabs.init()
        $(document).ready(function(){
            $("#debugInfo").text("");
            $("#debugInfoDate").text("");
            $("#debugInfo2").text("");
            $("#debugInfo2Date").text("");
            var $form = $("#metadataform");
            $("#rescan").click(function(e) {
                $("#savingMsg").text("Starting Rescan...");
                $("#savingMsg").first().show();
                $("#debugInfo").text(parseUrl(decodeURIComponent($form.serialize())));
                $("#debugInfoDate").text(Date());
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'code/metadata2.php',
                    dataType: 'xml',
                    timeout: 10000,
                    success: function(response) {
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(serializeXmlNode(response));
                        if ($(response).find("errorCode").text() == 0) {
                            $("#savingMsg").text("Started!");
                            $("#savingMsg").delay(800).fadeOut("slow");
                        } else {
                            $("#savingMsg").text("Error starting rescan! (" + $(response).find("parameter").text() + ")");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert("Error: " + textStatus)
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(errorThrown);
                    }
                });
                return false;
            });
            $("#submit").click(function(e) {
                $("#savingMsg").text("Saving...");
                $("#savingMsg").first().show();
                $("#debugInfo").text(parseUrl(decodeURIComponent($form.serialize())));
                $("#debugInfoDate").text(Date());
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'code/metadata1.php',
                    data: $form.serialize(),
                    dataType: 'xml',
                    timeout: 10000,
                    success: function(response) {
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(serializeXmlNode(response));
                        if ($(response).find("errorCode").text() == 0) {
                            $("#savingMsg").text("Saved!");
                            $("#savingMsg").delay(800).fadeOut("slow");
                        } else {
                            $("#savingMsg").text("Error saving data! (" + $(response).find("parameter").text() + ")");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert("Error: " + textStatus)
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(errorThrown);
                    }
                });
                return false;
            });
        });
    }
    //-------------------------------------------------------------------------
    if (pageurl.indexOf("content.php?tab=transcoding")!=-1) {
        var metTab1=new ddtabcontent("generalsettingstab")
        metTab1.setpersist(false)
        metTab1.setselectedClassTarget("link") //"link" or "linkparent"
        metTab1.init()
        var metTab2=new ddtabcontent("videosettingstab")
        metTab2.setpersist(false)
        metTab2.setselectedClassTarget("link") //"link" or "linkparent"
        metTab2.init()
        $(document).ready(function(){
            $("#debugInfo").text("");
            $("#debugInfoDate").text("");
            $("#debugInfo2").text("");
            $("#debugInfo2Date").text("");
            var $form = $("#transcodingform");
            $("#submit").click(function(e) {
                $("#savingMsg").text("Saving...");
                $("#savingMsg").first().show();
                $("#debugInfo").text(parseUrl(decodeURIComponent($form.serialize())));
                $("#debugInfoDate").text(Date());
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'code/transcoding1.php',
                    data: $form.serialize(),
                    dataType: 'xml',
                    timeout: 10000,
                    success: function(response) {
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(serializeXmlNode(response));
                        if ($(response).find("errorCode").text() == 0) {
                            $("#savingMsg").text("Saved!");
                            $("#savingMsg").delay(800).fadeOut("slow");
                        } else {
                            $("#savingMsg").text("Error saving data! (" + $(response).find("parameter").text() + ")");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert("Error: " + textStatus)
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(errorThrown);
                    }
                });
                return false;
            });

            $("#smallbrowser").folderTree({
                root: '/',
                script: 'tree/jquery_folder_tree/jquery.foldertree.php',
                loadMessage: 'My loading message...'
            });
                
            $("#smallbrowser").click(function() {
                var tmp = $(".sel").attr('href');
                $("#selValue").val(tmp);
            });

            $("#dialog-form").dialog({
                autoOpen: false,
                height: 440,
                width: 500,
                modal: true,
                buttons: {
                    "Select Folder": function() {
                        var tmp = $(".sel").attr('href');
                        $("#location").val(tmp);
                        $(this).dialog("close");
                    },
                    Cancel: function() {
                        $(this).dialog("close");
                    }
                }
            });

            $("#addFolder").click(function(e) {
                e.preventDefault();
                $("#dialog-form").dialog("open");
                return false;
            });

        });
    }
    //-------------------------------------------------------------------------
    if (pageurl.indexOf("content.php?tab=presentation")!=-1) {
        $(document).ready(function(){
            $("#debugInfo").text("");
            $("#debugInfoDate").text("");
            $("#debugInfo2").text("");
            $("#debugInfo2Date").text("");
            var $form = $("#presentationform");
            $("#submit").click(function(e) {
                $("#savingMsg").text("Saving...");
                $("#savingMsg").first().show();
                $("#debugInfo").text(parseUrl(decodeURIComponent($form.serialize())));
                $("#debugInfoDate").text(Date());
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'code/presentation1.php',
                    data: $form.serialize(),
                    dataType: 'xml',
                    timeout: 10000,
                    success: function(response) {
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(serializeXmlNode(response));
                        if ($(response).find("errorCode").text() == 0) {
                            $("#savingMsg").text("Saved!");
                            $("#savingMsg").delay(800).fadeOut("slow");
                        } else {
                            $("#savingMsg").text("Error saving data! (" + $(response).find("parameter").text() + ")");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert("Error: " + textStatus)
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(errorThrown);
                    }
                });
                return false;
            });
        });
    }
    //-------------------------------------------------------------------------
    if (pageurl.indexOf("content.php?tab=remote")!=-1) {
        var rmtTabs=new ddtabcontent("rmtSecurityTab")
        rmtTabs.setpersist(false)
        rmtTabs.setselectedClassTarget("link") //"link" or "linkparent"
        rmtTabs.init()
        var rmtTab2=new ddtabcontent("rmtDeliveryQualityTab")
        rmtTab2.setpersist(false)
        rmtTab2.setselectedClassTarget("link") //"link" or "linkparent"
        rmtTab2.init()
        $(document).ready(function(){
            $("#debugInfo").text("");
            $("#debugInfoDate").text("");
            $("#debugInfo2").text("");
            $("#debugInfo2Date").text("");
            var $form = $("#remoteform");
            $("#submit").click(function(e) {
                $("#savingMsg").text("Saving...");
                $("#savingMsg").first().show();
                $("#debugInfo").text(parseUrl(decodeURIComponent($form.serialize())));
                $("#debugInfoDate").text(Date());
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'code/remote.php',
                    data: $form.serialize(),
                    dataType: 'xml',
                    timeout: 10000,
                    success: function(response) {
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(serializeXmlNode(response));
                        if ($(response).find("errorCode").text() == 0) {
                            $("#savingMsg").text("Saved!");
                            $("#savingMsg").delay(800).fadeOut("slow");
                        } else {
                            $("#savingMsg").text("Error saving data! (" + $(response).find("parameter").text() + ")");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert("Error: " + textStatus)
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(errorThrown);
                    }
                });
                return false;
            });
        });
    }
    //-------------------------------------------------------------------------
    if (pageurl.indexOf("content.php?tab=settings")!=-1) {
        var conTabs=new ddtabcontent("consolesettingstab")
        conTabs.setpersist(false)
        conTabs.setselectedClassTarget("link") //"link" or "linkparent"
        conTabs.init()
        $(document).ready(function(){
            $("#debugInfo").text("");
            $("#debugInfoDate").text("");
            $("#debugInfo2").text("");
            $("#debugInfo2Date").text("");
            var $form = $("#settingsform");
            $("#submit").click(function(e) {
                $("#savingMsg").text("Saving...");
                $("#savingMsg").first().show();
                $("#debugInfo").text(parseUrl(decodeURIComponent($form.serialize())));
                $("#debugInfoDate").text(Date());
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'code/settings1.php',
                    data: $form.serialize(),
                    dataType: 'text',
                    timeout: 10000,
                    success: function(response) {
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text("Storage to Cookie successful");
                        $("#savingMsg").text("Saved!");
                        $("#savingMsg").delay(800).fadeOut("slow");
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert("Error: " + textStatus)
                        $("#debugInfo2Date").text(Date());
                        $("#debugInfo2").text(errorThrown);
                    }
                });
                return false;
            });
        });
    }
    //-------------------------------------------------------------------------
    if (pageurl.indexOf("content.php?tab=about")!=-1) {

        $("#license-form").dialog({
            autoOpen: false,
            height: 265,
            width: 500,
            modal: true,
            buttons: {
                Close: function() {
                    $(this).dialog("close");
                }
            }
        });

        $(document).ready(function(){
            $("#licenseResult").text("");
            $("#debugInfo").text("");
            $("#debugInfoDate").text("");
            $("#debugInfo2").text("");
            $("#debugInfo2Date").text("");
            $("#license").click(function(e) {
                // load form to upload new license key
                e.preventDefault();
                $("#license-form").dialog("open");

                $("#upload_target").load(function () {
                    result = $("#upload_target").contents().find("body").html();
                    if (result == "0") {
                        $("#licenseResult").text("Successfully Imported License!");
                    } else {
                        $("#licenseResult").text("Error! Invalid License!");
                    }
                });
                return false;
            });
        });
    }
    //-------------------------------------------------------------------------
}
</script>

<hr>

<?php
if ($debugLoc == "screen") {
?>
<div>
    <fieldset>
        <legend>Debug Info</legend>
        <fieldset>
            <legend>POST data</legend>
            <div id="debugInfoDate" class="debugInfoDate"> </div>
            <pre>
                <div id="debugInfo" class="debugInfo"> </div>
            </pre>
        </fieldset>
        <fieldset>
            <legend>Response data</legend>
            <div id="debugInfo2Date" class="debugInfo2Date"> </div>
            <pre>
                <div id="debugInfo2" class="debugInfo2"> </div>
            </pre>
        </fieldset>
    </fieldset>
</div>
<?php } ?>

<div align="center"><font size="1">Web UI for Serviio &copy; 2012 <a href="https://github.com/mpemberton5/Web-UI-for-Serviio">Mark Pemberton</a><br>
RESTfull class &copy; <a href="http://www.gen-x-design.com/">Ian Selby</a> // 
AJAX File Browser &copy; <a href="http://gscripts.net/free-php-scripts/Listing_Script/AJAX_File_Browser/details.html">Free PHP Scripts</a> //
Table Sorting/Filtering &copy; <a href="http://www.javascripttoolbox.com/lib/table/source.php">Matt Kruse</a> //
Math.uuid.js &copy; <a href="http://www.broofa.com">Robert Kieffer</a> licensed under the MIT and GPL licenses</font></div>

</body>
</html>
