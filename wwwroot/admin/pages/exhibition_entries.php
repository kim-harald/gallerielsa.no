<?php 
include_once '../../Classes/include_dao.php';

?>
<div class="add">
	<div class="exhibition-element">
		<a href="#detail" data-id="0" class="btn nav">
			<img class="exhibition-element" alt="Ny utstilling" src="../images/exhibition-icon.png" />
	    <p>Ny utstilling</p>
    </a>
  </div>
</div>
<div class="row">

<?php $exhibitions = DAOFactory::getExhibitionDAO()->queryAll();
foreach($exhibitions as $exh) {
	$pictures = DAOFactory::getPictureDAO()->queryByExhibition($exh->id);
	if (count($pictures)==0) {
		$picture = new Picture();
		$picture->aspect = "landscape";
	} else {
		$picture = $pictures[0];
	}
	$startDate = new DateTime($exh->startDate);
	$endDate = new DateTime($exh->endDate);
	?>
		    <div class="item-container" data-id="<?php echo $exh->id?>">
		    	<a href="#detail?id=<?php echo $exh->id?>" data-id="<?php echo $exh->id?>" class="nav detail">
				    <div class="item-title">
					    	<h4><?php echo $exh->name?></h4>
					    	<p><?php echo $startDate->format("d.m.y") . ' til ' . $endDate->format("d.m.y")?></p>
					    	<p><?php echo count($pictures)?> bilder</p>
					  </div>
				    <div class="image-container">
					    <img class="thumbnail <?php echo $picture->aspect?>" alt="<?php echo $picture->name?>" src="<?php echo $picture->thPath?>">
				    </div>
				    <div class="text-container"></div>
			    </a>
			  </div>
<?php } ?>
</div>