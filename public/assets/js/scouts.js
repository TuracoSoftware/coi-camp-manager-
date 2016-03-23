$(document).ready(function(){


	function custom_on_change(str, day){

		var classes_am_pm = $('.'+day);

		var classes_day = [].map.call(classes_am_pm, function (el) {
						  			return el.getAttribute("value");
								});

		$('#'+str+'912').on('change', function(){
			if($.inArray( $(this).val(), classes_day )  != -1){
				var c_value = $(this).val();
				//remove selected one
				$('#'+str+'25 option:selected').removeAttr('selected');
				//Using the value
				$('#'+str+'25').find('option[value='+c_value+']').attr("selected",true);
				$('#'+str+'25').val(c_value);

			}else{

				if($.inArray( $('#'+str+'25').val(), classes_day )  != -1){
					var o_value = $('#'+str+'25').val();
					$('#'+str+'25 option:selected').removeAttr('selected');
					//Using the value
					$('#'+str+'25').find('option[value="Free"]').attr("selected",true);
					$('#'+str+'25').val("Free");

				}

			}

		});

	}

	function custom_on_change_down(str, day){

		var classes_am_pm = $('.'+day);

		var classes_day = [].map.call(classes_am_pm, function (el) {
						  			return el.getAttribute("value");
								});

		$('#'+str+'25').on('change', function(){
			if($.inArray( $(this).val(), classes_day )  != -1){
				var c_value = $(this).val();
				//remove selected one
				$('#'+str+'912 option:selected').removeAttr('selected');
				//Using the value
				$('#'+str+'912').find('option[value='+c_value+']').attr("selected",true);
				$('#'+str+'912').val(c_value);

			}else{

				if($.inArray( $('#'+str+'912').val(), classes_day )  != -1){
					var o_value = $('#'+str+'912').val();
					$('#'+str+'912 option:selected').removeAttr('selected');
					//Using the value
					$('#'+str+'912').find('option[value="Free"]').attr("selected",true);
					$('#'+str+'912').val("Free");

				}

			}

		});

	}

	custom_on_change('mo', 'monday');
	custom_on_change_down('mo', 'monday');

	custom_on_change('tu', 'tuesday');
	custom_on_change_down('tu', 'tuesday');

	custom_on_change('we', 'wednesday');
	custom_on_change_down('we', 'wednesday');

	custom_on_change('th', 'thursday');
	custom_on_change_down('th', 'thursday');

	custom_on_change('fr', 'friday');
	custom_on_change_down('fr', 'friday');



});
