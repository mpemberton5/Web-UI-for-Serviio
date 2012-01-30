<?php
set_time_limit(0);
include("config.php");
include("lib/RestRequest.inc.php");
include("lib/serviio.php");

$tab = isset($_REQUEST["tab"])?$_REQUEST["tab"]:"";

if ($tab!="library" && $tab!="metadata" && $tab!="transcoding" && $tab!="about" && $tab!="presentation" && $tab!="settings") {
    $tab = "status";
}

if (isset($_COOKIE["language"]) && array_key_exists($_COOKIE["language"],$languages)) {
    $language = $_COOKIE["language"];
}

// initiate call to service
$serviio = new ServiioService($serviio_host,$serviio_port);

$appInfo = $serviio->getApplication();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo tr('window_title','Serviio console')?> <?php echo $appInfo["version"]?></title>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<script type="text/javascript">
    var GB_ROOT_DIR = "./greybox/greybox/";
</script>

<script type="text/javascript" src="greybox/greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/greybox/gb_scripts.js"></script>
<link href="greybox/greybox/gb_styles.css" rel="stylesheet" type="text/css" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script>!window.jQuery && document.write('<script src="http://code.jquery.com/jquery-1.4.2.min.js"><\/script>');</script>

<link href="css/styles.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="ajaxtabs/ajaxtabs.js">
/***********************************************
 * * Ajax Tabs Content script v2.2- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
 * * This notice MUST stay intact for legal use
 * * Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
 * ***********************************************/
</script>
<script type="text/javascript" language="javascript">
function switchSectionM(section) {
    document.getElementById('video').style.fontWeight = 'normal';
    document.getElementById('audio').style.fontWeight = 'normal';
    document.getElementById(section).style.fontWeight = 'bold';
    document.getElementById('videoHolder').style.display = 'none';
    document.getElementById('audioHolder').style.display = 'none';
    document.getElementById(section+'Holder').style.display = 'block';
    document.metadata.section.value = section;
    return false;
}
</script>
<SCRIPT type="text/javascript" language="javascript">
<!--
function switchLibSection(section) {
    document.getElementById('sharedfolders').style.fontWeight = 'normal';
    document.getElementById('onlinesources').style.fontWeight = 'normal';
    document.getElementById(section).style.fontWeight = 'bold';
    document.getElementById('sharedfoldersHolder').style.display = 'none';
    document.getElementById('onlinesourcesHolder').style.display = 'none';
    document.getElementById(section+'Holder').style.display = 'block';
    document.metadata.section.value = section;
    return false;
}

function addLibRow(tableID,path) {

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

//addLibOSRow('libraryTableOnlineSources',onlineFeedType, sourceURL, mediaType, thumbnailURL, displayName, stat);
function addLibOSRow(tableID,onlineFT,sURL,mType,tURL,Dname,stat) {
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
// -->
</SCRIPT>
<script type="text/javascript">
<!--
/*var maxFId = '<?php echo $midA?>';*/
var maxFId = '';
var localPath = '';
function addLibLocalPath() {
    if (localPath==null || localPath=='') {
        alert('Invalid path');
        return;
    }
    if (confirm('Add path "' + localPath + '" to media library?')) {
        addLibRow('libraryTableFolders',localPath);
    }
}
function populateDirectory(dir) {
    localPath = dir;
}
// -->
</script>
<script type="text/javascript">
<!--
/*var maxOSId = '<?php echo $midB?>';*/
var maxOSId = '';
var posted = '';
var onlineFeedType = '';
var sourceURL = '';
var mediaType = '';
var thumbnailURL = '';
var displayName = '';
var stat = '';
function addLibOnlineSource() {

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
        addLibOSRow('libraryTableOnlineSources',onlineFeedType, sourceURL, mediaType, thumbnailURL, displayName, stat);
    }
}
function populateLibData(oft,surl,mt,turl,pst,name) {
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
</head>
<body class="GreyBox" bgcolor="#eeeeee">

<div id="pageHeader" class="headerOff">
    <div id="headerContent">
        <div id="optionBar">
            <div id="wuSites">
                <span><b>Checking Updates:</b><span id="lucr"></span></span>
                <span><b>Checking Additions:</b><span id="lacr"></span></span>
                <span><b>Last Added Filename:</b><span id="lafn"></span></span>
                <span><b>Files Added:</b><span id="nofa"></span></span>
                <span><b>Last Refreshed:</b><span id="lastRefreshed"></span></span>
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
            $("#lucr").text(json.libraryUpdatesCheckerRunning); 
            $("#lacr").text(json.libraryAdditionsCheckerRunning); 
            $("#lafn").text(json.lastAddedFileName); 
            $("#nofa").text(json.numberOfAddedFiles); 
            var now = new Date();
            var hour        = now.getHours();
            var minute      = now.getMinutes();
            var second      = now.getSeconds();
            var monthnumber = now.getMonth()+1;
            var monthday    = now.getDate();
            var year        = now.getFullYear();
            $("#lastRefreshed").text(now.toDateString()+' '+now.toTimeString().substring(0,8));
        });
    }
});

</script>
<script type="text/javascript">
<!--
var localPath = '';
function addTransLocalPath() {
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

<ul id="indextabs" class="shadetabs">
<li><a href="content.php?tab=status" rel="indexcontainer" class="selected"><?php echo tr('tab_status','Status')?></a></li>
<li><a href="content.php?tab=library" rel="indexcontainer"><?php echo tr('tab_folders','Library')?></a></li>
<li><a href="content.php?tab=metadata" rel="indexcontainer"><?php echo tr('tab_metadata','Metadata')?></a></li>
<li><a href="content.php?tab=transcoding" rel="indexcontainer"><?php echo tr('tab_transcoding','Transcoding')?></a></li>
<li><a href="content.php?tab=presentation" rel="indexcontainer"><?php echo tr('tab_presentation','Presentation')?></a></li>
<li><a href="content.php?tab=settings" rel="indexcontainer"><?php echo tr('tab_console_settings','Console Settings')?></a></li>
<li><a href="content.php?tab=about" rel="indexcontainer"><?php echo tr('tab_about','About')?></a></li>
</ul>

<div id="indexdivcontainer" style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
<?php
// Application version check
$message = "";
if ($appInfo["version"]!=$version_req) {
//    $tab = "error";
//    $serviio->error = "Required Serviio ${version_req}, but found '${version}'";
    $message = "WARNING: There is a version mismatch between Serviio and Web UI. There may be a loss of functionality.";
} elseif ($appInfo["updateVersionAvailable"] > $appInfo["version"] && $appInfo["updateVersionAvailable"] != "") {
    $message = "There is a new version of Serviio available - <a href='http://serviio.org'>Click Here</a>";
}

include("code/${tab}.php");
if ($serviio->error && $tab!="about") {
    $tab = "error";
}
?>
<center><font color="red"><b><?php echo $message!=""?$message:""?></b></font></center>
<?php include("view/${tab}.php"); ?>
</div>

<script type="text/javascript">
var indexes=new ddajaxtabs("indextabs", "indexdivcontainer")
indexes.setpersist(true)
indexes.setselectedClassTarget("link") //"link" or "linkparent"
indexes.init()
</script>







<hr>
<div align="center"><font size="1">Web UI for Serviio &copy; 2012 <a href="http://tolik.org">Tolik aka AcidumIrae</a> (updated by <a href="https://github.com/mpemberton5/Web-UI-for-Serviio">mpemberton5</a>)<br>
RESTfull class &copy; <a href="http://www.gen-x-design.com/">Ian Selby</a> // 
AJAX File Browser &copy; <a href="http://gscripts.net/free-php-scripts/Listing_Script/AJAX_File_Browser/details.html">Free PHP Scripts</a> //
<a href="http://orangoo.com/labs/GreyBox/">GreyBox</a> &copy; <a href="http://amix.dk/">Amir Salihefendic</a> licensed under <a href="http://orangoo.com/labs/greybox/LGPL.txt">LGPL</a> // 
Math.uuid.js &copy; <a href="http://www.broofa.com">Robert Kieffer</a> licensed under the MIT and GPL licenses</font></div>
</body>
</html>
