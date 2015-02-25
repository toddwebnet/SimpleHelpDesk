<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends CI_Controller {
	
	var $template_vars;
	public function __construct() {
		parent::__construct();
		$this->template_vars = array(
			"title" => "Simple Help Desk"
			);
	}
	public function index()
	{
		$this->load->view('template/raw_template');
	}

	public function test()
	{
		$data = array(
			"template_vars" => $this->template_vars,
			);
		LoadPage("page", $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */