//Define variable
var objQueryString={};

//Get querystring value
function __qs_get(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

//Add or modify querystring
function __qs_change(key,value) {
	//Get query string value
	var searchUrl=location.search;
	if(searchUrl.indexOf("?")== "-1") {
		var urlValue='?'+key+'='+value;
		history.pushState({state:1, rand: Math.random()}, '', urlValue);
	}
	else {
		//Check for key in query string, if not present
		if(searchUrl.indexOf(key)== "-1") {
			var urlValue=searchUrl+'&'+key+'='+value;
		}
		else {	//If key present in query string
			oldValue = __qs_get(key);
			if(searchUrl.indexOf("?"+key+"=")!= "-1") {
				urlValue = searchUrl.replace('?'+key+'='+oldValue,'?'+key+'='+value);
			}
			else {
				urlValue = searchUrl.replace('&'+key+'='+oldValue,'&'+key+'='+value);
			}
		}
		history.pushState({state:1, rand: Math.random()}, '', urlValue);
		//history.pushState function is used to add history state.
		//It takes three parameters: a state object, a title (which is currently ignored), and (optionally) a URL.
	}
	objQueryString.key=value;
}

//Function used to remove querystring
function __qs_delete(key) {
	var urlValue=document.location.href;

	//Get query string value
	var searchUrl=location.search;

	if(key!="") {
		oldValue = __qs_get(key);
		removeVal=key+"="+oldValue;
		if(searchUrl.indexOf('?'+removeVal+'&')!= "-1") {
			urlValue=urlValue.replace('?'+removeVal+'&','?');
		}
		else if(searchUrl.indexOf('&'+removeVal+'&')!= "-1") {
			urlValue=urlValue.replace('&'+removeVal+'&','&');
		}
		else if(searchUrl.indexOf('?'+removeVal)!= "-1") {
			urlValue=urlValue.replace('?'+removeVal,'');
		}
		else if(searchUrl.indexOf('&'+removeVal)!= "-1") {
			urlValue=urlValue.replace('&'+removeVal,'');
		}
	}
	else {
		var searchUrl=location.search;
		urlValue=urlValue.replace(searchUrl,'');
	}
	history.pushState({state:1, rand: Math.random()}, '', urlValue);
}
