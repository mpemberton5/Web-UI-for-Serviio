<?php
include("../config.php");
include("../lib/RestRequest.inc.php");
include("../lib/serviio.php");

$language = $_POST["language"];
$_COOKIE["language"] = $language;
setcookie("language",$language,mktime(9,9,9,9,9,9999));

// initiate call to service
$serviio = new ServiioService($serviio_host,$serviio_port);

$errorCode = 0;
$retLang = getPostVar("language","en");
$retCheckForUpdates = getPostVar("checkForUpdates","0")==1?"true":"false";
$errorCode = $serviio->putConsoleSettings($retLang,$retCheckForUpdates);
if ($errorCode===false || $errorCode!=0) {
    $message = $serviio->warning;
}
return $errorCode;
?>
