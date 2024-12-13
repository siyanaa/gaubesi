<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
@endphp
@include('frontend.include.head')

<body>
    <div id="fb-root">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0" nonce="fXefOAoL"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Owl Carousel JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    </div>
    {{-- @include('frontend.include.topnav')--}}

    @include('frontend.include.navbar')
    @yield('content') 
    @include('frontend.include.footer')

    <style>
        @media (min-width:991px) {
            .hir {
                display: none;
            }


        }

        .hir {
            background: #F9F4F4;
            position: fixed;
            bottom: 0;
            z-index: 200;
        }
    </style>

    <section class="container-fluid hir">
        <div class="container py-2">
            <div class="row fbc">
                <a href="/" class="d-flex flex-column col-3">
                    <i class="fa-solid fa-house customicon"></i>
                    <span class="xs-text blackhighlight">home</span>
                </a>
                <a href="{{route("chat")}}" class="d-flex flex-column col-3">
                    <i class="fa-regular fa-message customicon"></i>
                    <span class="xs-text blackhighlight">chat</span>
                </a>
                <a href="{{route("cart")}}" class="d-flex flex-column col-3">
                    <i class="fa-solid fa-cart-plus customicon"></i>
                    <span class="xs-text blackhighlight">cart</span>
                </a>
                <a href="{{route("account")}}" class="d-flex flex-column col-3">
                    <i class="fa-regular fa-user customicon"></i>
                    <span class="xs-text blackhighlight">account</span>
                </a>
            </div>
        </div>

    </section>



    @include('frontend.include.script')


</body>

</html>