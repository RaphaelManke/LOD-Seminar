<?php
//require_once 'graph.php';
require_once 'EasyRdf.php';

//$graph = EasyRdf_Graph::newAndLoad('http://manke-hosting.de/wrapper/index.php/explore/apfelkuchen');
$graph = new EasyRdf_Graph();
$out = "";
$uniqid = uniqid();
$suchbegriff = $_GET["qname"];
//$suchbegriff = "apfelkuchen";

//  exec('sh /Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/bin/ldfu.sh '.
//  		'-i http://wrapper:8888/index.php/explore/'.$suchbegriff.' '.
//  		'-p /Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/examples/chefkoch.n3 '.
//  		'-o /Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/output/'.$uniqid.'.nt');

//$graph ->parseFile('/Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/output/'.$uniqid.'.nt');
$graph ->parseFile('/Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/schokokuchen.nt');

//$me = $foaf->primaryTopic();
//echo $graph->dump('html');
$resources = $graph -> resources();
$namespace = new EasyRdf_Namespace ();
$namespace->set ( 'rezept', "http://manke-hosting.de/ns-syntax#" );
$rezepte = $graph -> resourcesMatching('rezept:RezeptName');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
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