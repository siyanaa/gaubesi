<style>
  .logoimg {
    width: auto;
    height:56px;
    object-fit: cover;
  }

  @media (max-width: 400px) {
    .logoimg {
      width: 130px;
      height: 60px;
      object-fit: contain;
    }
  }

  a {
    text-decoration: none;
  }

  .crossmenu {
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    width: 60px;
    height: 44px;
    background: var(--off-green);
    border-radius: 8px;

  }

  .linea {
    margin-left: 6px;
    height: 4px;
    width: 72%;
    background-color: white;
    transition: all 0.3s ease;
  }

  .line1 {
    width: 66%;
  }

  .line2 {
    width: 76%;
  }

  .line3 {
    width: 66%;
  }

  .crossmenu.cross .line1 {
    transform: rotate(45deg) translate(11px, 5px);
  }

  .crossmenu.cross .line2 {
    opacity: 0;
  }

  .crossmenu.cross .line3 {
    transform: rotate(-45deg) translate(11px, -5px);
  }

  .navsection {
    background: var(--green) !important;
    position: sticky;
    top: 0;
    z-index: 1000;
  }

  .navsection .nav-item {
    font-size: 18px !important;
    font-weight: var(--weight400) !important;
    font-family: var(--font-family) !important;
    text-transform: capitalize !important;

  }

  .navsection .navbar-collapse .nav-item a {
    color: white !important;
    letter-spacing: 1px;
  }

  .navinput {
    width: 24vh;
    height: 5vh;
    border-radius: 20px 0 0 20px;
    border: 1px solid white;
  }
  .navinput:focus{
   
    border-radius: 20px 0 0 20px;
    border: 1px solid white;
    outline: none;
    stroke: none;
  }

  input::placeholder {
    font-size:16px;
    font-weight: 400;
    color: var(--pure-black);
    letter-spacing:1px;
    font-family: var(--font-family);
    letter-spacing:0.8px;
  outline: none;
  stroke: none;
  }

  .search {
    border: 1px solid black;
    background: black;
    padding: 0 2rem;
    border-radius: 0 20px 20px 0;
    color: white;
    letter-spacing:1px;
    font-size: var(--font-family);
  }

  @media (max-width:998px) {
    .forhide {
      display: none;
    }

  }

  .top-counter {
    position: absolute;
    padding: 0 7px;
    top: 0rem;
    right: 0rem;
    background: var(--yellow);
    border-radius: 20px;
    font-size: 11px;
    color: var(--pure-white);
  }

  .forrelative {
    position: relative;
  }


  .activites {
    display: none;
  }


  .bur-menu {
    display: none;
    z-index: 1000;
    background: var(--white-green);
    height: 90vh;
    width: 20vw;
    position: absolute;
    top: 5.17rem;
    left: 0.1rem;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 2;
    box-shadow: -2px 0px 10px rgba(0, 0, 0, 0.5);

  }

  .bur-menu li {
    display: flex;
    align-items: center;
    list-style: none;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius);
    width: 100%;
    text-align: center;

  }

  .bur-menu li a {
    color: var(--text-gray) !important;
    text-transform: uppercase !important;
    font-size: 18px !important;
    font-weight: 700;
    letter-spacing: 1px;
    font-family: var(--font-family) !important;

  }

  .bur-menu li:hover {
    background: var(--off-yellow);
    border-radius: var(--border-radius);
  }


  @media (max-width: 990px) {
    .bur-menu {
      width: 50vw;

    }

    .activites {
      display: block;
    }
  }

  @media (max-width: 700px) {
    .bur-menu {
      width: 80vw;
      top: 5.4rem;
    }


  }



  .customicons {
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    padding: 0.6rem;
    border-radius: var(--border-radius);
  }

  .font-collection :hover {
    border-radius: var(--border-radius);
    z-index: 1;
  }



  .nav-button-collection {
    display: none;
  }

  .forbottomline {
    height: 1px;
    width: 100%;
    color: red;
    background: #000;
  }

  .navactive {
    background: var(--off-green);
    
  }
</style>

<section class="container-fluid navsection">
  <div class="container">
    <div class="bur-menu p-3" id="bur-menu">
      <div class="">
        <!-- <div class="activites">
          <h2 class="navdestext pt-3 forbottomline">Activities Section</h2>
          <li class="nav-item  forbottomline">
            <a class="nav-link" aria-current="page" href="/">Introduction</a>
          </li>
          <li class="nav-item  forbottomline">
            <a class="nav-link" aria-current="page" href="{{ route('products') }}">Rent</a>
          </li>
          <li class="nav-item  forbottomline">
            <a class="nav-link" aria-current="page" href="{{ route('products') }}">Buy</a>
          </li>
        </div> -->
        <style>
          .bur-menu .nav-item:hover .dropdown-menu {
            display: block;
            position: absolute;
            top: 0rem;
            left: 17rem;

          }

          .dropdown-menu {
            display: none;

          }
        </style>
        @foreach($categories as $category)
        <li class="nav-item dropdown nav-item text-center d-flex flex-column gap-2">
            <a class="nav-link" href="{{ route('singlecatogories', $category->id) }}" role="button" aria-haspopup="true" aria-expanded="false">
                {{ $category->title }} 
            </a>
            <span class="forbottomline"></span>
        </li>
    @endforeach
    

        <div class="d-flex flex-column py-3">
          <h2 class="md-text text-center  py-1">connect with us</h2>
          <div class="d-flex font-collection fcc py-2 gap-3 p-0 m-0">
            <a href="#" class="p-0 m-0 "><i class="fa-brands fa-facebook customicons"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin customicons "></i></a>
            <a href="#"><i class="fa-brands fa-instagram customicons "></i></a>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light navcustom">
      <div class="d-flex justify-content-center align-items-center">
        <i class="customicons crossmenu p-1 m-0 d-flex" onclick="funmenu()">
          <div class="linea line1"></div>
          <div class="linea line2"></div>
          <div class="linea line3"></div>
        </i>
        <a class="navbar-brand " href="/"> <img src="{{ asset('image/logos.png') }}" alt="Logo" class="logoimg mx-md-3" /></a>
      </div>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 mx-auto gap-2 nav-pills nav-fill">
          <li class="nav-item ">
            <a class="nav-link" data-id="home" href="/" onclick="toggleActive(this)" data-target="home">home</a>
          </li>
          
          {{-- <li class="nav-item">
            <a class="nav-link" data-id="shop" href="{{ route('') }}" onclick="toggleActive(this)"
              data-target="shop">shop</a>
          </li> --}}

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-id="pages" href="#" role="button"
              aria-haspopup="true" aria-expanded="false" onclick="toggleActive(this)" data-target="pages">pages</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-id="blog" href="{{ route('blog') }}" onclick="toggleActive(this)"
              data-target="blog">blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-id="contact" href="{{ route('contact') }}" onclick="toggleActive(this)"
              data-target="contact">contact</a>
          </li>
        </ul>

      </div>

      <script>
        function toggleActive(element) {
          // Remove active class from all links
          const items = document.querySelectorAll(".nav-link");
          items.forEach(item => {
            item.classList.remove("navactive");
          });

          // Add active class to the clicked link
          element.classList.add("navactive");

          // Store the active state in local storage
          const target = element.getAttribute('data-target');
          localStorage.setItem('activeNav', target);
        }

        // Initialize active class based on local storage
        function initActive() {
          let activeTarget = localStorage.getItem('activeNav');
          const items = document.querySelectorAll(".nav-link");

          // If no active target, set default to "home" and store it
          if (!activeTarget) {
            activeTarget = 'home';
            localStorage.setItem('activeNav', activeTarget);
          }

          items.forEach(item => {
            if (item.getAttribute('data-target') === activeTarget) {
              item.classList.add("navactive");
            }
          });
        }

        // Initialize on page load
        window.addEventListener('load', initActive);
      </script>



      <div class="forhide">
        <div class="searchcontainer d-flex justify-content-center mx-3 ">
          <input type="text" class="navinput m-0 p-2" placeholder="search project">
          <button class="search"> Search</button>

        </div>
      </div>

      <div class="d-flex gap-2 relative">
        <a href="{{route("account")}}" class="d-flex align-items-center">
            <i class="fa-regular fa-user customicon forhide" aria-hidden="true"></i>
        </a>

        @auth {{-- Only show if user is logged in --}}
        <div class="forhide">
            <a href="{{ route('cart') }}" class="d-flex align-items-center forrelative">
                <i class="fa-solid fa-cart-plus customicon"></i>
                <p class="xs-text top-counter cart-count">0</p> <!-- Cart Count -->
            </a>
        </div>
        <div class="forhide">
            <a href="{{ route('favourite') }}" class="d-flex align-items-center forrelative">
                <i class="fa-regular fa-heart customicon"></i>
                <p class="xs-text top-counter favorite-count">0</p> <!-- Favorite Count -->
            </a>
        </div>
    @endauth
    

    </div>
</section>

<script>
  function funmenu() {
    const menuIcon = document.querySelector('.crossmenu');
    const menu = document.getElementById('bur-menu');

    // Toggle the 'cross' class on the menu icon
    menuIcon.classList.toggle('cross');

    // Toggle the display of the menu
    if (menu.style.display === "block") {
      menu.style.display = "none";
    } else {
      menu.style.display = "block";
    }
  }

  // Search Form Toggle Function
  function funsearchingon() {
    const hiddenformdata = document.getElementsByClassName("hiddenform")[0];
    hiddenformdata.style.display = hiddenformdata.style.display === "block" ? "none" : "block";
  }

  function funmenu() {
    const menuIcon = document.querySelector('.crossmenu');
    const menu = document.getElementById('bur-menu');

    // Toggle the 'cross' class on the menu icon
    menuIcon.classList.toggle('cross');

    // Toggle the display of the menu
    if (menu.style.display === "block") {
      menu.style.display = "none";
    } else {
      menu.style.display = "block";
    }
  }
  function funsearchingon() {
    const hiddenformdata = document.getElementsByClassName("hiddenform")[0];
    hiddenformdata.style.display = hiddenformdata.style.display === "block" ? "none" : "block";
  }

  function updateHeaderCounts() {
    $.ajax({
        url: '{{ route("get.header.counts") }}',
        type: 'GET',
        success: function(response) {
            $('.favorite-count').text(response.favorites_count);
            $('.cart-count').text(response.cart_count);
        }
    });
}

// Update counts on page load
$(document).ready(function() {
    updateHeaderCounts();
});

// Update counts after adding/removing from favorites
function deleteFavorite(id, element) {
    if (confirm("Are you sure you want to delete this item?")) {
        $.ajax({
            url: '{{ route("favorites.destroy", "") }}/' + id,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $(element).closest('.col-md-3').remove();
                    updateHeaderCounts(); // Update counts after deletion
                    alert(response.message);
                } else {
                    alert('Failed to delete item.');
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    }
}

// Add to favorites function
function addToFavorites(productId) {
    $.ajax({
        url: '{{ route("favorites.store") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: productId
        },
        success: function(response) {
            if (response.success) {
                updateHeaderCounts(); // Update counts after adding
                alert(response.message);
            } else {
                alert(response.message);
            }
        }
    });
}

// Add to cart function
function addToCart(productId) {
    $.ajax({
        url: '{{ route("cart.add") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: productId
        },
        success: function(response) {
            if (response.success) {
                updateHeaderCounts(); // Update counts after adding
                alert(response.message);
            } else {
                alert(response.message);
            }
        }
    });
}

// Remove from cart function
function removeFromCart(productId) {
    $.ajax({
        url: '{{ route("cart.clear") }}/' + productId,
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                updateHeaderCounts(); // Update counts after removing
                alert(response.message);
            } else {
                alert(response.message);
            }
        }
    });
}
</script>