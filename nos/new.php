<?php
set_time_limit(0);
include("../config.php");
include("../lib/RestRequest.inc.php");
include("../lib/serviio.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>New Online Source</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="nos.js"></script>
        <link href="../greybox/greybox/gb_styles.css" rel="stylesheet" type="text/css" />

        <style type="text/css">
            h1 {font-family: Tahoma; font-size: 90%;}
            p {font-family: Tahoma}
        </style>
    </head>
    <body>
    <h1><?php echo tr('new_online_source_description','Enter details of the required online source. Select the source type, enter URL of the source and pick type of media the source provides.')?></h1>
        <p>
        <form>
            <table>
            <tr>
                <td><?php echo tr('new_online_source_type','Source type:')?></td>
                <td><select id="onlineFeedType" name="onlineFeedType">
                       <option value="FEED" SELECTED>Online RSS/Atom feed</option>
                       <option value="LIVE_STREAM" SELECTED>Live Stream</option>
                       <option value="WEB_RESOURCE" SELECTED>Other Web Resources</option>
                    </select></td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_url','Source URL:')?></td>
                <td><input type="text" id="sourceURL" name="sourceURL" size="60" /></td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_name','Display Name:')?></td>
                <td><input type="text" id="Dname" name="Dname" size="60" /></td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_media_type','Media Type:')?></td>
                <td><input type="radio" id="mediaType" name="mediaType" value="VIDEO" /> Video
                    <input type="radio" id="mediaType" name="mediaType" value="AUDIO" /> Audio
                    <input type="radio" id="mediaType" name="mediaType" value="IMAGE" /> Image
                </td>
            </tr>
            <tr>
                <td><?php echo tr('new_online_source_thumbnail_url','Thumbnail URL:')?></td>
                <td><input type="text" id="thumbnailURL" name="thumbnailURL" size="60" readonly=readonly /></td>
            </tr>
        </table>

        <br />
        <input type="submit" onclick="publish(); return false;" value="Click" name="hi" />
        </form>
        </p>
    </body>
</html>
