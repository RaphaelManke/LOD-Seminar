<?php
//require_once 'graph.php';
require_once 'EasyRdf.php';
 
//$graph = EasyRdf_Graph::newAndLoad('http://manke-hosting.de/wrapper/index.php/explore/apfelkuchen');
$graph = new EasyRdf_Graph();
$out = "";
$uniqid = uniqid();
$suchbegriff = $_GET["qname"];
$suchbegriff='apfelkuchen';
$rdf ="";
if (isset($_GET["rdf"])){
	$rdf = $_GET["rdf"];
}
$basedir = dirname(realpath(__FILE__));
$root = $basedir;
$ldfu = $root.'/ldfu/bin/ldfu.sh';
$n3_programm = $root.'/n3-files/chefkoch.n3';
$input = 'http://wrapper:8888/index.php/explore/'.$suchbegriff;
$output = $root.'/output/'.$suchbegriff.'.nt';

if (!file_exists($output)) {
	

 shell_exec('sh '.$ldfu.' '.
 		'-i ' . $input .' '.
 		'-p '.$n3_programm.' '.
 		'-o '.$output);
}
$graph ->parseFile($output);
//$graph ->parseFile('/Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/streuselkuchen3.nt');

//$me = $foaf->primaryTopic();
//echo $graph->dump('html');
$resources = $graph -> resources();
$namespace = new EasyRdf_Namespace ();
$namespace->set ( 'rezept', "http://manke-hosting.de/ns-syntax#" );
$rezepte = $graph -> resourcesMatching('rezept:RezeptName');
if ($rdf == "true"){
	header("Content-Type: text/turtle; charset=utf-8");
	echo $graph->serialise("turtle");
}else{
		include 'results/rezept.php'; 
}