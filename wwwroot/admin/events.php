<!DOCTYPE html>
<html>
<head>
<?php
	include("../head.php");
	include_once "../utilities/common.php";
	
?>
<link rel="stylesheet" href="css/styles.css">
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/events.js"></script>
<link rel="stylesheet" href="../jodit/jodit.min.css">
<script src="../jodit/jodit.min.js"></script>
</head>
<body>
 
<?php include "header.php"?>
<div class="container-fluid  site-container">
<section class="ui_page active" id="main">
    <div class="add">
        <div class="page-element">
            <a href="#detail?id=0" data-id="0" class="btn nav add">
	  		    <img class="page-element" alt="Ny arrangementer" src="../images/art-icon-add.png" />
	  		    <p>Nye arrangement</p>
  		    </a>
        </div>
    </div>
    <div id="Event-Entries">
    	<?php include "pages/event_entries.php"?>
    </div>
</section>

<section class="ui_page" id="detail">
	<div class="row event" data-id="0">
		<div class="page-fields-container">		
			<div class="page-element">
				<label for="Title">titel</label><br/>
				<input id="Title" name="Title" type=text class="event title" placeholder="titel" />
			</div>
			<div class="page-element">
				<label for="Startdate">startdato</label><br/>
				<input id="Startdate" name="Startdate" type="date" class="event startdate" placeholder="1.7.2016"  />
			</div>
			<div class="page-element">
				<label for="Enddate">sluttdato</label><br/>
				<input id="Enddate" type=date name="Enddate" class="event enddate" placeholder="31.7.2016" />
			</div>
			<div class="page-element">
				<label for="Message">beskrivelse</label><br/>
				<textarea id="Message" name="Message" class="event message" placeholder=""></textarea>
			</div>
			<div class="page-element">
				<a href="#main" class="btn nav save btn-default" data-id="0">lagre</span></a>
				<a href="#main" class="btn nav btn-default">avbryt</a>
				<a href="#main" class="btn nav delete btn-default">slette</span></a>
			</div>
		</div>

</div>
</section>

</div>
<div id="AjaxSpinner" class=""></div>
</body>
</html>
