<?php
function getAlergene ($graph, $resource) {
$result ="";
if ($resource->hasProperty('rezept:allergySumm')){
	foreach ($graph->all($resource, 'rezept:allergySumm') as $possibleAlergene) {
		foreach ($possibleAlergene ->properties() as $possibleAlergeneInner) {
			$alergenCode = $possibleAlergene -> get($possibleAlergeneInner) -> get('rezept:rateScore');
			$alergenName = (string) $possibleAlergene -> get($possibleAlergeneInner) -> getLiteral('rezept:name');
			switch ($alergenCode) {
				case '600':
					$result[] = $alergenName;
					break;
	
				default:
					break;
			};
		}
		;
	};
}else {
	$result = "false";
}
	return $result;
}