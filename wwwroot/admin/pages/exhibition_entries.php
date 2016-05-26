<?php 
include_once '../../Classes/include_dao.php';

?>
<div class="add">
	<div class="page-element">
		<a href="#detail" data-id="0" class="btn nav">
			<img class="exhibition-element" alt="Ny utstilling" src="../images/exhibition-icon.png" />
	    <p>Ny utstilling</p>
    </a>
  </div>
</div>
<div class="row">
<?php $exhibitions = DAOFactory::getExhibitionDAO()->queryAll();
    foreach($exhibitions as $exh) {
    $pictures = DAOFactory::getExhibitionDAO()->queryExhibitionPictures($exh->id);
    if (count($pictures)==0) {
    	$p = new Picture();
    } else {
    	$p = $pictures[0];
 }
 ?>
 	<div class="page-element">
 		<a href="#detail" data-id="<?php echo $exh->id?>" class="nav detail">
 			<img alt="" src="<?php echo $p->path?>" />
      <p><?php echo $exh->name?></p>
      <p><?php echo count($pictures)?></p>
    </a>
   </div>
<?php }?>
</div>