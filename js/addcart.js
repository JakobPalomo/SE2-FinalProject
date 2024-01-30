$(document).ready(function () {
  // ... existing code ...

  // Handle Add to Cart button click and show modal
  $(".add-item").click(function () {
    var productId = $(this).data("product-id");
    var productName = $(this).data("product-name");
    var mediumPrice = $(this).data("medium-price");
    var largePrice = $(this).data("large-price");
    var xlPrice = $(this).data("xl-price");
    var xxlPrice = $(this).data("xxl-price");

    // Populate modal with product details
    $("#modalProductName").text(productName);
    $("#modalPrice").text(mediumPrice); // Default to medium price

    // Show modal
    $("#myModal").modal("show");

    // Handle Add to Cart button inside the modal
    $("#addToCartBtn").click(function () {
      var selectedQuantity = $("#quantity").val();
      var selectedSize = $("#size").val();

      // Determine the selected price based on size
      var selectedPrice = 0.0;
      if (selectedSize === "medium") selectedPrice = mediumPrice;
      else if (selectedSize === "large") selectedPrice = largePrice;
      else if (selectedSize === "xl") selectedPrice = xlPrice;
      else if (selectedSize === "xxl") selectedPrice = xxlPrice;

      // Call the addToCart function with selected quantity, size, and product ID
      addToCart(productId, selectedQuantity, selectedSize, selectedPrice);

      // Close the modal
      $("#myModal").modal("hide");
    });
  });

  // ... existing code ...
});
