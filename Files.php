<?php

class Files
{
	
	public function __construct() {}
	
	public function remote_file_exists($_url) {
		$fp = @fopen($_url, 'r');
		if($fp !== false){fclose($_url);}
		return($fp);
	}
	
	public function delete_dir($_dir) {
		
		if(is_dir($_dir)) {
			
			$objects = scandir($_dir);
			
			foreach($objects as $object) {
				
				if($object != "." && $object != "..") {
					
					if(filetype($_dir."/".$object) == "dir") {rrmdir($_dir."/".$object);}
					else {unlink($_dir."/".$object);}
					
				}
				
			}
			
			reset($objects);
			rmdir($_dir);
			
		}
		
	}
	
}