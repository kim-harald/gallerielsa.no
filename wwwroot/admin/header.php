<div id="Header">
	 <div class="banner">
	 <a href="/">
	 	<img src="/images/logo_4.svg">
	 </a>
	</div>
	<nav role="navigation" class="navbar navbar-default">
		<div class="navbar-header">
			<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div id="navbarCollapse" class="collapse navbar-collapse">
			<ul class="ui-menu menu ">
				<li class="active"><a href="/index.php">hjem</a></li>
				<li class="admin"><a href="index.php">admin</a></li>
				<li class="pictures"><a href="pictures.php">bilder</a></li>
				<li class="exhibitions"><a href="exhibitions.php">utstillinger</a></li>
				<li class="artists"><a href="artists.php">kunstnere</a></li>
				<li class="events"><a href="events.php">arrangement</a></li>
			</ul>
		</div>
	</nav>
</div>
<script>
	function setMenuActive(id) {
		$("ul.ui-menu li").removeClass("active");
		$('ul.ui-menu li[data-id="'+id+'"]').addClass("active");
	}
</script>