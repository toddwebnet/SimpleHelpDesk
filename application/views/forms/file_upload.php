<form id="FileForm" action="<?=base_url()?>tickets/file_upload_proc" method="POST" enctype="multipart/form-data" >
	<input type="file" name="FileUpload" id="FileUpload"/>
</form>
<script language="JavaScript">



function SubmitFileForm()
{
	cff = CheckFileForm();
	if( cff == "pass")
	{
		document.getElementById("FileForm").submit();
	}
	else
	{alert(cff);}
}

function CheckFileForm()
{
	filename = document.getElementById("FileUpload").value;
	if(filename=="")
	{return "Please Select a File For Upload";}
	allowable = "gif, jpg, png, jpeg, pdf, doc, docx, xls, xlsx";
	ext = GetFileExt(filename);
	if(!(allowable.indexOf(ext) > -1))
	{return "Only the following file types may be uploaded: " + allowable;}
	
	return "pass";

}

function GetFileExt(filename)
{
	return filename.split('.').pop();
}

</script>