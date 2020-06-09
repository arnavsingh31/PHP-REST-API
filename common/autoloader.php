<?php 
	function autoLoader($class){
		$path = 'models/';
		$extension = '.php';
		$fullPath = $path.$class.$extension


		if(!file_exists($fullPath)){
			return false;
		}

		include_once($fullPath);
		
	}
}
	spl_autoload_register('autoLoader');
?>