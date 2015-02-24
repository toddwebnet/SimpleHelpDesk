<h1>Admin</h1>

<input type="hidden" id="HomeContent_AutoLoad" value="<?=$HomeContent_AutoLoad?>" />
<div id="HomeContent">


<h3 class="tit">Tabs</h3>

			<div class="tabs box">
				<ul class="ui-tabs-nav">
					<li class="ui-tabs-selected"><a href="#TicketStatus" onclick="TicketStatusClick()"><span>Ticket Status</span></a></li>
					<li><a href="#TicketGroup" onclick="TicketGroupClick()"><span>Ticket Groups</span></a></li>
					<li><a href="#tab03"><span>Lorem ipsum</span></a></li>
				</ul>
			</div> <!-- /tabs -->

			<!-- Tab01 -->
			<div style="display: block;" class="ui-tabs-panel" id="TicketStatus">				
			</div> <!-- /tab01 -->

			<!-- Tab02 -->
			<div class="ui-tabs-panel ui-tabs-hide" id="TicketGroup">
			</div> <!-- /tab02 -->

			<!-- Tab03 -->
			<div class="ui-tabs-panel ui-tabs-hide" id="tab03">
			</div> <!-- /tab03 -->

</div>
<script language="JavaScript">
$(document).ready(function(){
	TicketStatusClick();
});
</script>