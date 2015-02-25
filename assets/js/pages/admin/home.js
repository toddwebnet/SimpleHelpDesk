function TicketStatusClick()
{
	animatedGif = "<img src='" + global_animated_gif + "'/><br>Loading...";
	$("#TicketStatus").html(animatedGif);
	URL = base_url + "admin/ajax_getTicketStatusList";
	$.ajax({
		url:URL,
		cache: false,		
		success:function(HTMLData) {
			$("#TicketStatus").html(HTMLData);
			$("#TicketStatusLoading").html(animatedGif);
		}
	});	

}

function AddNewTicketStatusClick()
{
	UpdateTicketStatusClick(0);
}

function UpdateTicketStatusClick(TicketStatusID)
{
	$("#TicketStatusLoading").show();
	
	$("#TicketStatusForm").html("");
	URL = base_url + "admin/ajax_getTicketStatusForm/" + TicketStatusID;
	$.ajax({
		url:URL,
		cache: false,		
		success:function(HTMLData) {
			$("#TicketStatusLoading").hide();
			$("#TicketStatusForm").html(HTMLData);
			$("#TicketStatusForm").show(255);
		}
	});	

}
function TicketStatusFormSubmit()
{
	$("#TicketStatusLoading").show();		
	
	URL = base_url + "admin/ajax_SaveTicketStatusForm/";
	FormData = $('form#TicketStatusForm').serialize();
	$("#TicketStatusForm").html("");
	$.ajax({
		url:URL,
		cache: false,
		type:'POST',		
		data: FormData,
		dataType: "json",
		success:function(data) {
			$("#TicketStatusLoading").hide();		
			if(data.pass==1)
				{TopMessageBarStart("Ticket Status Saved", "done");}
				else
				{TopMessageBarStart("An Error Occurred", "error");}
				TicketStatusClick();
		}
	});	
}

function TicketStatusDelete(TicketStatusID)
{
	if(confirm("Are You Sure"))
	{
		$("#TicketStatusLoading").show();
		
		$("#TicketStatusForm").html("");
		URL = base_url + "admin/ajax_TicketStatusDelete/" + TicketStatusID;
		$.ajax({
			url:URL,
			cache: false,
			dataType: "json",
			success:function(data) {				
				$("#TicketStatusLoading").hide();		
				if(data.pass==1)
				{TopMessageBarStart("Ticket Status Deleted", "done");}
				else
				{TopMessageBarStart("An Error Occurred", "error");}
				TicketStatusClick();
			}
		});	
	}
}


function TicketGroupClick()
{
	animatedGif = "<img src='" + global_animated_gif + "'/><br>Loading...";
	$("#TicketGroup").html(animatedGif);
	URL = base_url + "admin/ajax_getTicketGroupList";
	$.ajax({
		url:URL,
		cache: false,		
		success:function(HTMLData) {
			$("#TicketGroup").html(HTMLData);
			$("#TicketGroupLoading").html(animatedGif);
		}
	});	

}




function AddNewTicketGroupClick()
{
	UpdateTicketGroupClick(0);
}

function UpdateTicketGroupClick(TicketGroupID)
{
	$("#TicketGroupLoading").show();
	
	$("#TicketGroupForm").html("");
	URL = base_url + "admin/ajax_getTicketGroupForm/" + TicketGroupID;
	$.ajax({
		url:URL,
		cache: false,		
		success:function(HTMLData) {
			$("#TicketGroupLoading").hide();
			$("#TicketGroupForm").html(HTMLData);
			$("#TicketGroupForm").show(255);
		}
	});	

}
function TicketGroupFormSubmit()
{
	$("#TicketGroupLoading").show();		
	
	URL = base_url + "admin/ajax_SaveTicketGroupForm/";
	FormData = $('form#TicketGroupForm').serialize();
	$("#TicketGroupForm").html("");
	$.ajax({
		url:URL,
		cache: false,
		type:'POST',		
		data: FormData,
		dataType: "json",
		success:function(data) {
			$("#TicketGroupLoading").hide();		
			if(data.pass==1)
				{TopMessageBarStart("Ticket Group Saved", "done");}
				else
				{TopMessageBarStart("An Error Occurred", "error");}
				TicketGroupClick();
		}
	});	
}

function TicketGroupDelete(TicketGroupID)
{
	if(confirm("Are You Sure"))
	{
		$("#TicketGroupLoading").show();
		
		$("#TicketGroupForm").html("");
		URL = base_url + "admin/ajax_TicketGroupDelete/" + TicketGroupID;
		$.ajax({
			url:URL,
			cache: false,
			dataType: "json",
			success:function(data) {				
				$("#TicketGroupLoading").hide();		
				if(data.pass==1)
				{TopMessageBarStart("Ticket Group Deleted", "done");}
				else
				{TopMessageBarStart("An Error Occurred", "error");}
				TicketGroupClick();
			}
		});	
	}
}

