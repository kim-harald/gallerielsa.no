<!DOCTYPE html>
<html>
<head>
<?php
	include("../head.php");
	$langCode = getDefaultLanguage();
	
?>

<script type="text/javascript">

$(function() {
	$("button.cancel,button.save").hide();
	$("button.add").show();
	
	
	$("button.edit").on("click",function(){
		$(".artist-container").find("button").attr('disabled','disabled');
		
		$(this).parents(".artist-container").find("button").removeAttr('disabled');
		var name = $(this).parents(".artist-container").find("td.artist-name").data("name");
		var shortDescr = $(this).parents(".artist-container").find("td.artist-shortdescr").data("shortdescr");
		var longDescr = $(this).parents(".artist-container").find("td.artist-longdescr").data("longdescr");
		var html = '<input class="artist-name" type="text" value="' + name + '">';
		$(this).parents(".artist-container").find("td.artist-name").html(html);

		html = '<input class="artist-shortdescr" type="text" value="' + shortDescr + '">';
		$(this).parents(".artist-container").find("td.artist-shortdescr").html(html);

		html = '<textarea class="artist-longdescr">' + longDescr + '</textarea>';
		$(this).parents(".artist-container").find("td.artist-longdescr").html(html);
		$(this).parents(".artist-container").find("button.cancel").show();
		$(this).parents(".artist-container").find("button.save").show();		
		$(this).hide();
	});
	
	$("button.cancel").on("click",function(){
		setFields($(this).parents(".artist-container"));
	});

	$("button.save").on("click",function(){
		var $row = $(this).parents(".artist-container");
		var artist = {
				id : $row.data("id"),
				name : $row.find("input.artist-name").val(),
				shortdescr : $row.find("input.artist-shortdescr").val(),
				longdescr : $row.find("textarea.artist-longdescr").val(),
				deleteddate : $row.data("deleteddate")
				};
		var obj = {js_object : JSON.stringify(artist)};
		$.ajax({
						dataType: 'json',
						url:"ajax_save_artist.php",
						method:"POST",
						dataType: "json",
						data : obj,
						success : function(xhr) {
							$row.find("td.artist-name").data("name",xhr.name);
							$row.find("td.artist-shortdescr").data("shortdescr",xhr.shortDescr);
							$row.find("td.artist-longdescr").data("longdescr",xhr.longDescr);
							$row.data("id",xhr.id);
							if (artist.id==0) {
								addArtist(xhr,$row.parents("table:first"));
							} else {
								setFields($row);
							}
						},
						error : function(xhr) {
							alert(xhr.errorText);
						},
						complete : function(xhr) {
							//alert(JSON.stringify(xhr));
						}
			});
		});
	
		$("button.clear").on("click",function(){
			var $row = $(this).parents(".artist-container");
			$row.find("input.artist-name").val("");
			$row.find("input.artist-shortdescr").val("");
			$row.find("textarea.artist-longdescr").val("");
			resetButtons()
		});
	});
	
function setFields($row) {
	var name = $row.find("td.artist-name").data("name");
	var shortDescr = $row.find("td.artist-shortdescr").data("shortdescr");
	var longDescr = $row.find("td.artist-longdescr").data("longdescr");

	$row.find("td.artist-name").html(name);
	$row.find("td.artist-shortdescr").html(shortDescr);
	$row.find("td.artist-longdescr").html(longDescr);
	$row.find("button.edit").show();
	resetButtons();
}

function resetButtons() {
	$("button").removeAttr('disabled');
	$("button.cancel,button.save").hide();
	$("button.add").show();
}


function addArtist(artist,$table) {
	var html = '<tr class="artist-container" data-id="'+ artist.id + '" data-deleteddate="'+ artist.deletedDate +'">';
	html += '<td class="artist-name" data-name="' + artist.name +'">' + artist.name +'</td>';
	html += '<td class="artist-shortdescr" data-shortdescr="' + artist.shortDescr +'">' + artist.shortDescr +'</td>';
	html += '<td class="artist-longdescr" data-longdescr="' + artist.longDescr +'">'+ artist.longDescr +'</td>';
	html += '<td><button class="cancel btn">avbryt</button></td>';
	html += '<td><button class="edit btn"><span class="glyphicon glyphicon-chevron-left"></span></button><button class="save btn">lagre</button></td>';
	html += '</tr>';
	$table.find('> tbody:last-child').append(html);
	$("button.clear").click();
}

</script>
</head>
<body>
<div class="container">
<?php //include("../header.php"); ?>
<table>
	<thead>
		<tr>
			<th>navn</th>
			<th>kort beskrivelse</th>
			<th>langt beskrivelse</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr class="artist-container" data-id="0" data-deleteddate="">
			<td class="artist-name" data-name=""><input type=text class="artist-name" placeholder="navn"></td>
			<td class="artist-shortdescr" data-shortdescr=""><input type=text class="artist-shortdescr" placeholder="kort beskrivelse"></td>
			<td class="artist-longdescr" data-longdescr=""><textarea class="artist-longdescr" placeholder=langt beskrivelse"></textarea></td>
			<td><button class="clear btn"><span class="glyphicon glyphicon-unchecked"></button></td>
			<td>
				<button class="save add btn"><span class="glyphicon glyphicon-plus-sign"></span></button>
			</td>
			<td></td>
			<td></td>
		</tr>

	<?php 
		$artists = DAOFactory::getArtistDAO()->all();
		foreach ($artists as $artist) {
	?>
	<tr class="artist-container" data-id="<?php echo($artist->id) ?>" data-deleteddate="<?php echo($artist->deletedDate);?>">
		<td class="artist-name" data-name="<?php echo($artist->name);?>"><?php echo($artist->name);?></td>
		<td class="artist-shortdescr" data-shortdescr="<?php echo($artist->shortDescr);?>"><?php echo($artist->shortDescr);?></td>
		<td class="artist-longdescr" data-longdescr="<?php echo($artist->longDescr);?>"><?php echo($artist->longDescr);?></td>
		<td><button class="cancel btn"><span class="glyphicon glyphicon-unchecked"></button></td>
		<td>
			<button class="edit btn"><span class="glyphicon glyphicon-chevron-left"></span></button>
			<button class="save btn"><span class="glyphicon glyphicon-ok"></span></button>
		</td>
		<td><button class="delete btn"><span class="glyphicon glyphicon-remove"></span></button></td>
		<td><a href="<?php echo "/admin/artist_pictures.php?artist_id=" . $artist->id ?>" class="picture btn"><span class="glyphicon glyphicon-picture"></span></a></td>
	</tr>
	<?php 
		}
	?>
	</tbody>
</table>
</div>
</body>
</html>