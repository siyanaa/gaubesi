



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
        color:var(--yellow);
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
    .daydeal{
        background:#F1F4F0;
    }
</style>


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
                @endforeach
            </div>
        </div>
    </section>
    