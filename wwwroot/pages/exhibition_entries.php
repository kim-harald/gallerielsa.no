<?php 
include_once '/Classes/include_dao.php';
include_once '/utilities/common.php';

$exhibitions = DAOFactory::getExhibitionDAO()->queryGetCurrentFutureDescr("startDate,endDate");
?>
<h1>utstillinger</h1>
<div class="row">
	
	<div class="col-xs-12 col-sm-6 col-md-12">
<?php foreach($exhibitions as $exh) {
	$picture = DAOFactory::getPictureDAO()->queryGetFirstPicture($exh->id);
	$startDate = new DateTime($exh->startDate);
	$endDate = new DateTime($exh->endDate);
?>
	<a href="exhibition.php?id=<?php echo $exh->id?>" class="exhibition-container" data-id="<?php echo $exh->id?>">
		<div class="exhibition-row">
			<h2><?php echo $exh->name?></h2>
			<div class="exhibition-image">
				<img class="thumbnail" alt="<?php echo $picture->name?>" src="<?php echo $picture->thPath?>" title="klikk å se detaljer">
			</div>
			<div class="exhibition-text">
				<p><?php echo $startDate->format("d.m.Y") . ' til ' . $endDate->format("d.m.Y")?></p>
			</div>
		</div>
	</a>
<?php } ?>
	</div>     
	
</div>