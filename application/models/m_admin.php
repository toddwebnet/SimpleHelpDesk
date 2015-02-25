<?php
class M_admin extends CI_Model {

	public function __construct() 
	{
		parent::__construct();

	}
	/////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////
	public function GetTicketStatusList()
	{
		$sql = "select TicketStatusID, StatusName from TicketStatus where IsActive = 1";
		return GetResultsFromQuery($this, $sql);
	}

	public function GetTicketStatus($TicketStatusID)
	{
		if($TicketStatusID == 0)
		{
			return (object)array(
				"TicketStatusID" => 0,
				"StatusName" => "",
				);
		}
		else
		{
			$TicketStatusID = $this->db->escape($TicketStatusID);
			$sql = "select TicketStatusID, StatusName from TicketStatus where TicketStatusID = " . $TicketStatusID;
			return GetFirstResultFromQuery($this, $sql);
		}
	}

	public function GetTicketStatusCount()
	{
			$sql = "select count(*) TicketStatusCount from TicketStatus where IsActive = 1";
			return GetFirstResultFromQuery($this, $sql)->TicketStatusCount;
	}

	public function SaveTicketStatus($TicketStatusID, $StatusName)
	{

		if($TicketStatusID == 0)
		{
			$sql = "insert into TicketStatus (StatusName, IsActive) values (" . dbText($StatusName) . ", 1)";
			$this->db->query($sql);
		}
		else
		{
			$sql = "update TicketStatus set StatusName = " . dbText($StatusName) . " where TicketStatusID = " . dbQuote($TicketStatusID);
			$this->db->query($sql);
		}
	}

	public function DeleteTicketStatus($TicketStatusID)
	{
		$sql = "update TicketStatus set IsActive = 0 where TicketStatusID = " . dbQuote($TicketStatusID);
		$this->db->query($sql);
		
	}

	/////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////
	public function GetTicketGroupList()
	{
		$sql = "select TicketGroupID, GroupName from TicketGroups where IsActive = 1";
		return GetResultsFromQuery($this, $sql);
	}

	public function GetTicketGroup($TicketGroupID)
	{
		if($TicketGroupID == 0)
		{
			return (object)array(
				"TicketGroupID" => 0,
				"GroupName" => "",
				);
		}
		else
		{
			$TicketStatusID = $this->db->escape($TicketGroupID);
			$sql = "select TicketGroupID, GroupName from TicketGroups where TicketGroupID = " . $TicketGroupID;
			return GetFirstResultFromQuery($this, $sql);
		}
	}

	public function GetTicketGroupCount()
	{
			$sql = "select count(*) TicketGroupCount from TicketGroups where IsActive = 1";
			return GetFirstResultFromQuery($this, $sql)->TicketGroupCount;
	}

	public function SaveTicketGroup($TicketGroupID, $GroupName)
	{

		if($TicketGroupID == 0)
		{
			$sql = "insert into TicketGroups (GroupName, IsActive) values (" . dbText($GroupName) . ", 1)";
			$this->db->query($sql);
		}
		else
		{
			$sql = "update TicketGroups set GroupName = " . dbText($GroupName) . " where TicketGroupID = " . dbQuote($TicketGroupID);
			$this->db->query($sql);
		}
	}

	public function DeleteTicketGroup($TicketGroupID)
	{
		$sql = "update TicketGroups set IsActive = 0 where TicketGroupID = " . dbQuote($TicketGroupID);
		$this->db->query($sql);
		
	}
}