<?='<?xml version="1.0"?>'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/main.css" /> <!-- MAIN STYLE SHEET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/2col.css" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/1col.css" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/style.css" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?=base_url();?>assets/css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
	<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/switcher.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/toggle.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/ui.core.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/ui.tabs.js"></script>

<link  rel="stylesheet" href="<?=base_url();?>assets/js/select2/select2.css" />
<script src="<?=base_url();?>assets/js/select2/select2.js"></script>

	<?=$extra_js?>
	<script type="text/javascript">
	var base_url = "<?=base_url()?>";
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
	</script>

	<script type="text/javascript" src="<?=base_url();?>assets/js/loadmask/loadmask.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/js/loadmask/loadmask.css" />
	<script type="text/javascript" src="<?=base_url();?>assets/js/SimpleHelpDesk.js"></script>	

	<title><?=$title?></title>
</head>

<body>

<div id="main">

	<!-- Tray -->
	<div id="tray" class="box">

		<p class="f-left box">			
			Project: <strong>Simple Help Desk</strong>

		</p>
		
		<?if (Is_Numeric(GetSessionVariable("UserID"))):?>
		<p class="f-right">User: <strong><a href="/user/info/<?=GetSessionVariable("UserID")?>"><?=GetSessionVariable("FirstName")?> <?=GetSessionVariable("LastName")?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="/login/out/" id="logout">Log out</a></strong></p>
		<?endif;?>
	

	</div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	<div id="menu" class="box">
		<?if($UserID):?>
		<ul class="box f-right">
			<li><a href="<?=base_url()?>admin/"><span><strong>Admin</strong></span></a></li>
		</ul>
		
		<ul class="box">
		
			<li id="menu-active"><a href="<?=base_url()?>tickets/show/MyTickets"><span>My Tickets(<?=$MyAssignedTicketsCount?>,<?=$MyStartedTicketsCount?>)</span></a></li> 
			<li id="menu-active"><a href="<?=base_url()?>tickets/show/Unassigned"><span>Unassigned Tickets (<?=$UnassignedTicketsCount?>)</span></a></li> 
			<li><a href="<?=base_url()?>tickets/show/OpenTickets"><span>All Open Tickets (<?=$OpenTicketsCount?>)</span></a></li>
			<li><a href="<?=base_url()?>tickets/show/NewTicket"><span>Start New Ticket</span></a></li>

		</ul>
		<?endif;?>

	</div> <!-- /header -->

	<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">
		
		
		<!-- Content (Right Column) -->
		<div id="content" class="box">
<div id="TopMessageBar" style="display:none"></div>