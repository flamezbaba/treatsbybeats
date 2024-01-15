@extends('layouts.main')
@section('add_js')
    <script>
        function renderCartPage() {
            let cptotal = 0;
            // Retrieve the cart items from localStorage to cart page
            var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];

            var cartItemsContainer = document.querySelector(".cart-items-container");

            var itemCount = cartItems.length;
            $("#item-count").text(itemCount);

            cartItemsContainer.innerHTML = "";

            cartItems.forEach(function(cartItem) {
                cptotal = Number(cartItem.totalPrice) + cptotal;
                var itemDiv = document.createElement("div");
                itemDiv.classList.add("cart-item", "style-1");

                itemDiv.innerHTML = `
                    <div class="dz-media">
                        <img src="${cartItem.image_url}" alt="">
                    </div>
                    <div class="dz-content">
                        <div class="dz-head">
                            <h6 class="title mb-0">${cartItem.name} ($${cartItem.price})</h6>
                            <span class="remove-cart-btn-vpage" data-product-id="${cartItem.id}"><i
                                    class="fa-solid fa-xmark text-danger"></i></span>
                        </div>

                        <div class="dz-body">
                            <div class="btn-quantity style-1">
                                <input type="number" data-product-id="${cartItem.id}" value="${cartItem.qty}" class="form-control cpqty"
                                    style="width: 90px;" min="1">

                            </div>
                            <h5 class="price text-primary mb-0">$${cartItem.totalPrice}</h5>
                        </div>
                    </div>
                `;

                cartItemsContainer.appendChild(itemDiv);

            });

            var removeButtons = document.querySelectorAll(".remove-cart-btn-vpage");
            removeButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    removeItemFromCart(button.getAttribute("data-product-id"));
                    renderCartItems();
                    renderCartPage();
                });
            });

            var qtyInput = document.querySelectorAll(".cpqty");
            qtyInput.forEach(function(inp) {
                inp.addEventListener("input", function() {
                    updateItemQty(inp.getAttribute("data-product-id"), inp.value);
                    renderCartItems();
                    renderCartPage();
                });
            });

            $(".cptp").text(cptotal.toFixed(2));
        }

        function updateItemQty(id, qty) {
            var products = JSON.parse(localStorage.getItem("cartItems"));

            var product = products.map(function(item) {
                if (item.id == id) {
                    item.qty = qty;
                    item.totalPrice = calcTotal(item.price, qty);
                }

                return item;
            });

            localStorage.setItem("cartItems", JSON.stringify(product));
        }

        $("#product-modal #product-quantity").on("input", function() {
            var qty = $("#product-modal #product-quantity");
            var total = calcTotal(tproduct.price, qty.val());
            $("#product-modal #product-total").text(total);
        });

        renderCartPage();

        var cxcc = JSON.parse(localStorage.getItem("cartItems")) || [];
        $("#axa").hide();
        $("#bxb").hide();
        if (cxcc.length > 0) {
            $("#axa").show();
        } else {
            $("#bxb").show();
        }

        @auth

        $('.submit-order-btn').click(function() {
            $.ajax({
                url: "{{ route('ajax.cart.record') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    products: JSON.parse(localStorage.getItem("cartItems")),
                },
                beforeSend: function() {
                    $('.submit-order-btn').attr('disabled', true).html("Processing...");
                },
                success: function(response) {
                    $('.submit-order-btn').attr('disabled', false).html("Place Order");
                    clearAllCart();
                    window.location.href = response.data;
                },
                error: function(response) {
                    $('.submit-order-btn').attr('disabled', false).html("Place Order");
                    alert("Order Failed");
                }
            });
        });
        @endauth

        @guest
        $('.submit-order-btn').click(function(e) {
            e.preventDefault();
            $("#confirm-modal").modal("show");
        });
        @endguest
    </script>
@endsection
@section('content')
    <div class="page-content bg-white">
        <!-- Banner  -->
        <div class="dz-bnr-inr style-1 text-center bg-parallax tpbr">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>Shop Cart</h1>
                </div>
            </div>
        </div>
        <!-- Banner End -->

        <!-- Cart Section -->
        <section class="content-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6" id="axa">
                        <div class="widget" style="margin-bottom: 10px;">
                            <div class="shop-filter style-1">
                                <div class="d-flex justify-content-between">
                                    <div class="widget-title">
                                        <h5 class="title m-b30">Cart (<span class="text-primary" id="item-count">0</span>)
                                        </h5>
                                    </div>
                                </div>
                                <div class="cart-items-container">
                                </div>
                                <div class="cart-items-containerd">

                                    <div class="order-detail">
                                        <h6>Bill Details</h6>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>Total Price</td>
                                                    <td class="price text-primary">$ <span class="cptp">0.00</span> </td>
                                                </tr>
                                                <tr class="charges">
                                                    <td>Delivery Charges</td>
                                                    <td class="price text-primary">$ 0.00</td>
                                                </tr>

                                                <tr class="total">
                                                    <td>
                                                        <h6>Total</h6>
                                                    </td>
                                                    <td class="price text-primary">$ <span class="cptp">0.00</span></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <button
                                class="btn btn-primary d-block text-center btn-md w-100 btn-hover-1 submit-order-btn"><span>Order
                                    Now <i class="fa-solid fa-arrow-right"></i></span></button>
                        </div>
                    </div>
                    <div class="col-lg-6" id="bxb">
                        <div class="widget" style="margin-bottom: 10px;">
                            <div class="shop-filter style-1">
                                <div class="cart-items-containerdd">
                                    <div class="order-detail">
                                        <h6 style="text-align: center;">No Products in your cart</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <a href="{{ route('menu') }}"
                                class="btn btn-primary d-block text-center btn-md w-100 btn-hover-1"><span>Place
                                    Order
                                    Now <i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
                <div class="dz-divider bg-gray-dark icon-center my-5">
                    <i class="fa fa-circle bg-white text-primary"></i>
                </div>

            </div>
        </section>
        <!-- cart Section -->

    </div>

    <style>
        .pxxp {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <div class="modal modal-detail fade" id="confirm-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body pxxp">

                    <div class="detail-info">
                        <a href="{{ route('user.login') }}?via=cart"
                            class="btn btn-primary d-block text-center btn-md w-100 btn-hover-1"><span>Login
                                <i class="fa-solid fa-arrow-right"></i></span></a>
                        <p class="" style="margin-top: 20px; margin-bottom: 20px; text-align: center;">OR</p>
                        <a href="{{ route('user.register') }}?via=cart"
                            class="btn btn-primary d-block text-center btn-md w-100 btn-hover-1"><span>Create Account
                                <i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
