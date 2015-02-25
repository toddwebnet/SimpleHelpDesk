<?if($Tickets):?>
	<table style="width:100%">
	<tr>
		<th>&nbsp;</th>
		<th>Created By</th>
		<th>Group</th>
		<th>Title</th>
		<th>Status</th>
		<th>Owner</th>
		<th>Age</th>
		<th>Last Touch</th>
	</tr>
	<?foreach($Tickets as $Ticket):?>
	<tr>
		<td style="text-align:center"><a href="<?=base_url()?>tickets/view/<?=$Ticket->TicketID?>">View</a></td>
		<td><?=(strlen(trim($Ticket->CreatorUserName))>0)?$Ticket->CreatorUserName:$Ticket->CreatorEmail?></td>
		<td><?=$Ticket->GroupName?></td>
		<td><?=$Ticket->Title?></td>
		<td><?=$Ticket->StatusName?></td>
		<td><?=$Ticket->AssignedToUserName?></td>
		<td><?=GetTimeDiffString($Ticket->TicketCreateDate, $Ticket->Now)?></td>
		<td><?=GetTimeDiffString($Ticket->LastTouchDate, $Ticket->Now)?></td>
	</tr>
	<?endforeach;?>
	</table>
<?else:?>
<p style="margin-left:7px;">No Tickets</p>
<?endif;?>