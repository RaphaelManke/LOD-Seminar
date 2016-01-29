<?php include_once 'utils.php';?>
<?php foreach ( $rezept->all ( 'rezept:rezept_zutaten' ) as $counter => $zutat ):?>
<tr>
	<td>
      <?php echo $graph->get ( $zutat, 'rezept:name' );?>														
    </td>
	<td>
	<?php
		echo $graph->get ( $zutat, 'rezept:menge' );
		if ($graph->get ( $zutat, 'rezept:einheit' ) != "false")
			echo " " . $graph->get ( $zutat, 'rezept:einheit' );
	?>
	</td>
	<td>
		<select class="form-control zutaten"
			id="sel-<?php echo $key."-".$counter;?>">
			
		   <?php foreach ($graph->all($zutat, 'rezept:possible_produkt') as $innerkey => $product): ?>
		    <option data-id="<?php echo $key."-".$counter;?>"
					data-menge="<?php echo $product->get('rezept:baseQuantity');?>"
					data-mengeused="<?php echo $graph->get($zutat, 'rezept:menge');?>"
					data-mengeused-einheit="<?php echo $graph->get($zutat, 'rezept:einheit');?>"
					data-einheit="<?php echo $product->get('rezept:quantityType');?>"
					data-preis="<?php echo $product->get('rezept:price');?>"
					data-hatAlergene="<?php 	
						$out = getAlergene($graph, $product);
						if ($out != "" && $out != "false"){
							foreach ($out as $alergen) {
								echo $alergen.' ';
							};
							
						}elseif ($out == ""){
							echo "none";
						}
						else {
							echo "unknown";
						};
					?>"
					data-kohlenhydrate="<?php 
						
						if ($product->hasProperty('rezept:nutriTable')){
							echo $product->get('rezept:nutriTable')->get('rezept:carbonhydrate');
							//echo $nutritable ->get('rezept:carbonhydrate');
						}else {
							echo 'leer';
						}
					?>">
					<?php echo $product->get('rezept:brand') ." - ".$product->get('rezept:title');?>
			</option>
		   <?php endforeach;?>
		  </select></td>
	<td class="preis" id="preis-<?php echo $key."-".$counter;?>"></td>
	<td class="allegene">
	</td>
	<td class="kohlenhydrate">
	</td>
</tr>
<?php endforeach;?>
