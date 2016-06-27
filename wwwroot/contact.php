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
</head>

<body>
	<div id="Body" class="container-fluid">
	<?php include "header.php"?>
		<div class="row">
			<div class="col-sm-3 col-md-3"></div>
			<div class="col-xs-12 col-sm-6 col-md-6">
		    <div class="contact-fields">
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
		                <label for="NotRobot">Jeg er ikke en robot</label><br />
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
  </div>
    <script>
        $(function() {
            $("#SendMessage").on("click", function() {
            if (!validate($("fieldset"), $("fieldset"))) return;
                
                var msg = {
                    ts: new Date(),
                    name: $("#Name").val(),
                    email: $("#Email").val(),
                    subject: $("#Subject").val(),
                    message: $("#Message").val(),
                    IsNotRobot: $("#NotRobot").prop("checked"),
                    IsRobot: $("#Robot").prop("checked")
                };

                if (msg.IsNotRobot && !msg.IsRobot) {
                    sendMessage(msg)
                    return;
                }
                alert("Pwned! Lu2r heinous spammer!");
            });
        });

        function validate($anchor,$msgAnchor) {
            $(".errorMessage").remove();
            var msg = "";
            $anchor.find(":invalid").each(function() {
                    msg += $(this).attr("data-errormsg") + "<br/>";
            });
            if (msg != "") {

                msg = '<div class="errorMessage">Må festes:-<br/>' + msg + '</div>';
                $msgAnchor.append(msg);
                return false;
            }
            return true;
        }

        function sendMessage(msg) {
            var obj = { js_object: JSON.stringify(msg) };
            setSpinner();
            $.ajax({
                dataType: 'json',
                url: "pages/ajax_message.php?verb=send",
                method: "POST",
                data: obj,
                success: function(xhr) {
                	 $('<div class="popup">Melding sendt</div>').bPopup({
                         autoClose: 2000 //Auto closes after 1000ms/1sec
                     });
                },
                error: function(xhr) {
                    alert(JSON.stringify(xhr));
                },
                complete: function(xhr) {
                    clearSpinner();
                    loadContent("pages/exhibition_entries.php", $("section#main"), setEvents);
                    setSection("#main");
                }
            });
        }
    </script>
</body>
</html>
