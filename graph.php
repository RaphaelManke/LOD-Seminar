<?php
require_once 'EasyRdf.php';
header ( 'Content-Type: text/turtle; charset=UTF-8' );

//$graph = EasyRdf_Graph::newAndLoad('http://manke-hosting.de/wrapper/index.php/explore/apfelkuchen');
$graph = new EasyRdf_Graph();
$out = "";
$uniqid = uniqid();

//$me = $foaf->primaryTopic();
//echo $graph->dump('html');
//print_r($graph ->get("rdf:type") );
$graph ->parseFile('/Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/schokokuchen.nt');

//$me = $foaf->primaryTopic();
//echo $graph->dump('html');
$resources = $graph -> resources();
$namespace = new EasyRdf_Namespace ();
$namespace->set ( 'rezept', "http://manke-hosting.de/ns-syntax#" );


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