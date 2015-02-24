<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Extra note: template helper auto adds js to header if located in "page" location /assets/js/{page}
*/
class Admin extends CI_Controller {
	
	var $template_vars;
	public function __construct() {
		parent::__construct();

		if(GetSessionVariable("UserID") == "")
		{redirect(base_url() . "login");}

		$this->load->model("m_tickets");
		$this->load->model("m_admin");

		$this->template_vars = array(
			"title" => "Simple Help Desk - Admin"
			);
	}


	public function index()
	{$this->show("");}

	public function show($HomeContent_AutoLoad = "")
	{
		//$this->template_vars['title'] .= "";
		$data = array(
			"template_vars" => $this->template_vars,
			"HomeContent_AutoLoad" => $HomeContent_AutoLoad,
			);
		LoadPage("pages/admin/home", $data);
	}


	/////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////

	function ajax_getTicketStatusList()
	{
		$data = array(
			"TicketStatusList" => $this->m_admin->GetTicketStatusList(),
			);
		$this->load->view("pages/admin/ticket_status_list", $data);
	}

	function ajax_getTicketStatusForm($TicketStatusID)
	{
		$data = array(
			"TicketStatus" => $this->m_admin->GetTicketStatus($TicketStatusID),
			"TicketStatusCount" => $this->m_admin->GetTicketStatusCount(),
			);
		$this->load->view("forms/admin/ticket_status", $data);
	}

	function ajax_SaveTicketStatusForm()
	{
		$TicketStatusID = $this->input->post("TicketStatusID");
		$StatusName = $this->input->post("StatusName");

		$this->m_admin->SaveTicketStatus($TicketStatusID, $StatusName);
		$data = array(
		"pass" => 1,	
		);
		print json_encode($data);
	}

	function ajax_TicketStatusDelete($TicketStatusID)
	{
		$this->m_admin->DeleteTicketStatus($TicketStatusID);
		$data = array(
		"pass" => 1,	
		);
		print json_encode($data);
	}

	/////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////


	function ajax_getTicketGroupList()
	{
		$data = array(
			"TicketGroupList" => $this->m_admin->GetTicketGroupList(),
			);
		$this->load->view("pages/admin/ticket_group_list", $data);
	}

	function ajax_getTicketGroupForm($TicketGroupID)
	{
		$data = array(
			"TicketGroup" => $this->m_admin->GetTicketGroup($TicketGroupID),
			"TicketGroupCount" => $this->m_admin->GetTicketGroupCount(),
			);
		$this->load->view("forms/admin/ticket_group", $data);
	}

	function ajax_SaveTicketGroupForm()
	{
		$TicketGroupID = $this->input->post("TicketGroupID");
		$GroupName = $this->input->post("GroupName");

		$this->m_admin->SaveTicketGroup($TicketGroupID, $GroupName);
		$data = array(
		"pass" => 1,	
		);
		print json_encode($data);
	}

	function ajax_TicketGroupDelete($TicketGroupID)
	{
		$this->m_admin->DeleteTicketGroup($TicketGroupID);
		$data = array(
		"pass" => 1,	
		);
		print json_encode($data);
	}


	

	
}

