<?
$UserCustomerID = GetSessionVariable("CustomerID");

$CustomerID = $UserCustomerID;
$TicketStatusID = 1;
$TicketGroupID = 0;
?>
<h1 class="tit">New Ticket</h1>


	<form name="NewTicketForm" id="NewTicketForm" onsubmit="NewTicketFormSubmit();return false;">
	<fieldset>
	<legend>Ticket Information</legend>

	<table class="nostyle">
	<tbody>
	<tr>
	<td>Status:</td>
	<td>
		<select class="select2" name="TicketStatusID" id="NewTicketForm_TicketStatus" style="width:150px" disabled="disabled">
		<?foreach($TicketStatusList as $TicketStatus):?>
		<option value="<?=$TicketStatus->TicketStatusID?>" <?=($TicketStatusID==$TicketStatus->TicketStatusID)?"selected":"";?>><?=$TicketStatus->StatusName?></option>
		<?endforeach;?>
		</select>
	</td>
	</tr>

	<tr>
	<td>Ticket Group</td>
	<td>
		<select class="select2" name="TicketGroupID" id="NewTicketForm_TicketGroup" style="width:300px">
		<?foreach($TicketGroupList as $TicketGroup):?>
		<option value="<?=$TicketGroup->TicketGroupID?>" <?=($TicketGroupID==$TicketGroup->TicketGroupID)?"selected":"";?>><?=$TicketGroup->GroupName?></option>
		<?endforeach;?>
		</select>

	</td>
	</tr>


	<tr>
	<td>Customer: </td>
	<td>
		<select class="select2" name="CustomerID" id="NewTicketForm_Customer" style="width:300px" disabled="disabled">
		<?foreach($CustomerList as $Customer):?>
		<option value="<?=$Customer->CustomerID?>" <?=($CustomerID==$Customer->CustomerID)?"selected":"";?>><?=$Customer->CustomerName?></option>
		<?endforeach;?>
		</select>

	</td>
	</tr>


	<tr>
	<td>Title: </td>
	<td>
	<input class="input-text" type="text" name="Title" id="NewTicketForm_Title" maxlength="255" style="width:300px">
	</td>
	</tr>

	<tr>
	<td>Creator: </td>
	<td>
	<input type="hidden" name="CreatorEmail" value="<?=GetSessionVariable("Email")?>" />
	<?=GetSessionVariable("FirstName")?> <?=GetSessionVariable("LastName")?>
	</td>
	</tr>
	</tbody>
	</table>
	</fieldset>
	<div id="TicketEntriesNew"></div>
	<div id="NewTicketForm_err" class="msg warning" style="display:none"></div>
	<input type="Submit" value="Save" />
	<input type="Button" value="Go" onclick="NewTicketFormSubmit()"/>

</form>