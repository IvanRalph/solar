$("#makeRequestForm").on('submit', function(e){
	e.preventDefault();
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
	  swal(
	    'Success!',
	    'You have successfully submitted 123 - type - Category - Subcategory - Requestor name.',
	    'success'
	  )
	})
});