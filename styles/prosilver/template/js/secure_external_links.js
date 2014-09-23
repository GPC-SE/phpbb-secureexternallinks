/**
 * @param base_url the page that provides the ref-function - it will get "?url=..." appended.
 * @param whitelist_links comma-separated list of valid domains
 */
function secure_external_links(base_url, whitelist_links)
{
	var loc = window.location.hostname;
	if(whitelist_links != "" && !whitelist_links.match(loc))
	{
		whitelist_links += ", " + loc;
	}
	else if(whitelist_links == "")
	{
		whitelist_links = loc;
	}
	whitelist_links = whitelist_links.replace(" ", "");

	var arr = whitelist_links.split(",");
	var arr_length = arr.length;

	var in_whitelist = false;

	var links = document.getElementsByTagName("a");

	var j = 0;
	var current_href = "";
	for(var i = 0; i < links.length; i++)
	{
		in_whitelist = false;
		j = 0;
		while(in_whitelist == false && j < arr_length)
		{
			current_href = links[i].href;
			if(current_href.match(arr[j]) || !current_href || !current_href.match("http://"))
			{
				in_whitelist = true;
			}
			j++;
		}
		
		if(in_whitelist == false)
		{
			links[i].href = base_url+"?url=" + escape(current_href);
		}
	}
}

