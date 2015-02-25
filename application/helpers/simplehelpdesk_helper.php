<?
function GetTimeDiffString($Date1, $Date2)
{
	$Seconds =  strtotime($Date2) - strtotime($Date1);

	$Minutes = floor($Seconds/60);
	$Seconds = $Seconds - ($Minutes*60);
	
	$Hours =  floor($Minutes/60);
	$Minutes = $Minutes - ($Hours*60);
	
	$Days = floor($Hours/24);
	$Hours = $Hours - $Days * 24;
	
	$Weeks = floor($Days/7);
	$Days = $Days - $Weeks*7;

	if($Weeks > 0)
	{return $Weeks . " wk " . $Days . " d";}
	elseif($Days > 0)
	{return $Days . " d " . $Hours . " hr ";}
	elseif($Hours > 0)
	{return $Hours . " hr " . $Minutes . " min ";}
	elseif($Minutes > 0)
	{return $Minutes . " min " . $Seconds . " sec";}
	else
	{return $Seconds . " sec";}

}

function FormatTicketID($TicketID)
{
	$TicketString = trim($TicketID);
	for($x=strlen(trim($TicketID));$x<4;$x++)
	{
		$TicketString = "0" . $TicketString;
	}
	return $TicketString;
}