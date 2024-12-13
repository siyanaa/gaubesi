<!-- Single Buy Section -->
<section class="container-fluid hidesinglebuy">
    <div class="container fcc">
        <i class="fa-solid fa-xmark customicon" onclick="closeSinglebuy()"></i>
        <div class="row py-3 my-1 showsinglebuy fcc gap-2">
            <div class="col-md-8">
                <div class="row d-flex align-items-center border rounded shadow-sm bg-light py-2">
                    <div class="col-md-3 d-flex align-items-center">
                        <img id="buyNowImage" src="" alt="Product Image" class="col-md-5 smimage-lg smimage-lgcd mx-2">
                    </div>
                    <div class="col-md-4">
                        <h5 class="sm-text"><strong id="buyNowTitle"></strong></h5>
                    </div>
                    <div class="d-flex align-items-center gap-1 col-md-3">
                        <button class="btn-xs" onclick="updateQuantity('decrease')">-</button>
                        <button id="buyNowQuantity" class="btn-xsbutton-lg p-0 m-0">1</button>
                        <button class="btn-xs" onclick="updateQuantity('increase')">+</button>
                    </div>
                    <p id="buyNowPrice" class="xs-text-bd yellowhighlight m-md-0 m-2 col-md-2"></p>
                </div>
            </div>
            <div class="col-md-3 border rounded shadow-sm bg-light">
                <div class="row col-md-12 green p-3 gap-2">
                    <p class="topic-collection md-text p-1">Order Summary</p>
                    <span class="sm-text topic-collection p-1">Total Items: <span id="totalItems">1</span></span>
                    <span class="sm-text topic-collection p-1">Total Amount: Rs.<span id="totalAmount">0</span></span>
                    <button class="btn-buttonoutline-sm p-0 m-0" onclick="showOrderForm()">Buy Now</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Order Form Modal -->
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
                                <!-- Items will be populated here -->
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

<script>
// Store the current product details
let currentProduct = {
    id: null,
    price: 0,
    quantity: 1,
    title: '',
    image: ''
};

// Initialize Bootstrap Modal
let orderFormModal;

document.addEventListener('DOMContentLoaded', function() {
    orderFormModal = new bootstrap.Modal(document.getElementById('orderFormModal'));
    
    // Handle form submission
    document.querySelector('.orderform').addEventListener('submit', handleOrderSubmission);
});

function buyNowFun(productId, title, price, image) {
    // Store product details
    currentProduct = {
        id: productId,
        price: parseFloat(price),
        quantity: 1,
        title: title,
        image: image
    };

    // Update the buy now section
    document.getElementById('buyNowTitle').textContent = title;
    document.getElementById('buyNowImage').src = image;
    document.getElementById('buyNowPrice').textContent = `Rs ${price}`;
    document.getElementById('buyNowQuantity').textContent = '1';
    document.getElementById('totalItems').textContent = '1';
    document.getElementById('totalAmount').textContent = price;

    // Show the buy now section
    document.querySelector(".hidesinglebuy").style.display = "block";
}

function updateQuantity(action) {
    let quantityElement = document.getElementById('buyNowQuantity');
    let currentQty = parseInt(quantityElement.textContent);

    if (action === 'increase') {
        currentQty++;
    } else if (action === 'decrease' && currentQty > 1) {
        currentQty--;
    }

    // Update quantity display and current product
    quantityElement.textContent = currentQty;
    currentProduct.quantity = currentQty;

    // Update total amount
    const totalAmount = (currentProduct.price * currentQty).toFixed(2);
    document.getElementById('totalItems').textContent = currentQty;
    document.getElementById('totalAmount').textContent = totalAmount;
}

function showOrderForm() {
    // Clear existing items
    const orderItemsTable = document.getElementById('orderItemsTable');
    orderItemsTable.innerHTML = '';

    // Add current product to order form
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${currentProduct.title}</td>
        <td>Rs ${currentProduct.price}</td>
        <td>${currentProduct.quantity}</td>
        <input type="hidden" name="product_ids[]" value="${currentProduct.id}">
    `;
    orderItemsTable.appendChild(row);

    // Set current date
    document.getElementById('currentDate').textContent = new Date().toLocaleDateString('en-US');

    // Set total price
    document.getElementById('modalTotalPrice').textContent = 
        `Rs ${(currentProduct.price * currentProduct.quantity).toFixed(2)}`;

    // Show modal
    orderFormModal.show();
}

function handleOrderSubmission(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('location', document.getElementById('location').value);
    formData.append('contact', document.getElementById('contact').value);
    formData.append('date', document.getElementById('currentDate').textContent);
    formData.append('product_ids[]', currentProduct.id);
    formData.append('quantities[]', currentProduct.quantity);

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
            closeSinglebuy();
            alert(`Order placed successfully! Your bill number is: ${data.bill_no}`);
        } else {
            throw new Error(data.message || 'Error placing order');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error placing order: ' + error.message);
    });
}

function closeSinglebuy() {
    document.querySelector(".hidesinglebuy").style.display = "none";
}
</script>

<style>
.hidesinglebuy {
    background: var(--white-green);
    min-height: 100vh;
    width: 55%;
    position: fixed;
    top: 0;
    right: 0;
    z-index: 30;
    display: none;
    box-shadow: -2px 0px 10px rgba(0, 0, 0, 0.5);
}

.fa-xmark {
    position: absolute;
    top: 22%;
    right: 1.5%;
    z-index: 20;
    background: black;
    border-radius: var(--radius8);
    cursor: pointer;
}

@media (max-width:770px) {
    .hidesinglebuy {
        width: 92%;
    }
}

.makeactive {
    background: var(--pure-black) !important;
    color: var(--pure-white);
}

.showsinglebuy {
    background: var(--green);
    margin: 0 1rem;
    top: 10rem;
    position: absolute;
    padding: 0 1rem;
    border-radius: var(--radius4);
}

#additional,
#review {
    display: none;
}

.feature-smallimg {
    width: 140px;
    height: 84px;
    object-fit: cover;
    border-radius: var(--radius8);
}

@media (max-width:700px) {
    .hidesinglebuy {
        top: -3.5rem;
        left: 0;
        bottom: 20rem;
    }
    .fa-xmark {
        top: 24%;
        right: 3%;
    }
    #additional,
    #review {
        display: none;
    }
}

.starpointer {
    cursor: pointer;
}
</style>