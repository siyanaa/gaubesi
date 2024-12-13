@extends('frontend.layouts.master')

@section('content')
<style>
    .descard {
        background: white;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
    }

    .des-button {
        color: white;
        background: var(--off-green);
        border-radius: var(--radius4);
        font-weight: 500;
        padding: 1rem 0;
        font-size: 17px;
        text-transform: capitalize;
        font-family: var(--font-family);
    }

    .des-button:hover {
        background: var(--green);
        cursor: pointer;
    }

    .auth_button {
        border: 1px solid var(--pure-white);
        font-size: 18px;
        padding: 4px 6px;
        color: var(--pure-white);
        background: var(--yellow);
        font-family: var(--font-family);
        text-decoration: none;
        display: inline-block;
        margin-right: 5px;
    }

    .auth_button_black {
        background: var(--pure-black);
    }

    .heightcontroll {
        width: 100%;
        height: 12vh;
        object-fit: cover;
        border-radius: var(--radius4) !important;
    }

    .logout-form {
        display: inline;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    @media (max-width:400px) {
        .des-button {
            font-size: 14px;
            font-weight: 400;
        }
    }

    .forpadding {
        margin-left: 1px;
    }
</style>

<section class="container-fluid py-3">
    <div class="container">
        <div class="row p-0 gap-4 forpadding">
            <div class="col-md-8 row fbc gap-3 p-0 m-0 order-md-1 order-2">
                <!-- Your existing card elements remain the same -->
                <div class="col-md-6 row descard py-3 rounded gap-3">
                    <a href='{{route("chat")}}' class="col-1 p-0 m-0">
                        <i class="fa-solid fa-box customicon_blue"></i>
                    </a>
                    <div class="col-5">
                        <p class="sm-text">order</p>
                        <p class="xs-text">items</p>
                    </div>
                </div>


                <div class="col-md-6 row descard  py-3 rounded gap-3">
                    <a href='{{route("chat")}}' class="col-1 p-0 m-0">
                        <i class="fa-regular fa-message customicon"></i>
                    </a>
                    <div class="col-5">
                        <p class="sm-text">chat </p>
                        <p class="xs-text">items</p>
                    </div>
                </div>
                <div class="col-md-6 row descard  py-3 rounded gap-3">
                <a href='#' class="col-1 p-0 m-0">
                        <i class="fa-solid fa-truck customicon_pink"></i>
         </a>
                    <div class="col-5">
                        <p class="sm-text"> Delivery </p>
                        <p class="xs-text">items</p>
                    </div>
                </div>
                <div class="col-md-6 row descard  py-3 rounded gap-3">
                    <a href='#' class="col-1 p-0 m-0">
                        <i class="fa-brands fa-creative-commons-nd customicon_yellow"></i>
                    </a>
                    <div class="col-5">
                        <p class="sm-text">activities </p>
                        <p class="xs-text">items</p>
                    </div>
                </div>

                <div class="col-md-6 row descard  py-3 rounded gap-3">
                <a href='#' class="col-1 p-0 m-0">
                        <i class="fa-solid fa-volume-high customicon_yellow"></i>
                    </a>
                    <div class="col-5">
                        <p class="sm-text">promos </p>
                        <p class="xs-text">items</p>
                    </div>
                </div>

                <div class="col-md-6 row descard  py-3 rounded gap-3">
                <a href='#' class="col-1 p-0 m-0">
                        <i class="fa-solid fa-handshake-angle customicon_blue"></i>
                    </a>
                    <div class="col-10">
                        <p class="sm-text"> help center </p>
                        <p class="xs-text">items</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 order-md-2 order-1">
                <div class="row">
                    <div class="col-4">
                        <img src="{{asset('image/expl.png')}}" alt="" class="col-12 rounded heightcontroll">
                    </div>

                    <div class="col-8 row">
                        @guest
                            <div class="col-12 user-info">
                                <a href="{{ route('login') }}" class="auth_button rounded">Login</a>
                                <a href="{{ route('register') }}" class="auth_button auth_button_black rounded">Register</a>
                            </div>
                        @else
                            <div class="col-12 user-info">
                                <div class="sm-text">{{ Auth::user()->name }}</div>
                                <div class="d-flex align-items-center gap-2">
                                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                        @csrf
                                        <button type="submit" class="auth_button rounded">Logout</button>
                                    </form>
                                    @if(Route::has('favourite'))
                                        <a href="{{ route('favourite') }}" class="d-flex align-items-center text-decoration-none">
                                            <span class="sm-text1 counter me-1">1</span>
                                            <i class="fa-solid fa-heart"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection