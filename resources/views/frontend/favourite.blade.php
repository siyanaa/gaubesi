@extends("frontend.layouts.master")
@section("content")
@include ("frontend.singlebuy")

<style>
    .routingname { background-color: #f5f5f5; }
    .customcard { border: 2px solid var(--border-color); }
    .imgf { border-bottom: 1px solid var(--border-color); }
    .wrongprice { text-decoration: line-through; }
    .fa-star { color: var(--yellow); }
    .custom-fa-trash { background-color: var(--yellow); }
    .custom-fa-trash:hover { background: #000; }
    @media(max-width:450px) { .needhide { display: none; } }
    .sold-out { 
        opacity: 0.7;
        position: relative;
    }
    .sold-out::after {
        content: 'SOLD OUT';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(255, 0, 0, 0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }
</style>

<section class="container-fluid routingname">
    <div class="container py-3">
        <p class="sm-text"><i class="fa-solid fa-location-dot greenhighlight"></i> <span>Home</span> . <span>Favourite</span></p>
    </div>

    <section class="container-fluid mt-2">
        <div class="container">
            <div class="title">
                <div class="lg-texts">Favourite <span class="greenhighlight">Collection</span></div>
                <div class="xs-text-md greenhighlight">Create a space that reflects your inner tranquility.</div>
            </div>
            <div class="row py-2 fcc flex-wrap gap-md-0 gap-1">
                @forelse($favorites as $favorite)
                    <div class="col-md-3 col-5 mb-2">
                        <div class="customcard row col-md-12 p-2 rounded">
                            <div class="card-body">
                                <i class="fa-solid fa-trash customicon custom-fa-trash" onclick="deleteFavorite({{ $favorite->favorite_id }}, this)"></i>
                                <div class="imgf d-flex justify-content-center py-2 {{ $favorite->availability_status === 'sold' ? 'sold-out' : '' }}">
                                    @if($favorite->mainImagePath)
                                        <img src="{{ asset($favorite->mainImagePath) }}" alt="{{ $favorite->title }}" class="mdimage-lg">
                                    @else
                                        <img src="{{ asset('default-image.jpg') }}" alt="Default Image" class="mdimage-lg">
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between mx-1">
                                    <p class="xs-text">
                                        @php
                                            $rating = optional($favorite->reviews)->avg('ratings') ?? 0;
                                            $rating = round($rating); 
                                        @endphp
                                        @for($i = 0; $i < 5; $i++)
                                            <i class="fa-{{ $i < $rating ? 'solid' : 'regular' }} fa-star"></i>
                                        @endfor
                                    </p>
                                </div>
                                
                                <p class="xs-text-bd m-1 my-2">{{ $favorite->title }}</p>
                                <div class="d-flex justify-content-between mx-1">
                                    <p class="md-text">
                                        Rs. <span>{{ $favorite->selling_price }}</span>
                                        @if($favorite->cost_price)
                                            <span class="xs-text wrongprice">{{ $favorite->cost_price }}</span>
                                        @endif
                                    </p>
                                    <p class="xs-text needhide">{{ $favorite->product_quantity ?? 0 }} in stock</p>
                                </div>
                                
                                <div class="d-flex gap-2 py-2">
                                    <i class="fa-solid fa-bag-shopping customicon" 
                                       onclick="handleProductAction('buy', {{ $favorite->id }}, '{{ $favorite->availability_status }}', '{{ $favorite->title }}', '{{ $favorite->selling_price }}', '{{ $favorite->mainImagePath }}')"></i>
                                    <i class="fa-solid fa-cart-plus customicon" 
                                       onclick="handleProductAction('cart', {{ $favorite->id }}, '{{ $favorite->availability_status }}', '{{ $favorite->selling_price }}')"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p>No favorite items found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    
    <script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function handleProductAction(action, productId, availabilityStatus, ...args) {
        if (availabilityStatus === 'sold') {
            alert('Sorry, this product is sold out!');
            return;
        }
    
        if (action === 'buy') {
            const [title, price, image] = args;
            buyNowFun(productId, title, price, image);
        } else if (action === 'cart') {
            const [price] = args;
            addToCart(productId, price);
        }
    }
    
    function addToCart(productId, price) {
        $.ajax({
            url: '{{ route("cart.add") }}',
            type: 'POST',
            data: {
                product_id: productId,
                price: price,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    // Update cart count in header if exists
                    if (response.cartCount !== undefined) {
                        $('.cart-count').text(response.cartCount);
                    }
                } else {
                    if (response.message.includes('login')) {
                        // Redirect to login page or show login modal
                        window.location.href = '{{ route("login") }}';
                    } else {
                        alert(response.message);
                    }
                }
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    // Unauthorized - user needs to login
                    window.location.href = '{{ route("login") }}';
                } else {
                    console.error('Cart error:', xhr);
                    alert('An error occurred. Please try again.');
                }
            }
        });
    }


function deleteFavorite(id, element) {
    console.log ($('meta[name="csrf-token"]').attr('content'))
    
    if (confirm("Are you sure you want to delete this item?")) {
        $.ajax({
            url: `/favorites/${id}`,  
            type: 'DELETE',
            data: {
            _token: '{{ csrf_token() }}',
            
        },
            success: function(response) {
                if (response.success) {
                    $(element).closest('.col-md-3, .col-5').remove();
                    
                    // Update counts in the header
                    if (response.counts) {
                        $('.favorite-count').text(response.counts.favorites_count);
                    }
                    
                    // Show success message
                    alert(response.message);
                    
                    // If no more favorites, show the empty message
                    if ($('.col-md-3, .col-5').length === 0) {
                        $('.row.py-2').html('<div class="col-12 text-center py-4"><p>No favorite items found.</p></div>');
                    }
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                console.error('Delete error:', xhr);
                let errorMessage = 'An error occurred. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                alert(errorMessage);
            }
        });
    }
}

function updateHeaderCounts() {
    $.ajax({
        url: '{{ route("get.header.counts") }}',
        type: 'GET',
        success: function(response) {
            if (response.success) {
                $('.favorite-count').text(response.favorites_count);
                $('.cart-count').text(response.cart_count);
            }
        }
    });
}


</script>

@endsection