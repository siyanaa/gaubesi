@extends('frontend.layouts.master')
@section("content")
<section class="container-fluid routingname">
    <div class="container py-3">
        <p class="md-text">
            <i class="fa-solid fa-location-dot greenhighlight"></i> 
            <span class="md-text">Home</span> .
            <span>{{ $category->title }}</span>
        </p>
    </div>
</section>
<section class="container-fluid py-2">
    <div class="container">
        <div class="row py-2 fcc flex-wrap gap-md-0 gap-1">
            @foreach($category->subcategories as $subcategory)
                @foreach($subcategory->products as $product)
                    <div class="col-md-3 col-5 mb-2">
                        <a href="{{ route('singleproducts', ['id' => $product->id]) }}" style="text-decoration: none; color: inherit;">
                            <div class="customcard row col-md-12 p-2 rounded">
                                <div class="card-body">
                                    <div class="imgf d-flex justify-content-center py-2">
                                        <img src="{{ asset($product->mainImagePath) }}" alt="{{ $product->title }}" class="mdimage-lg">
                                    </div>
                                    <div class="d-flex justify-content-between mx-1">
                                        <p class="xs-text needhide yellowhighlight">{{ $category->title }}</p>
                                        <p class="xs-text">
                                            @php
                                                $averageRating = round($product->averageRating);
                                            @endphp
                                            @for($i = 0; $i < 5; $i++)
                                                <i class="fa-{{ $i < $averageRating ? 'solid' : 'regular' }} fa-star"></i>
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
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>
@endsection
