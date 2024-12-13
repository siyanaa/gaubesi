@extends("frontend.layouts.master")

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
    color: var(--yellow);
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
  .daydeal {
    background: #F1F4F0;
  }
  .descriptionborder {
    border: 2px solid var(--border-color);
    border-radius: var(--radius4);
  }
  .findstockbutton {
    background-color: #FDE0E9 !important;
    border: 1px solid var(--text-gray) !important;
    color: var(--yellow) !important;
  }
  .forline {
    height: 1px;
    width: 100%;
    background: var(--border-color);
    color: red;
  }
  .routingname {
    background-color: #F5F5F5;
  }
  .btn-xs-weight {
    border-radius: var(--radius4);
    height: 22px;
    width: 54px;
    font-size: 12px;
  }
  .btn-xs {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius4);
    height: 28px;
    width: 44px;
    font-size: 24px;
    font-family: var(--font-family);
    font-weight: var(--weight700);
  }
  @media(max-width:450px) {
    .needhide {
      display: none;
    }
    .col-md-3 .customcard:nth-child(even) {
      margin-top: 0.5rem;
    }
  }
  .sidebar .searchcontainer {
    background: var(--off-green);
    border-radius: var(--radius4);
  }
</style>
@section("content")
<section class="container-fluid routingname ">
  <div class="container py-3 ">
    <p class="sm-text"><i class="fa-solid fa-location-dot greenhighlight"></i> <span>Home</span> . <span>Product</span>
    </p>
  </div>
</section>
<style>
  .hidesinglebuy {
    background: var(--white-green);
    min-height: 100vh;
    width: 55%;
    position: fixed;
    top: 0;
    right: 0;
    z-index: 30;
    display: none;
    box-shadow: -2px 0px 10px rgba(0, 0, 0, 0.5);
  }
  .fa-xmark {
    position: absolute;
    top: 22%;
    right: 1.5%;
    z-index: 20;
    background: black;
    border-radius: var(--radius8);
    cursor: pointer;
  }
  @media (max-width:770px) {
    .hidesinglebuy {
      width: 92%;
    }
  }
  .makeactive {
    background: var(--pure-black) !important;
    color: var(--pure-white);
  }
  .showsinglebuy {
    background: var(--green);
    margin: 0 1rem;
    top: 10rem;
    position: absolute;
    padding: 0 1rem;
    border-radius: var(--radius4);
  }
  #additional,
  #review {
    display: none;
  }
  @media (max-width:700px) {
    .hidesinglebuy {
      top: -3.5rem;
      left: 0;
      bottom: 20rem;
    }
    .fa-xmark {
      top: 24%;
      /* Adjust to a percentage for responsive design */
      right: 3%;
    }
    #additional,
    #review {
      display: none;
    }
  }
</style>

<!--open after click the buy button  -->
<section class="container-fluid hidesinglebuy">
  <div class="container fcc ">
    <i class="fa-solid fa-xmark customicon" onclick="closeSinglebuy()"></i>
    <div class="row  py-3 my-1  showsinglebuy fcc gap-2">
      <div class="col-md-8">
        <div class="row  d-flex align-items-center border rounded shadow-sm bg-light py-2">
          <div class="col-md-3 d-flex align-items-center">
            <img src="{{ asset("image/house3.png")}}" alt="" srcset="" class="col-md-5 smimage-lg smimage-lgcd mx-2">
          </div>
          <div class="col-md-4">
            <h5 class="sm-text"><strong>Seeds of Change helll</strong></h5>
          </div>
          <div class="d-flex align-items-center gap-1 col-md-3">
            <button class="btn-xs">-</button>
            <button class="btn-xsbutton-lg p-0 m-0 ">0</button>
            <button class=" btn-xs ">+</button>
          </div>
          <p class="xs-text-bd  yellowhighlight m-md-0 m-2 col-md-2 ">Rs 30000</p>
        </div>
      </div>
      <div class="col-md-3  border rounded shadow-sm bg-light">
        <div class="row col-md-12 green p-3 gap-2">
          <p class=" topic-collection md-text p-1">order summary </p>
          <span class="sm-text topic-collection p-1">total items : </span>
          <span class="sm-text topic-collection p-1">total itemss s : </span>
          <button class="btn-buttonoutline-sm p-0 m-0 ">Buy Now</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- start of single product -->
<section class="container-fluid singleprojectpage py-2">
  <div class="container">
      <div class="row gap-5">
          <div class="col-md-8">
              <div class="row">
                  <div class="col-md-12">
                      <div class="row">
                          <div class="d-flex col-md-5">
                              <div class="row">
                                  @php
                                      $mainImages = !empty($products->main_image) ? json_decode($products->main_image, true) : [];
                                      $mainImage = !empty($mainImages) ? asset($mainImages[0]) : asset('images/default-placeholder.png');
                                  @endphp
                                  <img src="{{ $mainImage }}" alt="{{ $products->title }}" class="col-md-12 lgimage-lgheightcd productnameimage">
                                  <div class="col-md-12 m-3">
                                      @foreach($mainImages as $image)
                                          <img src="{{ asset($image) }}" alt="{{ $products->title }}" class="col-md-3 smimage-lg" onclick="otherimage(this)">
                                      @endforeach
                                  </div>
                              </div>
                          </div>

              <script>
                function otherimage(element) {
                  const productnameimage = document.querySelector(".productnameimage");
                  productnameimage.src = element.src;
                }
              </script>
              <!-- Product Details -->
                            <div class="col-md-7 d-flex flex-column justify-content-between">
                                <div class="d-flex gap-1">
                                    <button class="btn-buttonoutline-sm findstockbutton">
                                        {{ $products->product_quantity > 0 ? 'available' : 'stock out' }}
                                    </button>
                                </div>
                                <h3 class="sm-text py-2">{{ $products->title }}</h3>
                                <h3 class="xs-text pb-2">{{ $products->description }}</h3>
                                <div class="forline"></div>
                                <div class="d-flex flex-column p-0 m-0">
                                    <p class="m-0 p-0">
                                        <span class="xs-text-bd">Brand </span>
                                        <span class="xs-text">: {{ $products->brand }}</span>
                                    </p>
                                    @if($products->flavour)
                                    <p class="m-0 p-1">
                                        <span class="xs-text-bd">Flavour </span>
                                        <span class="xs-text">: {{ $products->flavour }}</span>
                                    </p>
                                    @endif
                                    <p class="m-0 p-1">
                                        <span class="xs-text-bd">Weight </span>
                                        <span class="xs-text">: {{ $products->weight }} {{ $products->weight_unit }}</span>
                                    </p>
                                    @if($products->additional_info)
                                    <p class="m-0 p-1">
                                        <span class="xs-text-bd">Info </span>
                                        <span class="xs-text">: {{ $products->additional_info }}</span>
                                    </p>
                                    @endif
                                </div>
                                <h3 class="greenhighlight p-md-0 m-0 py-2">₹{{ $products->selling_price }}</h3>
                                <div class="d-flex align-items-center gap-2 md-py-0 py-2">
                                    <button class="btn-buttonoutline-sm p-0 m-0" onclick="addToFavorites({{ $products->id }})">favourite</button>
                                    <button class="btn-buttonoutline-sm p-0 m-0" onclick="addToCart({{ $products->id }})">add cart</button>
                                    <button class="btn-buttonoutline-sm p-0 m-0" onclick="buyNowFun()">Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
        <!-- Description Section -->
        <div class="col-md-12 my-2 descriptionborder p-4">
          <div class="row">
              <div class="col-md-6 gap-3 d-flex">
                  <button class="btn-buttonoutline-sm p-0 m-0 changer makeactive" data-id="description" onclick="callToggle(this)">description</button>
                  <button class="btn-buttonoutline-sm p-0 m-0 changer" data-id="additional" onclick="callToggle(this)">add info</button>
              </div>
              <p class="xs-text py-2 mx-md-2" id="description">
                  {{ $products->description }}
              </p>
              <p class="xs-text py-2 mx-md-2" id="additional">
                  {{ $products->additional_info }}
              </p>
          </div>
      </div>
        
        <style>
              .starpointer {
                cursor: pointer;
              }
            </style>
        <form action="" class="col-md-12 my-2 descriptionborder p-4">
          <div class="row gap-3">
            <div class="col-md-12 d-flex align-items-center">
              <i class="fa-solid fa-star"></i>
              <p class="xs-text-bd p-0 m-0 mx-2 greenhighlight">Your Experience</p>
              <i class="fa-solid fa-star"></i>
            </div>
            <div class="col-md-3">
              <label for="name" class="xs-text py-2">Name</label>
              <input type="text" id="name" class="input " required placeholder="Enter your name">
            </div>
            <div class="col-md-4">
              <label for="name" class="xs-text py-2">experience in one word</label>
              <input type="text" id="name" class="input " required placeholder="one word">
            </div>
            <div class="col-md-4">
              <label for="name" class="xs-text py-2">rating</label>
              <div class="starpointer">
                <div>
                  <i class="star fa fa-star fa-regular" onclick="fillStar(this)"></i>
                  <i class="star fa fa-star fa-regular" onclick="fillStar(this)"></i>
                  <i class="star fa fa-star fa-regular" onclick="fillStar(this)"></i>
                  <i class="star fa fa-star fa-regular" onclick="fillStar(this)"></i>
                  <i class="star fa fa-star fa-regular" onclick="fillStar(this)"></i>
                </div>
                </p>
              </div>
            </div>
            <div class="col-md-12">
              <label for="comment" class="xs-text py-2">Your Comment</label>
              <textarea id="comment" class="textarea" rows="2" required
                placeholder="Share your experience..."></textarea>
            </div>
            <div class="col-md-12">
              <button type="submit" class="btn-buttonoutline-green" onclick="reviewSubmit()">Submit</button>
            </div>
          </div>
        </form>
                  <script>
                    // for rating
    function fillStar(element) {
        const stars = document.querySelectorAll(".star");
        // to get items upto click items from beginning
        const clickitems=Array.from(stars).indexOf(element);
        stars.forEach((star, index) => {
            if (index <= clickitems) {
                star.classList.remove("fa-regular");
                star.classList.add("fa-solid");
            } else {
                star.classList.remove("fa-solid");
                star.classList.add("fa-regular");
            }
        });
    }
    function reviewSubmit(){
      console.log("i am clciked")
    }
</script>
        <div class="col-12 row my-3 mt-4 gap-4">
          <div class="col-12 col-md-12 d-flex align-items-start">
            <img src="{{asset('image/house1.png')}}" alt="House" class="smimage rounded-circle" />
            <div class="col-9 ms-3">
              <p class="mb-0 d-flex align-items-center gap-2">
                <span class="xs-text-bd p-0 m-0">Name</span> <span class="d-flex"> <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i
                    class="fa-solid fa-star"></i></span>
              </p>
              <p class="xs-text-bd p-0  m-0 italic py-1"> One-word experience</p>
              <p class="text-muted p-0  m-0">Whole message goes here. This is where you can provide a more detailed
                description of your experience.
              </p>
            </div>
          </div>
          <div class="col-12 col-md-12 d-flex align-items-start">
            <img src="{{asset('image/house1.png')}}" alt="House" class="smimage rounded-circle" />
            <div class="col-9 ms-3">
              <p class="mb-0 d-flex align-items-center gap-2">
                <span class="xs-text-bd p-0 m-0">Name</span> <span class="d-flex"> <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i
                    class="fa-solid fa-star"></i></span>
              </p>
              <p class="xs-text-bd p-0  m-0 italic py-1"> One-word experience</p>
              <p class="text-muted p-0  m-0">Whole message goes here. This is where you can provide a more detailed
                description of your experience.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 sidebar">
        <div class="">
          <div class="searchcontainer fcc p-2 mt-2  ">
            <input type="text" class="footerinput m-0 p-2" placeholder="search your project">
            <button class="search m-0 py-2 px-3"> Search</button>
          </div>
          <div class="featurelist-body">
            <p class="md-text  p-2">our product </p>
            @foreach ($products as $product)
              <a class="featurelist-content d-flex py-1" href="{{ route('singleproducts', ['id' => $product->id]) }}">
                @php
            $mainImages = !empty($product->main_image) ? json_decode($product->main_image, true) : [];
            $mainImage = !empty($mainImages) ? asset($mainImages[0]) : asset('images/default-placeholder.png');
        @endphp
                <img src="{{ $mainImage }}" alt="Product Image" class="feature-smallimg"
                data-src="holder.js/200x250?theme=thumb" />
                <div class="featurlist-description mx-3">
                <h3 class="sm-text">{{ $product->title }}</h3>
                <p class="sm-text highlight">{{ $product->selling_price }}</p>
                </div>
              </a>
      @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- product deal -->
@include("frontend.include.productdeal")
<!-- advertisement -->
@include("frontend.include.advertisement")
<script>
  // to toggle description ,additional and review
  function callToggle(element) {
    const items = document.querySelectorAll('.changer')
    const description = document.getElementById('description');
    const additional = document.getElementById('additional');
    const review = document.getElementById('review');
    description.style.display = "none";
    additional.style.display = "none";
    review.style.display = "none";
    items.forEach(item => {
      item.classList.remove("makeactive");
    })
    element.classList.add("makeactive");
    const id = element.getAttribute("data-id");
    if (id === "description") {
      description.style.display = "block";
    }
    else if (id === "additional") {
      additional.style.display = "block";
    }
    else {
      review.style.display = "block";
    }
  }
  // Toggle the display product
  function buyNowFun() {
    const getSingleBuy = document.querySelector(".hidesinglebuy");
    if (getSingleBuy.style.display === "none") {
      getSingleBuy.style.display = "block";
    } else {
      getSingleBuy.style.display = "none";
    }
  }
  //to close the display product of single page
  function closeSinglebuy() {
    const getSingleBuy = document.querySelector(".hidesinglebuy");
    if (getSingleBuy.style.display === "block") {
      getSingleBuy.style.display = "none";
    }
    else {
      getSingleBuy.style.display = "block";
    }
  }
</script>
@endsection