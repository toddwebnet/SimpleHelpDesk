<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Extra note: template helper auto adds js to header if located in "page" location /assets/js/{page}
*/
class Tickets extends CI_Controller {
	
	var $template_vars;
	public function __construct() {
		parent::__construct();
		$UserID = GetSessionVariable("UserID");
		if($UserID == "")
		{
			redirect(base_url() . "login");
			die();
		}

		$this->load->model("m_login");
		$this->load->model("m_tickets");

		$this->template_vars = array(
			"title" => "Simple Help Desk",
			"MyAssignedTicketsCount" => $this->m_tickets->GetCountTicketsByUserID($UserID), 
			"MyStartedTicketsCount" => $this->m_tickets->GetCountTicketByCreatorEmail(GetSessionVariable("Email")), 
			"UnassignedTicketsCount" => $this->m_tickets->GetCountTicketsByUserID("null"), 
			"OpenTicketsCount" => $this->m_tickets->GetCountOpenTickets("null"), 
			);
	}


	public function index()
	{$this->show("MyTickets");}

	public function show($HomeContent_AutoLoad = "")
	{
		//$this->template_vars['title'] .= "";
		$data = array(
			"template_vars" => $this->template_vars,
			"HomeContent_AutoLoad" => $HomeContent_AutoLoad,
			);
		LoadPage("pages/home_list", $data);
	}



	public function ajax_newTicket()
	{
		$data = array(
			"TicketStatusList" => $this->m_tickets->GetListTicketStatus(),
			"TicketGroupList" => $this->m_tickets->GetListTicketGroup(),
			"CustomerList" => $this->m_tickets->GetCustomerList(),
		);
		$this->load->view("forms/new_ticket", $data);
	}

	public function ajax_TicketEntriesForm($TicketID, $TicketEntryID = 0)
	{
		$data = array(
			"TicketID"=>$TicketID,	
			"TicketEntryID"=>$TicketEntryID,	
			"Email" => GetSessionVariable("Email"),
			"Descr" => "",
		);
		$this->load->view("forms/ticket_entry", $data);
	}

	
	public function iframe_file_upload()
	{$this->load->view("forms/file_upload");}

	public function file_upload_proc()
	{
		$config =  array(
			'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"]) . DIRECTORY_SEPARATOR . "files" . DIRECTORY_SEPARATOR,
			'upload_url'      => base_url()."files/",
			'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml",
			'overwrite'       => TRUE,
			'max_size'        => "1000KB",                 
		);
		$this->load->library('upload', $config);
		if($this->upload->do_upload("FileUpload"))
		{
			?>
			<script language="JavaScript">
				parent.SuccesfulUpload("<?=$_FILES['FileUpload']["name"]?>");
			</script>
			<?			
		}
		else
		{
			$errors = $this->upload->display_errors();
			print_rr($errors);;
			echo "file upload failed";
		}
		
		
	}

	public function ajax_NewTicketFormSubmitSave()
	{
		$FileUpload = $this->input->post("FileUpload");

		$TicketGroupID = $this->input->post("TicketGroupID");
		$TicketStatusID = $this->input->post("TicketStatusID");
		$CustomerID = $this->input->post("CustomerID");
		$Title = $this->input->post("Title");
		$CreatorEmail = $this->input->post("CreatorEmail");
		

		$TicketID = $this->m_tickets->SaveNewTicket($TicketGroupID, $TicketStatusID, $CustomerID, $Title, $CreatorEmail);

		$Descr = $this->input->post("Descr");
		$Email = $this->input->post("Email");

		$TicketEntryID = $this->m_tickets->SaveNewTicketEntry($TicketID, $Descr, $Email);

		$this->ProcessFileUpload($TicketID, $TicketEntryID, $FileUpload);

		$data = array(
			"TicketID" => $TicketID,
			"TicketEntryID" => $TicketEntryID,
			);
		print json_encode($data);

	}

	function ajax_NewTicketEntryFormSubmitSave()
	{
		$TicketID = $this->input->post("TicketID");
		$FileUpload = $this->input->post("FileUpload");
		$Descr = $this->input->post("Descr");
		$Email = $this->input->post("Email");
		$TicketEntryID = $this->m_tickets->SaveNewTicketEntry($TicketID, $Descr, $Email);

		$this->ProcessFileUpload($TicketID, $TicketEntryID, $FileUpload);

		$data = array(
			"TicketID" => $TicketID,
			"TicketEntryID" => $TicketEntryID,
			);
		print json_encode($data);
	}

	private function ProcessFileUpload($TicketID, $TicketEntryID, $FileUpload)
	{
		if(strlen(trim($FileUpload))>0)
		{
			$FileName = $FileUpload;
			$FilePath = dirname($_SERVER["SCRIPT_FILENAME"]) . DIRECTORY_SEPARATOR . "files" . DIRECTORY_SEPARATOR;
			$FilePath_file = $FilePath . $FileUpload;
			if(file_exists($FilePath_file))
			{
				$p = $FilePath . "tickets";
				if (!file_exists($p)) {mkdir($p);}
				$p .= DIRECTORY_SEPARATOR . $TicketID;
				if (!file_exists($p)) {mkdir($p);}
				$p .= DIRECTORY_SEPARATOR . $TicketEntryID;
				if (!file_exists($p)) {mkdir($p);}

				$info = new SplFileInfo($FilePath_file);
				$ext = STRTOLOWER($info->getExtension());
				$TicketEntryFileID = $this->m_tickets->InsertTicketEntryFile($TicketEntryID);
				$NewFilePath =  $p . DIRECTORY_SEPARATOR . $TicketEntryFileID . "." . $ext;
				rename($FilePath_file, $NewFilePath);

				$FilePathURL = base_url().'files/tickets/' . $TicketID . '/' . $TicketEntryID . '/' . $TicketEntryFileID . "." . $ext;
				$this->m_tickets->UpdateTicketEntryFile($TicketEntryFileID, $FileName, $FilePathURL, $ext);

			}
		}
	}

		
	public function ajax_MyTickets()
	{
		$UserID = GetSessionVariable("UserID");
		$Email = GetSessionVariable("Email");
		$PermissionLevel = GetSessionVariable("PermissionLevel");
		if($PermissionLevel <= 2)
		{
			//Ticketeer, Admin
		}
		$data = array(
			"PermissionLevel"          => $PermissionLevel,
			"TicketsAssignedToMe"      => "",
			"TicketsAssignedToMeCount" => 0,
			"TicketsStartedByMe"       => "",
			"TicketsStartedByMeCount"  => 0,
			
		);

		$TicketsAssignedToMe_data = $this->m_tickets->GetListTicketsByUserID($UserID);
		$TicketsStartedByMe_data  = $this->m_tickets->GetListTicketByCreatorEmail($Email);
		$data["TicketsAssignedToMe"] = $this->load->view("pages/ticket_table", array("Tickets"=>$TicketsAssignedToMe_data), true);
		$data["TicketsAssignedToMeCount"] = count($TicketsAssignedToMe_data);
		$data["TicketsStartedByMe"]  = $this->load->view("pages/ticket_table", array("Tickets"=>$TicketsStartedByMe_data), true);
		$data["TicketsStartedByMeCount"]  = count($TicketsStartedByMe_data);
		


		$this->load->view("pages/my_tickets", $data);
	}
	
	public function ajax_UnassignedTickets()
	{
		$data["UnassignedTickets"]   = $this->load->view("pages/ticket_table", array("Tickets"=>$this->m_tickets->GetListTicketsByUserID("null") ), true);
		$this->load->view("pages/unassigned_tickets", $data);
	}

	public function ajax_OpenTickets()
	{
		$data["OpenTickets"]   = $this->load->view("pages/ticket_table", array("Tickets"=>$this->m_tickets->GetListOpenTickets() ), true);
		$this->load->view("pages/open_tickets", $data);
	}

	public function view($TicketID)
	{
		$data = array(
			"template_vars" => $this->template_vars,
			"Ticket" => $this->m_tickets->GetTicketInfo($TicketID),	
			"Users" => $this->m_tickets->GetListUsers(),
			"TicketStatusList" => $this->m_tickets->GetListTicketStatus(),
			"TicketGroupList" => $this->m_tickets->GetListTicketGroup(),
			"TicketEntries" => $this->m_tickets->GetListTicketEntries($TicketID),
			"TicketEntryFiles" => $this->m_tickets->GetListTicketEntryFilesArray($TicketID),
		
		);		
		LoadPage("pages/ticket", $data);
	}
	
	public function ajax_TicketAttributeChange($Attribute, $TicketID, $AttributeID)
	{
		$AttributeFieldName = "";
		switch($Attribute)
		{
			case "User":
				$AttributeFieldName = "UserID";
				break;
			case "Status":
				$AttributeFieldName = "TicketStatusID";
				break;
			case "Group":
				$AttributeFieldName = "TicketGroupID";
				break;
			default:
				print json_encode(array("pass"=>false));
				return;
		}
		$this->m_tickets->TicketAttributeChange($AttributeFieldName, $AttributeID, $TicketID);
		print json_encode(array("pass"=>true));
	}
}

