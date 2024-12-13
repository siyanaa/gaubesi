<!-- In frontend/searching.blade.php -->
@extends('frontend.layouts.master')

@section('content')
<section class="container-fluid otherpagebanner">
    <div class="row">
        <div class="col-md-12 p-0">
            <div class="carousel-inner ">
                <div class="row d-flex">
                    <div class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2 ">
                        <img src="{{ asset('image/abou1.png') }}" alt="" srcset="" class="imagecontroller imagecontrollerheight imagecontrollerheightextra">
                        <div class="flex bannercontentheight">
                            <div class="bannercontentinnerheight ">
                                <h4 class="lg-text1">Search Results</h4>
                                <h5 class="md-text1"><a href="">Home</a> <i class="fa-solid fa-angle-right "></i>
                                    <span class="highlight">Search Results</span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid pb-4">
    <div class="container">
        @if($properties->isNotEmpty())
            <div class="row mt-4">
                @foreach ($properties as $property)
                <a class="col-md-4 my-2" href="{{ route('singleproducts', ['id' => $property->id]) }}">
                    <div class="card">
                        @php
                            $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
                            $mainImage = !empty($mainImages) ? asset($mainImages[0]) : asset('images/default-placeholder.png');
                        @endphp
                        <img src="{{ $mainImage }}" alt="Property Image" class="p-2">
                        <div class="sell_rent_button d-flex justify-content-between ">
                            <div class="btn-buttonxs btn-buttonxsyellow ">{{$property->status}}</div>
                            <div class="btn-buttonxs btn-buttonxsgreen mx-1">{{$property->availability_status}}
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="md-text">{{strlen($property->title)>34 ? substr($property->title ,0 ,34). "...":$property->title }}</h5>
                            <div class=" d-flex gap-3 flex-wrap ">
                                <h2 class="sm-text"><span class="mx-1">{{ $property->bedrooms}}</span> bedroom</h2>
                                <h2 class="sm-text"><span class="mx-1">{{ $property->bathrooms}}</span>bathroom</h2>
                                <h2 class="sm-text"><span class="mx-1">{{ $property->price}}</span>area</h2>
                            </div>
                            <div class="price-person ">
                                <div class="d-flex justify-content-between align-content-center">
                                    <div class=" sm-text"> <span class="md-text"> ${{ $property->price}}
                                            /</span>{{ $property->rental_period}} </div>
                                    <img src="{{asset('image/blog.png')}}" alt="" sizes="" srcset=""
                                        class="feature-smallimg feature-smallimgdup">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        @else
            <p class="text-center mt-4">No properties found matching your search criteria.</p>
        @endif
    </div>
</section>
@endsection