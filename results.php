<?php
//require_once 'graph.php';
require_once 'EasyRdf.php';

//$graph = EasyRdf_Graph::newAndLoad('http://manke-hosting.de/wrapper/index.php/explore/apfelkuchen');
$graph = new EasyRdf_Graph();
$out = "";
$uniqid = uniqid();
$suchbegriff = $_GET["qname"];
//$suchbegriff = "apfelkuchen";

 exec('sh /Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/bin/ldfu.sh '.
 		'-i http://wrapper:8888/index.php/explore/'.$suchbegriff.' '.
 		'-p /Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/examples/chefkoch.n3 '.
 		'-o /Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/output/'.$uniqid.'.nt');

$graph ->parseFile('/Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/output/'.$uniqid.'.nt');
//$graph ->parseFile('/Users/raphaelmanke/Downloads/linked-data-fu-0.9.9/output/56a37367723b6.nt');

//$me = $foaf->primaryTopic();
//echo $graph->dump('html');
$resources = $graph -> resources();
$rezepte = $graph -> resourcesMatching('rdf:RezeptName');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  	<script type="text/javascript">
	$(document).ready(function() {
		$.each($("select option:selected"), function() {
		  	var preis = $(this).data('preis');
			var id = $(this).data('id');
			var menge=$(this).data('menge');
			var einheit=$(this).data('einheit');
			var mengeused=$(this).data('mengeused');
			var mengeusedeinheit=$(this).data('mengeused-einheit');
			menge = menge * convert(einheit);
			mengeused = mengeused * convert(mengeusedeinheit); 
			var value = (preis * (mengeused / menge) / 100).toFixed(2);
			if ($.isNumeric(value)){
		    $('#preis-'+id).text(value);
			}
		});
		
		
 	    $('select').change(function() {
 	        var preis = $(this).find(':selected').data('preis');
 	        var id = $(this).find(':selected').data('id');
			var menge=$(this).find(':selected').data('menge');
			var einheit=$(this).find(':selected').data('einheit');
			var mengeused=$(this).find(':selected').data('mengeused');
			var mengeusedeinheit=$(this).find(':selected').data('mengeused-einheit');
			
			menge = menge * convert(einheit);
			mengeused = mengeused * convert(mengeusedeinheit); 
			var value = (preis * (mengeused / menge) / 100).toFixed(2);
			
			if ($.isNumeric(value)){
			    $('#preis-'+id).text(value);
				}
 	    });
	});
	function convert (input){
			input = input.toString().toLowerCase();
			switch (input) {
			case "kg":
				var factor = 1000;
				return factor;
				break;
			case "g":
				var factor = 1;
				return factor;
				break;
			case "tl, gestr.":
				var factor = 4;
				return factor;
				break;
			case "prise(n)":
				var factor = 1/5;
				return factor;
				break;

			default:
				var factor = 0;
			return factor;
			
				break;
			}
			};
			
			
	</script>
  
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<?php foreach ($rezepte as $key => $rezept):?>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading-<?php echo $key;?>">
              <h4 class="panel-title">
              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $key;?>" aria-expanded="<?php if ($key == 0) {echo "true";}else {echo "false";}?>" aria-controls="collapse-<?php echo $key;?>">
                <?php echo $rezept->get('rdf:RezeptName');?>
              </a>
              </h4>
            </div>
            <div id="collapse-<?php echo $key;?>" class="panel-collapse collapse <?php if ($key == 0) echo 'in'; ?>" role="tabpanel" aria-labelledby="heading-<?php echo $key;?>">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-2">
                    <h3>Bild</h3>
                    <img src="<?php echo $rezept->get('rdf:RezeptBild');?>">
                  </div>
                  <div class="col-md-5">
                    <h3>Info</h3>
                    <ul class="list-group">
                      <li class="list-group-item"><?php echo $rezept->get('rdf:RezeptName2');?></li>
                      <li class="list-group-item">Kalorien <span class="badge">140 kcal</span></li>
                      <li class="list-group-item">Fett<span class="badge">10 g</span></li>
                      <li class="list-group-item">Porta ac consectetur ac</li>
                      <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                  </div>
                  <div class="col-md-5">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Zubereitung</h3>
                      </div>
                      <div class="panel-body">
                        <ul class="list-group">
                          <li class="list-group-item">Arbeitszeit: ca. 30 min</li>
                          <li class="list-group-item">Schwierigkeit: <?php echo $rezept->get('rdf:rezept_schwierigkeit');?></li>
                          <li class="list-group-item">Portionen: <?php echo $rezept->get('rdf:rezept_user_portionen');?></li>
                        </ul>
                      </div>
                    </div>
                    
                  </div>
                </div>
                <div class="clearfix">
                  <button class="pull-right btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse-more-<?php echo $key;?>" aria-expanded="false" aria-controls="collapse-more-<?php echo $key;?>">
                  mehr ...
                  </button>
                </div>
                <div class="row clearfix collapse" id="collapse-more-<?php echo $key;?>">
                  <div class="row">
                    
                    <div class="col-md-4">
                      <div class="panel-<?php echo $key;?> panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Zutaten</div>
                        <!-- Table -->
                        <table id="countit-<?php echo $key;?>"class="table">
                          <tr>
                            <th>Name</th>
                            <th>Menge</th>
                            <th>Produkt</th>
                            <th>Preis</th>
                          </tr>
                          <?php foreach ($rezept -> all('rdf:rezept_zutaten') as $counter => $zutat): ?>
                          <tr>
                            <td>
                            <?php 
                            echo $graph->get($zutat, 'rdf:name');?>
                            </td>
                            <td><?php 
                            echo $graph->get($zutat, 'rdf:menge');
  							if ($graph->get($zutat, 'rdf:einheit') != "false")
                            echo " " . $graph->get($zutat, 'rdf:einheit');?>
                            </td>
                            <td>                           
							  <select class="form-control zutaten" id="sel-<?php echo $key."-".$counter;?>">
							   <?php foreach ($graph->all($zutat, 'rdf:possible_produkt') as $innerkey => $product): ?>
							    <option data-id="<?php echo $key."-".$counter;?>"
							    		data-menge="<?php echo $product->get('rdf:baseQuantity');?>"
							    		data-mengeused="<?php echo $graph->get($zutat, 'rdf:menge');?>"
							    		data-mengeused-einheit="<?php echo $graph->get($zutat, 'rdf:einheit');?>"
							    		data-einheit="<?php echo $product->get('rdf:quantityType');?>"
							    		data-preis="<?php echo $product->get('rdf:price');?>"><?php echo $product->get('rdf:brand') ." - ".$product->get('rdf:title');?></option>
							   <?php endforeach;?>
							  </select>
							</td>
							<td class="preis" id="preis-<?php echo $key."-".$counter;?>">
							
							</td>
                          </tr>
                          <?php endforeach;?>
                          <tr class="sum">
					        <th>Total</th>
					        <td></td>
					        <td class="sum">#</td>
					    </tr>
                        </table>
                        <script language="javascript" type="text/javascript">
            var tds = document.getElementById('countit-<?php echo $key;?>').getElementsByTagName('td');
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'preis') {
                    sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
                }
            }
            document.getElementById('countit-<?php echo $key;?>').innerHTML += '<tr><td>' + sum + '</td><td>total</td></tr>';
        </script>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <p>
                      <?php echo $rezept->get('rdf:rezept_zubereitung');?>
                        
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
           <?php endforeach;?>
        </div>
       
      </div>
    </div>
  </body>
</html>