<h1 class="tit">My Tickets</h1>


<?if ($TicketsAssignedToMeCount>0):?>
	<h3 class="tit">Tickets Assigned to Me (Count: <?=$TicketsAssignedToMeCount?>)</h3>	
	<?=$TicketsAssignedToMe;?>
<?endif;?>
<?if ($TicketsStartedByMeCount>0):?>
	<h3 class="tit">Tickets Started by Me (Count: <?=$TicketsStartedByMeCount?>)</h3>
	<?=$TicketsStartedByMe;?>
<?endif;?>


<?if ($TicketsStartedByMeCount + $TicketsAssignedToMeCount == 0):?>
No Tickets To Show
<?endif;?>