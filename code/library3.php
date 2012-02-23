<?php
include("../config.php");
if ($debugLevel == "debug") {
    ini_set('display_errors', 1);
    ini_set('error_reporting', E_ALL);
}
include("../lib/RestRequest.inc.php");
include("../lib/serviio.php");

// initiate call to service
$serviio = new ServiioService($serviio_host,$serviio_port);
$errorCode = $serviio->postAction("forceOnlineResourceRefresh", getPostVar("os_no", ""));
return $errorCode;
?>

