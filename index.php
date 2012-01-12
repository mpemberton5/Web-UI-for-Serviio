<?php
set_time_limit(0);
include("config.php");
include("lib/RestRequest.inc.php");
include("lib/serviio.php");
$tab = isset($_REQUEST["tab"])?$_REQUEST["tab"]:"";
if ($tab!="library" && $tab!="metadata" && $tab!="transcoding" && $tab!="about" && $tab!="presentation" && $tab!="phpsysinfo" && $tab!="settings") {
    $tab = "status";
}
if (isset($_COOKIE["language"]) && array_key_exists($_COOKIE["language"],$languages)) {
    $language = $_COOKIE["language"];
}
$message = "";
// Application version check
$serviio = new ServiioService($serviio_host,$serviio_port);
$version = $serviio->getApplication();
if ($version!=$version_req) {
    $tab = "error";
    $serviio->error = "Required Serviio ${version_req}, but found '${version}'";
}
include("code/${tab}.php");
if ($serviio->error && $tab!="about") {
    $tab = "error";
}
?>
<html>
<head>
<title><?php echo tr('window_title','Serviio console')?> <?php echo $version?></title>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<script type="text/javascript">
    var GB_ROOT_DIR = "./greybox/greybox/";
</script>
<script type="text/javascript" src="greybox/greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/greybox/gb_scripts.js"></script>
<link href="greybox/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
</head>
<body class="GreyBox" bgcolor="#eeeeee">
<hr>
<div align="center">
<a href="?tab=status"><?php echo tr('tab_status','Status')?></a> |
<a href="?tab=library"><?php echo tr('tab_folders','Library')?></a> |
<a href="?tab=metadata"><?php echo tr('tab_metadata','Metadata')?></a> |
<a href="?tab=transcoding"><?php echo tr('tab_transcoding','Transcoding')?></a> |
<a href="?tab=presentation"><?php echo tr('tab_presentation','Presentation')?></a> |
<a href="?tab=settings"><?php echo tr('tab_console_settings','Console settings')?></a> |
<a href="?tab=about"><?php echo tr('tab_about','About')?></a>
</div>
<hr>
<center><font color="red"><b><?php echo $message!=""?$message:""?></b></font></center>
<?php include("view/${tab}.php"); ?>
<hr>
<div align="center"><font size="1">serviio web frontend &copy; 2011 <a href="http://tolik.org">Tolik aka AcidumIrae</a><br>
RESTfull class &copy; <a href="http://www.gen-x-design.com/">Ian Selby</a> // 
AJAX File Browser &copy; <a href="http://gscripts.net/free-php-scripts/Listing_Script/AJAX_File_Browser/details.html">Free PHP Scripts</a> //
<a href="http://orangoo.com/labs/GreyBox/">GreyBox</a> &copy; <a href="http://amix.dk/">Amir Salihefendic</a> licensed under <a href="http://orangoo.com/labs/greybox/LGPL.txt">LGPL</a> // 
Math.uuid.js &copy; <a href="http://www.broofa.com">Robert Kieffer</a> licensed under the MIT and GPL licenses</font></div>
</body>
</html>
