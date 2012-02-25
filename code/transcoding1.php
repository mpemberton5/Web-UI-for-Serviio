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

$errorCode = 0;
$transcoding = getPostVar("transcoding","0")==1?"true":"false";
$location = getPostVar("location","");
$cores = getPostVar("cores","1");
$audio = getPostVar("audio","")=="downmix"?"true":"false";
$quality = getPostVar("quality","0")==1?"true":"false";
$errorCode = $serviio->putTranscoding($transcoding,$location,$cores,$audio,$quality);
if ($errorCode===false || $errorCode!=0) {
    $message = $serviio->warning;
}
return $errorCode;
?>
