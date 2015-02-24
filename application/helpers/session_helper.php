<?
function GetSessionVariable($key)
{
	$CI = get_instance(); 
	return $CI->session->userdata($key);
}

function SetSessionVariable($key,$value)
{
	$CI = get_instance();
	$data = array($key=>$value);
	$CI->session->set_userdata($data);
}

function EmptySessionVariables()
{
	$CI = get_instance();
	$CI->session->sess_destroy();	
}