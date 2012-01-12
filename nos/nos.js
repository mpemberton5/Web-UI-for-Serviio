function publish() {
    var olft = document.getElementById('onlineFeedType');
    var sURL = document.getElementById('sourceURL');
    var mt = getRadioVal('mediaType');
    var turl = document.getElementById('thumbnailURL');
    var Dname = document.getElementById('Dname');
    parent.parent.populateData(olft.value,sURL.value,mt,turl.value,'true',Dname.value);
    // populateData(onlineFeedType,sourceURL,mediaType,thumbnailURL,posted,displayName)
    //parent.parent.populateData('FEED','http://www.ted.com/talks/rss','VIDEO','','true');
    parent.parent.GB_hide();
}
function getRadioVal(radioName) {
    var rads = document.getElementsByName(radioName);

    for (var rad in rads) {
        if (rads[rad].checked)
            return rads[rad].value;
    }
    return null;
}
