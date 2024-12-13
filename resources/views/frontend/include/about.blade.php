{{-- <!-- about --> --}}
<section class="container-fluid about gapbetweensection indexaboutsection" style="background-image: url('{{ asset('image/indexabo.jpg') }}');">
  <div class="container d-flex flex-column justify-content-center align-items-center">
    <div class="row py-4">
      @foreach ($aboutuss as $aboutus)
     
      <div class="col-md-6 d-flex">
  <div class="image col-md-6 first">
    @php
      $images = json_decode($aboutus->image, true);
    @endphp

    @if (!empty($images) && isset($images[0]))
      <img src="{{ asset('storage/aboutus/' . basename($images[0])) }}" alt="aboutus">
    @else
      <p>No image available</p>
    @endif
  </div>

  <div class="image col-md-6 my-2 mx-1 second">
    @php
      $images = json_decode($aboutus->image, true);
    @endphp

    @if (!empty($images) && isset($images[1]))
      <img src="{{ asset('storage/aboutus/' . basename($images[1])) }}" alt="aboutus">
    @else
      <p>No image available</p>
    @endif
  </div>
</div>

    @endforeach
      <div class="col-md-5 mx-md-4">
        <div class="title">
          <div class="xs-text dashline">Trusted Real estate Care</div>
          <div class="lg-text1">Dream living Spaces Setting New Build</div>
        </div>
        @foreach ($aboutuss as $aboutus)
      <p class="sm-text1">{{$aboutus->description}}</p>
      <div class="d-flex">
        <i class="fa-solid fa-hand-point-right customicons mx-2"></i>
        <p class="sm-text1">{{$aboutus->description}}</p>
      </div>
  
      <div class="d-flex">
        <i class="fa-solid fa-hand-point-right customicons mx-2"></i>
        <p class="sm-text1">{{$aboutus->description}}</p>
      </div>
    @endforeach
      </div>
    </div>
  </div>
</section>