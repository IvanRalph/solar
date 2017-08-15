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

$("#clear").on('click', function(e){
	e.preventDefault();

	swal({
	  title: 'Are you sure?',
	  text: "Are you sure you want to clear all entered information?",
	  type: 'question',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes',
	  cancelButtonText: 'No'
	}).then(function () {
		$("#makeRequestForm")[0].reset();
	})
})

$("#cancel").on('click', function(e){
	e.preventDefault();
	swal({
	  title: 'Are you sure?',
	  text: "Are you sure you want to cancel and discard prepared request?",
	  type: 'question',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes',
	  cancelButtonText: 'No'
	}).then(function () {
	  window.location.href = "index.php";
	})
})

$("#deleteRequest").on('click', function(e){
	e.preventDefault();
	var id = $(this).data("id");
	swal({
	  title: 'Are you sure?',
	  text: "Are you sure you want to delete this request?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes',
	  cancelButtonText: 'No'
	}).then(function () {
		$.ajax({
			url: 'php/softDelete.php',
			type: 'POST',
			data: 'id=' + id,
			success: function(data, status){
				if(data == 'success'){
					swal(
					  'Deleted!',
					  'The request has been deleted',
					  'success'
					).then(function(){
						location.reload();
					})					
				}else if(data == 0){
					swal(
						'Oops..',
						'The request you are trying to delete doesn\'t exist. Reloading page...',
						'warning'
					).then(function(){
						location.reload();
					})
				}else{
					swal(
					  'Error!',
					  'There was an error in deleting your request, check logs for more info.',
					  'error'
					)
					console.log(data);
				}
			},
			error: function(xhr, status, thrown){
		        console.log("ERROR: " + status + " THROW: " + thrown + " XHR: " + xhr.responseText);
		    }
		})
	})
})

$('#viewRequest').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('whatever')
  var modal = $(this)
  $.ajax({
  	url: 'php/populateModal.php',
  	type: 'POST',
  	data: 'id=' + recipient,
  	dataType: 'JSON',
	success: function(data, status){
		modal.find('.modal-title').text('Request Number: ' + data.request_no);
		modal.find('#modal-type').val(data.type);
		modal.find('#modal-category').val(data.category);
		modal.find('#modal-subcategory').val(data.subcategory);
		modal.find('#modal-description').val(data.description);
		modal.find('#modal-assigned-to').val(data.assigned_to);

	},
	error: function(xhr, status, thrown){
        console.log("ERROR: " + status + " THROW: " + thrown + " XHR: " + xhr.responseText);
    }
  });
});