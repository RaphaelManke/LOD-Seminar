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
					?>">
					<?php echo $product->get('rezept:brand') ." - ".$product->get('rezept:title');?>
			</option>
		   <?php endforeach;?>
		  </select></td>
	<td class="preis" id="preis-<?php echo $key."-".$counter;?>"></td>
	<td class="allegene">
	<?php 
/*
 * foreach (getAlergene($graph, $product) as $alergen) {
		echo $alergen.' ';
	}
 * 
 * 
	foreach ($graph->all($product, 'rezept:allergySumm') as $possibleAlergene) {	
		foreach ($possibleAlergene ->properties() as $possibleAlergeneInner) {
			$alergenCode = $possibleAlergene -> get($possibleAlergeneInner) -> get('rezept:rateScore');
			$alergenName = $possibleAlergene -> get($possibleAlergeneInner) -> get('rezept:name');
			switch ($alergenCode) {
				case '600':
				echo '<span class="label label-success">' . $alergenName . '</span>';
				break;
				
				case '100':
				echo '<span class="label label-danger">' . $alergenName . '</span>';
				break;
				
				default:
				echo '<span class="label label-info">' . $alergenName . '</span>';
				break;
			};
			
			
		}
		;
	};	*/	
	?>
	</td>
</tr>
<?php endforeach;?>
