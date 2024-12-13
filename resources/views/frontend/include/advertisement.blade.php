<!-- explore -->
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
<section class="container-fluid advertisement py-5">
    <div class="container">
        @if($advertisement)
            <div class="row d-flex justify-content-center align-items-center gap-3">
                <div class="col-md-6 order-2 order-md-1">
                   
                    <div class="lg-texts whitehighlight">Explore categories</div>
                    <p class="xs-text whitehighlight my-2">{{ $advertisement->description }}</p>
                    <div class="adv-button-collection d-flex gap-3">
                       
                  <a href="{{ $advertisement->link }}" class="btn-buttonwhite mt-2" role="button">Link</a>
                    </div>
                </div>
                <img src="{{ asset('' . $advertisement->image) }}" alt="Advertisement Image" class="col-md-4 lgimage order-md-2 order-1">
            </div>
        @else
            <!-- Optional: Show something when no advertisements exist -->
            <div class="text-center">
                <p>No advertisements available.</p>
            </div>
        @endif
    </div>
</section>