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
$categories = array();
$presentation_language = getPostVar("presentation_language", "en");
$showParentCategoryTitle = getPostvar("showParentCategoryTitle", "0")=="1"?"true":"false";
$titles = isset($_POST['titles'])?$_POST['titles']:0;
$visibilities = isset($_POST['visibility'])?$_POST['visibility']:0;
if (is_array($titles) && count($titles)>0 && is_array($visibilities) && count($visibilities)>0) {
    foreach ($titles as $id=>$entry) {
        $title = "";
        $visibility = "";
        $subCategories = array();
        foreach ($entry as $sid=>$val) {
            if ($sid!="0") {
                $subVisibility = $visibilities[$id][$sid];
                $subCategories[$sid] = array($val, $subVisibility);
            }
        }
        $title = $titles[$id][0];
        $visibility = $visibilities[$id][0];
        $categories[$id] = array($title, $visibility, $subCategories);
    }
}
$errorCode = $serviio->putPresentation($categories, $presentation_language, $showParentCategoryTitle);
return $errorCode;
?>
