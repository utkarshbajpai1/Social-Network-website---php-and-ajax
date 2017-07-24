<?php 

	function cryptPass($input, $rounds = 9){
		$salt = "";
		$charsArray = array_merge(range('A','Z'),range('a','z'),range(0,9));
		for($i=0; $i<22; $i++){
			$salt .= $charsArray[array_rand($charsArray)];
		}
		return crypt($input,sprintf('$2y$%02d$', $rounds) . $salt);
	}

 ?>