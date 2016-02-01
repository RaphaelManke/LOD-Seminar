	$(document).ready(function() {
		$.each($("select option:selected"), function() {
			update($(this));
		});
				
 	    $('select').change(function() {	    	
 	    	var position = $(this).find(':selected');
 	    	update(position);
 	    	});
	});
	
function update(position){
	var table = position.parents('table').attr('id');
    var preis = position.data('preis');
    var id = position.data('id');
	var menge=position.data('menge');
	var einheit=position.data('einheit');
	var mengeused=position.data('mengeused');
	var mengeusedeinheit=position.data('mengeused-einheit');
	var alergene = position.data('hatalergene');
	var kohlenhydrate = position.data('kohlenhydrate');
	var kalorien = position.data('kalorien');
	var zucker = position.data('zucker');
	var fett = position.data('fett');
	menge = menge * convert(einheit);
	mengeused = mengeused * convert(mengeusedeinheit);
	if ($.isNumeric(kohlenhydrate)){
		kohlenhydrate = kohlenhydrate * (mengeused * convert(mengeusedeinheit) / 100 ).toFixed(2);	
	}
	if ($.isNumeric(kalorien)){
		kalorien = kalorien * (mengeused * convert(mengeusedeinheit) / 100 ).toFixed(2);	
	}
	if ($.isNumeric(zucker)){
		zucker = zucker * (mengeused * convert(mengeusedeinheit) / 100 ).toFixed(2);	
	}
	if ($.isNumeric(fett)){
		fett = fett * (mengeused * convert(mengeusedeinheit) / 100 ).toFixed(2);	
	}
	if (menge != 0) {
		var value = (preis * (mengeused / menge) / 100).toFixed(2);
	}else{
		var value = 0;
	}
	
	
	if (alergene == "unknown"){
		position.parent().parent().siblings('.allegene').html('<span class="label label-default">' + alergene + '</span>');	
	}
	else if (alergene == "none") {
		position.parent().parent().siblings('.allegene').html('<span class="label label-success">' + alergene + '</span>');
	}
	else {
		position.parent().parent().siblings('.allegene').html('<span class="label label-danger">' + alergene + '</span>');
	}
	if ($.isNumeric(value)){
	    $('#preis-'+id).text(value);
	}
	if($.isNumeric(kohlenhydrate)){
		position.parent().parent().siblings('.kohlenhydrate').html('<span class="label label-primary">' + kohlenhydrate.toFixed(2) +'</span>');
	}else{
		position.parent().parent().siblings('.kohlenhydrate').html('<span class="label label-default">unknown</span>');	
	}
	if($.isNumeric(kalorien)){
		position.parent().parent().siblings('.kalorien').html('<span class="label label-primary">' + kalorien.toFixed(2) + '</span>');
	}else{
		position.parent().parent().siblings('.kalorien').html('<span class="label label-default">unknown</span>');	
	}
	if($.isNumeric(fett)){
		position.parent().parent().siblings('.fett').html('<span class="label label-primary">' + fett.toFixed(2) + '</span>');
	}else{
		position.parent().parent().siblings('.fett').html('<span class="label label-default">unknown</span>');	
	}
	if($.isNumeric(zucker)){
		position.parent().parent().siblings('.zucker').html('<span class="label label-primary">' + zucker.toFixed(2) + '</span>');
	}else{
		position.parent().parent().siblings('.zucker').html('<span class="label label-default">unknown</span>');	
	}
	
	var price_field = $('#'+table).parents('.panel-body').find('li.preis');
	price_field.find('span').html(sumTable(table,' .preis').toFixed(2)+' &euro;');
	var kalorien_field = $('#'+table).parents('.panel-body').find('li.kalorien');
	kalorien_field.find('span').html(sumTable(table,' .kalorien span').toFixed(2)+' kcal');
	var zucker_field = $('#'+table).parents('.panel-body').find('li.zucker');
	zucker_field.find('span').html(sumTable(table,' .zucker span').toFixed(2)+' g');
	var fett_field = $('#'+table).parents('.panel-body').find('li.fett');
	fett_field.find('span').html(sumTable(table,' .fett span').toFixed(2)+' g');

 
}
	
	function convert (input){
			input = input.toString().toLowerCase();
			switch (input) {
			case "kg":
				var factor = 1000;
				return factor;
				break;
			case "kilogramm":
				var factor = 1000;
				return factor;
				break;
			case "g":
				var factor = 1;
				return factor;
				break;
			case "gramm":
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
			case "prise":
				var factor = 1/5;
				return factor;
				break;
			case "ml":
				var factor = 1;
				return factor;
				break;
			case "milliliter":
				var factor = 1;
				return factor;
				break;
			case "l":
				var factor = 1000;
				return factor;
				break;
			case "liter":
				var factor = 1000;
				return factor;
				break;
			case "st":
				var factor = 1;
				return factor;
				break;
			case "stueck":
				var factor = 1;
				return factor;
				break;
			case "stück":
				var factor = 1;
				return factor;
				break;
			case "tl":
				var factor = 4;
				return factor;
				break;
			case "teelöffel":
				var factor = 4;
				return factor;
				break;
			case "teeloeffel":
				var factor = 4;
				return factor;
				break;
			case "el":
				var factor = 10;
				return factor;
				break;
			case "esslöffel":
				var factor = 10;
				return factor;
				break;
			case "essloeffel":
				var factor = 10;
				return factor;
				break;
			case "scheibe":
				var factor = 30;
				return factor;
				break;
			case "tasse":
				var factor = 150;
				return factor;
				break;
			case "false":
				var factor = 1;
				return factor;
				break;

			default:
				var factor = 0;
			return factor;
			
				break;
			}
			};
function sumTable (table, colum) {
	sum = 0;
	$.each($('#'+table+colum),function(){
		$value = $(this).html();
		if($.isNumeric( $value ) ){
			sum = sum + parseFloat($(this).html());
		}
		});
	return sum;
}
