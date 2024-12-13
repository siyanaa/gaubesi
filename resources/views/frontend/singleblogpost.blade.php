@extends('frontend.layouts.master')
@section("content")
<style>
  .feature-smallimg {
    width: 140px;
    height: 84px;
    object-fit: cover;
    border-radius: var(--radius8);
  }
  .blogs-image {
    width: 90%;
    height: 60vh;
    object-fit: cover;
    border-radius: 5px;
  }
  .paddingbox {
    border: 1px solid var(--border-color);
    border-radius: var(--radius8);
    padding: 1rem;
  }
</style>
<section class="singlepage pt-4">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="row d-flex flex-col">
          <div class="col-md-12 mb-3">
            @php
        $images = json_decode($blogs->image, true);
      @endphp
            @if (!empty($images))
        @foreach ($images as $image)
      <img class="blogs-image" src="{{ asset('storage/blog_images/' . basename($image)) }}" alt="Blog image">
    @endforeach
      @else
    <p>No images available</p>
  @endif
            <div class="d-flex gap-3 py-3">
              <div class="d-flex">
                <i class="fa-solid fa-calendar-days customiconssmall pt-1 mx-1"></i>
                <h2 class="sm-text text-center">{{ $blogs->created_at->format('F j, Y') }}</h2>
              </div>
            </div>
            <h5 class="md-text">{{ $blogs->title }}</h5>
            <p class="sm-text py-1">{{ $blogs->description }}</p>
          </div>
        </div>
      </div>
      <!-- Sidebar -->
      <div class="col-md-3 sidebarheight gap-1">
        <div class="paddingbox">
          <h2 class="md-text my-2">Recent Posts</h2>
          <ul class="c">
            @foreach ($relatedPosts as $related)
        <li class="py-1">
          <a href="{{ route('singleblogpost', ['id' => $related->id]) }}" class="sm-text">
          <!-- <i class="fa-solid fa-hand-point-right"></i> -->
          <span class="sm-text-bd">{{ $related->title }}</span>
          </a>
        </li>
      @endforeach
          </ul>
        </div>
        <div class="paddingbox my-2">
          <h2 class="md-text my-2">Feature List</h2>
          <div class="featurelist-body">
            @foreach ($products as $product)
              <a class="featurelist-content d-flex py-1" href="{{ route('singleproducts', ['id' => $product->id]) }}">
                @php
            $mainImages = !empty($product->main_image) ? json_decode($product->main_image, true) : [];
            $mainImage = !empty($mainImages) ? asset($mainImages[0]) : asset('images/default-placeholder.png');
        @endphp
                <img src="{{ $mainImage }}" alt="Product Image" class="feature-smallimg" />
                <div class="featurlist-description mx-3">
                <h3 class="sm-text">{{ $product->title }}</h3>
                <p class="sm-text-bd yellowhighlight mt-1">{{ $product->selling_price }}</p>
                </div>
              </a>
      @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection