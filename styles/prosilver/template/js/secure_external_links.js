/**
 * @param base_url
 *            the page that provides the ref-function - it will get "?url=..."
 *            appended.
 * @param whitelist_links
 *            comma-separated list of valid domains
 */
function secure_external_links(base_url, whitelist_links) {
	function startsWith(str, word) {
		return str.lastIndexOf(word, 0) === 0;
	}
	var loc = window.location.hostname;
	if (whitelist_links != "" && !whitelist_links.match(loc)) {
		whitelist_links += ", " + loc;
	} else if (whitelist_links == "") {
		whitelist_links = loc;
	}
	whitelist_links = whitelist_links.replace(" ", "");

	var arr = whitelist_links.split(",");
	var arr_length = arr.length;

	var links = document.getElementsByTagName("a");

	var current_href = "";
	for (var i = 0; i < links.length; i++) {
		in_whitelist = false;
		for (var j = 0; !in_whitelist && j < arr_length; j++) {
			current_href = links[i].href;
			if (!current_href
					|| current_href.match(arr[j])
					|| !(startsWith(current_href, "http://")
							|| startsWith(current_href, "https://")
							|| startsWith(current_href, "ftp://"))) {
				in_whitelist = true;
			}
		}

		if (!in_whitelist) {
			links[i].href = base_url + "?url=" + escape(current_href);
		}
	}
}
