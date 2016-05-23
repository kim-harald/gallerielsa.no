<?php 
include_once '../../Classes/include_dao.php';
$id = isset($_GET["id"])?$_GET["id"]:0;
$exhPictures = DAOFactory::getExhibitionDAO()->queryExhibitionPictures($id);
$exh = DAOFactory::getExhibitionDAO()->load($id);
$artists = DAOFactory::getArtistDAO()->all();
$pictures = DAOFactory::getPictureDAO()->queryAll();
?>
<div class="row" data-id="<?php echo $id?>">
    <div>
    	<input type="text" class="exhibition-name" placeholder="utstillingstitel" value="<?php echo $exh->name?>">
    	
    </div>
    <div class="dateGroup">
    	<label for="exhibition-startDate">startdato</label>
    	<input name="exhibition-startDate" type="date" class="exhibition-startDate" placeholder="" value="<?php echo $exh->startDate?>">
    </div>
    <div class="dateGroup">
    	<label for="exhibition-endDate">sluttdato</label>
    	<input name="exhibition-endDate" type="date" class="exhibition-endDate" placeholder="" value="<?php echo $exh->endDate?>">
    </div>
    <div>
        <a href="#main" class="btn save nav btn-default" data-id="0">lagre</span></a>
        <a href="#main" class="btn nav btn-default">avbryt</a>
        <a href="#main" class="btn delete btn-default" data-id="0">slette</a>
    </div>
</div>
<div class="row" data-id="0">
	<ul class="">
	<?php foreach($exhPictures as $p){?>
	    <li>
	        <img src="<?php echo $p->thPath ?>">
	        <div><?php echo $p->name?></div>';
	    </li>
	<?php }?>
	</ul>
<div class="row" data-id="0">
	<a href="#" class="btn pictures btn-default" data-id="0">legg til bilder</a>
	<div id="Artists">
		<select id="DdArtists">
			<option value="0">alle kunstner</option>
			<?php foreach ($artists as $a){?>
			<option value="<?php echo $a->id?>"><?php echo $a->name?></option>
			<?php }?>
		</select>
	</div>
	<ul class="sortable">
	<?php foreach($pictures as $p){?>
	    <li class="select-element" data-artistid="<?php $p->artistid?>">
	    		<a href="#" data-id="<?php echo $p->id?>" data-artistid="<?php $p->artistid?>">
	        <img src="<?php echo $p->thPath ?>">
	        <div><?php echo $p->name?></div>
	        </a>
	    </li>
	<?php }?>
	</ul>
</div>