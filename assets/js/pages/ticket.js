
$(document).ready(function(){
	Select2_Engage();

	
});

function NewEntryButtonClick()
{
	$("#NewEntryButton").hide(255);
	TicketEntriesForm($("#TicketID").val());
}

function TicketAttributeChange(Attribute, TicketID, AttributeID)
{
	AjaxStartLoading();	
	URL = base_url + "tickets/ajax_TicketAttributeChange/" + Attribute + "/" + TicketID + "/" + AttributeID;
	$.ajax({
		url:URL,
		cache: false,	
		dataType: "json",
		success:function(Data) {
			AjaxStopLoading();		
			if(!Data.pass)
			{alert("oops... something happened");}
		}
	});	
}