<h2>Ticket Status Form</h2>

<form name="TicketGroupForm" id="TicketGroupForm" onsubmit="TicketGroupFormSubmit();return false">
<input type="hidden" name="TicketGroupID" value="<?=$TicketGroup->TicketGroupID?>"/>

<fieldset style="width:500px">
<legend>Ticket Group Information</legend>
<table class="nostyle">
<tr>
	<td>Status Name</td>
	<td><input type="text" class="input-text" maxlength="32" name="GroupName" id="TicketGroupForm_GroupName" value="<?=$TicketGroup->GroupName?>" style="width:200px;" /></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" class="input-submit" value="Save"/>
	<?if($TicketGroup->TicketGroupID!=0 && $TicketGroupCount > 1):?>
	<input type="button" class="input-submit" value="Delete" style="margin-left:100px" onclick="TicketGroupDelete(<?=$TicketGroup->TicketGroupID?>)"/>
	<?endif;?>
	</td>
</tr>
</table>
</fieldset>
</form>