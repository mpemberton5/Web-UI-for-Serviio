<?php
// load error handling script, config and browse class
require_once ('error_handler.php');
require_once ('browse.class.php');
require_once ('config.php');

// Create new browse object
$browser = new Browse();
$browser->invalid_files = $invalid_files;

//generate response
	$response =
	'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
	'<response>' .
	'<result>' .
	$browser->BrowseAJAX($_POST['inputValue'], $_POST['fieldID']) .
	'</result>' .
	'<fieldid>' .
	$_POST['fieldID'] .
	'</fieldid>' .
	'</response>';
	// generate the response
	if(ob_get_length()) ob_clean();
	header('Content-Type: text/xml');
	echo $response;

?>