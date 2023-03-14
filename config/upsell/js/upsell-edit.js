jQuery(function($) {
    
	function refresh_text_blocks() {
		$('#text-blocks .card-body').load('ajax.php?v=' + Math.random(), {action: 'get_text_blocks'});
	}
	
	function refresh_products() {
		$('#products .card-body').load('ajax.php?v=' + Math.random(), {action: 'get_products'});
	}
	 
	$(document).on('submit', '.text-blocks-form', function(e) {
		e.preventDefault();
		
		var form_data = new FormData($(this).get(0));
		form_data.append('action', 'edit_text_blocks');

		
		$.ajax({
			url: 'ajax.php',
			type: 'post',
			data: form_data,
			dataType: 'html',
			processData: false,
			contentType: false, 
			success: function(response) {
				if(response){
					alert(response);
				}
			},
			complete: function() {
				refresh_text_blocks();
			}
		});
	});
	
	$(document).on('submit', '.products-form', function(e) {
		e.preventDefault();
		
		var form_data = new FormData($(this).get(0));
		form_data.append('action', 'edit_product');

		
		$.ajax({
			url: 'ajax.php',
			type: 'post',
			data: form_data,
			dataType: 'html',
			processData: false,
			contentType: false, 
			success: function(response) {
				if(response){
					alert(response);
				}
			},
			complete: function() {
				refresh_products();
			}
		});
	});
	
	$(document).on('click', '.del-product', function(e) {
		e.preventDefault();
		
		if(confirm('Вы действительно хотите удалить товар?')) {
			var product_id = $(this).closest('form').find(':hidden[name="product-id"]').val();
			var data = new FormData();
			data.append('action', 'del_product');
			data.append('product_id', product_id);
			
			$.ajax({
				url: 'ajax.php',
				type: 'post',
				data: data,
				dataType: 'html',
				processData: false,
				contentType: false, 
				success: function(response) {
					if(response){
						alert(response);
					}
				},
				complete: function() {
					refresh_products();
				}
			});
		}
	});
	
	$(document).on('click', '.add-product', function(e) {
		e.preventDefault();
		
		var data = new FormData();
		data.append('action', 'add_product');
		
		$.ajax({
			url: 'ajax.php',
			type: 'post',
			data: data,
			dataType: 'html',
			processData: false,
			contentType: false, 
			success: function(response) {
				if(response){
					alert(response);
				}
			},
			complete: function() {
				refresh_products();
			}
		});
	});
	
	$(document).on('click', '.del-image', function(e) {
		e.preventDefault();
		
		var product_id = $(this).closest('form').find(':hidden[name="product-id"]').val();
		var image_id = $(this).data('imageId');
		var data = new FormData();
		data.append('action', 'del_image');
		data.append('product_id', product_id);
		data.append('image_id', image_id);
		
		$.ajax({
			url: 'ajax.php',
			type: 'post',
			data: data,
			dataType: 'html',
			processData: false,
			contentType: false, 
			success: function(response) {
				if(response){
					alert(response);
				}
			},
			complete: function() {
				refresh_products();
			}
		});
	});
	
	refresh_products();
	refresh_text_blocks();
});
 