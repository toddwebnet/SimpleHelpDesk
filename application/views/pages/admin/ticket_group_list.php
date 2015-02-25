<h2 class="tit">Ticket Group List</h2>
<div style="float:left;padding-right:50px">
	<a href="JavaScript:AddNewTicketGroupClick()">Add New</a>
	<table>
		<tr>
		<th>Status</th>
		<th>&nbsp;</th>
		</tr>
		<?foreach($TicketGroupList as $TicketGroup):?>
		<tr><td><?=$TicketGroup->GroupName?></td>
		<td><a href="JavaScript:UpdateTicketGroupClick(<?=$TicketGroup->TicketGroupID?>)">edit</a>
		</tr>
		<?endforeach;?>
	</table>
</div>

<div id="TicketGroupLoading" style="display:none"></div>
<div id="TicketGroupForm" style="">
<div>
