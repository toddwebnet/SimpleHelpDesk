$.fn.hasAttr = function(name) {  
   return this.attr(name) !== undefined;
};

var global_animated_gif = "/assets/images/spiderman-dancing.gif";


function Select2_Engage()
{
	$('select').select2({"minimumResultsForSearch":8});
}

function AjaxStartLoading()
{
	
	img_src= global_animated_gif;
	html = "<div style='text-align:center;border:0px;'><img src=\"" + img_src + "\"><br>Waiting for content to load...</div>";
	$("body").mask(html);
}
function AjaxStopLoading()
{
	$("body").unmask();
}

function TopMessageBarStart(msg, cssClass)
{

	html = "<p class=\"msg " + cssClass + "\">" + msg + "</p>";
	$("#TopMessageBar").html(html);
	$("#TopMessageBar").show(255);
	setTimeout("TopMessageBarEnd()", 10000);
	/*
	<p class="msg warning">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
	<p class="msg info">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
	<p class="msg done">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
	<p class="msg error">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
	*/
}
function TopMessageBarEnd()
{
	$("#TopMessageBar").html("");
	$("#TopMessageBar").hide(255);
}

function StartMyTicketsClick()
{
	AjaxStartLoading();	
	URL = base_url + "tickets/ajax_MyTickets";
	$.ajax({
		url:URL,
		cache: false,		
		success:function(HTMLData) {
			AjaxStopLoading();
			$("#HomeContent").hide(255);
			$("#HomeContent").html("");			
			$("#HomeContent").html(HTMLData);		
			$("#HomeContent").show(255);				
		}
	});	
}
function StartOpenTicketsClick()
{
	AjaxStartLoading();	
	URL = base_url + "tickets/ajax_OpenTickets";
	$.ajax({
		url:URL,
		cache: false,		
		success:function(HTMLData) {
			AjaxStopLoading();
			$("#HomeContent").hide(255);
			$("#HomeContent").html("");			
			$("#HomeContent").html(HTMLData);		
			$("#HomeContent").show(255);				
		}
	});	
}
function StartUnassignedTicketsClick()
{
	AjaxStartLoading();	
	URL = base_url + "tickets/ajax_UnassignedTickets";
	$.ajax({
		url:URL,
		cache: false,		
		success:function(HTMLData) {
			AjaxStopLoading();
			$("#HomeContent").hide(255);
			$("#HomeContent").html("");			
			$("#HomeContent").html(HTMLData);		
			$("#HomeContent").show(255);				
		}
	});	
}
function StartNewTicketClick()
{
	AjaxStartLoading();	
	URL = base_url + "tickets/ajax_newTicket";
	$.ajax({
		url:URL,
		cache: false,		
		success:function(HTMLData) {
			AjaxStopLoading();
			$("#HomeContent").hide(255);
			$("#HomeContent").html("");			
			$("#HomeContent").html(HTMLData);		
			$("#HomeContent").show(255);	
			Select2_Engage();
			TicketEntriesForm(0);
		}
	});	

}
function TicketEntriesForm(TicketID)
{
	AjaxStartLoading();	
	URL = base_url + "tickets/ajax_TicketEntriesForm/" + TicketID;
	$.ajax({
		url:URL,
		cache: false,
		success:function(HTMLData) {
			AjaxStopLoading();
			$("#TicketEntriesNew").hide(255);
			$("#TicketEntriesNew").html("");			
			$("#TicketEntriesNew").html(HTMLData);		
			$("#TicketEntriesNew").show(255);	
			Select2_Engage();
		}
	});	
}

function FileUploadCheckbox_click()
{
	if(document.getElementById("TicketEntryForm_FileUploadCheck").checked)
	{$("#FileUploadForm").show(255);}
	else
	{$("#FileUploadForm").hide(255);}
	
}

function SuccesfulUpload(FileName)
{
	if ($('form#NewTicketForm').length > 0) { 
    NewTicketFormSubmitSave(FileName);
	}
	else
	{
		NewTicketEntryFormSubmitSave(FileName);
	}
}
function NewTicketFormSubmitSave(FileName)
{
	$("#TicketEntryForm_FileUploadCheck").val(FileName);
	//AjaxStartLoading();	
	URL = base_url + "tickets/ajax_NewTicketFormSubmitSave";
	
	if(TicketStatusDisabled)
	{$("#NewTicketForm_TicketStatus").removeAttr('disabled');}
	if(CompanyDisabled)
	{$("#NewTicketForm_Customer").removeAttr('disabled');}

	FormData = $('form#NewTicketForm').serialize();
	
	if(TicketStatusDisabled)
	{$("#NewTicketForm_TicketStatus").attr('disabled','disabled');}
	if(CompanyDisabled)
	{$("#NewTicketForm_Customer").attr('disabled','disabled');}
	
	$.ajax({
		url:URL,
		cache: false,
		type:'POST',		
		data: FormData,
		dataType: "json",
		success:function(data) {			
			if(data.TicketEntryID && data.TicketID)
			{
				document.location =base_url;
			}
			else
			{alert("You Failed!");}

			AjaxStopLoading();
			
		}
	});	
}

function NewTicketFormSubmit()
{

	TicketStatusDisabled = $("#NewTicketForm_TicketStatus").hasAttr('disabled');
	CompanyDisabled = $("#NewTicketForm_Customer").hasAttr('disabled');


	$("#NewTicketForm_err").hide(255);
	$("#NewTicketForm_err").html("");

	err=0;errMsg = "";
	if($("#NewTicketForm_TicketStatus").val()==0)
	{err=1;errMsg+="Please Select a Ticket Status<br/>";}
	if($("#NewTicketForm_TicketGroup").val()==0)
	{err=1;errMsg+="Please Select a Ticket Group<br/>";}
	if($("#NewTicketForm_Customer").val()==0)
	{err=1;errMsg+="Please Select a Customer<br/>";}
	if($("#NewTicketForm_Title").val().trim()=="")
	{err=1;errMsg+="Please Enter a Title<br/>";}
	if($("#TicketEntryForm_Descr").val().trim()=="")
	{err=1;errMsg+="Please Enter a Comment/Description<br/>";}
	if(document.getElementById("TicketEntryForm_FileUploadCheck").checked)
	{		
		CheckForm = document.getElementById('FileUploadForm2').contentWindow.CheckFileForm();
		
		if(CheckForm != "pass")
		{err=1;errMsg+=CheckForm + "<br/>";}
	}	
	if(err==1)
	{
		$("#NewTicketForm_err").html(errMsg);
		$("#NewTicketForm_err").show(255);
		return false;
	}
	if(document.getElementById("TicketEntryForm_FileUploadCheck").checked)
	{
		document.getElementById('FileUploadForm2').contentWindow.SubmitFileForm();		
	}
	else
	{NewTicketFormSubmitSave("");}

	
	
}

function TicketEntryFormSubmit()
{
	$("#TicketEntryForm_err").hide(255);
	$("#TicketEntryForm_err").html("");
	
	err=0;
	errMsg="";
	if($("#TicketEntryForm_Descr").val().trim()=="")
	{err=1;errMsg+="Please Enter a Comment/Description<br/>";}
	if(document.getElementById("TicketEntryForm_FileUploadCheck").checked)
	{		
		CheckForm = document.getElementById('FileUploadForm2').contentWindow.CheckFileForm();		
		if(CheckForm != "pass")
		{err=1;errMsg+=CheckForm + "<br/>";}
	}	
	if(err==1)
	{
		$("#TicketEntryForm_err").html(errMsg);
		$("#TicketEntryForm_err").show(255);
	}
	else
	{
		if(document.getElementById("TicketEntryForm_FileUploadCheck").checked)
		{document.getElementById('FileUploadForm2').contentWindow.SubmitFileForm();}
		else
		{NewTicketEntryFormSubmitSave("")}
	}
}

function NewTicketEntryFormSubmitSave(FileName)
{
	$("#TicketEntryForm_FileUploadCheck").val(FileName);
	AjaxStartLoading();	
	URL = base_url + "tickets/ajax_NewTicketEntryFormSubmitSave";	
	FormData = $('form#TicketEntryForm').serialize();
	
	$.ajax({
		url:URL,
		cache: false,
		type:'POST',		
		data: FormData,
		dataType: "json",
		success:function(data) {			
			AjaxStopLoading();
			if(data.TicketEntryID && data.TicketID)
			{
				document.location =base_url + 'tickets/view/' + data.TicketID;
			}
			else
			{
				alert('something went wrong');
			}
			
			
		}
	});	
}

