function AjaxStartLoading()
{
	img_src="assets/images/giphy.gif";	
	img_src="assets/images/angry-at-computer-o.gif";
	img_src="assets/images/spiderman-dancing.gif";
	html = "<div style='text-align:center;border:0px;'><img src=\"" + img_src + "\"><br>Waiting for content to load...</div>";
	$("body").mask(html);
}
function AjaxStopLoading()
{
	$("body").unmask();
}
