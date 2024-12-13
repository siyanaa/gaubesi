@extends("frontend.layouts.master")
@include ("frontend.singlebuy")


<style>
    .advertisement {
        background: linear-gradient(rgba(124, 158, 119, 1) 0%,
                rgba(44, 56, 42, 1) 100%);
    }

    .offerprice {
        background: var(--off-green);

    }

    .offercard {
        background: var(--green);
    }

    .customcard {
        border: 2px solid var(--border-color);

    }

    .imgf {
        border-bottom: 1px solid var(--border-color);
    }

    .wrongprice {
        text-decoration: line-through;

    }

    .fa-star {
        color: var(--yellow);

    }

    .topic-collection {
        border-bottom: 1px solid var(--border-color);
    }

    .underlineborder {
        position: relative;
        color: var(--yellow);
    }

    .underlineborder::after {
        content: " ";
        color: var(---yellow);
        position: absolute;
        display: block;
        height: 4px;
        width: 76%;
        bottom: -1rem;
        border-bottom: 4px solid var(--yellow);

    }

    .customcard-dup {
        background: rgba(153, 153, 153, 0.12);

    }

    .daydeal {
        background: #F1F4F0;
    }


    .descriptionborder {
        border: 1px solid red;
        border-radius: var(--radius4);
    }



    .findstockbutton {
        background-color: #FDE0E9 !important;
        border: 1px solid var(--text-gray) !important;
        color: var(--yellow) !important;
    }

    .forline {
        height: 1px;
        width: 100%;
        background: var(--border-color);
        color: red;

    }

    .routingname {
        background-color: #f5f5f5;
    }

    .btn-xs {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius4);
        height:28px;
        width: 44px;
        font-size:24px;
        font-family: var(--font-family);
        font-weight: var(--weight700);
    }

    @media(max-width:450px) {
        .needhide {
            display: none;
        }

        .col-md-3 .customcard:nth-child(even) {
            margin-top: 0.5rem;
        }
    }

    .sidebar .searchcontainer {
        background: var(--off-green);
        border-radius: var(--radius4);
    }

   

    .deleteall {
        color: red !important;
        cursor: pointer;

    }
</style>

@section("content")
<section class="container-fluid routingname">
    <div class="container py-3">
        <p class="sm-text"><i class="fa-solid fa-location-dot greenhighlight"></i> <span>Home</span> . <span>Cart</span></p>
    </div>
</section>

<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="container-fluid py-2 mt-2">
    <div class="container">
        <div class="row d-flex align-items-start gap-5">
            <!-- Cart Details Section -->
            <div class="col-md-8 order-2 order-md-1">
                <div class="row">
                    <div class="col-md-12 fbc mb-3">
                        <p class="md-text" id="cart-count">Cart Details ({{ count($cart) }})</p>
                        <p class="sm-text deleteall" onclick="clearSelectedItems()">Clear </p>
                    </div>

                    <div id="cart-items-container">
                        @forelse($cart as $index => $item)
                            <div class="col-md-12 gap-2 cart-item" data-index="{{ $index }}">
                                <div class="row d-flex align-items-center border rounded shadow-sm bg-light py-3 my-1">
                                    <div class="col-md-3 d-flex align-items-center col-2">
                                        <input type="checkbox" class="btn-xsbutton cart-item-checkbox" data-item-id="{{ $item['id'] }}" />
                                        <img src="{{ asset($item['image']) }}" alt="" class="col-md-5 smimage-lg smimage-lgcd mx-2">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="sm-text"><strong>{{ $item['title'] }}</strong></h5>
                                        <p class="sm-text py-1"><strong>Sold By:</strong> <span>Your Store</span></p>
                                    </div>
                                    <div class="d-flex align-items-center gap-1 col-md-3">
                                        <button class="btn-xs quantity-btn" onclick="updateQuantity({{ $index }}, 'decrease')">-</button>
                                        <span class="btn-xsbutton-lg p-0 m-0 quantity-display">{{ $item['quantity'] }}</span>
                                        <button class="btn-xs quantity-btn" onclick="updateQuantity({{ $index }}, 'increase')">+</button>
                                    </div>
                                    <p class="xs-text-bd yellowhighlight m-md-0 m-2 col-md-2 item-total">Rs {{ $item['price'] * $item['quantity'] }}</p>
                                </div>
                            </div>
                        @empty
                            <p id="empty-cart-message">Your cart is empty</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="col-md-3 border rounded shadow-sm bg-light py-3 my-1 order-1 order-md-2 mt-md-5">
                <div class="row col-md-12 green p-3 gap-2">
                    <p class="topic-collection md-text p-1">Order Summary</p>
                    <span class="sm-text topic-collection p-1" id="total-items">Total items: {{ count($cart) }}</span>
                    <span class="sm-text topic-collection p-1" id="total-price">
                        Total Price: Rs {{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) }}
                    </span>
                    <button class="btn-buttonoutline-sm p-0 m-0" id="orderSummaryBuyNow">Buy Now</button>
                </div>
            </div>
            
        </div>
    </div>
    <div class="modal fade" id="orderFormModal" tabindex="-1" aria-labelledby="orderFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderFormModalLabel">Complete Your Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="container orderform pt-2 pb-3 rounded">
                        <div class="d-flex py-3 align-items-center bg-inherit">
                            <img src="{{ asset('image/logos.png') }}" alt="Logo" class="logoimg" />
                            <p class="lg-texts whitehighlight"></p>
                        </div>
                        <div class="bill-details d-flex flex-column gap-2 mt-3">
                            <p class="xs-text"><span class="label">Bill No:</span> <span class="value xs-text"></span></p>
                            <p class="xs-text"><span class="label">Date:</span> <span class="value" id="currentDate"></span></p>
                            <div class="d-flex flex-column gap-1 py-1">
                                <label for="location" class="label xs-text">Location :</label>
                                <input type="text" id="location" class="inputc rounded" placeholder="location" required>
                            </div>
                            <div class="d-flex flex-column gap-1">
                                <label for="contact" class="label xs-text">Contact :</label>
                                <input type="text" id="contact" class="rounded inputc" placeholder="contact" required>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Rate</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody id="orderItemsTable">
                                    <!-- Cart items will be populated here -->
                                </tbody>
                            </table>
                            <p class="md-text"><span></span> <span class="yellowhighlight" id="modalTotalPrice"></span></p>
                            <button type="submit" class="btn-buttonoutline-green mt-3">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Product Deal Section -->
<section class="container-fluid sectiongap">
    <div class="container">
        <div class="title">
            <div class="lg-texts">product <span class="greenhighlight">deal</span></div>
            <div class="xs-text-md greenhighlight">Don't wait. The time will never be just right.</div>
        </div>

        <div class="row py-2 fcc flex-wrap gap-md-0 gap-1">
            @foreach($categories as $category)
                @foreach($category->subcategories as $subcategory)
                    @foreach($subcategory->products as $product)
                        <div class="col-md-3 col-5 mb-2">
                            <div class="customcard row col-md-12 p-2 rounded">
                                <div class="card-body">
                                    <div class="imgf d-flex justify-content-center py-2">
                                        <img src="{{ asset($product->mainImagePath) }}" alt="{{ $product->title }}" class="mdimage-lg">
                                    </div>
                                    <div class="d-flex justify-content-between mx-1">
                                        <!-- Display availability_status -->
                                        <p class="xs-text">{{ $product->availability_status }}</p>
                                        <p class="xs-text">
                                            @for($i = 0; $i < 5; $i++)
                                                <i class="fa-{{ $i < $product->rating ? 'solid' : 'regular' }} fa-star"></i>
                                            @endfor
                                        </p>
                                    </div>
                                    <p class="xs-text-bd m-1 my-2">{{ $product->title }}</p>
                                    <div class="d-flex justify-content-between mx-1">
                                        <p class="md-text">rs. <span>{{ $product->selling_price }}</span>
                                            @if($product->original_price)
                                                <span class="xs-text wrongprice">{{ $product->original_price }}</span>
                                            @endif
                                        </p>
                                        <p class="xs-text needhide">{{ $product->product_quantity }} ml</p>
                                    </div>
                                    <!-- Cart, Shop, and Favorite Buttons -->
                                    <div class="d-flex gap-2 py-2">
                                        <i class="fa-solid fa-cart-plus customicon" title="Add to Cart"
                                            onclick="addToCart('{{ $product->id }}', '{{ $product->title }}', {{ $product->selling_price }}, '{{ $product->mainImagePath }}', '{{ $product->availability_status }}')"></i>
                                        <i class="fa-solid fa-heart customicon {{ in_array($product->id, auth()->check() ? auth()->user()->favorites->pluck('product_id')->toArray() : []) ? 'fas' : 'far' }}"
                                            onclick="addToFavorites(this)" data-product-id="{{ $product->id }}"></i>
                                        <i class="fa-solid fa-bag-shopping customicon" onclick="buyNowFun(
                                            '{{ $product->id }}',
                                            '{{ $product->title }}',
                                            '{{ $product->selling_price }}',
                                            '{{ $product->mainImagePath }}',
                                            '{{ $product->availability_status }}'
                                        )"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @endforeach
        </div>
    </div>
</section>


<!-- explore -->
<section class="container-fluid advertisement py-5">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center gap-3">

            <div class="col-md-6 order-2 order-md-1">
                <div class="lg-texts whitehighlight">Explore categories</div>
                <p class="xs-text whitehighlight my-2">{{ $advertisement->description }}</p>
                <div class="adv-button-collection d-flex gap-3">
                    <button class="btn-buttonblack mt-2">Shop Now</button>
                    <button class="btn-buttonwhite mt-2">Shop Now</button>
                </div>
            </div>
            <img class="lgimage-lg col-md-8 needhide" src="{{ asset('image/expl.png') }}" alt="Categoryimage">
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap Modal
    const orderFormModal = new bootstrap.Modal(document.getElementById('orderFormModal'));

    // Add click handler for individual product buy now buttons
    const buyNowButtons = document.querySelectorAll('.fa-bag-shopping');
    buyNowButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productData = {
                id: this.getAttribute('data-product-id'),
                title: this.getAttribute('data-title'),
                price: this.getAttribute('data-price'),
                image: this.getAttribute('data-image'),
                availabilityStatus: this.getAttribute('data-availability')
            };
            buyNowFun(productData.id, productData.title, productData.price, productData.image, productData.availabilityStatus);
        });
    });

    // Update the buyNowFun function
    window.buyNowFun = function(productId, title, price, image, availabilityStatus) {
        if (availabilityStatus === 'sold') {
            alert('Sorry, this item is sold out!');
            return;
        }

        const orderDetails = {
            productId: productId,
            title: title,
            price: price,
            image: image,
            quantity: 1
        };
        sessionStorage.setItem('buyNowProduct', JSON.stringify(orderDetails));

        // Fetch order form content
        fetch('/frontend/orderform')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to load order form');
                }
                return response.text();
            })
            .then(html => {
                const modalBody = document.querySelector('#orderFormModal .modal-body');
                modalBody.innerHTML = html;

                // Add product details to the form
                const orderDetails = JSON.parse(sessionStorage.getItem('buyNowProduct'));
                if (orderDetails) {
                    const productInfo = `
                        <div class="selected-product-info mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <img src="${orderDetails.image}" alt="${orderDetails.title}" class="img-fluid">
                                </div>
                                <div class="col-md-9">
                                    <h6>${orderDetails.title}</h6>
                                    <p>Price: Rs ${orderDetails.price}</p>
                                    <p>Quantity: ${orderDetails.quantity}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    modalBody.insertAdjacentHTML('afterbegin', productInfo);
                }

                // Show the modal
                orderFormModal.show();
            })
            .catch(error => {
                console.error('Error loading order form:', error);
                alert('Error loading order form. Please try again.');
            });
    };
});

function addToCart(productId, title, price, image, availabilityStatus) {
    // First check if product is sold out
    if (availabilityStatus === 'sold') {
        alert('Sorry, this item is sold out!');
        return;
    }

    // Disable the button to prevent double clicks
    const button = event.currentTarget;
    button.disabled = true;

    // Check if item already exists in cart
    const existingItem = document.querySelector(`.cart-item[data-product-id="${productId}"]`);
    if (existingItem) {
        alert('This product is already in your cart');
        button.disabled = false;
        return;
    }

    // Get the CSRF token from the meta tag
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Make the AJAX request
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: productId,
            title: title,
            price: price,
            image: image,
            quantity: 1
        })
    })
    .then(response => {
        if (response.status === 401) {
            window.location.href = '/login';
            throw new Error('Please login to add items to cart');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const cartContainer = document.getElementById('cart-items-container');
            const emptyCartMessage = document.getElementById('empty-cart-message');
            
            if (emptyCartMessage) {
                emptyCartMessage.remove();
            }

            const newItemHtml = `
                <div class="col-md-12 gap-2 cart-item" data-index="${data.cartIndex}" data-product-id="${productId}">
                    <div class="row d-flex align-items-center border rounded shadow-sm bg-light py-3 my-1">
                        <div class="col-md-3 d-flex align-items-center col-2">
                            <input type="checkbox" class="btn-xsbutton cart-item-checkbox" data-item-id="${productId}" />
                            <img src="${image}" alt="" class="col-md-5 smimage-lg smimage-lgcd mx-2">
                        </div>
                        <div class="col-md-4">
                            <h5 class="sm-text"><strong>${title}</strong></h5>
                            <p class="sm-text py-1"><strong>Sold By:</strong> <span>Your Store</span></p>
                        </div>
                        <div class="d-flex align-items-center gap-1 col-md-3">
                            <button class="btn-xs quantity-btn" onclick="updateQuantity(${data.cartIndex}, 'decrease')">-</button>
                            <span class="btn-xsbutton-lg p-0 m-0 quantity-display">1</span>
                            <button class="btn-xs quantity-btn" onclick="updateQuantity(${data.cartIndex}, 'increase')">+</button>
                        </div>
                        <p class="xs-text-bd yellowhighlight m-md-0 m-2 col-md-2 item-total">Rs ${price}</p>
                    </div>
                </div>
            `;
            cartContainer.insertAdjacentHTML('beforeend', newItemHtml);

            // Update cart summary
            const cartCount = document.getElementById('cart-count');
            const totalItems = document.getElementById('total-items');
            const totalPrice = document.getElementById('total-price');
            
            cartCount.textContent = `Cart Details (${data.cartCount})`;
            totalItems.textContent = `Total items: ${data.cartCount}`;
            totalPrice.textContent = `Total Price: Rs ${data.cartTotal}`;

            // Success message
            alert('Product added to cart successfully!');
        } else {
            throw new Error(data.message || 'Error adding to cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (error.message !== 'Please login to add items to cart') {
            alert('Error adding product to cart: ' + error.message);
        }
    })
    .finally(() => {
        // Re-enable the button
        button.disabled = false;
    });
}


    function updateCartDetails(cart) {
        const cartContainer = document.querySelector('.col-md-8 .row');
        if (!cartContainer) return;
        // Clear existing cart items except the header
        const header = cartContainer.querySelector('.col-md-12.fbc');
        cartContainer.innerHTML = '';
        if (header) {
            cartContainer.appendChild(header);
        }
        if (Object.keys(cart).length === 0) {
            cartContainer.innerHTML += '<p>Your cart is empty</p>';
            return;
        }
        // Add each item to the cart
        Object.entries(cart).forEach(([productId, item]) => {
            const itemHtml = `
            <div class="col-md-12 gap-2">
                <div class="row d-flex align-items-center border rounded shadow-sm bg-light py-3 my-1">
                    <div class="col-md-3 d-flex align-items-center col-2">
                        <input type="checkbox" class="btn-xsbutton" />
                        <img src="${item.image}" alt="" class="col-md-5 smimage-lg smimage-lgcd mx-2">
                    </div>
                    <div class="col-md-4">
                        <h5 class="sm-text"><strong>${item.title}</strong></h5>
                        <p class="sm-text py-1"><strong>Sold By:</strong> <span>Your Store</span></p>
                    </div>
                    <div class="d-flex align-items-center gap-1 col-md-3">
                        <button class="btn-xs" onclick="updateCart('${productId}', 'decrease')">-</button>
                        <button class="btn-xsbutton-lg p-0 m-0">${item.quantity}</button>
                        <button class="btn-xs" onclick="updateCart('${productId}', 'increase')">+</button>
                    </div>
                    <p class="xs-text-bd yellowhighlight m-md-0 m-2 col-md-2">Rs ${item.price * item.quantity}</p>
                </div>
            </div>`;
            cartContainer.insertAdjacentHTML('beforeend', itemHtml);
        });
    }


    function updateCartHeader(count) {
        // Update cart count in the main header
        const cartHeader = document.querySelector('.col-md-12.fbc .md-text');
        if (cartHeader) {
            cartHeader.textContent = `Cart Details (${count})`;
        }
    }

    function updateOrderSummary(total, count) {
        // Update the order summary section
        const totalItems = document.querySelector('.topic-collection.sm-text');
        const totalPrice = document.querySelector('.topic-collection.sm-text:last-of-type');


        if (totalItems) {
            totalItems.textContent = `Total items: ${count}`;
        }
        if (totalPrice) {
            totalPrice.textContent = `Total Price: Rs ${total}`;
        }
    }

    function updateCart(index, productId, action) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const cartItem = document.querySelector(`.cart-item[data-index="${index}"]`);
    const quantityDisplay = cartItem.querySelector('.quantity-display');
    const itemTotal = cartItem.querySelector('.item-total');
    
    const currentQuantity = parseInt(quantityDisplay.textContent);
    let newQuantity;

    if (action === 'increase') {
        newQuantity = currentQuantity + 1;
    } else if (action === 'decrease') {
        if (currentQuantity === 1) {
            return; // Stop here if quantity is already 1
        }
        newQuantity = currentQuantity - 1;
    }

    fetch('/cart/update-quantity', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            index: index,
            product_id: productId,
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update quantity display
            quantityDisplay.textContent = newQuantity;
            
            // Update item total price
            itemTotal.textContent = `Rs ${data.updatedItem.price * newQuantity}`;
            
            // Update cart summary
            document.getElementById('cart-count').textContent = `Cart Details (${data.cartCount})`;
            document.getElementById('total-items').textContent = `Total items: ${data.cartCount}`;
            document.getElementById('total-price').textContent = `Total Price: Rs ${data.totalPrice}`;
        } else {
            alert(data.message || 'Failed to update cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating cart');
    });
}

function clearCart() {
    // Collect the IDs of the selected items
    const selectedItems = Array.from(document.querySelectorAll('.cart-item-checkbox:checked'))
        .map(checkbox => checkbox.getAttribute('data-item-id'));

    if (selectedItems.length === 0) {
        alert('Please select items to remove.');
        return;
    }

    if (!confirm('Are you sure you want to remove the selected items from the cart?')) {
        return;
    }

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/cart/clear', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({ items: selectedItems }) // Send only selected item IDs
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove selected items from the DOM
                selectedItems.forEach(id => {
                    const itemElement = document.querySelector(`.cart-item-checkbox[data-item-id="${id}"]`).closest('.cart-item');
                    itemElement.remove();
                });

                // Update cart count and totals
                document.getElementById('cart-count').textContent = `Cart Details (${data.newCartCount})`;
                document.getElementById('total-items').textContent = `Total items: ${data.newCartCount}`;
                document.getElementById('total-price').textContent = `Total Price: Rs ${data.newTotalPrice}`;

                showNotification('Selected items removed successfully!', 'success');
            } else {
                throw new Error(data.message || 'Error removing selected items');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error removing items: ' + error.message, 'error');
        });
}


function removeItem(index) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/cart/remove-item', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            index: index
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the item from DOM
            const cartItem = document.querySelector(`.cart-item[data-index="${index}"]`);
            cartItem.remove();

            // Update cart summary
            document.getElementById('cart-count').textContent = `Cart Details (${data.cartCount})`;
            document.getElementById('total-items').textContent = `Total items: ${data.cartCount}`;
            document.getElementById('total-price').textContent = `Total Price: Rs ${data.totalPrice}`;

            // Show empty cart message if no items left
            if (data.cartCount === 0) {
                document.getElementById('cart-items-container').innerHTML = 
                    '<p id="empty-cart-message">Your cart is empty</p>';
            }
        } else {
            alert(data.message || 'Failed to remove item');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error removing item from cart');
    });
}

function buyNowFun(productId, title, price, image, availabilityStatus) {
    // Check if product is sold out
    if (availabilityStatus === 'sold') {
        alert('Sorry, this item is sold out!');
        return;
    }

    // If product is available, proceed with buy now functionality
    if (availabilityStatus === 'available') {
        // Store product details in session storage for the order form
        const orderDetails = {
            productId: productId,
            title: title,
            price: price,
            image: image,
            quantity: 1
        };
        sessionStorage.setItem('buyNowProduct', JSON.stringify(orderDetails));
        
        // Load and show the order form modal
        loadOrderForm();
    }
}

    function clearCart() {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


        fetch('/cart/clear', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Clear cart items container
                    document.getElementById('cart-items-container').innerHTML =
                        '<p id="empty-cart-message">Your cart is empty</p>';


                    // Update cart count and totals
                    document.getElementById('cart-count').textContent = 'Cart Details (0)';
                    document.getElementById('total-items').textContent = 'Total items: 0';
                    document.getElementById('total-price').textContent = 'Total Price: Rs 0';


                    showNotification('Cart cleared successfully!', 'success');
                } else {
                    throw new Error(data.message || 'Error clearing cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error clearing cart: ' + error.message, 'error');
            });
    }

    function addToFavorites(button) {
        // Check if user is authenticated
        @guest
            window.location.href = "/login";
            return;
        @endguest
        const productId = button.getAttribute('data-product-id');
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Send AJAX request to the correct route
        fetch('/favorites', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update heart icon for all matching product buttons
                    const heartIcons = document.querySelectorAll(`button[data-product-id="${productId}"] i.fa-heart`);
                    heartIcons.forEach(icon => {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                    });
                    showNotification(data.message, 'success');
                } else if (data.status === 'already_added') {
                    showNotification(data.message, 'info');
                } else {
                    throw new Error(data.message || 'Error adding to favorites');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error adding to favorites: ' + error.message, 'error');
            });
    }

    function updateQuantity(index, action) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const cartItem = document.querySelector(`.cart-item[data-index="${index}"]`);
    if (!cartItem) return;

    const quantityDisplay = cartItem.querySelector('.quantity-display');
    const itemTotal = cartItem.querySelector('.item-total');
    if (!quantityDisplay || !itemTotal) return;
    
    const currentQuantity = parseInt(quantityDisplay.textContent);
    let newQuantity;

    if (action === 'increase') {
        newQuantity = currentQuantity + 1;
    } else if (action === 'decrease') {
        if (currentQuantity === 1) {
            return; // Don't allow quantity below 1
        }
        newQuantity = currentQuantity - 1;
    }

    // Disable quantity buttons during update
    const quantityButtons = cartItem.querySelectorAll('.quantity-btn');
    quantityButtons.forEach(btn => btn.disabled = true);

    fetch('/cart/update-quantity', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            index: index,
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update quantity display
            quantityDisplay.textContent = data.updatedItem.quantity;
            
            // Update item total price
            const totalPrice = data.updatedItem.price * data.updatedItem.quantity;
            itemTotal.textContent = `Rs ${totalPrice}`;
            
            // Update cart summary
            document.getElementById('cart-count').textContent = `Cart Details (${data.cartCount})`;
            document.getElementById('total-items').textContent = `Total items: ${data.cartCount}`;
            document.getElementById('total-price').textContent = `Total Price: Rs ${data.cartTotal}`;
        } else {
            throw new Error(data.message || 'Failed to update cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating cart: ' + error.message);
        
        // Revert the quantity display on error
        quantityDisplay.textContent = currentQuantity;
    })
    .finally(() => {
        // Re-enable quantity buttons
        quantityButtons.forEach(btn => btn.disabled = false);
    });
}

function clearSelectedItems() {
    // Get all checked checkboxes
    const selectedCheckboxes = document.querySelectorAll('.cart-item-checkbox:checked');
    
    if (selectedCheckboxes.length === 0) {
        alert('Please select items to remove');
        return;
    }
    
    if (!confirm('Are you sure you want to remove the selected items?')) {
        return;
    }
    
    // Get selected item IDs
    const selectedItems = Array.from(selectedCheckboxes).map(checkbox => 
        parseInt(checkbox.getAttribute('data-item-id'))
    );
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch('/cart/clear-items', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            items: selectedItems
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove selected items from DOM
            selectedCheckboxes.forEach(checkbox => {
                const cartItem = checkbox.closest('.cart-item');
                if (cartItem) cartItem.remove();
            });
            
            // Update cart summary
            document.getElementById('cart-count').textContent = `Cart Details (${data.newCartCount})`;
            document.getElementById('total-items').textContent = `Total items: ${data.newCartCount}`;
            document.getElementById('total-price').textContent = `Total Price: Rs ${data.newTotalPrice}`;
            
            // Show empty cart message if no items left
            if (data.newCartCount === 0) {
                const cartContainer = document.getElementById('cart-items-container');
                cartContainer.innerHTML = '<p id="empty-cart-message">Your cart is empty</p>';
            }
            
            alert('Selected items removed successfully');
        } else {
            throw new Error(data.message || 'Error removing selected items');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message);
    });
}

    function showNotification(message, type) {
        alert(message);
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap Modal
    const orderFormModal = new bootstrap.Modal(document.getElementById('orderFormModal'));
    
    // Add click handler for order summary buy now button
    document.getElementById('orderSummaryBuyNow').addEventListener('click', function() {
        // Get cart items
        const cartItems = document.querySelectorAll('.cart-item');
        const orderItemsTable = document.getElementById('orderItemsTable');
        orderItemsTable.innerHTML = ''; // Clear existing items
        
        // Populate form with cart items
        cartItems.forEach(item => {
            const title = item.querySelector('.sm-text strong').textContent;
            const price = item.querySelector('.item-total').textContent.replace('Rs ', '');
            const quantity = item.querySelector('.quantity-display').textContent;
            const productId = item.querySelector('.cart-item-checkbox').getAttribute('data-item-id');
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${title}</td>
                <td>Rs ${price}</td>
                <td>${quantity}</td>
                <input type="hidden" name="product_ids[]" value="${productId}">
            `;
            orderItemsTable.appendChild(row);
        });
        
        // Set current date
        const currentDate = new Date().toLocaleDateString('en-US');
        document.getElementById('currentDate').textContent = currentDate;
        
        // Set total price
        const totalPrice = document.getElementById('total-price').textContent;
        document.getElementById('modalTotalPrice').textContent = totalPrice;
        
        // Show modal
        orderFormModal.show();
    });
    
    // Handle form submission
    document.querySelector('.orderform').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData();
        formData.append('location', document.getElementById('location').value);
        formData.append('contact', document.getElementById('contact').value);
        formData.append('date', document.getElementById('currentDate').textContent);
        
        // Add product IDs
        const productIds = Array.from(document.getElementsByName('product_ids[]')).map(input => input.value);
        productIds.forEach(id => formData.append('product_ids[]', id));

        
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        fetch('/order/store', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                orderFormModal.hide();
                alert(`Order placed successfully! Your bill number is: ${data.bill_no}`);
                // Clear cart after successful order
                clearCart();
            } else {
                throw new Error(data.message || 'Error placing order');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error placing order: ' + error.message);
        });
    });
});


    </script>
    
    <style>
    .orderform {
        background: white;
        width: 100%; /* Changed from 30% to work better in modal */
        max-width: 800px;
        margin: 0 auto;
    }
    
    .bg-inherit {
        background: var(--off-green);
        border-radius: var(--radius4);
    }
    
    .inputc {
        padding: 8px;
        outline: none;
        border: 1px solid var(--border-color);
        width: 100%;
    }
    
    @media (max-width: 700px) {
        .input-group {
            display: flex;
            flex-direction: column;
        }
    }
    </style>
    
@endsection


