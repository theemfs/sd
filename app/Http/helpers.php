<?php



	function trunc($phrase, $max_words) {
		$phrase_array = explode(' ',$phrase);
		if(count($phrase_array) > $max_words && $max_words > 0)
			$phrase = implode(' ',array_slice($phrase_array, 0, $max_words));
		return $phrase;
	}



	function limit_words($words, $limit, $append = ' &hellip;') {
			// Add 1 to the specified limit becuase arrays start at 0
			$limit = $limit+1;
			// Store each individual word as an array element
			// Up to the limit
			$words = explode(' ', $words, $limit);
			// Shorten the array by 1 because that final element will be the sum of all the words after the limit
			array_pop($words);
			// Implode the array for output, and append an ellipse
			$words = implode(' ', $words) . $append;
			// Return the result
			return $words;
	 }



	function human_filesize($bytes, $decimals = 2) {
		$size = array('b','Kb','Mb','Gb','Tb','Pb','Eb','Zb','Yb');
		$factor = floor((strlen($bytes) - 1) / 3);
		return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . @$size[$factor];
	}



	function getCleanPhpinfo(){
		ob_start();
		phpinfo();
		$pinfo = ob_get_contents();
		ob_end_clean();
		$pinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
		return $pinfo;
	}



	function link_it($text)
	{
		$text= preg_replace("/(^|[\n ])([\w]*?)([\w]*?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", 	"$1$2<a href=\"$3\" target='_blank'>$3</a>", 			$text);
		$text= preg_replace("/(^|[\n ])([\w]*?)((www)\.[^ \,\"\t\n\r<]*)/is", 			"$1$2<a href=\"http://$3\" target='_blank'>$3</a>", 	$text);
		$text= preg_replace("/(^|[\n ])([\w]*?)((ftp)\.[^ \,\"\t\n\r<]*)/is", 			"$1$2<a href=\"ftp://$3\" target='_blank'>$3</a>", 	$text);
		$text= preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", 	"$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);
		return($text);
	}
