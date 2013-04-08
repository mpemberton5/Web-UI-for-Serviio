<?php
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $errorCode = 0;
    if (getPostVar("rescan","")!="") {
	$errorCode = $serviio->postAction("forceVideoFilesMetadataUpdate");
    } else if (getPostVar("save","")!="") {
	$audio_cover = getPostVar("audio_cover","0")==1?"true":"false"; // audioLocalArtExtractorEnabled
	$thumbnails = getPostVar("thumbnails","0")==1?"true":"false"; // videoGenerateLocalThumbnailEnabled
	$img_thumbnails = getPostVar("img_thumbnails","0")==1?"true":"false"; // imageGenerateLocalThumbnailEnabled
	$cover_search = getPostVar("cover_search","0")==1?"true":"false"; // videoLocalArtExtractorEnabled
	$online_sources = getPostVar("online_sources","NONE"); // descriptiveMetadataExtractor
	$download_cover = getPostVar("download_cover","0")==1?"true":"false"; // videoOnlineArtExtractorEnabled
	$metadata_language = getPostVar("metadata_language","en"); // metadataLanguage
	$orig_title = getPostVar("orig_title","0")==1?"true":"false"; // retrieveOriginalTitle
	$errorCode = $serviio->putMetadata($audio_cover,$cover_search,$download_cover,$thumbnails,$img_thumbnails,$metadata_language,$online_sources,$orig_title);  
    }  
    if ($errorCode===false || $errorCode!=0) {
	$message = $serviio->warning;
    }
}
$serviio->getMetadata();
$section = getPostVar("section","");
if ($section!="audio") {
    $section = "video";
}
$descriptiveMetadataExtractors = $serviio->getReferenceData('descriptiveMetadataExtractors');
$metadataLanguages = $serviio->getReferenceData('metadataLanguages');
?>
