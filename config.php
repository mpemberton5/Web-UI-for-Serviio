<?php
    $webUIver = "1.4beta3";
	$debugLevel = "none"; // none, debug
	$debugLoc = "none"; // none, screen
	$serviio_host = "127.0.0.1";
	$serviio_port = "23423";
	$serviidb_url = "http://www.serviidb.com/api/";
	$version_req = "1.2.1";
	$serviio_log = "";

	# set appropriate encoding
	mb_internal_encoding("UTF-8");

	if ($debugLevel == "debug") {
		ini_set('display_errors', 1);
		ini_set('error_reporting', E_ALL);
	}
?>
