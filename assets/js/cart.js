$(document).ready(function()
{

	// Update product quantity in cart
	$(".cart-quantity").on('change', function()
	{
		var element = this;

		setTimeout(function ()
		{
			update_quantity.call(element);
		}, 500);
	});

	function update_quantity()
	{
		var pcode = $(this).attr("data-code");
		var quantity = $(this).val();

		// $(this).parent().parent().fadeOut();
		$.getJSON("manage_cart.php",
		{
			"update_quantity" : pcode,
			"quantity" : quantity
		}, function(data)
		{
			window.location.reload();
		});
	}

	// Add product to cart
	$(".product-form").submit(function(e)
	{

		var form_data = $(this).serialize();
		const el = document.createElement('div');
		el.innerHTML = "<a href='cart.php' class='btn btn-outline-primary'>Go to cart</a>";

		$.ajax({
			url: "manage_cart.php",
			type: "POST",
			dataType:"json",
			data: form_data
		}).done(function(data)
		{
			$("#cart-container").html(data.products);
			swal({
				title: "Product added to cart!",
				content: el,
				icon: "success",
				button: "Keep shopping!",
			});
		});

		e.preventDefault();
	});

	// Remove products from cart
	$("#shopping-cart-results").on('click', 'a.remove-item', function(e)
	{
		e.preventDefault();

		var pcode = $(this).attr("data-code");
		$(this).parent().parent().fadeOut();

		$.getJSON( "manage_cart.php", {
			"remove_code" : pcode
		} , function(data) {
			$("#cart-container").html(data.products);
			swal({
				title: "Product removed from cart!",
				icon: "success"
			});

			setTimeout(function ()
			{
				window.location.reload();
			}, 1500);

		});
	});
});