<!DOCTYPE html>
<html>
<head>
<title>Ta kontakt</title>
<?php 
		include("head.php");
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"/>
    <script type="text/javascript" src="js/jquery.bpopup.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAVi432Doa8eylsnPqKWeCZBmORVQ8Qjz4"></script>
    <script type="text/javascript" src="js/contact.js"></script>
    
</head>

<body>
	<div id="Body" class="container-fluid">
	<?php include "header.php"?>
		<h3>kontakt oss</h3>
		<div class="row">
		    
		    <div class="col-xs-12 col-sm-4 col-md-5">
		    	<div class="contact-address">
			    	<table>
				  		<tr><td valign="Top" colspan="2"><b class=1>åpningstider ved galleriet</td></tr>
				  		<tr><td>Mandag</td><td>11:00-16:30</td></tr>
							<tr><td>Tirsdag</td><td>11:00-16:30</td></tr>
							<tr><td>Onsdag</td><td>11:00-16:30</td></tr>
							<tr><td>Torsdag</td><td>11:00-17:30</td></tr>
							<tr><td>Fredag</td><td>11:00-16:30</td></tr>
							<tr><td>Lørdag</td><td>11:00-14:00</td></tr>
							<tr><td colspan="2">Enkelte søndager</td></tr>
				  	</table>
			  	</div>
			    <div class="contact-map">
				    <div id="gmap_canvas" style="height:100%"></div>
				    <div>
				    	<small><a href="http://embedgooglemaps.com">embed google maps</a></small>
				    </div>
				    <div>
				    	<small><a href="https://privacypolicytemplate.net">privacy policy template</a></small>
				    </div>
				    <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
			    </div>
			    
		    </div>
		    <div class="col-xs-12 col-sm-3 col-md-3">
		    <div class="contact-address">
						<b>postadresse</b><br>
						Havnegt. 24<br>
						7800 Namsos<br>
						<br>
						<b>telefon</b><br>
						909 65 191 eller<br>
						74 21 82 38
						<br/>
						<b>kontaktperson</b><br>
						Elsa Eilden
					</div>
		    </div>
		    <div class="col-xs-12 col-sm-3 col-md-2">
			    <div class="contact-fields">
			    <b class="field-group-heading">ta kontakt</b>
		      <fieldset>
		      	<div class="contact-field">
                <label for="Name">navn</label><br />
                <input class="validate" data-errormsg="Navnet" name="Name" id="Name" type=text placeholder="feks Ole/Kari Nordman" required/>
		        </div>
            <div class="contact-field">
                <label for="Email">email</label><br />
                <input class="validate" data-errormsg="Epost" name="Email" id="Email" type=email placeholder="feks noen@email.no" required/>
            </div>
            <div class="contact-field">
                <label for="Subject">emne</label><br />
                <input class="validate" data-errormsg="Subjektet" name="Subject" id="Subject" type=text value="emne" required/>
            </div>
            <div class="contact-field">
                <label for="Message">melding</label><br />
                <textarea class="validate" data-errormsg="Meldingen" name="Message" id="Message" placeholder="Melding..." required></textarea>
            </div>
            <div class="contact-field">
                <label for="NotRobot">jeg er ikke en robot</label><br />
                <input type=checkbox name="NotRobot" id="NotRobot"  title="Jeg er ikke robot"  />
            </div>
            <div class="contact-field hidden">
                <input type=checkbox name="Robot" id="Robot" />
            </div>
          </fieldset>
			    <div><a id="SendMessage" class="btn btn-primary">Send</a></div>
			    </div>
			  </div>	    
	  </div>
<?php 
include 'footer.php'?>
  </div>
</body>
</html>
