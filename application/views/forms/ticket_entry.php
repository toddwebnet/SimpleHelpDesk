<fieldset>
	<legend>Description/Comments</legend>
	<?if($TicketID != 0):?>
	<form name="TicketEntryForm" id="TicketEntryForm" onsubmit="TicketEntryFormSubmit();return false">
	<input type="hidden" name="TicketID" value="<?=$TicketID?>" />
	<?endif;?>
	<input type="hidden" name="TicketEntryID" value="<?=$TicketEntryID?>"/>
	<input type="hidden" name="Email" value="<?=$Email?>"/>
	Comment/Description: <BR/>
	<textarea style="width: 500px;height:150px" maxlength="64000" id="TicketEntryForm_Descr" name="Descr"><?=$Descr?></textarea>
	<br/><br/><input type="checkbox" id="TicketEntryForm_FileUploadCheck" name="FileUpload" onclick="FileUploadCheckbox_click()" /> <label for="TicketEntryForm_FileUploadCheck">File Upload</label>
	<BR/>
	<div id="FileUploadForm"  style="display:none">
	<iframe id="FileUploadForm2" src="<?=base_url()?>tickets/iframe_file_upload" style="width:800px;height:50px;" border=1></iframe>
	</div>
	<?if($TicketID != 0):?>
	<div id="TicketEntryForm_err" class="msg warning" style="display:none"></div>
	<input type="submit" value="Save"/>
	</form>
	<?endif;?>
</fieldset>
