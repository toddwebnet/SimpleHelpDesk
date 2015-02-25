<h2 class="tit">Ticket Status List</h2>
<div style="float:left;padding-right:50px">
	<a href="JavaScript:AddNewTicketStatusClick()">Add New</a>
	<table>
		<tr>
		<th>Status</th>
		<th>&nbsp;</th>
		</tr>
		<?foreach($TicketStatusList as $TicketStatus):?>
		<tr><td><?=$TicketStatus->StatusName?></td>
		<td><a href="JavaScript:UpdateTicketStatusClick(<?=$TicketStatus->TicketStatusID?>)">edit</a>
		</tr>
		<?endforeach;?>
	</table>
</div>

<div id="TicketStatusLoading" style="display:none"></div>
<div id="TicketStatusForm" style="">
<div>
