<?php
class M_tickets extends CI_Model {

	public function __construct() 
	{
		parent::__construct();

	}

	function GetListTicketStatus()
	{
		$sql = "select TicketStatusID, StatusName from TicketStatus where IsActive = 1";
		return GetResultsFromQuery($this, $sql);					
	}

	function getListTicketGroup()
	{
		$sql = "select TicketGroupID, GroupName from TicketGroups where IsActive = 1";
		return GetResultsFromQuery($this, $sql);
	}

	function GetCustomerList()
	{
		$sql = "select CustomerID, CustomerName from Customers where IsActive = 1 order by CustomerName";
		return GetResultsFromQuery($this, $sql);					
	}

	
	function InsertTicketEntryFile($TicketEntryID)
	{
			$sql = "insert into TicketEntryFiles(TicketEntryID, CreateDate) value (" . dbQuote($TicketEntryID) . ", NOW())";
			$this->db->query($sql);

			return GetOneField("max(TicketEntryFileID)", "TicketEntryFiles", "TicketEntryID", $TicketEntryID);
			
	}

	function UpdateTicketEntryFile($TicketEntryFileID, $FileName, $FilePath, $FileExt)
	{
			$sql = "update TicketEntryFiles set 
			FileName = " . dbText($FileName, 255) . ", 
			FilePath = " . dbText($FilePath, 255) . ", 
			FileExt = " . dbText($FileExt, 8) . "
			where TicketEntryFileID = " . dbQuote($TicketEntryFileID);
			$this->db->query($sql);
			
	}


	function SaveNewTicket($TicketGroupID, $TicketStatusID, $CustomerID, $Title, $CreatorEmail)
	{
		$sql = "insert into Tickets(TicketGroupID, TicketStatusID, CustomerID, Title, CreatorEmail, CreateDate,  IsActive) values (" . dbQuote($TicketGroupID) . ", " . dbQuote($TicketStatusID) . ", " . dbQuote($CustomerID) . ", " . dbText($Title, 255) . ", " . dbText($CreatorEmail, 255) . ", NOW(), 1)";
		
		$this->db->query($sql);

		return GetOneField("max(TicketID)", "Tickets", "CreatorEmail", $CreatorEmail);
	}

	function SaveNewTicketEntry($TicketID, $Descr, $Email)
	{

		$sql = "insert into TicketEntries (TicketID, Descr, Email, CreateDate, IsActive) values (" . dbQuote($TicketID) . ", " . dbText($Descr, 64000) . ", " . dbText($Email, 255) . ", NOW(), 1)";

		$this->db->query($sql);

		return GetOneField("max(TicketEntryID)", "TicketEntries", "Email", $Email);	
	}

	function GetListTicketsByUserID($UserID)
	{
		$Condition = ($UserID == "null")?"is":"=";
 
		$sql = "
			select 
				t.TicketID, 
				concat(u.FirstName , ' ', u.LastName) AssignedToUserName, 
				concat(u2.FirstName , ' ', u2.LastName) CreatorUserName, 
				t.CreatorEmail, 			
				tg.GroupName, 
				ts.StatusName,
				t.Title, 
				t.CreateDate TicketCreateDate, 
				max(te.CreateDate) LastTouchDate,
				NOW() Now
			from 
			Tickets t
			inner join TicketStatus ts on ts.TicketStatusID = t.TicketStatusID
			inner join TicketGroups tg on tg.TicketGroupID = t.TicketGroupID
			inner join Customers c on c.CustomerID = t.CustomerID
			left outer join Users u on u.UserID = t.UserID
			left outer join Users u2 on u2.Email = t.CreatorEmail
			left outer join TicketEntries te on te.TicketID = t.TicketID
			where t.IsActive = 1 and ts.StatusName != 'Closed'
			and t.UserID  " . $Condition . " " . dbQuote($UserID) . "
			group by 
				t.TicketID, 
				concat(u.FirstName , ' ', u.LastName), 
				concat(u2.FirstName , ' ', u2.LastName), 
				t.CreatorEmail, 			
				tg.GroupName, 
				ts.StatusName,
				t.Title, 
				t.CreateDate";

		return GetResultsFromQuery($this, $sql);		
	}

	function GetCountTicketsByUserID($UserID)
	{
		$Condition = ($UserID == "null")?"is":"=";
 
		$sql = "
			select 
				count(*) NumTickets
			from 
			Tickets t
			inner join TicketStatus ts on ts.TicketStatusID = t.TicketStatusID
			inner join TicketGroups tg on tg.TicketGroupID = t.TicketGroupID
			inner join Customers c on c.CustomerID = t.CustomerID
			left outer join Users u on u.UserID = t.UserID
			left outer join Users u2 on u2.Email = t.CreatorEmail
			where t.IsActive = 1 and ts.StatusName != 'Closed'
			and t.UserID  " . $Condition . " " . dbQuote($UserID);
		return GetFirstResultFromQuery($this, $sql)->NumTickets;
	}
	function GetListTicketByCreatorEmail($CreatorEmail)
	{
		$sql = "
			select 
				t.TicketID, 
				concat(u.FirstName , ' ', u.LastName) AssignedToUserName, 
				concat(u2.FirstName , ' ', u2.LastName) CreatorUserName, 
				t.CreatorEmail, 			
				tg.GroupName, 
				ts.StatusName,
				t.Title, 
				t.CreateDate TicketCreateDate, 
				max(te.CreateDate) LastTouchDate,
				NOW() Now
			from 
			Tickets t
			inner join TicketStatus ts on ts.TicketStatusID = t.TicketStatusID
			inner join TicketGroups tg on tg.TicketGroupID = t.TicketGroupID
			inner join Customers c on c.CustomerID = t.CustomerID
			left outer join Users u on u.UserID = t.UserID
			left outer join Users u2 on u2.Email = t.CreatorEmail
			left outer join TicketEntries te on te.TicketID = t.TicketID
			where t.IsActive = 1 and ts.StatusName != 'Closed'
			and t.CreatorEmail = " . dbText($CreatorEmail) . "
			group by 
				t.TicketID, 
				concat(u.FirstName , ' ', u.LastName), 
				concat(u2.FirstName , ' ', u2.LastName), 
				t.CreatorEmail, 			
				tg.GroupName, 
				ts.StatusName,
				t.Title, 
				t.CreateDate";

		return GetResultsFromQuery($this, $sql);		
	}
	function GetCountTicketByCreatorEmail($CreatorEmail)
	{
		$sql = "
			select 
				count(*) NumTickets
			from 
			Tickets t
			inner join TicketStatus ts on ts.TicketStatusID = t.TicketStatusID
			inner join TicketGroups tg on tg.TicketGroupID = t.TicketGroupID
			inner join Customers c on c.CustomerID = t.CustomerID
			left outer join Users u on u.UserID = t.UserID
			left outer join Users u2 on u2.Email = t.CreatorEmail
			where t.IsActive = 1 and ts.StatusName != 'Closed'
			and t.CreatorEmail = " . dbText($CreatorEmail);
		return GetFirstResultFromQuery($this, $sql)->NumTickets;
	}

	function GetListOpenTickets()
	{
		$sql = "
			select 
				t.TicketID, 
				concat(u.FirstName , ' ', u.LastName) AssignedToUserName, 
				concat(u2.FirstName , ' ', u2.LastName) CreatorUserName, 
				t.CreatorEmail, 			
				tg.GroupName, 
				ts.StatusName,
				t.Title, 
				t.CreateDate TicketCreateDate, 
				max(te.CreateDate) LastTouchDate,
				NOW() Now
			from 
			Tickets t
			inner join TicketStatus ts on ts.TicketStatusID = t.TicketStatusID
			inner join TicketGroups tg on tg.TicketGroupID = t.TicketGroupID
			inner join Customers c on c.CustomerID = t.CustomerID
			left outer join Users u on u.UserID = t.UserID
			left outer join Users u2 on u2.Email = t.CreatorEmail
			left outer join TicketEntries te on te.TicketID = t.TicketID
			where t.IsActive = 1 and ts.StatusName != 'Closed'
			group by 
				t.TicketID, 
				concat(u.FirstName , ' ', u.LastName), 
				concat(u2.FirstName , ' ', u2.LastName), 
				t.CreatorEmail, 			
				tg.GroupName, 
				ts.StatusName,
				t.Title, 
				t.CreateDate
			";
		return GetResultsFromQuery($this, $sql);
	}

	function GetCountOpenTickets()
	{
		$sql = "
			select count(*) NumTickets
			from 
			Tickets t
			inner join TicketStatus ts on ts.TicketStatusID = t.TicketStatusID
			inner join TicketGroups tg on tg.TicketGroupID = t.TicketGroupID
			inner join Customers c on c.CustomerID = t.CustomerID
			left outer join Users u on u.UserID = t.UserID
			left outer join Users u2 on u2.Email = t.CreatorEmail
			where t.IsActive = 1 and ts.StatusName != 'Closed'
			";
		return GetFirstResultFromQuery($this, $sql)->NumTickets;
	}


	function GetTicketInfo($TicketID)	
	{
		$sql = "
			select 
				t.TicketID, 
				u.UserID, 
				concat(u.FirstName , ' ', u.LastName) AssignedToUserName, 
				concat(u2.FirstName , ' ', u2.LastName) CreatorUserName, 
				t.CreatorEmail,
				t.TicketGroupID,
				tg.GroupName, 
				t.TicketStatusID,
				ts.StatusName,
				c.CustomerName, 
				t.Title, 
				t.CreateDate TicketCreateDate, 
				max(te.CreateDate) LastTouchDate,
				NOW() Now
			from 
			Tickets t
			inner join TicketStatus ts on ts.TicketStatusID = t.TicketStatusID
			inner join TicketGroups tg on tg.TicketGroupID = t.TicketGroupID
			inner join Customers c on c.CustomerID = t.CustomerID
			left outer join Users u on u.UserID = t.UserID
			left outer join Users u2 on u2.Email = t.CreatorEmail
			left outer join TicketEntries te on te.TicketID = t.TicketID
			where t.IsActive = 1 and ts.StatusName != 'Closed'
			and t.TicketID = " . dbQuote($TicketID);
		return GetFirstResultFromQuery($this, $sql);

	}

	function GetListUsers()
	{
		$sql = "
		select
			UserID, 
			concat(FirstName, ' ', LastName) UserName
			from Users u 
			inner join UserRoles ur on ur.UserRoleID = u.UserRoleID
			where ur.PermissionLevel <=2
			order by concat(FirstName, ' ', LastName)
		";
		return GetResultsFromQuery($this, $sql);
	}

	function TicketAttributeChange($AttributeFieldName, $AttributeID, $TicketID)
	{
		$sql = "update Tickets set " . dbQuote($AttributeFieldName) . " = " . dbQuote($AttributeID) . " where TicketID = " . dbQuote($TicketID);
		$this->db->query($sql);
	}

	function GetListTicketEntries($TicketID)
	{		
		$sql = "select te.TicketEntryID, te.Descr, 
		concat(u.FirstName , ' ', u.LastName) UserName, 
		te.Email Email,
		te.CreateDate
		from TicketEntries te
		left outer join Users u on u.Email = te.Email
		where te.TicketID = " . dbQuote($TicketID) . "
		and te.IsActive = 1
		order by te.CreateDate desc";		
		return GetResultsFromQuery($this, $sql);
	}

	function GetListTicketEntryFilesArray($TicketID)
	{
		$sql = " select tef.TicketEntryID, tef.FileName, tef.FilePath, tef.FileExt, tef.CreateDate 
		from TicketEntryFiles tef
		inner join TicketEntries te on te.TicketEntryID = tef.TicketEntryID
		where Te.TicketID = " . dbQuote($TicketID);
		$Files = GetResultsFromQuery($this, $sql);
		$r = array();
		foreach($Files as $File)
		{
			$r[$File->TicketEntryID][] = $File;
		}
		return $r;
	}
}
