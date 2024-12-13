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

<section class="container-fluid sectiongap">
    <div class="container">
        <div class="title">
            <div class="lg-texts">Day of the <span class="greenhighlight">deal</span></div>
            <div class="xs-text-md greenhighlight">Don't wait. The time will never be just right.</div>
        </div>
        
        <div class="row my-md-4 fcc flex-wrap gap-md-0 gap-1">
            @foreach($dayDeals as $deal)
                <div class="col-md-4 col-11">
                    <a href="{{ route('singleproducts', ['id' => $deal->product->id]) }}" style="text-decoration: none; color: inherit;">
                        <div class="offercard row col-md-12 p-2 rounded">
                            <p class="md-text whitehighlight py-3 d-flex justify-content-center text-center offerprice">
                                Offer Price Rs.{{ $deal->product->selling_price }}
                            </p>
                            <div class="d-flex gap-2 py-3">
                                <div>
                                    <p class="sm-text-bd whitehighlight p-0 m-0">{{ $deal->product->title }}</p>
                                    <p class="xs-text whitehighlight my-2">{{ $deal->product->description }}</p>
                                </div>
                                <img src="{{ asset('' . $deal->product->decodedMainImage) }}" 
                                     alt="{{ $deal->product->title }}" 
                                     class="mdimage-lg col-md-4">
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>