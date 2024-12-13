@extends('frontend.layouts.master')
@section("content")



<!-- same for contact and blog page but used the style of contact -->
<style>
  .blog_contact_section {
    position: relative;
  }

  .extra-lg-lg {
    font-size: 92px;
    font-weight:900;
    text-transform: uppercase;
    letter-spacing: 2px;
    stroke: 1px;
    color: var(--pure-black);
    text-shadow: 2px 3px var(--off-green);

  }


  .blog_contact_heroimage_container {
    position: relative; 
    width: 99%;
    height: 70vh; 
}

.blog_contact_heroimage {
    width:100%;
    height: 100%; 
    object-fit: cover;
    position: relative;
    bottom: 1.2rem;
}

.blog_contact_heroimage_container::before {
  position: absolute;
  width: 98.5%;
  height: 70vh; 
    content: " ";
    display: block;
    top:-1.2rem;
    left:0.7rem;
    right: 0;
    bottom:0rem;
    background-color:rgba(150, 150, 150, 0.2);
    z-index: 100;
    height: 100%; 
}



  @media (max-width: 700px) {
    .extra-lg-lg {
      font-size: 50px;

    }
    .blog_contact_heroimage {;
    bottom:0.8rem;

  }
  .blog_contact_heroimage_container::before {
    top:-0.8rem;
  
}


  }
</style>

<section class="container-fluid pt-2">
  <div class="container">
    <div class="row blog_contact_section">
      <h1 class="extra-lg-lg text-center pb-0 mb-0">Blogs</h1>
      <div class="blog_contact_heroimage_container">
    <img src="{{asset('image/house1.png')}}" alt="" class="blog_contact_heroimage p-0 m-0">
</div>

    </div>
</section>

<!-- Blog Section -->
<!-- Blog Section in Blog Listing Page -->
<section class="container-fluid py-4 pb-5">
  <div class="container">
    <div class="row gap-2 fcc flex-wrap">
      @foreach($blogs as $blog)
        @php
          $imagePath = json_decode($blog->image, true);
        @endphp
        <div class="col-md-4 row col-md-4">
          <!-- Link to Single Blog Page -->
          <a href="{{ route('singleblogpost', ['id' => $blog->id]) }}">
            <img src="{{ asset($imagePath[0]) }}" alt="{{ $blog->title }}" class="lgimage lgimageheightcontroller p-0 m-0 rounded">
            <h1 class="md-text py-2">{{ $blog->title }}</h1>
          </a>
          <p class="xs-text">{{ Str::limit($blog->description, 150, '...') }}</p>
        </div>
      @endforeach
    </div>
    {{-- <a href="{{ route('blog') }}" class="btn btn-buttonoutline mt-4">View More</a> --}}
  </div>
</section>


<!-- Pagination Section -->
<section class="container-fluid">
  <div class="container">
    <div class="row nextpage">
      {{ $blogs->links('pagination::bootstrap-4') }}
    </div>
  </div>
</section>

@endsection


<script>
  function changepage(element) {
    const pageli = document.getElementsByClassName("nextli");
    for (let i = 0; i < pageli.length; i++) {
      pageli[i].classList.remove("activeli");
    }
    element.classList.add("activeli");
  }
</script>
