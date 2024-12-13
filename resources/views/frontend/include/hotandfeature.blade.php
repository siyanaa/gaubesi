<style>
    .featureandhot {
        background: #f9f9f9;
        padding: 4rem 0;
    }
    .customcard-dup{
        border: 1px solid var(--green);
    }

    .hotproduct {
        display: none;
    }
</style>

<section class="container-fluid featureandhot">
    <div class="container">
        <div class="row gap-5">
            <div class="col-md-8">
                <div class="topic-collection d-flex gap-4">
                    <p class="lg-text-md underlineborder active" id="featuresProduct">features products</p>
                    <p class="lg-text-md" id="hotSale">hot sale</p>
                </div>

                <!-- Featured Products -->
                <div class="row py-3 col-md-12 product-container featureproduct">
                    <div class="fbc gap-1 flex-wrap">
                        @foreach($featuredProducts as $offer)
                            <div class="col-md-3 d-flex align-items-center mb-3">
                                <a href="{{ route('singleproducts', ['id' => $offer->product->id]) }}" style="text-decoration: none; color: inherit;">
                                    <img src="{{ asset('' . $offer->product->mainImagePath) }}" alt="{{ $offer->product->name }}" class="smimage">
                                    <div class="mx-2">
                                        <p class="xs-text-md p-0 m-0">{{ $offer->product->title }}</p> 
                                        <p class="xs-text-md p-0 m-0 yellowhighlight">rs <span>{{ $offer->product->selling_price }}</span></p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Hot Sale Products -->
                <div class="row py-3 col-md-12 product-container hotproduct">
                    <div class="fbc flex-wrap gap-1">
                        @foreach($hotSaleProducts as $offer)
                            <div class="col-md-3 d-flex align-items-center mb-3">
                                <a href="{{ route('singleproducts', ['id' => $offer->product->id]) }}" style="text-decoration: none; color: inherit;">
                                    <img src="{{ asset('' . $offer->product->mainImagePath) }}" alt="{{ $offer->product->name }}" class="smimage">
                                    <div class="mx-2">
                                        <p class="xs-text-md p-0 m-0">{{ $offer->product->title }}</p> 
                                        <p class="xs-text-md p-0 m-0 yellowhighlight">rs <span>{{ $offer->product->selling_price }}</span></p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="customcard-dup row col-md-3 col-11 p-2 rounded mx-md-0 mx-2">
                <div class="card-body fcc flex-column">
                    <p class="md-text text-center mx-1">mali gaiko pure gheu</p>
                    <div class="d-flex justify-content-center py-2">
                        <img src="{{ asset('image/house3.png') }}" alt="" class="mdimage-lglg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const featureDiv = document.querySelector(".featureproduct");
        const hotDiv = document.querySelector(".hotproduct");
        const featuresProduct = document.getElementById("featuresProduct");
        const hotSale = document.getElementById("hotSale");

        // Set initial states
        featureDiv.style.display = "block"; // Show feature product initially
        hotDiv.style.display = "none";      // Hide hot product initially

        // Event listeners for toggling
        featuresProduct.addEventListener("click", function () {
            featureFun();
            // Add underline and active class
            featuresProduct.classList.add("underlineborder", "active");
            hotSale.classList.remove("underlineborder", "active");
        });

        hotSale.addEventListener("click", function () {
            hotFun();
            // Add underline and active class
            hotSale.classList.add("underlineborder", "active");
            featuresProduct.classList.remove("underlineborder", "active");
        });
    });

    function featureFun() {
        const featureDiv = document.querySelector(".featureproduct");
        const hotDiv = document.querySelector(".hotproduct");

        // Show featureDiv and hide hotDiv
        featureDiv.style.display = "block";
        hotDiv.style.display = "none";
    }

    function hotFun() {
        const featureDiv = document.querySelector(".featureproduct");
        const hotDiv = document.querySelector(".hotproduct");

        // Show hotDiv and hide featureDiv
        hotDiv.style.display = "block";
        featureDiv.style.display = "none";
    }
</script>
