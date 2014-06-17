<?
function LoadPage($page, $data_vars)
{
	$CI = get_instance();
	$data_vars["template_vars"]["extra_js"] = GetJSFiles($page);
	$data_vars["template_vars"]["UserID"] = GetSessionVariable("UserID");
	$data_vars["template_vars"]["PermissionLevel"] = GetSessionVariable("PermissionLevel");
	$CI->load->view("template/top_template", $data_vars["template_vars"]);
	$CI->load->view($page, $data_vars);
	$CI->load->view("template/bottom_template", $data_vars["template_vars"]);
}



function GetJSFiles($page)
{
	$ds = DIRECTORY_SEPARATOR;
	$js_local = getcwd() . $ds . "assets" . $ds . "js" . $ds . implode($ds, explode("/", $page)). ".js";
	$js_web = base_url() . "/assets/js/" . implode("/", explode("/", $page)). ".js";
	if(file_exists($js_local))
	{return "<script type=\"text/javascript\" src=\"" . $js_web . "\"></script>";}
	else
	{return "";}


}