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
	menge = menge * convert(einheit);
	mengeused = mengeused * convert(mengeusedeinheit); 
	var value = (preis * (mengeused / menge) / 100).toFixed(2);
	
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
	if(kohlenhydrate != "leer"){
		position.parent().parent().siblings('.kohlenhydrate').html('<span class="badge">' + kohlenhydrate + ' g</span>');
	}else{
		position.parent().parent().siblings('.kohlenhydrate').html('<span class="badge">unknown</span>');	
	}
	
	var price = $('#'+table).parents('.panel-body').find('li.preis');
	price.find('span').html(sumTable(table).toFixed(2));

 
}
	
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
			case "ml":
				var factor = 1;
				return factor;
				break;
			case "l":
				var factor = 1000;
				return factor;
				break;

			default:
				var factor = 0;
			return factor;
			
				break;
			}
			};
function sumTable (table) {
	sum = 0;
	$.each($('#'+table+' .preis'),function(){
		if($.isNumeric( $(this).html() ) ){
			sum = sum + parseFloat($(this).html());
		}
		});
	return sum;
}
