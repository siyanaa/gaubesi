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

    @media (max-width:400px) {
        .des-button {
            font-size: 14px;
            font-weight: 400;
        }

    }

    .htcon {
        height: 12vh;
        width: 100%;
        object-fit: cover;

    }

    .advertisementcard {
        background: white;
        border: 1px solid var(--border-color);

    }
</style>

<section class="container-fluid py-3">
    <div class="container">
        <div class="row  p-0 gap-4">
            <div class="col-md-1  left-items py-md-4 py-2 gap-4 rounded">
                <div class="d-flex align-items-center flex-column">
                    <i class="fa-regular fa-message customicon "></i>
                    <p class="xs-text">chat</p>
                </div>
                <div class="d-flex align-items-center flex-column my-md-3">
                    <i class="fa-solid fa-box customicon_blue"></i>
                    <p class="xs-text ">order</p>
                </div>
                <div class="d-flex align-items-center flex-column my-md-3">
                    <i class="fa-brands fa-creative-commons-nd customicon_yellow"></i>
                    <p class="xs-text">Activities</p>
                </div>
                <div class="d-flex align-items-center flex-column my-md-3">
                    <i class="fa-solid fa-truck customicon_pink"></i>
                    <p class="xs-text">Delivery</p>
                </div>
            </div>

            <div class="col-md-7  d-flex flex-column gap-2 rounded p-0 m-0 ">
                <div class="descard gap-1 p-3 rounded">
                    <p class="sm-text">gaubesi</p>
                    <p class="xs-text">yesterday</p>
                </div>
               
                <div class="descard gap-2 p-3 rounded">
                    <p class="sm-text">gaubesi</p>
                    <p class="xs-text">yesterday</p>
                </div>
                <div class="descard gap-2 p-3 rounded">
                    <p class="sm-text">vendor 1</p>
                    <p class="xs-text">yesterday</p>
                </div>
                <div class="descard gap-2 p-3 rounded">
                    <p class="sm-text">vendor 2</p>
                    <p class="xs-text">yesterday</p>
                </div>
            </div>
            <div class="col-md-3 p-0 m-0">
                <div class="d-flex flex-column gap-2 rounded">
                    <div class="advertisementcard p-3 rounded">
                        <p class="d-flex align-items-center gap-3 p-0 m-0">
                            <i class="fa-solid fa-volume-high customicon_yellow"></i>
                            <span class="sm-text">here is the 100% product</span>
                        </p>
                        <img src="{{asset('image/house1.png')}}" alt="" class="lgimage htcon p-0 m-0 py-1">
                        <p class="xs-text p-0 m-0">here is the 100% product only available for today</p>
                    </div>
                    <div class="advertisementcard p-3 rounded">
                        <p class="d-flex align-items-center gap-3 p-0 m-0">
                            <i class="fa-solid fa-volume-high customicon_yellow"></i>
                            <span class="sm-text">here is the 100% product</span>
                        </p>
                        <img src="{{asset('image/house1.png')}}" alt="" class="lgimage htcon p-0 m-0 py-1">
                        <p class="xs-text p-0 m-0">here is the 100% product only available for today</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection