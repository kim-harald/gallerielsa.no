<?php

	include_once "/classes/include_dao.php";
	include_once "/utilities/languagehandler.php";
	
	function getDictValue($langCode,$key,$default) {
		$item = DAOFactory::getDictionaryDAO()->queryByLangCodeKey($langCode,$key);
		if (isset($item)) {
			return $item->value;
		} else {
			return $default;
		}
	}
	
	function thumbnailImage($imagePath) {
		$imagick = new \Imagick(realpath($imagePath));
		$imagick->setbackgroundcolor('rgb(64, 64, 64)');
		$imagick->thumbnailImage(100, 100, true, true);
		header("Content-Type: image/jpg");
		echo $imagick->getImageBlob();
	}
	
?>
	<meta charset="ISO-8859-1">
	<title>Gallerielsa</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/responsive.css">
  <link rel="stylesheet" href="/css/slideshow.css">
  <script src="/js/hammer.js"></script>
  <script src="/js/slideshow.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript">
  $(function() {
	    // Code here
	});
  </script>
