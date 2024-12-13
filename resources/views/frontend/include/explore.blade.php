

<style>
  .explorecat{
  /* background:#F1EFEF; */

}
.swiper-slide .card{
  border: none;
  border-radius: var(--radius20);
}
.swiper-slide .card :hover{
  border: none;

}
.swiper-slide:nth-child(3n + 1) .card {
    background: rgba(124, 158, 119, 0.11); /* 1st, 4th, 7th, etc. */
}

.swiper-slide:nth-child(3n + 2) .card {
    background: rgba(241, 225, 210, 1); /* 2nd, 5th, 8th, etc. */
}

.swiper-slide:nth-child(3n + 3) .card {
    background: #CCD0E8; /* 3rd, 6th, 9th, etc. */
}

/* If you have additional styles, you can continue */
.swiper-slide:nth-child(3n + 4) .card {
    background: #FDE0E9; /* 4th, 7th, 10th, etc. */
}




  @media(max-width:450px){
        .needhide{
            display:none ;
        }
      
    }





</style>



<section class="container-fluid explorecat sectiongap">
  <div class="container">
    <div class="row fcc">
      <img class="lgimage-lg col-md-8 needhide" src="{{ asset('image/expl.png') }}" alt="Categoryimage">

      <div class="swiper col-md-8">
        <div class="d-flex flex-column p-0 m-0 pb-3">
          <span class="extralarger p-0 m-0">explore</span>
          <span class="greenhighlight extralarger p-0 m-0">categories</span>
        </div>

        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          @foreach ($categories as $category)
              <div class="swiper-slide">
                  <div class="card fcc py-2 p-0 mx-4 col-10 mx-md-0">
                      <img class="mdimage" src="{{ asset($category->decodedImage) }}" alt="Category image">
                      <div class="card-body">
                          <p class="sm-text-bd text-center">
                              {{ strlen($category->title) > 10 ? substr($category->title, 0, 20) : $category->title }}
                          </p>
                          <p class="xs-text text-center">
                              {{ $category->products_count }} products available
                          </p>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>
      
      </div>
    </div>
  </div>
</section>