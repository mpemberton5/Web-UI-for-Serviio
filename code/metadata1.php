<?php
include("../config.php");
include("../lib/RestRequest.inc.php");
include("../lib/serviio.php");

// initiate call to service
$serviio = new ServiioService($serviio_host,$serviio_port);

$errorCode = 0;

$audio_cover = getPostVar("audio_cover","0")==1?"true":"false"; // audioLocalArtExtractorEnabled
$thumbnails = getPostVar("thumbnails","0")==1?"true":"false"; // videoGenerateLocalThumbnailEnabled
$cover_search = getPostVar("cover_search","0")==1?"true":"false"; // videoLocalArtExtractorEnabled
$online_sources = getPostVar("online_sources","NONE"); // descriptiveMetadataExtractor
$download_cover = getPostVar("download_cover","0")==1?"true":"false"; // videoOnlineArtExtractorEnabled
$metadata_language = getPostVar("metadata_language","en"); // metadataLanguage
$orig_title = getPostVar("orig_title","0")==1?"true":"false"; // retrieveOriginalTitle
$errorCode = $serviio->putMetadata($audio_cover,$cover_search,$download_cover,$thumbnails,$metadata_language,$online_sources,$orig_title);

return $errorCode;
?>
