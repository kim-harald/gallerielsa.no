<!DOCTYPE html>
<html>
<head>
<?php 
		include("head.php");
		$exhibitions = DAOFactory::getExhibitionDAO()->queryAllOrderBy('startDate');
?>
</head>
<body>
	<div class="container">
<?php include("header.php"); ?>
	  <div id="Body" class="container-fluid">
        
	  	<div class="col-sm-3 col-md-3"></div>
            
            
      <div id="CurrentExhibition" class="row">
      	<div class="col-xs-12 col-sm-6 col-md-6">
<?php 
for ($i = count($exhibitions)-1; $i >=0; $i--) {
	$exh = $exhibitions[$i];
	$class = getClass($exh->startDate, $exh->endDate)
?>
					<div class="exhibition <?php echo $class?>">
						<a href="exhibition.php?id=<?php echo $exh->id?>">
							<h3 class=""><?php echo $exh->name?></h3>
						</a>
						<p class=""><?php echo $exh->longDescr?></p>
	        </div>
<?php } ?>
				</div>
	    </div>
	    <div class="col-sm-3 col-md-3"></div>

		</div>
<?php include 'footer.php'?>
  </div>
  
  <?//php echo phpinfo()?>
</body>
</html>
<?php 
function getClass($date0,$date1) {
	$today = date('d-m-Y',time());
	$end = date('d-m-Y h:i:s',strtotime($date1));
	$endDate =  date_create($end);
	$start = date('d-m-Y h:i:s',strtotime($date0));
	$startDate = date_create($start);
	$todayDate = date_create($today);
	$futureCount = 0; $currentCount = 0; $pastCount = 0;
	$exhibitionClass = '';
	if ($endDate > $today && $startDate < $today) {
		// current exhibition
		$currentCount++;
		if ($currentCount<=1) {
			$exhibitionClass = 'future-exhibition';
		} else {
			$exhibitionClass = 'hidden';
		}
		$exhibitionClass = 'hidden';
	} else if ($endDate > $todayDate && $startDate > $todayDate) {
		// future exhibition
		$futureCount++;
		if ($futureCount<=1) {
			$exhibitionClass = 'current-exhibition';
		} else {
			$exhibitionClass = 'hidden';
		}
	} else {
		// past exhibition
		$pastCount++;
		if ($pastCount<=0) {
			$exhibitionClass = 'past-exhibition';
		} else {
			$exhibitionClass = 'hidden';
		}
	}
	return $exhibitionClass;
}
?>