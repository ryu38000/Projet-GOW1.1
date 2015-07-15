<?php
$f = fopen('./languages/iso639-1.txt','r');
$iso = array();
//fgets($f);
if ($f) {
	while (($line = fgets($f)) !== false) {
		$iso[explode("\t",$line)[0]]=trim(explode("\t",$line)[1]);
		//array_push($iso,explode("\t",$line)[6]);
	}
	fclose($f);
	//sort($iso);
}
?>