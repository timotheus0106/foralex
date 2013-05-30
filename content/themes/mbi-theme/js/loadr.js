Modernizr.load([
	{
		load: "http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"
	}

	// {
	// 	test: window.matchMedia,
	// 	nope: "js/libs/matchMedia.js"
	// },
	// 'js/libs/jquery-1.7.1.min.js',
	// "js/libs/enquire.min.js",
	// {
	// 	//Home & Home-Teaser
	// 	test: elementExists('home','section') || elementExists('home-teaser','section') || elementExists('standort','section'),
	// 	yep: "js/libs/jquery.cycle.js",
	// },{
	// 	//Content
	// 	test: elementExists('content','section'),
	// 	yep: ["js/libs/jquery.movingboxes.js", "js/libs/jquery.easing.1.2.js"],
	// },{
	// 	test: elementExists('kontakt', 'section'),
	// 	yep: ["js/libs/jquery.validate.js", "js/libs/jquery.jqEasyCharCounter.js", "js/libs/mobile/jquery.motionCaptcha.0.2.js"]
	// },{
	// 	test: elementExists('listing', 'section'),
	// 	yep: "js/libs/mobile/jquery.syncheight.js"
	// },{
	// 	test: elementExists('news', 'section'),
	// 	yep: ["js/libs/jscroll.js", "js/libs/startstop.events.jquery.js"]
	// },
	// "js/libs/mobile/jquery.touchwipe.min.js",
	// "js/libs/jquery.lightbox-0.5.js",
	// {
	// 	test: elementExists('news', 'section') || elementExists('suchergebnis', 'section'),
	// 	yep: ['js/libs/mobile/jstorage.js','js/libs/mobile/jquery.esn.autobrowse.js']
	// },{
	// 	test: ie8andLower(),
	// 	yep: 'js/ie8-fix.js'
	// },
	// "js/script.js"
]);


/** Helper Stuff **/
function elementExists(searchClass,tag) {
	var classElements = new Array();
	if ( tag == null )
		tag = '*';
	var els = document.getElementsByTagName(tag);
	var elsLen = els.length;
	var pattern = new RegExp("(^|\\s)"+searchClass+"(\\s|$)");
	for (i = 0, j = 0; i < elsLen; i++) {
		if ( pattern.test(els[i].className) ) {
			classElements[j] = els[i];
			j++;
		}
	}
	return (classElements.length > 0) ? true : false;
}
function checkIE(){
  var rv = -1; // Return value assumes failure.
  if (navigator.appName == 'Microsoft Internet Explorer'){
    if (new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})").exec(navigator.userAgent) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}
function ie8andLower(){
	rv = -1;
	if (navigator.appName == 'Microsoft Internet Explorer'){
    if (new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})").exec(navigator.userAgent) != null)
     	rv = parseFloat( RegExp.$1 );
  }
  if(rv != -1 && rv <= 8)return true;
  return false;
}