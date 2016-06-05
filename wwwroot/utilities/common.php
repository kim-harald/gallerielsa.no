<?php
#########################################################
# Copyright � 2008 Darrin Yeager                        #
# https://www.dyeager.org/                               #
# Licensed under BSD license.                           #
#   https://www.dyeager.org/downloads/license-bsd.txt    #
#########################################################

function getDefaultLanguage() {
   if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
      return parseDefaultLanguage($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
   else
      return parseDefaultLanguage(NULL);
   }

function parseDefaultLanguage($http_accept, $deflang = "en") {
   if(isset($http_accept) && strlen($http_accept) > 1)  {
      # Split possible languages into array
      $x = explode(",",$http_accept);
      foreach ($x as $val) {
         #check for q-value and create associative array. No q-value means 1 by rule
         if(preg_match("/(.*);q=([0-1]{0,1}.\d{0,4})/i",$val,$matches))
            $lang[$matches[1]] = (float)$matches[2];
         else
            $lang[$val] = 1.0;
      }

      #return default language (highest q-value)
      $qval = 0.0;
      foreach ($lang as $key => $value) {
         if ($value > $qval) {
            $qval = (float)$value;
            $deflang = $key;
         }
      }
   }
   return strtolower($deflang);
}

########################################################
#                                                      #
#			Kim Harald Designs                               # 
#                                                      #
########################################################

function getAspect($filename) {
	$sRoot = $_SERVER['DOCUMENT_ROOT'];
	
	list($width,$height,$type) = getimagesize($sRoot . $filename);
	if ($height > $width) {
		return "portrait";
	} else {
		return "landscape";
	}

}

function getItemHtml($id,$imgPath,$imgAspect,$text1) {
	$html = 
		'<div class="item-container">'.
	    '<div class="image-container" data-id="'.$id.'">'.
    	'<img class="thumbnail '.$imgAspect.'" alt="" src="'.$imgPath .'">'.
	    '</div>'.
	    '<div class="text-container">'.
		  '<div>'. $text1 .'</div>'.
	    '</div>'.
    '</div>';
	
    
  return $html;
}


?>