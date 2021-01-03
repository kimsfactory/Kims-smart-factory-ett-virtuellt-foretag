$(document).ready(function() {

	$('.delete-order-btn').on('click', deleteOrderEvent);
		function deleteOrderEvent(e) {
			e.preventDefault();
		
			let orderId = $(this).parent().find('$order['id']');
			
		$.ajax({
			method: 'POST',
			url: 'deleteOrder.php',
			data: { 
				delete-order-btn: true, 
				orderId: orderId.val() 
			},
			dataType: 'json',
			success: function(data) {
				appendOrderList(data);
			},
		});
	}



	$('#search-input').on('keyup', function() {
		getOrderList($(this).val());
	});

	function getOrderList(searchQuery) {
		$.ajax({
			method: 'GET',
			url: 'searchOrder.php',
			data: {
				searchQuery: searchQuery 
			},
			dataType: 'json',
			success: function(data) {
				appendOrderList(data);
			},
		});
	}

	// Run the function getPunlist, on new pageload
	window.load = getOrderList('');



	function appendOrderList(data) {
		let html = '';
		for (id of data['orders']) {

			html +=
				'<tr>' +
			      '<td>' + '<a href="order.php?id=<?=$order['id']?>">' + '#' + '<?=$order['id']?>' + '</a>' + '</td>' +
			      '<td>' + '<?=$order['billing_full_name']?>' + '</td>' +
			      '<td>' + '<?=$order['total_price']?>' + '</td>' +
			      '<td>' +
					'<select name="status" id="status" class="form-control">' +
					    '<option>' + 'Öppen' + '</option>' +
					    '<option>' + 'Behandlas' + '</option>' +
					    '<option>' + 'Skickad' + '</option>' +
					    '<option>' + 'Makulerad' + '</option>' +
					'</select>' +
			      '</td>' +
			      '<td>' +
			      	'<button type="submit" class="btn delete-order-btn">' +
			      		'<svg class="bi bi-trash" width="2" height="2" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
  							'<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>' +
 	 						'<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>' +
						'</svg>' +
					'</button>' +
			      '</td>' +
			    '</tr>';
				
		}

		$('#order-list').html(html);

		$('.delete-order-btn').on('click', deleteOrderEvent);
	}
	
});	