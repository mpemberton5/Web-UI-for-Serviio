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

$types = array('VIDEO','AUDIO','IMAGE');

$errorCode = 0;
$lastFId = getPostVar("lastFId", "0");
$lastOSId = getPostVar("lastOSId", "0");
$repo = array();
foreach ($_POST as $key=>$val) {
    if (substr($key, 0, 7)=="folder_") {
        $id = substr($key, 7);
        $items = array();
        $videosel = false;
        foreach ($types as $type) {
            if (getPostVar("${type}_${id}", "0")==1) {
                $items[] = $type;
                if ($type == "VIDEO") {
                    $videosel = true;
                }
            }
        }

        // this takes care of the issue where video isn't selected but scan is
        if ($videosel == true) {
            $scanval = getPostVar("SCAN_${id}", "0")==1?"true":"false";
        } else {
            $scanval = "false";
        } 
        $repo[0][$id] = array(
            getPostVar("name_${id}", ""),
            $items,
            getPostVar("ONLINE_${id}", "0")==1?"true":"false",
            $scanval,
            getPostVar("folder_${id}", "new"));
    }

    // Online Sources
    if (substr($key, 0, 13)=="onlinesource_") {
        $id = substr($key, 13);
        $repo[1][$id] = array(
            getPostVar("os_type_${id}", ""),
            getPostVar("os_url_${id}", ""),
            getPostVar("os_media_${id}", ""),
            $id>$lastOSId?false:true,
            getPostVar("os_name_${id}", ""),
            getPostVar("os_stat_${id}", ""),
            getPostVar("os_thumb_${id}", "")
            );
    }
}

$serviio->searchHiddenFiles = getPostVar("addhidden", "0")==1?"true":"false";
$serviio->searchForUpdates = getPostVar("searchupdates", "0")==1?"true":"false";
$serviio->automaticLibraryUpdate = getPostVar("autoupdate", "0")==1?"true":"false";
$serviio->automaticLibraryUpdateInterval = getPostVar("minutes", "0");

$serviio->maxNumberOfItemsForOnlineFeeds = getPostVar("maxfeeditems", "20");
$serviio->onlineFeedExpiryInterval = getPostVar("feedexpiry", "10");
$serviio->onlineContentPreferredQuality = getPostVar("onlinequality", "LOW");

$errorCode = $serviio->putRepository($repo);
return $errorCode;
?>
