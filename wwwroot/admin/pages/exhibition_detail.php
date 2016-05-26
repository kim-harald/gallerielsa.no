<?php 
include_once '../../Classes/include_dao.php';

$id = (isset($_GET["id"])?$_GET["id"]:0);
$exhibition = DAOFactory::getExhibitionDAO()->load($id);
$exhibitionPictures = DAOFactory::getPictureDAO()->queryByExhibition($id);
$pictures = DAOFactory::getPictureDAO()->queryAvailablePictures($id);
$artists = DAOFactory::getArtistDAO()->all();

?>
<div class="row" data-id="1">
    <fieldset class="controlGroup">
		<div class="dateGroup">
			<label for= "exhibition-name">utstillingstitel</label>
    		<input name="exhibition-name" class="exhibition-name" placeholder="utstillingstitel" value="<?php echo $exhibition->name ?>" type="text">
		</div>
		<div class="dateGroup">
			<label for= "exhibition-descr">beskrivelse</label>
    		<textarea name="exhibition-descr" class="exhibition-descr" placeholder="beskrivelse" ><?php echo $exhibition->longDescr ?></textarea>
		</div>
    
	    <div class="dateGroup">
	    	<label for="exhibition-startdate">startdato</label>
	    	<input name="exhibition-startdate" class="exhibition-startdate" placeholder="" value="<?php echo $exhibition->startDate ?>" type="date">
	    </div>
	    <div class="dateGroup">
	    	<label for="exhibition-enddate">sluttdato</label>
	    	<input name="exhibition-enddate" class="exhibition-enddate" placeholder="" value="<?php echo $exhibition->endDate?>" type="date">
	    </div>
	  </fieldset>
    <div class="buttonGroup">
        <a href="#main" class="btn save btn-default" data-id="1">lagre</a>
        <a href="#main" class="btn nav btn-default">avbryt</a>
        <a href="#main" class="btn delete btn-default" data-id="0">slette</a>
    </div>
</div>
<div class="row">
	<h3>utstillinge bilder</h3>
	<ul id="SelectedPictures" class="sortable">
		<?php foreach($exhibitionPictures as $p) { ?>
		<li class="select-element exhibition-element" data-artistid="<?php echo $p->artistid?>" data-id="<?php echo $p->id?>">
		    <img src="<?php echo $p->thPath?>">
	    	<div><?php echo $p->name ?></div>
	    	<a href="#" data-id="<?php echo $p->id?>" data-artistid="<?php echo $p->artistid?>">
	        	<span class="glyphicon glyphicon-plus"></span>
			</a>
	    </li>
	    <?php } ?>
	</ul>
</div>
<div class="row">
	<h3>ledig bilder</h3>
	<div id="Artists">
		<select id="DdArtists">
			<option selected="selected" value="0">alle kunstner</option>
			<?php foreach($artists as $artist) {?>
			<option value="<?php echo $artist->id?>"><?php echo $artist->name ?></option>
			
			<?php }?>
		</select>
	</div>
	<ul id="AvailablePictures">
	<?php foreach ($pictures as $picture) {?>
		<li class="select-element exhibition-element" data-artistid="<?php echo $picture->artistid?>" data-id="<?php echo $picture->id?>">
		    <img src="<?php echo $picture->thPath?>">
	    	<div>cv</div>
	    	<a href="#" data-artistid="<?php echo $picture->artistid?>" data-id="<?php echo $picture->id?>">
	        	<span class="glyphicon glyphicon-plus"></span>
			</a>
	    </li>
	  <?php }?>
		</ul>
</div>