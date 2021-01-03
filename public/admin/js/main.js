$(document).ready(function() {
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var title = button.data('title'); // Extract info from data-* attributes
        var description = button.data('description'); // Extract info from data-* attributes
        var price = button.data('price'); // Extract info from data-* attributes
        var id = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find(".modal-body input[name='title']").val(title);
        modal.find(".modal-body textarea[name='description']").val(description);
        modal.find(".modal-body input[name='price']").val(price);
        modal.find(".modal-body input[name='id']").val(id);
    });
    //add info with ajax
	$('#add-product-btn').on('click', addProductEvent);
	function addProductEvent(e) {
		e.preventDefault();
		let title         = $('input[name="title"]');
		let description   = $('textarea[name="description"]');
		let price         = $('input[name="price"]');
		$.ajax({
			method: 'POST',
			   url: 'add.php',
			  data: {
                  addBtn: true, 
				   title: title.val(),
             description: description.val(),
                   price: price.val()
			}, 
			dataType: 'json',
			 success: function(data) {
//				console.log(data);
				$('#form-message').html(data['message']);
				appendProductList(data);
			},
		});
	}
    //delete info with ajax
	$('.delete-product-btn').on('click', deleteProductEvent);
	function deleteProductEvent(e) {
		e.preventDefault();
		let hidId = $(this).parent().find('input[name="hidId"]');
        //console.log(hidId.val());
		$.ajax({
			method: 'POST',
			   url: 'delete.php',
			  data: { 
				deleteBtn: true, 
				    hidId: hidId.val() 
			},
			dataType: 'json',
			 success: function(data) {
                //console.log(data);
				$('#form-message').html(data['message']);
				appendProductList(data);
			},
		});
	}
    //update info with ajax
	$('.update-product-btn').on('click', updateProductEvent);
	function updateProductEvent(e) {
		e.preventDefault();
		let id          = $('#exampleModal input[name="id"]');
		let title       = $('#exampleModal input[name="title"]');
		let description = $('#exampleModal textarea[name="description"]');
		let price       = $('#exampleModal input[name="price"]');
		// console.log(id.val());
		// console.log(description.val());
		$.ajax({
			method: 'POST',
			   url: 'update.php',
			  data: { 
				  updateBtn: true, 
				      title: title.val(),
				description: description.val(),
				      price: price.val(),
				         id: id.val()
			},
			dataType: 'json',
			 success: function(data) {
				// console.log(data);
				$('#form-message').html(data['message']);
				appendProductList(data);
				$('#exampleModal').modal('toggle');
			},
		});
	}
	function appendProductList(data) {
		let html = '';
		for (product of data['products']) {
//			console.log(product);
			html +=
				'<li class="list-group-item border-info mb-1">' +
					'<p class="float-left">' +
						'<h3>'+ product['title'] + '</h3>' +
						        product['description'] +
                        '<h4>'+ product['price'] + '</h4>' +
					'</p>' +
					'<form action="" method="POST" class="float-right">' +
						'<input type="hidden" name="hidId" value="' + product['id'] + '">' +
						'<input type="submit" name="deleteBtn" value="Delete" class="btn btn-danger delete-product-btn">' +
					'</form>' +
					'<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal" data-title="' + product['title'] + '" data-description="' + product['description'] + '" data-price="' + product['price'] + '" data-id="' + product['id'] + '">Update</button>' +
				'</li>';
		}
		// Append newly generetad pun list
		$('#product-list').html(html);
		// Add eventlisteners
		$('.delete-product-btn').on('click', deleteProductEvent);
	}
});	