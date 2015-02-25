<h2>Ticket Status Form</h2>

<form name="TicketStatusForm" id="TicketStatusForm" onsubmit="TicketStatusFormSubmit();return false">
<input type="hidden" name="TicketStatusID" value="<?=$TicketStatus->TicketStatusID?>"/>

<fieldset style="width:500px">
<legend>Ticket Status Information</legend>
<table class="nostyle">
<tr>
	<td>Status Name</td>
	<td><input type="text" class="input-text" maxlength="32" name="StatusName" id="TicketStatusForm_StatusName" value="<?=$TicketStatus->StatusName?>" style="width:200px;" /></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" class="input-submit" value="Save"/>
	<?if($TicketStatus->TicketStatusID!=0 && $TicketStatusCount > 1):?>
	<input type="button" class="input-submit" value="Delete" style="margin-left:100px" onclick="TicketStatusDelete(<?=$TicketStatus->TicketStatusID?>)"/>
	<?endif;?>
	</td>
</tr>
</table>
</fieldset>
</form>