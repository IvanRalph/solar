$("#makeRequestForm").on('submit', function(e){
	e.preventDefault();
	var type = $("select[name='request-type']").val();
	var category = $("select[name='request-category']").val();
	var subcategory = $("select[name='request-subcategory']").val();
	var description = $("textarea[name='request-description']").val();
	if(type == 'Type' || category == 'Category' || subcategory == 'Subcategory' || description == ''){
		swal('Oops..', 'Please fill in all fields', 'warning');
	}else{
		swal({
		  title: 'Confirm',
		  text: "Are you sure you want to submit this request?",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes',
		  cancelButtonText: 'No'
		}).then(function () {
		  var formData = $("#makeRequestForm").serialize();
		  $.ajax({
		  	url: "php/makerequest.php",
		  	type: 'POST',
		  	data: formData,
		  	dataType: 'JSON',
		  	success: function(data, status){
		  		if(data.status == "success"){
		  			swal(
		  			  'Success!',
		  			  'You have successfully submitted \''+ data.request_no +' - '+ data.type +' - '+ data.category +' - '+ data.subcategory +' - '+ data.name +'.\'',
		  			  'success'
		  			);
		  		}else{
		  			console.log("ERROR: " + data);
		  		}
		  	},
		  	error: function(xhr, status, thrown){
	            console.log("ERROR: " + status + " THROW: " + thrown + " XHR: " + xhr.responseText);
	        }
		  });
		}).then(function(){
			$("#makeRequestForm")[0].reset();
		});
	}
});

$("select[name='request-type']").on('change', function(){
	$.ajax({
		url: 'php/populateSelect.php',
		type: 'POST',
		data: 'request-type=' + $(this).val() + '&a=type',
		dataType: 'JSON',
		success: function(data, status){
			var $el = $("select[name='request-category']");
			$el.empty();
			$el.append($("<option></option>").text('Category'));
			$.each(data, function(key,value) {
			  $el.append($("<option></option>").text(value.category));
			});
		},
		error: function(xhr, status, thrown){
            console.log("ERROR: " + status + " THROW: " + thrown + " XHR: " + xhr.responseText);
        }
	});
});

$("select[name='request-category']").on('change', function(){
	$.ajax({
		url: 'php/populateSelect.php',
		type: 'POST',
		data: 'request-type=' + $(this).val() + '&a=category',
		dataType: 'JSON',
		success: function(data, status){
			var $el = $("select[name='request-subcategory']");
			$el.empty();
			$el.append($("<option></option>").text('Subcategory'));
			$.each(data, function(key,value) {
			  $el.append($("<option></option>").text(value.subcategory));
			});
		},
		error: function(xhr, status, thrown){
            console.log("ERROR: " + status + " THROW: " + thrown + " XHR: " + xhr.responseText);
        }
	});
});