/* Simple script created by -- cesarherreralic
   you can find me on 
   http://fiverr.com/cesarherreralic
   email: cesarherreralic@gmail.com
*/

//$(document).ready(function(){



function open_modal(question, url, ajax = false, method = false){
	console.log('calling open_modal');
	$('#modalyn .textcontent').html(question);

	if(ajax){

		if(method === false){
			method = 'POST';
		}

		//add <button type="button"></button> with function that handle ajax 
		$('#modalyn .yes').attr('onclick', "send_a_request('"+url+"', '"+method+"')");

	}else{
		
		//add <a></a> with link to url
		$('#modalyn .yes').html('<a class="btn btn-small btn-primary" href="'+url+'">yes</a>');
	}

	$('#modalyn').modal("show");

}


// function close_modal(){
// 	$('#modalyn').modal("hide");
// }


function send_a_request(url, method = false){
	console.log('calling send_a_request');
	//
	console.log(url);
	console.log(method);

	var dataToSend = $(this).serializeArray();

	if(method !== false){
		if(method == 'DELETE'){
			dataToSend.push({name: "_method", value: 'DELETE'});
		}
		if(method == 'PUT'){
			dataToSend.push({name: "_method", value: 'PUT'});
		}
	}

	$.ajax({	//create an ajax request to load_page.php
		headers: {
	      'X-CSRF-Token': $('meta[name="_token"]').attr('content')
	    },
		type: "POST",
		url: url,
		data: dataToSend,
		success: function(msg){
			console.log('SUCCESS');
			if(msg == 'success'){
				 window.location.href = window.location.pathname;
			}
			if(msg == 'error'){
				$('#modalyn').modal("hide");
			}
			console.log(msg);
		},
		error: function(msg){
			console.log('ERROR');
			console.log(msg);
		}
	});


}



//});