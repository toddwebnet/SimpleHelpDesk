

$(document).ready(function(){
	
	$('form#Login').submit(function(e){
		e.preventDefault();
		LoginFormProc();
	});

});

function LoginFormProc()
{
	AjaxStartLoading();
	$("#Login_err").hide(255);
	URL = base_url + "login/a_proc_login";
	$.ajax({
		url:URL,
		cache: false,
		type:'POST',		
		data: $('form#Login').serialize(),
		dataType: "json",
		success:function(data) {
			AjaxStopLoading();
			if(data.pass==1)
			{document.location = base_url;}
			else
			{
				$("#Login_err").html("Invalid Security Credentials");
				$("#Login_err").show(255);
			}
		}
	});	

}