<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Extra note: template helper auto adds js to header if located in "page" location /assets/js/{page}
*/
class Login extends CI_Controller {
	
	var $template_vars;
	public function __construct() {
		parent::__construct();

		$this->load->model("m_login");

		$this->template_vars = array(
			"title" => "Simple Help Desk"
			);
	}
	public function index($Logout=false)
	{

		EmptySessionVariables();
		$this->template_vars['title'] .= " - Login ";
		$data = array(
			"template_vars" => $this->template_vars,
			"Logout" => $Logout
			);
		LoadPage("forms/login", $data);
	}
	public function out()
	{
		$this->index(true);	
	}

	function a_proc_login()
	{
		$email    = $this->input->post("email");
		$password = $this->input->post("password");
		$pass = $this->m_login->validate_login($email, $password);

		$return = array(
			"pass" => $pass->count
			);
		if($pass->count>0)
		{
			foreach((array)$pass as $key=>$value)
			{
				if($key != "count")
				{SetSessionVariable($key,$value);}
			}
		}
		print json_encode($return);
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */