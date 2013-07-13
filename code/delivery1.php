<?php
include("../config.php");
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

$subtitles = getPostVar("subtitles","0")==1?"true":"false";
$subtitlesextraction = getPostVar("subtitlesextraction","0")==1?"true":"false";
$hardsubsenabled = getPostVar("hardsubsenabled","0")==1&&(getPostVar("hardsubs","")=="enabled"||getPostVar("hardsubs","")=="")?"true":"false";
$hardsubsforced = getPostVar("hardsubsenabled","0")==1&&getPostVar("hardsubs","0")=="forced"?"true":"false";
$language = getPostVar("language","");
$hardSubsCharacterEncoding = getPostVar("hardSubsCharacterEncoding","");
$errorCode = $serviio->putDelivery($transcoding,$location,$cores,$audio,$quality,$subtitles,$subtitlesextraction,$hardsubsenabled,$hardsubsforced,$language,$hardSubsCharacterEncoding);
if ($errorCode===false || $errorCode!=0) {
    $message = $serviio->warning;
}
return $errorCode;
?>
