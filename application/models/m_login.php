<?php
class M_login extends CI_Model {

	public function __construct() 
	{
		parent::__construct();

	}

	function validate_login($email, $password)
	{		
		$password = md5($password);
		$sql = "select count(*) count from Users where email = " . dbText($email) . " and password = " . dbText($password);
		$c = GetFirstResultFromQuery($this, $sql);
		if($c->count == 0)
		{return $c;}
		else
		{
			$sql = "select 1 count, UserID, FirstName, LastName, PermissionLevel
			from Users u 
			inner join UserRoles ur on ur.UserRoleID = u.UserRoleID 
			where u.email = " . dbText($email);
			return GetFirstResultFromQuery($this, $sql);					
		}		
	}
}
