function SwitchLanguage(obj) {
	var lang = obj.options[obj.selectedIndex].value;
	
	var search = document.location.search.replace(/[&\?]lang=([a-zA-Z\-]+)?/i, "");

	if (search) {
		search = search + "&lang=" + lang;
	} else {
		search = "?lang=" + lang;
	}
	document.location.assign(document.location.pathname + search + document.location.hash);
}
