@extends("frontend.layouts.master")
@section("content")




<!-- css are same of dayofdeal and properrties and landproperties -->


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
        border: 2px solid var(--border-color);
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


    .btn-xs-weight {
        border-radius: var(--radius4);
        height: 22px;
        width: 54px;
        font-size: 12px;
    }


    .btn-xs {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius4);
        height: 28px;
        width: 44px;
        font-size: 24px;
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


    .sidebar {
        background: var(--pure-white);
        border-radius: var(--radius8);
        padding: 1rem;
    }


    .sidebarheight {
        min-height: 80vh !important;
        background: var(--pure-white);
        border-radius: var(--radius8);
        padding: 1rem;
    }


    .sidebarheight .searchcontainer {
        background: var(--off-green);
        border-radius: var(--radius4);


    }
</style>




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
        width: 170px;
        height: 100px;
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
            /* Adjust to a percentage for responsive design */
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






<!-- herosection -->
<section class="container-fluid routingname ">
    <div class="container py-3 ">
        <p class="sm-text"><i class="fa-solid fa-location-dot greenhighlight"></i> <span>Home</span> .
            <span>Product</span>
        </p>
    </div>
</section>




@include ("frontend.singlebuy")


<!-- start of single product -->
<section class="container-fluid singleprojectpage py-2 ">
    <div class="container">
        <div class="row gap-5">
            <div class="col-md-8 sidebar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="d-flex col-md-5 ">
                                <div class="row">
                                    @php
                                        $mainImages = !empty($products->main_image) ? json_decode($products->main_image, true) : [];
                                        $mainImage = !empty($mainImages) ? asset($mainImages[0]) : asset('images/default-placeholder.png');
                                    @endphp
                                    <img src="{{ $mainImage }}" alt="Product Image"
                                        class="col-md-12  lgimage-lgheightcd  productnameimage">
                                    <div class="col-md-12 m-3">
                                        @if (!empty($otherImages))
                                            <div class="col-md-12 m-3">
                                                @foreach ($otherImages as $image)
                                                    <img src="{{ asset($image) }}" alt="" class="col-md-3 smimage-lg"
                                                        onclick="otherimage(this)">
                                                @endforeach
                                            </div>
                                        @endif


                                    </div>


                                </div>
                            </div>


                            <script>
                                function otherimage(element) {
                                    const productnameimage = document.querySelector(".productnameimage");
                                    productnameimage.src = element.src;


                                }


                            </script>


                            <!-- Product Details -->
                            <div class=" col-md-7 d-flex flex-column  gap-2 ">
                                <div class="d-flex gap-1">
                                    <button class="btn-buttonoutline-sm findstockbutton ">{{ $products->availability_status}}</button>
                                    
                                </div>
                                <p class="md-text p-0 m-0 py-1 ">{{ $products->title }}</p>
                                <p class="pb-1 xs-text">
                                    {{ strlen($products->description) < 200 ? $products->description : substr($products->description, 0, 200) }}
                                </p>




                                <div class="forline my-1"></div>
                                <div class="d-flex flex-column p-0 m-0 gap-1">
                                    
                                    <p class="m-0 p-1 gap-1">
                                        <span class="xs-text-bd">Flavour </span>
                                        <span>:</span>
                                        <span class="xs-text">{{ $products->flavour }}</span>
                                    </p>
                                    <p class="m-0 p-1 gap-1">
                                        <span class="xs-text-bd">Weight </span>
                                        <span>:</span>
                                        <span class="xs-text">{{ $products->weight }}</span>
                                    </p>

                                    <p class="m-0 p-1 gap-1">
                                        <span class="xs-text-bd">Brand </span>
                                        <span>:</span>
                                        <span class="xs-text">{{ $products->brand }}</span>
                                    </p>
                                    <p class="m-0 p-1 gap-1">
                                        <span class="xs-text-bd">Info</span>
                                        <span>:</span>
                                        <span class="xs-text ">{{ $products->description }}</span>
                                    </p>
                                    <p class="m-0  d-flex gap-1 p-0 ">
                                        <span class="xs-text-bd">Quantity</span>
                                        <span>:</span>
                                        <span class="xs-text">{{ $products->product_quantity }}</span>
                                    </p>
                                    <p class="m-0  p-0">
                                        <span class="xs-text-bd">price</span>
                                        <span>:</span>
                                        <span class="greenhighlight  md-text">Rs.{{$products->selling_price}}</span>
                                    </p>
                                    <div class="d-flex align-items-center gap-2 p-0 m-0 my-2">
                                        <button 
                                        class="btn-buttonoutline-sm p-0 m-0 favorite-btn" 
                                        data-product-id="{{ $products->id }}"
                                        onclick="handleFavorite('{{ $products->id }}')"
                                    >
                                        <i class="{{ in_array($products->id, auth()->check() ? auth()->user()->favorites->pluck('product_id')->toArray() : []) ? 'fas' : 'far' }}"></i>
                                        Favourite
                                    </button>                                    
                                        
                                         <button class="btn-buttonoutline-sm" onclick="handleAddToCart('{{ $products->id }}', '{{ $products->title }}', {{ $products->selling_price }}, '{{ $mainImage }}')">
                                         <i class=""></i> Add to Cart
                                         </button>
                                         <button class="btn-buttonoutline-sm p-0 m-0" onclick="handleBuyNow(
                                         '{{ $products->id }}', 
                                         '{{ $products->title }}', 
                                         '{{ $products->selling_price }}', 
                                         '{{ $mainImage }}'
                                         )">Buy Now</button>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <!-- Overview and Description -->
                <div class="col-md-12 my-2 descriptionborder p-4 ">
                    <div class="row">
                        <div class="col-md-6 gap-3 d-flex">
                            <button class="btn-buttonoutline-sm p-0 m-0 changer makeactive " data-id="description"
                                onclick="callToggle(this)">description</button>
                            <button class="btn-buttonoutline-sm p-0 m-0 changer " data-id="additional"
                                onclick="callToggle(this)">add
                                info</button>


                        </div>
                        <p class="xs-text py-2 mx-md-2 " id="description">
                            {{ $products->description }}
                        </p>
                        <p class="xs-text py-2 mx-md-2" id="additional">
                            {{ $products->description }}
                        </p>
                    </div>
                </div>


                <form action="{{ route('reviews.store') }}" method="POST" class="col-md-12 my-2 descriptionborder p-4" onsubmit="reviewSubmit(event)">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                
                    <div class="row gap-3">
                        <div class="col-md-12 d-flex align-items-center">
                            <i class="fa-solid fa-star"></i>
                            <p class="xs-text-bd p-0 m-0 mx-2 greenhighlight">Your Experience</p>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="name" class="xs-text py-2">Name</label>
                            <input type="text" id="name" name="name" class="input" 
                                   value="{{ Auth::check() ? Auth::user()->name : '' }}" 
                                   {{ Auth::check() ? 'readonly' : '' }} 
                                   required>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="email" class="xs-text py-2">Email</label>
                            <input type="text" id="email" name="email" class="input" 
                                   value="{{ Auth::check() ? Auth::user()->email : '' }}" 
                                   {{ Auth::check() ? 'readonly' : '' }} 
                                   required>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="xs-text py-2">Rating</label>
                            <div class="starpointer">
                                <div>
                                    <input type="hidden" id="rating" name="ratings" value="0">
                                    <i class="star fa fa-star fa-regular" onclick="fillStar(this, 1)"></i>
                                    <i class="star fa fa-star fa-regular" onclick="fillStar(this, 2)"></i>
                                    <i class="star fa fa-star fa-regular" onclick="fillStar(this, 3)"></i>
                                    <i class="star fa fa-star fa-regular" onclick="fillStar(this, 4)"></i>
                                    <i class="star fa fa-star fa-regular" onclick="fillStar(this, 5)"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="comment" class="xs-text py-2">Your Comment</label>
                            <textarea id="comment" name="reviews" class="textarea" rows="2" required placeholder="Share your experience..."></textarea>
                        </div>
                        
                        <div class="col-md-12">
                            <button type="submit" class="btn-buttonoutline-green">Submit</button>
                        </div>
                    </div>
                </form>                
                
                
                <div class="col-12 row my-3 mt-4 gap-4">
                    @if($products->acceptedReviews && $products->acceptedReviews->isNotEmpty())
                        @foreach($products->acceptedReviews as $review)
                            <div class="col-12 col-md-12 d-flex align-items-start">
                                <img src="{{ asset('images/' . $products->main_image) }}" alt="Product Image" class="smimage rounded-circle" />
                                <div class="col-9 ms-3">
                                    <p class="mb-0 d-flex align-items-center gap-2">
                                        <span class="xs-text-bd p-0 m-0">{{ e($review->name) }}</span>
                                        <span class="d-flex">
                                            @for($i = 0; $i < $review->ratings; $i++)
                                                <i class="fa-solid fa-star"></i>
                                            @endfor
                                            @for($i = $review->ratings; $i < 5; $i++)
                                                <i class="fa-regular fa-star"></i>
                                            @endfor
                                        </span>
                                    </p>
                                    <p class="xs-text-bd p-0 m-0 italic py-1">{{ e($review->experience ?? 'Experience') }}</p>
                                    <p class="text-muted p-0 m-0">{{ e($review->reviews) }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No reviews available for this product.</p>
                    @endif
                </div>
            </div>
                
                
        
   
                


            <style>
                .inputcontrol {
                    width: 154px;
                    border-radius: 20px 0 0 20px;
                    outline: none;
                    stroke: none;
                    border: 1px solid white;
                    padding-left: 8px
                }

                .hidesinglebuy {
    display: none; /* Hidden by default */
}


                .inputcontrol:focus {
                    outline: none;
                    stroke: none;
                    border: none;
                    padding-left: 8px
                }


                .searchside {
                    width: 100%;
                    border-radius: 0 20px 20px 0;
                    outline: none;
                    stroke: none;
                    background: #000;
                    border: 1px solid black;
                    padding-left: 8px;
                    color: white;


                }
            </style>


            <div class="col-md-3 ">
                <div class="sidebarheight">
                    <div class="searchcontainer fcc p-3">
                        <input type="text" class=" py-2 inputcontrol" placeholder="search  project">
                        <button class="searchside py-2"> Search</button>
                    </div>
                    <div class="featurelist-body">
                        <p class="md-text  p-2">our product </p>
                        @foreach ($relatedProducts as $product)
                                                <a class="featurelist-content d-flex py-1"
                                                    href="{{ route('singleproducts', ['id' => $product->id]) }}">
                                                    @php
                                                        $mainImages = !empty($product->main_image) ? json_decode($product->main_image, true) : [];
                                                        $mainImage = !empty($mainImages) ? asset($mainImages[0]) : asset('images/default-placeholder.png');
                                                    @endphp
                                                    <img src="{{ $mainImage }}" alt="Product Image" class="feature-smallimg"
                                                        data-src="holder.js/200x250?theme=thumb">
                                                    <div class="featurlist-description mx-3 py-1">
                                                        <h3 class="sm-text">{{ $product->title }}</h3>
                                                        <p class="sm-text yellowhighlight">{{ $product->selling_price}}</p>
                                                    </div>
                                                </a>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>


<!-- product deal -->
@include("frontend.include.productdeal")


<!-- advertisement -->
@include("frontend.include.advertisement")


<script>

 // Variable to store the selected rating value
let ratingValue = 0;

// Function to handle star rating
function fillStar(element, value) {
    // Set the rating value based on clicked star
    ratingValue = value;
    document.getElementById("rating").value = ratingValue;

    // Update the visual star selection
    const stars = document.querySelectorAll(".star");
    stars.forEach((star, index) => {
        if (index < ratingValue) {
            star.classList.remove("fa-regular");
            star.classList.add("fa-solid");
        } else {
            star.classList.remove("fa-solid");
            star.classList.add("fa-regular");
        }
    });
}

// Form submission handler
function reviewSubmit(event) {
    // If additional validation is needed, handle it here
    // For example, if rating must be non-zero
    if (ratingValue === 0) {
        event.preventDefault();
        alert("Please select a rating before submitting.");
        return;
    }

    // Otherwise, allow the form to submit as usual
    console.log("Form is being submitted with the following data:");
    console.log("Name:", document.getElementById("name").value);
    console.log("Email:", document.getElementById("email").value);
    console.log("Rating:", ratingValue);
    console.log("Comment:", document.getElementById("comment").value);
}

</script>

<script>
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
</script>

<script>

function handleFavorite(productId) {
        if (isLoggedIn) {
            addToFavorites(productId);
        } else {
            alert("Please log in to add to favorites.");
        }
    }

    function handleAddToCart(productId, title, price, mainImage) {
    if (!isLoggedIn) {
        alert("Please log in to add items to the cart.");
        return;
    }
    
    // Get the availability status from the page
    const availabilityStatus = document.querySelector('.findstockbutton').textContent.trim();
    
    if (availabilityStatus.toLowerCase() === 'sold') {
        alert("Sorry, this product is sold out!");
        return;
    }
    
    addToCart(productId, title, price, mainImage);
}

function handleBuyNow(productId, title, price, mainImage) {
    if (!isLoggedIn) {
        alert("Please log in to proceed with the purchase.");
        return;
    }
    
    // Get the availability status from the page
    const availabilityStatus = document.querySelector('.findstockbutton').textContent.trim();
    
    if (availabilityStatus.toLowerCase() === 'sold') {
        alert("Sorry, this product is sold out!");
        return;
    }
    
    buyNowFun(productId, title, price, mainImage);
}

    // to toggle description ,additional and review
    function callToggle(element) {
        const items = document.querySelectorAll('.changer')
        const description = document.getElementById('description');
        const additional = document.getElementById('additional');
        description.style.display = "none";
        additional.style.display = "none";


        items.forEach(item => {
            item.classList.remove("makeactive");
        })
        element.classList.add("makeactive");


        const id = element.getAttribute("data-id");
        if (id === "description") {
            description.style.display = "block";
        }
        else {
            additional.style.display = "block";
        }


    }

    // Populate product details in the Buy Now section
    document.querySelector('.showsinglebuy .sm-text strong').textContent = title;
    document.querySelector('.showsinglebuy .yellowhighlight').textContent = 'Rs ' + price;
    document.querySelector('.showsinglebuy .btn-xsbutton-lg').textContent = quantity;
    document.querySelector('.showsinglebuy img').setAttribute('src', image);


// Close the Buy Now section
function closeSinglebuy() {
    document.querySelector('.hidesinglebuy').classList.add('d-none');
}

</script>

<script>
     function addToFavorites(productId) {
        // Send AJAX request to add to favorites
        fetch('{{ route("favorites.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: productId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Update the button icon for the added favorite
                const button = document.querySelector(`button[data-product-id="${productId}"]`);
                const heartIcon = button.querySelector('i');
                heartIcon.classList.remove('far');
                heartIcon.classList.add('fas');
                alert(data.message);
            } else if (data.status === 'already_added') {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while adding to favorites');
        });
    }

function addToCart(productId, title, price, image) {
    // Disable the button to prevent double-clicks
    const button = event.currentTarget;
    button.disabled = true;

    // Get the CSRF token
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
            image: image
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Update cart count in header if exists
            const cartCount = document.querySelector('.cart-count');
            if (cartCount) {
                cartCount.textContent = data.cartCount;
            }

            // Show success message
            showNotification('Product added to cart successfully!', 'success');

            // Update mini cart if it exists
            updateMiniCart(data.cart, data.cartTotal, data.cartCount);
        } else {
            throw new Error(data.message || 'Error adding to cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error adding product to cart: ' + error.message, 'error');
    })
    .finally(() => {
        // Re-enable the button
        button.disabled = false;
    });
}

function updateMiniCart(cart, total, count) {
    const miniCart = document.querySelector('.mini-cart');
    if (!miniCart) return;

    // Update cart item count
    const cartCountElement = miniCart.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = count;
    }

    // Update cart total
    const cartTotalElement = miniCart.querySelector('.cart-total');
    if (cartTotalElement) {
        cartTotalElement.textContent = `Rs ${total}`;
    }

    // Update cart items list
    const cartItemsList = miniCart.querySelector('.cart-items');
    if (cartItemsList) {
        cartItemsList.innerHTML = '';
        
        Object.values(cart).forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'cart-item d-flex align-items-center border-bottom py-2';
            itemElement.innerHTML = `
                <img src="${item.image}" alt="${item.title}" class="cart-item-image me-2" style="width: 50px; height: 50px; object-fit: cover;">
                <div class="flex-grow-1">
                    <h6 class="mb-0">${item.title}</h6>
                    <small>${item.quantity} × Rs ${item.price}</small>
                </div>
                <span class="text-right">Rs ${item.price * item.quantity}</span>
            `;
            cartItemsList.appendChild(itemElement);
        });
    }
}

function showNotification(message, type) {
    alert(message);
}
    
    </script>




@endsection



