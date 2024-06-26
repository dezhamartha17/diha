$(document).ready(function() {
    // Function to open modal when add to cart button is clicked
    $('.add-to-cart-btn').click(function() {
        var productId = $(this).data('product-id');
        var productName = $(this).closest('.rounded').find('h2').text();
        $('#modalContent').html(`Add ${productName} to cart?`);
        $('#addToCartModal').removeClass('hidden');
        $('#confirmAddBtn').data('product-id', productId);
    });

    // Function to close modal
    $('#closeModalBtn').click(function() {
        $('#addToCartModal').addClass('hidden');
    });

    // Function to handle confirmation and send data to server
    $('#confirmAddBtn').click(function() {
        var productId = $(this).data('product-id');
        var quantity = $('#quantity').val(); // Get quantity from input

        // Validate quantity (optional)
        if (quantity <= 0) {
            alert('Quantity must be greater than zero.');
            return;
        }

        // Ajax request to send data to server
        $.ajax({
            url: 'add_cart.php',
            type: 'POST',
            data: { productId: productId, quantity: quantity },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.success) {
                    alert('Product added to cart successfully!');
                    $('#addToCartModal').addClass('hidden'); // Close modal
                } else {
                    alert('Failed to add product to cart. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
                alert('Error adding product to cart. Please try again.');
            }
        });
    });
});
