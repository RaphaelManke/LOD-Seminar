<?php
require_once 'EasyRdf.php';
//$graph = EasyRdf_Graph::newAndLoad('http://manke-hosting.de/wrapper/index.php/explore/apfelkuchen');
$graph = new EasyRdf_Graph();
$out = "";
$uniqid = uniqid();
exec('sh /Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/bin/ldfu.sh '.
		'-i http://manke-hosting.de/wrapper/index.php/explore/pfannkuchen '.
		'-p /Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/examples/chefkoch.n3 '.
		'-o /Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/output/'.$uniqid.'.nt');

$graph ->parseFile('/Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/output/'.$uniqid.'.nt');

//$me = $foaf->primaryTopic();
//echo $graph->dump('html');
$resources = $graph -> resources();
//print_r($graph ->get("rdf:type") );
exec('rm /Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/output/'.$uniqid.'.nt');


echo $graph->serialise("turtle");
//print_r($graph->allOfType("rdf:RezeptName"));
/*
	foreach ($resources as $value) {
		if ($value -> get("rdf:type", "arecipe:Recipe") != ""){
			echo $value;
		}
		echo "bla" . "<br>";
		print_r( $value ->all('^rdf:type') );
	} 

*/