<?php
include("../config.php");
include("../lib/RestRequest.inc.php");
include("../lib/serviio.php");

// initiate call to service
$serviio = new ServiioService($serviio_host,$serviio_port);
$errorCode = $serviio->postAction("forceVideoFilesMetadataUpdate");
return $errorCode;
?>
