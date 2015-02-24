<input type="hidden" id="TicketID" value="<?=$Ticket->TicketID?>"/>
<h1 class="tit">Ticket: <?=FormatTicketID($Ticket->TicketID)?></h1>
<h2><?=$Ticket->Title?></h2>
<div style="white-space:nowrap;">
<b>Group: </b><select class="select2" style="width:250px" 
onchange="TicketAttributeChange('Group', <?=$Ticket->TicketID?>, this.value)">
<?foreach($TicketGroupList as $TicketGroup):?>
<option value="<?=$TicketGroup->TicketGroupID?>" <?=($Ticket->TicketGroupID==$TicketGroup->TicketGroupID)?"selected='selected'":""?>><?=$TicketGroup->GroupName?></option>
<?endforeach;?>
</select>

<b>Status</b>
<select class="select2" style="width:150px"
onchange="TicketAttributeChange('Status', <?=$Ticket->TicketID?>, this.value)">
<?foreach($TicketStatusList as $TicketStatus):?>
<option value="<?=$TicketStatus->TicketStatusID?>" <?=($Ticket->TicketStatusID==$TicketStatus->TicketStatusID)?"selected='selected'":""?>><?=$TicketStatus->StatusName?></option>
<?endforeach;?>
</select>



<b>Assigned To: </b>
<select class="select2" style="width:150px"
onchange="TicketAttributeChange('User', <?=$Ticket->TicketID?>, this.value)">
<option value="null">Unassigned</option>
<?foreach($Users as $User):?>
<option value="<?=$User->UserID?>" <?=($Ticket->UserID==$User->UserID)?"selected='selected'":""?>><?=$User->UserName?></option>
<?endforeach;?>
</select>

<b>Customer: </b><span class="input-text"><?=$Ticket->CustomerName?></span>
<b>Creator: </b><span class="input-text"><?=$Ticket->CreatorUserName?></span>
</div>
<div id="TicketEntriesNew"></div>


<a href="JavaScript:NewEntryButtonClick()" id="NewEntryButton">New Entry</a>
<?foreach($TicketEntries as $TicketEntry):?>
<fieldset><legend><?
if(strlen(trim($TicketEntry->UserName))> 0)
{print $TicketEntry->UserName;}
else
{print $TicketEntry->Email;}
?> - <?=$TicketEntry->CreateDate?></legend>
<?=$TicketEntry->Descr?>
<br/>
<?if(isset($TicketEntryFiles[$TicketEntry->TicketEntryID])):?>
<?foreach($TicketEntryFiles[$TicketEntry->TicketEntryID] as $File):?>
	
	
	<a href="<?=$File->FilePath?>" target="_blank"><img src="<?
	if(strpos("gif, jpg, png, jpeg", $File->FileExt)>=0)
	{print $File->FilePath;}
	else
	{
		switch($File->Ext)
		{
			case "pdf":
				print "/assets/images/pdf_icon.png";
				break;
			case "doc":
			case "docx":
				print "/assets/images/doc_icon.png";
				break;
			case "xls":
			case "xlsx":
				print "/assets/images/xls_icon.png";
				break;
			default:
				print "/assets/images/doc_icon.png";
				break;
		}
	}?>" height="50" /></a>
<?endforeach;?>
<?endif;?>

</fieldset>

<?endforeach;?>

