<style>

footer{
  background:var(--extra-grey);


}

  footer li a {
    font-size: 16px !important;
    font-weight: var(--weight400) !important;
    color: var(--text-gray) !important;
 

  }

  .rightpadding {
    margin-right: 4px;

  }


  .footerinput {
    width: 40vh;
    border: 2px solid white;
    border-radius: 20px 0 0 20px;
  }

  .image-wrapper {
    position: relative;
  }

  .image-wrapper::before {
    content: " ";
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: var(--radius8);

  }

  .smimage-lg {
    position: relative;
    z-index: 0;
  }

  

  .button-footer {
    border-top: 1px solid var(--border-color);
  }


  .customui{
    list-style: none;
  }
  .customui li a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    text-transform: capitalize;
}

.customui li a:hover {
    text-decoration: none;
    color: var(--yellow);
    font-size: 18px;
    text-transform: capitalize;
}
.dropdownhide {
    font-size: 20px;

}
@media (max-width:500px) {
  .footerinput {
    width: 20vh;

  }
   
}
@media (max-width:767px) {
  .hideall{
 display: none;

  }
   
}
@media (min-width:767px) {
  .dropdownhide{
 display: none;

  }
   
}
   



</style>






<footer class="container-fluid py-4">
  <div class="container mb-2 ">
    <div class="row ">
      <div class="col-md-4 my-1 ">
        <p class="d-flex align-items-center justify-content-between" ><span class="md-text ">ghaubasi info.  </span><i class="fa-solid fa-angle-down  mx-2 dropdownhide " onclick="openDropdownfun(this)"></i></p>
        <div class="hideall">
        <p class="xs-text pb-2 ">
          Located in northern Brazil and traversed by the lower Amazon River. </p>
        <p class="xs-text  pb-2">
          <i class="fa-solid fa-location-dot  rightpadding greenhighlight pb-1"></i>51 Green St.Huntington ohaio,Brazil

        </p>
        <p class="xs-text pb-2">
          <i class="fa-solid fa-envelope  rightpadding greenhighlight"></i>example@1245gmail.com

        </p>
        <p class="xs-text pb-2">
          <i class="fa-solid fa-phone  rightpadding greenhighlight"></i>+977-65548986
        </p>
        </div>
      </div>

      <div class=" col-md-4 ">
        <div class="row d-flex  ">

          <div class="col-md-7 sm-col-12  my-1">
          <p class="d-flex align-items-center justify-content-between" ><span class="md-text ">Quick link </span><i class="fa-solid fa-angle-down  mx-2 dropdownhide" onclick="openDropdownfun(this)"></i></p>
          <div class="hideall"> 
          <ul class="d-flex  customui flex-column gap-2 m-1 p-0 ">
              <li><a href="" class="xs-text"> about us </a></li>
              <li><a href="" class="xs-text">privacy policy </a></li>
              <li><a href="{{ url('/terms') }}" class="xs-text">Terms & Conditions</a></li>
              <li><a href="" class="xs-text">delivery information </a></li>
              <li><a href="" class="xs-text">contact us </a></li>
              <li><a href="" class="xs-text">support center </a></li>
            </ul>
          </div>
          </div>

          <div class="col-md-4 sm-col-12 my-1">

          <p class="d-flex align-items-center justify-content-between" ><span class="md-text ">Category </span><i class="fa-solid fa-angle-down mx-2 dropdownhide" onclick="openDropdownfun(this)"></i></p>
          <div class="hideall"> 
            <ul class="d-flex  customui flex-column gap-2 m-1 p-0 ">
              <li><a href="" class="xs-text"> about us </a></li>
              <li><a href="" class="xs-text">privacy  </a></li>
              <li><a href="" class="xs-text"> condition </a></li>
              <li><a href="" class="xs-text"> information </a></li>
              <li><a href="" class="xs-text">contact us </a></li>
           
            </ul>
          </div>
          </div>

        </div>
      </div>

 <div class="col-md-4 col-sm-12  my-1">
 <p class="d-flex align-items-center justify-content-between" ><span class="md-text ">Subscribe Our Newsletter </span><i class="fa-solid fa-angle-down  mx-2 dropdownhide" onclick="openDropdownfun(this)"></i></p>
 <div class="hideall">     
 <div class="d-flex flex-column gap-2 mt-3">
          <div class="searchcontainer d-flex ">
            <input type="text" class="footerinput m-0 p-2" placeholder="search your project">
            <button class="search "> Search</button>
          </div>
          <div class="d-flex font-collection py-2">
            <i class="fa-brands fa-facebook customicons mx-2"></i>
            <i class="fa-brands fa-linkedin customicons mx-2"></i>
            <i class="fa-brands fa-youtube customicons mx-2"></i>
            <i class="fa-brands fa-instagram customicons mx-2"></i>
          </div>

          <div class="feature-images d-flex gap-2 flex-wrap">
            <div class="image-wrapper">
              <img src="{{asset('image/abb.png')}}" alt="" srcset="" class="smimage-lg">
            </div>
            <div class="image-wrapper">
              <img src="{{asset('image/house2.png')}}" alt="" srcset="" class="smimage-lg">
            </div>
            <div class="image-wrapper">
              <img src="{{asset('image/about.jpg')}}" alt="" srcset="" class="smimage-lg">
            </div>
            <div class="image-wrapper">
              <img src="{{asset('image/house1.png')}}" alt="" srcset="" class="smimage-lg">
            </div>
            <div class="image-wrapper">
              <img src="{{asset('image/house2.png')}}" alt="" srcset="" class="smimage-lg">
            </div>
          </div>
        </div>
        </div>

      </div> 
    </div>
  </div>
    <div class="container d-flex align-items-center  justify-content-center flex-column button-footer mb-md-0 mb-4">
      <p class="xs-text py-2"> © <span id="currentYear"></span><span class="greenhighlight"> Aasha Tech </span>All
        rights reserved </p>

      <!-- <ul class="d-flex justify-content-around customui">
        <li><a href="" class=" mx-1 line">fAQ</a></li>
        <li><a href="" class=" mx-1 line">Policy</a></li>
        <li><a href="" class=" mx-2">Term and Condition</a></li>

      </ul> -->

    </div>




</footer>



<script>
function openDropdownfun(element) {
  const parentDiv = element.closest('div'); 
  const getHidedate = parentDiv.querySelector('.hideall');

  if (getHidedate) {
    const currentDisplay = getComputedStyle(getHidedate).display;

    // Toggle the display based on the current state
    if (currentDisplay === "none") {
      getHidedate.style.display = "block";
    } else {
      getHidedate.style.display = "none";
    }
  }
}

// Set current year
document.getElementById('currentYear').textContent = new Date().getFullYear();
</script>