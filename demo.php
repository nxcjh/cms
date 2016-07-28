<?php
ini_set("charset","UTF-8");


$f = fopen("/Users/aimei02132/phone2", "r");
while(!feof($f)){
	// sleep(5);
	$line = fgets($f);
	
		$html = file_get_contents("https://tcc.taobao.com/cc/json/mobile_tel_segment.htm?tel=".trim($line)."0000"); 
		$ret = substr($html, 19);
		$ret =str_replace("mts", "'mts'", $ret);
		$ret =str_replace("province", "'province'", $ret);
		$ret =str_replace("catName", "'catName'", $ret);
		$ret =str_replace("telString", "'telString'", $ret);
		$ret =str_replace("areaVid", "'areaVid'", $ret);
		$ret =str_replace("ispVid", "'ispVid'", $ret);
		$ret =str_replace("carrier", "'carrier'", $ret);
		$ret =str_replace("'", "\"", $ret);
		// echo "\"".$ret."\"";
		// print_r(json_decode("\"".$ret."\""));
		// $res = json_decode($ret);
		// print_r($res);
		// echo "<br/>";
		print_r($ret."<br/>");
	

}
fclose($f);

?>