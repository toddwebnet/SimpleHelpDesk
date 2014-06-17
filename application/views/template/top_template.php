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

			<!-- Switcher <?if (false):?>
			<span class="f-left" id="switcher">
				<a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="<?=base_url();?>assets/design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="<?=base_url();?>assets/design/switcher-2col.gif" alt="2 Columns" /></a>
			</span>
			<?endif;?>-->
			Project: <strong>Simple Help Desk</strong>

		</p>
		
		<!--<?if (false):?>
		<p class="f-right">User: <strong><a href="#">Administrator</a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="#" id="logout">Log out</a></strong></p>
			<?endif;?>-->
	

	</div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	<div id="menu" class="box">
		<?if($UserID):?>
		<ul class="box f-right">
			<li>
			<div>
			
			<form id="SearchTickets" action="#" onSubmit="return false">
			
			<input type="text" name="SearchTicketsBox">
			</div>
			</form>
			</li>
		</ul>

		<ul class="box">
		
			<li id="menu-active"><a href="#"><span>My Tickets</span></a></li> <!-- Active -->
			<li><a href="#"><span>All Open Tickets</span></a></li>
			<li><a href="#"><span>Start New Ticket</span></a></li>

		</ul>
		<?endif;?>

	</div> <!-- /header -->

	<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">
		
		<?if (false):?>
		<!-- Aside (Left Column) -->
		<div id="aside" class="box">

			<div class="padding box">

				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="#"><img src="<?=base_url();?>assets/tmp/logo.gif" alt="Our logo" title="Visit Site" /></a></p>

				<!-- Search -->
				<form action="#" method="get" id="search">
					<fieldset>
						<legend>Search</legend>

						<p><input type="text" size="17" name="" class="input-text" />&nbsp;<input type="submit" value="OK" class="input-submit-02" /><br />
						<a href="javascript:toggle('search-options');" class="ico-drop">Advanced search</a></p>

						<!-- Advanced search -->
						<div id="search-options" style="display:none;">

							<p>
								<label><input type="checkbox" name="" checked="checked" /> Option I.</label><br />
								<label><input type="checkbox" name="" /> Option II.</label><br />
								<label><input type="checkbox" name="" /> Option III.</label>
							</p>

						</div> <!-- /search-options -->

					</fieldset>
				</form>

				<!-- Create a new project -->
				<p id="btn-create" class="box"><a href="#"><span>Create a new project</span></a></p>

			</div> <!-- /padding -->

			<ul class="box">
				<li><a href="#">Lorem ipsum</a></li>
				<li><a href="#">Lorem ipsum</a></li>
				<li><a href="#">Lorem ipsum</a></li>
				<li id="submenu-active"><a href="#">Active Page</a> <!-- Active -->
					<ul>
						<li><a href="#">Lorem ipsum</a></li>
						<li><a href="#">Lorem ipsum</a></li>
						<li><a href="#">Lorem ipsum</a></li>
						<li><a href="#">Lorem ipsum</a></li>
						<li><a href="#">Lorem ipsum</a></li>
					</ul>
				</li>
				<li><a href="#">Lorem ipsum</a></li>
				<li><a href="#">Lorem ipsum</a>
					<ul>
						<li><a href="#">Lorem ipsum</a></li>
						<li><a href="#">Lorem ipsum</a></li>
						<li><a href="#">Lorem ipsum</a></li>
					</ul>
                </li>
				<li><a href="#">Lorem ipsum</a></li>
			</ul>

		</div> <!-- /aside -->
		
		<hr class="noscreen" />
		<?endif;?>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
