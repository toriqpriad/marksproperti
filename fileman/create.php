<?php 
		
		$dir = '../iproguide/rest/assets/images/content_image/guides_article_images/oke/' ;
		
		if(!is_dir($dir)){
			$create = mkdir($dir,0777,true);
			if($create == TRUE){
			echo "Created";		
			} else {
			echo "not created";
			}
		} else {
			echo "EXISTS";
		}
	?>