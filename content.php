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

$serviio = new ServiioService($serviio_host,$serviio_port);

include("code/${tab}.php");
include("view/${tab}.php"); ?>
