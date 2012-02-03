<?php
$types = array('VIDEO','AUDIO','IMAGE');
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $errorCode = 0;
    if (getPostVar("force", "")!="") {
        $errorCode = $serviio->postAction("forceLibraryRefresh");
    } else if (getPostVar("save", "")!="") {
        $lastFId = getPostVar("lastFId", "0");
        $lastOSId = getPostVar("lastOSId", "0");
        $repo = array();
        foreach ($_POST as $key=>$val) {
            if (substr($key, 0, 7)=="folder_") {
                $id = substr($key, 7);
                $items = array();
                foreach ($types as $type) {
                    if (getPostVar("${type}_${id}", "0")==1) {
                        $items[] = $type;
                    }
                }
                $repo[0][$id] = array(
                    getPostVar("name_${id}", ""),
                    $items,
                    getPostVar("ONLINE_${id}", "0")==1?"true":"false",
                    getPostVar("SCAN_${id}", "0")==1?"true":"false",
                    $id>$lastFId?false:true);
            }
            // Online Sources
            if (substr($key, 0, 13)=="onlinesource_") {
                $id = substr($key, 13);
                $items = "";
                foreach ($types as $type) {
                    if (getPostVar("os_${type}_${id}", "0")==1) {
                        $items = $type;
                    }
                }
                $repo[1][$id] = array(
                    getPostVar("os_type_${id}", ""),
                    getPostVar("os_url_${id}", ""),
                    $items,
                    $id>$lastOSId?false:true,
                    getPostVar("os_name_${id}", ""),
                    getPostVar("os_stat_${id}", "")
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
    }
    if ($errorCode===false || $errorCode!=0) {
        $message = $serviio->warning;
    }
}
$repo = $serviio->getRepository();
?>
