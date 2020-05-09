$(document).ready(function() {

	// Update product quantity in cart
	$(".cart-quantity").on('change', function() {
		var element = this;

		setTimeout(function () {
			update_quantity.call(element);
		}, 1000);
	});

	function update_quantity() {
		var pcode = $(this).attr("data-code");
		var quantity = $(this).val();

		// $(this).parent().parent().fadeOut();
		$.getJSON("manage_cart.php", {
			"update_quantity" : pcode,
			"quantity" : quantity
		}, function(data) {
			window.location.reload();
		});
	}

	// Add product to cart
	$(".product-form").submit(function(e) {

		var form_data = $(this).serialize();

		$.ajax({
			url: "manage_cart.php",
			type: "POST",
			dataType:"json",
			data: form_data
		}).done(function(data) {
			$("#cart-container").html(data.products);
			swal({
				title: "Success!",
				text: "Product added to cart!",
				icon: "success",
				button: "Keep shopping!",
			});
		});

		e.preventDefault();
	});

	// Remove products from cart
	$("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
		e.preventDefault();

		var pcode = $(this).attr("data-code");
		$(this).parent().parent().fadeOut();

		$.getJSON( "manage_cart.php", {
			"remove_code" : pcode
		} , function(data) {
			$("#cart-container").html(data.products);
			swal({
				title: "Success!",
				text: "Product removed from cart!",
				icon: "success"
			});

			setTimeout(function () {
				window.location.reload();
			}, 1000);

		});
	});
});