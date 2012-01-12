<?php
require_once ('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Ajax Tree File Browser</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="browse.js"></script>
	<style type="text/css">
		h1 {font-family: Tahoma; font-size: 110%;font-weight: bold}
		p {font-family: Tahoma}
		a{text-decoration: none;font-family: Tahoma}
		a:link {color: #000}
		a:visited {color: #444444}
		a:hover {font-size: 110%}
		a:active {color: #000}
		.hidden {display: none;}
		.show{color: #cccccc;}
	</style>
  </head>
  <body onload="browse('open','<?php echo $path?>');">
  <div id="busy" align="center"><h1>Click on a folder to browse</h1></div>
	<p align="left"><b>
	<span id="<?php echo $path?>" title="open" onclick="browse(this.title,this.id);"/><h2><?php echo $path?></h2></span>
	</b></p>
	<p align="left">
	<span id="<?php echo $path?>Info"></span>
	</p>
  </body>
</html>
