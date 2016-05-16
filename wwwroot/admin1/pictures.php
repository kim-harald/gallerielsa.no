<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/responsive.css">
  <link rel="stylesheet" href="../css/admin.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript">
      $(function() {

      initialise()
          
  });

  function initialise() {

      var html = $("section#main .add").html();
      html += '<div class="row">';

      for (i = 0; i < pictures.length; i++) {
          var picture = pictures[i];
          html += '<div class="picture-element center" data-id="' + picture.id + '">' +
  		          '<a href="#detail" data-id="' + picture.id + '" class="nav">' +
	  		      '<img alt="' + picture.name + '" src="' + picture.path + '">' +
	  		      '<p class="artist-name">' + picture.name + '</p>' +
  		          '</a>' +
  	              '</div>';
      }
        html += "</div>";
      $("section#main").html(html);
  }

  var pictures = [
      { id: 1, name: "Picture1", path: "/pictures/picture.jpg", shortDescr: "kort beskrivelse", longDescr: "lang beskrivelse" },
      { id: 2, name: "Picture2", path: "/pictures/picture2jpg", shortDescr: "kort beskrivelse", longDescr: "lang beskrivelse" },
      { id: 3, name: "Picture3", path: "/pictures/picture3.jpg", shortDescr: "kort beskrivelse", longDescr: "lang beskrivelse" }
  ];
  </script>

</head>
<body>
<div class="container-fluid">
<section class="ui_page active" id="main">
    <div class="add">
        <div class="picture-element">
            <a href="#edit" data-id="0" class="nav">
	  		    <img alt="Ny bilde" src="../images/art-icon.png" />
	  		    <p></p>
	  		    <p></p>
  		    </a>
        </div>
    </div>
    <div class="row">
        <div class="picture-element">
            <a href="#detail" data-id="0" class="nav">
	  		    <img alt="" src="" />
	  		    <p>name</p>
	  		    <p>0</p>
  		    </a>
        </div>
    </div>
</section>

<section class="ui_page" id="detail">
    <div class="row" data-id="0">
        <div class="picture-name"></div>
        <div class="picture-shortdescr"></div>
        <div class="picture-longdescr"></div>
        <a href="#edit" class="btn edit" data-id="0"><span class="glyphicon glyphicon-pencil"></span></a>
        <a href="#main" class="btn main nav"><span class="glyphicon glyphicon-menu-up"></span></a>
    </div>
</section>
</div>
</body>
</html>
