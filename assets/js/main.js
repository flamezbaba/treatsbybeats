let tproduct = {};

$("#ddm").click(function (e) {
    e.preventDefault();
    $("#delivery-modal").modal("show");
});

$("#ssm").click(function (e) {
    e.preventDefault();
    $("#refund-modal").modal("show");
});

$(".open-order-modal").click(function () {
    var product = $(this).data("product");
    tproduct = product;

    $("#product-modal #product-name").text(product.name);
    $("#product-modal #product-desc").text(product.description);
    $("#product-modal #product-price").text(product.price);
    $("#product-modal #product-image").attr("src", product?.image_url);

    var qty = $("#product-modal #product-quantity");
    qty.val(1);

    var total = calcTotal(product.price, qty.val());
    $("#product-modal #product-total").text(total);
    $("#product-modal").modal("show");
});

$("#product-modal #product-quantity").on("input", function () {
    var qty = $("#product-modal #product-quantity");
    var total = calcTotal(tproduct.price, qty.val());
    $("#product-modal #product-total").text(total);
});

function calcTotal(price, qty) {
    var aprice = parseFloat(price);
    var aqty = parseInt(qty);
    var total = aprice * aqty;

    return isNaN(total) ? 0 : total.toFixed(2);
}

$(".add-to-cart").click(function () {
    var product = tproduct;

    // Multiply quantity by the price
    product.totalPrice = $("#product-modal #product-total").text();
    product.qty = $("#product-modal #product-quantity").val();

    // Retrieve the existing cart items from localStorage
    var products = JSON.parse(localStorage.getItem("cartItems")) || [];

    // Check if the product is already in the cart
    var existingProduct = products.find(function (item) {
        return item.id == product.id;
    });

    if (existingProduct) {
        // The product is already in the cart, update its quantity and total price
        existingProduct.qty = product.qty;
        existingProduct.totalPrice = product.totalPrice;
    } else {
        // The product is not in the cart, add it to the cart
        products.push(product);
    }

    // Save the updated cart back to localStorage
    localStorage.setItem("cartItems", JSON.stringify(products));

    count();
    renderCartItems();
    alert("Item Added to Cart");
    // $("#product-modal").modal("hide");
});

$(".clear-all-cart").click(function () {
    clearAllCart();
    renderCartItems();
    $(".cart-list").hide();
});

function clearAllCart() {
    localStorage.setItem("cartItems", JSON.stringify([]));
}

function renderCartItems() {
    let total = 0;
    // Retrieve the items from localStorage
    var products = JSON.parse(localStorage.getItem("cartItems")) || [];

    // Get a reference to the ul element
    var cartList = document.querySelector("#top-cart-item");

    // Clear the existing items in the list (if any)
    cartList.innerHTML = "";

    products.forEach(function (product) {
        total = Number(product.totalPrice) + total;

        var li = document.createElement("li");
        li.classList.add("cart-item");

        var itemHtml = `
            <div class="media">
                <div class="media-left">
                    <a href="product-detail.html">
                        <img alt="" class="media-object" src="${product.image_url}">
                    </a>
                </div>
                <div class="media-body">
                    <h6 class="dz-title">
                        <a href="product-detail.html" class="media-heading">${product.name}</a>
                    </h6>
                    <span class="dz-price">$${product.totalPrice}</span>
                    <span class="item-close remove-cart-btn" data-product-id="${product.id}">&times;</span>
                </div>
            </div>
        `;

        li.innerHTML = itemHtml;
        cartList.appendChild(li);
    });

    var removeButtons = document.querySelectorAll(".remove-cart-btn");
    removeButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            removeItemFromCart(button.getAttribute("data-product-id"));
            renderCartItems();
            renderCartPage();
        });
    });

    $(".cart-list #ttp").text(total.toFixed(2));

    count();
}

function removeItemFromCart(id) {
    // Get the products from localStorage
    var products = JSON.parse(localStorage.getItem("cartItems")) || [];

    // Find and remove the item from the products array
    var updatedProducts = products.filter((product) => product.id != id);

    // Save the updated products back to localStorage
    localStorage.setItem("cartItems", JSON.stringify(updatedProducts));
}

renderCartItems();

function count() {
    const num = JSON.parse(localStorage.getItem("cartItems"));
    const numCount = num.length;
    $("#cartNumber").text(numCount);
}
