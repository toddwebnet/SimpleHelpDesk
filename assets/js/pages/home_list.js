$(document).ready(function(){
	AutoLoad = $("#HomeContent_AutoLoad").val();
	switch(AutoLoad)
	{
		case "OpenTickets":
			StartOpenTicketsClick();
			break;
		case "MyTickets":
			StartMyTicketsClick();
			break;
		case "Unassigned":
			StartUnassignedTicketsClick();
			break;
		case "NewTicket":
			StartNewTicketClick();
			break;

		default:

	}
	$("select").select2();	
});


