

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="{{asset('boot/css/bootstrap.css')}}">
  <script src="{{ asset('boot/js/bootstrap.min.js')}}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />



</head>

<body>
      <section class="container-fluid">
    <div class="container">
    <div class="button-collection row  gap-sm-5 nav-button-collection py-2">
          <button class="btn-buttonyellow reg-logbutton reg-logbutton-white mb-1 mx-1 coloryellow">register</button>
          <button class="btn-buttonyellow reg-logbutton mx-1 ">login</button>
        </div>
    </div>
  </section>

<!-- navbar -->

<section class="container-fluid navsection">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light navcustom">
        <a class="navbar-brand" href="#"> <img src="{{ asset('image/logo.png') }}" alt="Logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav m-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Introduction
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="#">Why Us</a>
                </li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <a class="dropdown-item" href="./pages/about.html">About</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
          <button class="btn-buttonyellow ">login/register</button>
        </div>
      </nav>
    </div>
  </section>


  <!-- each team des -->
  <!-- banner section -->
  <section class="container-fluid singleprojectpage">
      <div class="row">
        <div
          class="col-md-12 text-center d-flex flex-column justify-content-center align-items-center mb-2 imagecontroller  imagecontrollerheight"
          style="background-image: url('{{ asset('image/bighouse.png') }}');">
          <img src="" alt="">
          <p class="sm-text mb-3 text-center">More than <span class="highlight">1000+</span> houses available for
            sale &
            rent in the country</p>
          <h4 class="lg-text mb-4">Find Your Dream Home</h4>
        </div>

      </div>
  </section>

  <!-- member description -->
  <section class="container-fluid singleprojectpage">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="description-body">
            <div class="row d-flex gap-2">
              <img src="{{ asset('image/bighouse.png') }}" alt="" srcset="" class="memberimage col-md-3">
              <div class="d-flex flex-column  col-md-7">
                <h1 class="md-text p-0 m-0 mb-1">animesh baral</h1>
                <p class="sm-text p-0 m-0 mb-1">full stack develpoere </p>
                <p class="sm-text p-0 m-0  mb-1"> member Of : </p>
                <p class="sm-text p-0 m-0  mb-1">Steet ,full address </p>
                <p class="sm-text p-0 m-0  mb-1">Steet ,full address </p>
                <div class=" col-md-12 py-2">
                  <div class="row gap-1">
                    <h1 class="sm-text col-md-3 col-4 grayborder">Send mail</h1>
                    <h1 class="sm-text col-md-4 col-4  grayborder">977-222-33</h1>
                    <h1 class="sm-text col-md-3  col-4 grayborder">whatsApp</h1>
                  </div>
                </div>
              </div>
            </div>
            <div class="py-3">
              <h1 class="md-text">about us</h1>
              <p class="sm-text">We wanted to take a moment to tell you what a pleasure it has been to work with you
                and your team at Al Asar. Your team professionalism has been by far beyond industry Firms and even
                ourexpectations. It's a pleasure to work with a firm which not only understands and commodes customers
                request but a</p>
            </div>
            <div class="row py-2">
              <div class="col-md-4">
                <h1 class="md-text">experience</h1>
                <p class="sm-text">We wanted to take </p>
              </div>
              <div class="col-md-4">
                <h1 class="md-text">experience</h1>
                <p class="sm-text">We wanted to take </p>

              </div>
              <div class="col-md-4">
                <h1 class="md-text">experience</h1>
                <p class="sm-text">We wanted to take </p>
              </div>
            </div>
            <h1 class="md-text"> specialties and service area</h1>
            <div class="row gap-4 mx-1 py-2">

              <h1 class="sm-text col-md-2 col-5  grayborder">experience</h1>
              <h1 class="sm-text col-md-2 col-5  grayborder">experience</h1>
              <h1 class="sm-text col-md-2 col-5  grayborder">experience</h1>
            </div>
            <div class="row py-3">
              <div class="col-md-4">
                <h1 class="md-text">experience</h1>
                <p class="sm-text">We wanted to take </p>
              </div>
              <div class="col-md-4">
                <h1 class="md-text">experience</h1>
                <p class="sm-text">We wanted to take </p>
              </div>
              <div class="col-md-4">
                <h1 class="md-text">office hours</h1>
                <p class="sm-text">We wanted to take </p>
              </div>
              <div class="col-md-4">
                <h1 class="md-text">office address</h1>
                <p class="sm-text">We wanted to take </p>
              </div>
              <div class="col-md-4">
                <h1 class="md-text">langauage spoken</h1>
                <p class="sm-text">We wanted to take </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="description-body">
            <h3 class="md-text greenhighlight">nexon detail center</h3>
            <div class="d-flex flex-column gap-2">
              <input type="text" name="" id="" class="input" placeholder="Person name" />
              <input type="text" name="" id="" class="input" placeholder="Contact NO." class="my-2" />
              <textarea name="" id="" class="textarea"></textarea>
              <button class="btn-buttongreen btn-buttonygreenlarge mx-2">Search</button>
            </div>
          </div>
        </div>
      </div>
  </section>






{{--footer section --}}

<footer class="container-fluid container-fluid-background mt-5">
    <div class="container">
      <div class="row  d-flex justify-content-between">
        <div class="col-md-5 flex-col sm-col-12 py-1">
          <h1 class="lg-text1 highlight p-0 m-0">NEXON</h1>
          <p class="sm-text1">
            Welcome to pagename where our passion for real estate and dedication to
            client satisfaction converge to create an unparalleled home-buying experience. Founded </p>

        </div>
        <div class="col-md-2 sm-col-12  py-1 px-5">
          <h1 class="md-text1 highlight">Quick link</h1>
          <ul class="d-flex justify-content-around customui flex-column gap-2">
            <li><a href=""> <i class="fa-solid fa-truck-moving  customiconssmall"></i>Rent</a></li>
            <li><a href=""><i class="fa-solid fa-cart-shopping customiconssmall"></i>Buy</a></li>
            <li><a href=""> <i class="fa-solid fa-address-book customiconssmall"></i>About</a></li>
            <li><a href=""><i class="fa-solid fa-blog customiconssmall"></i>Blog</a></li>
          </ul>


        </div>
        <div class="col-md-3 col-sm-12  py-1">
          <h1 class="md-text1 highlight">Message us</h1>
          <input type="text" class="input" placeholder="Your email id here">
          <textarea name="" id="" rows="1" cols="" class="textarea my-1"></textarea>
          <button class=" btn-buttonyellow  footer-button">login/register</button>

        </div>
      </div>

    </div>
  </footer>

  <div class="container-fluid button-footer">
    <div class="container d-flex align-items-center  justify-content-center flex-column py-2">
      <div class="d-flex justify-content-around  py-2 ">
        <i class="fa-brands fa-facebook customicons mx-2"></i>
        <i class="fa-brands fa-instagram customicons mx-2"></i>
        <i class="fa-brands fa-linkedin customicons mx-2"></i>
        <i class="fa-brands fa-youtube customicons mx-2"></i>
      </div>
      <ul class="d-flex justify-content-around customui">
        <li><a href="" class=" mx-1 line">fAQ</a></li>
        <li><a href="" class=" mx-1 line">Policy</a></li>
        <li><a href="" class=" mx-2">Term and Condition</a></li>

      </ul>


    </div>
  </div>






</body>
</html>
