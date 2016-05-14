<?php
//artists.html
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
<script>
    $(function() {
        $("#pageone li a.nav").on("click", function() {
            var pictureid = $(this).data("pictureid");
            var src = "pages/artist-detail.html?pictureid=" + pictureid;
            $.get(src, "html")
            .done(function(html) {
            var $pageContent = $("#artist-detail");
                $pageContent.html(html);
            })
            .fail(function(err) {
                alert(err);
            });
        });
    });
</script>
<div data-role="page" id="pageone">
  <div data-role="header">
    <h1>kunstner</h1>
  </div>

  <div data-role="main" class="ui-content">
    <a href="#detail" data-artistid="0" class="nav" data-role="button" data-icon="plus" data-inline="true"></a>
    <ul>
      <li><a href="#detail" data-artistid="1" class="nav">kunstner1</a></li>
      <li><a href="#detail" data-artistid="2" class="nav">kunstner2</a></li>
    </ul>
  </div>

  <div data-role="footer">
    <h1>Footer Text</h1>
  </div>
</div> 

<div data-role="page" id="detail">
  <div data-role="header">
    <h1>kunstner detaljer</h1>
  </div>

  <div data-role="main" class="ui-content">
    <div id="artist-detail" data-artistid="1">
        <p>navn</p>
        <p>kort beskrivelser</p>
        <p>lang beskrivelse</p>
    
        <a href="#pictures" data-artistid="1"><button data-icon="grid" data-inline="true"></button></a>
        <a href="#edit" data-artistid="1"><button data-icon="arrow-r" data-inline="true"></button></a>
        <a href="#pageone"><button data-icon="back" data-inline="true"></button></a>
    </div>
  </div>

  <div data-role="footer">
    <h1>Footer Text</h1>
  </div>
</div>

<div data-role="page" id="edit">
  <div data-role="header">
    <h1>redigerer kunstner</h1>
  </div>

  <div data-role="main" class="ui-content">
    <div id="artist-edit" data-artistid="1">
        <input type="text" placeholder="navn">
        <input placeholder="kort beskrivelse">
        <textarea placeholder="lang beskrivelser"></textarea>
        <button data-icon="check" class="artist-save" data-inline="true" data-artistid="1"></button>
        <a href="#detail" data-artistid="1"><button data-icon="back" data-inline="true"></button></a>
        <a href="#pictures" data-artistid="1"><button data-icon="grid" data-inline="true"></button></a>
    </div>
  </div>

  <div data-role="footer">
    <h1>Footer Text</h1>
  </div>
</div>

<div data-role="page" id="pictures">
  <div data-role="header">
    <h1>bildene</h1>
  </div>

  <div data-role="main" class="ui-content">
    <img src="picture1.jpg" class="picture-thumbnail" />
    <img src="picture2.jpg" class="picture-thumbnail" />
    <img src="picture3.jpg" class="picture-thumbnail" />
    <img src="picture4.jpg" class="picture-thumbnail" />
    
    <a href="#pageone">back</a>
  </div>

  <div data-role="footer">
    <h1>Footer Text</h1>
  </div>
</div>    

</body>
</html>
