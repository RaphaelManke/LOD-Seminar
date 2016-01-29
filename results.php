<?php
//require_once 'graph.php';
require_once 'EasyRdf.php';
 
//$graph = EasyRdf_Graph::newAndLoad('http://manke-hosting.de/wrapper/index.php/explore/apfelkuchen');
$graph = new EasyRdf_Graph();
$out = "";
$uniqid = uniqid();
$suchbegriff = $_GET["qname"];
$basedir = dirname(realpath(__FILE__));
$root = $basedir;
$ldfu = $root.'/ldfu/bin/ldfu.sh';
$n3_programm = $root.'/n3-files/chefkoch.n3';
$input = 'http://manke-hosting.de/wrapper/index.php/explore/'.$suchbegriff;
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

?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <title>Bootstrap Example</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/page.js" type="text/javascript"></script>  
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<?php include 'results/rezept.php'; ?>
        </div>      
      </div>
    </div>
  </body>
</html>