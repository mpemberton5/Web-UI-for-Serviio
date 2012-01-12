var xmlHttp = createXmlHttpRequestObject();
var serverAddress = "browse.php";
var showErrors = true;
var cache = new Array();
//XMLHttpRequest instance
function createXmlHttpRequestObject() {
	var xmlHttp;
	try {
		xmlHttp = new XMLHttpRequest();
	}
	catch(e) {
		var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
		"MSXML2.XMLHTTP.5.0",
		"MSXML2.XMLHTTP.4.0",
		"MSXML2.XMLHTTP.3.0",
		"MSXML2.XMLHTTP",
		"Microsoft.XMLHTTP");
		// try every id until one works
		for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++) {
			try {
				xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
			}
			catch (e) {}
		}
	}
	if (!xmlHttp)
	displayError("Error creating the XMLHttpRequest object.");
	else
	return xmlHttp;
}
// error message
function displayError($message) {
	if (showErrors) 	{
		showErrors = false;
		alert("Error encountered: \n" + $message);
		setTimeout("browse();", 10000);
	}
}
// the function handles the validation for any form field
function browse(inputValue, fieldID) {
	if (xmlHttp) {
		if (fieldID) {
			if (inputValue == "close") {
				document.getElementById(fieldID).title = "open";
				document.getElementById(fieldID + "Info").innerHTML = "";
				//alert("image" + fieldID);
				if (document.getElementById("image" + fieldID))
				document.getElementById("image" + fieldID).src = "images/folder.gif";
				return;
			}
			else {
				document.getElementById(fieldID).title = "close";
				if (document.getElementById("image" + fieldID))
				document.getElementById("image" + fieldID).src = "images/back.gif";
			}

			inputValue = encodeURIComponent(inputValue);
			fieldID = encodeURIComponent(fieldID);
			cache.push("inputValue=" + inputValue + "&fieldID=" + fieldID);
			parent.parent.populateDirectory(replaceAll(fieldID,'%2F','/'));
		}
		// try to connect to the server
		try	{
			if ((xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
					&& cache.length > 0) {
				// get a new set of parameters from the cache
				var cacheEntry = cache.shift();
				// make a server request to validate the extracted data
				xmlHttp.open("POST", serverAddress, true);
				xmlHttp.setRequestHeader("Content-Type",
				"application/x-www-form-urlencoded");
				xmlHttp.onreadystatechange = handleRequestStateChange;
				xmlHttp.send(cacheEntry);
			}
			if (xmlHttp.readyState == 1)
				document.getElementById("busy").innerHTML = "<b>Busy...</b>";
			else
				document.getElementById("busy").innerHTML = "<b>Ajax Tree File Browser</b>";
		}
		catch (e) {
			displayError(e.toString());
		}
	}
}
// function that handles the HTTP response
function handleRequestStateChange() {
	// when readyState is 4, we read the server response
	if (xmlHttp.readyState == 4) {
		// continue only if HTTP status is "OK"
		if (xmlHttp.status == 200) {
			try	{
				readResponse();
			}
			catch(e) {
				displayError(e.toString());
			}
		}
		else {
			displayError(xmlHttp.statusText);
		}
	}
}
function replaceAll( str, from, to ) {
    var idx = str.indexOf( from );


    while ( idx > -1 ) {
        str = str.replace( from, to ); 
        idx = str.indexOf( from );
    }

    return str;
}
// read server's response
function readResponse() {
	// retrieve the server's response
	var response = xmlHttp.responseText;
	amp = new RegExp("&amp;", "g");

	// server error?
	if (response.indexOf("ERRNO") >= 0
			|| response.indexOf("error:") >= 0
			|| response.length == 0)
	throw(response.length == 0 ? "Server error." : response);
	// get response in XML format (assume the response is valid XML)
	responseXml = xmlHttp.responseXML;
	// get the document element
	xmlDoc = responseXml.documentElement;
	result = xmlDoc.getElementsByTagName("result")[0].firstChild.data;
	fieldID = xmlDoc.getElementsByTagName("fieldid")[0].firstChild.data;
	// find the HTML element that displays the error
	result = result.replace("amp", "&");

	message = document.getElementById(fieldID + "Info");
	message.innerHTML = result;
	// show the error or hide the error
	//message.className = (result == "0") ? "error" : "hidden";
	// call validate() again, in case there are values left in the cache
	setTimeout("browse();", 500);
}
