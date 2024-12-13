
<section class="container-fluid">
  <div class="container gapbetweensection">
    <div class=" d-flex flex-column justify-content-center align-items-center title pb-2  ">
      <div class="xs-text1 dashline">Trusted Real Estate Care</div>
      <div class="lg-text">Latest Project on Sale</div>
      <p class=" extra-small-text text-center col-md-7">Utilizing her exceptional experience and knowledge of
        the luxury waterfront markets, Simone serves an extensive and elite worldwide client base. </p>
    </div>
    <div class="row py-1 property-body">

    @php
    $properties = \App\Models\Property::latest()->take(5)->get(); 

@endphp
      @if(count($properties) > 0)
        @php
        $firstPropeties = $properties->shift();
      @endphp
        <a class="col-md-6 pb-1" href="{{route('singleproducts', ["id" => $firstPropeties->id])}}">
        <div class="property-container rounded">

          @php
        $mainImages = !empty($firstPropeties->main_image) ? json_decode($firstPropeties->main_image, true) : [];
        $mainImage = !empty($mainImages) ? asset('' . $mainImages[0]) : asset('images/default-placeholder.png');
       @endphp
          <img src="{{ $mainImage }}" alt="Property Image"
          class="imagecontroller imagecontrollerheight imagecontrollermd " data-src="holder.js/200x250?theme=thumb" />
          <div class="property-details">
          <div class="md-text1 p-0 m-0"> {{ $firstPropeties->title}}</div>
          <div class="md-text highlight text-center p-0 m-0"> <i class="fa-solid fa-location-dot mx-2"></i>{{ $firstPropeties->state }}-{{ $firstPropeties->suburb }}-{{ $firstPropeties->street }}</div>
          <div class="d-flex justify-content-between gap-3 p-0 mx-4">
            <p class="detail-item sm-text1">
            <span class="sm-text1">{{ $firstPropeties->bedrooms}}</span><br />
            <i class="fa-solid fa-bed detail-icon"></i>
            </p>
            <p class="detail-item sm-text1">
            <span class="detail-number">{{ $firstPropeties->bathrooms}}</span><br />
            <i class="fa-solid fa-bath detail-icon"></i>
            </p>
            <p class="detail-item sm-text1">
            <span class="sm-text1">{{ $firstPropeties->area}}</span><br />
            <i class="fa-solid fa-chart-area  detail-icon"></i>
            </p>
          </div>
          <p class="extra-small-text1 px-2">{{ $firstPropeties->description}} </p>
          </div>
    @endif
        </div>
      </a>
      <div class="col-md-6 sub-image-content">
        <div class="row ">
          
          @foreach ($properties as $property)
            <div class="col-md-6 mb-1 gap-sm-1">
            <a class="col-md-4 mb-4" href="{{route('singleproducts', ['id' => $property->id])}}">
              <div class="property-container rounded ">
              @php
        $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
        $mainImage = !empty($mainImages) ? asset('' . $mainImages[0]) : asset('images/default-placeholder.png');
         @endphp
              <img src="{{ $mainImage }}" alt="Property Image" class="property-image">
              <div class="property-details">
                <div class="md-text1 p-0 m-0"> {{ strlen($property->title) >27 ? substr($property->title, 0, 27)  : $property->title}}</div>
                <div class="sm-text highlight text-center p-0 m-0"> <i class="fa-solid fa-location-dot mx-2"></i>{{ $property->state }}-{{ $property->suburb }}-{{ $property->street }}</div>
                <div class="d-flex justify-content-between gap-3 p-0 mx-4">
                <p class="detail-item sm-text1">
                  <span class="sm-text1">{{ $property->bedrooms }}</span><br />
                  <i class="fa-solid fa-bed detail-icon"></i>
                </p>
                <p class="detail-item sm-text1">
                  <span class="detail-number">{{ $property->bathrooms}}</span><br />
                  <i class="fa-solid fa-bath detail-icon"></i>
                </p>
                <p class="detail-item sm-text1">
                  <span class="sm-text1">{{ $property->area }}</span><br />
                  <i class="fa-solid fa-chart-area  detail-icon"></i>
                </p>
                </div>
                <p class="extra-small-text1 px-2 text-center">
                {{strlen($property->description) > 150 ? substr($property->description, 0, 150) . "..." : $property->description}}
                </p>
              </div>
              </div>
            </a>
            </div>
      @endforeach
        </div>
      </div>
    </div>

    <!-- <p class="d-flex justify-content-end pt-3 ">
    <a href="{{ route('properties') }}" class="btn-buttonyellow py-1">View More</a>
    </p> -->
  </div>
</section>





















{{--

<section class="container-fluid ">
  <div class="container gapbetweensection">
    <div class=" d-flex flex-column justify-content-center align-items-center title pb-2  ">
      <div class="xs-text1 dashline">Trusted Real Estate Care</div>
      <div class="lg-text">Latest Project on Sale</div>
      <p class=" extra-small-text text-center col-md-7">Utilizing her exceptional experience and knowledge of
        the luxury waterfront markets, Simone serves an extensive and elite worldwide client base. </p>
    </div>
    <div class="row align-items-center justify-content-center">
      @foreach ($properties as $property)
      <a class="col-md-4 mb-4" href="{{route('singleproducts',['id'=>$property->id])}}">
        <div class="property-container rounded ">
          @php
          $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
          $mainImage = !empty($mainImages) ? asset('' . $mainImages[0]) : asset('images/default-placeholder.png');
          @endphp

          <img src="{{ $mainImage }}" alt="Property Image" class="property-image">
          <div class="property-details">
            <div class="md-text1 p-0 m-0">{{ $property->title }}</div>
            <div class="sm-text highlight text-center p-0 m-0">{{ $property->title }}</div>
            <div class="d-flex justify-content-between gap-3 p-0 mx-4">
              <p class="detail-item sm-text1">
                <span class="sm-text1">{{ $property->bedrooms }}</span><br />
                <i class="fa-solid fa-bed detail-icon"></i>
              </p>
              <p class="detail-item sm-text1">
                <span class="detail-number">{{ $property->bathrooms}}</span><br />
                <i class="fa-solid fa-bath detail-icon"></i>
              </p>
              <p class="detail-item sm-text1">
                <span class="sm-text1">{{ $property->area }}</span><br />
                <i class="fa-solid fa-bed detail-icon"></i>
              </p>
            </div>
            <p class="extra-small-text1 px-2 text-center">
              {{strlen($property->description) > 150 ? substr($property->description, 0, 150) . "..." :
              $property->description}}
            </p>
          </div>
        </div>
      </a>
      @endforeach
    </div>
    <p class="d-flex justify-content-end ">
      <a href="{{ route('properties') }}" class="btn-buttonyellow py-1">View More</a>
    </p>

  </div>
</section>



--}}































{{--

<section class="container-fluid">
  <div class="container gapbetweensection">
    <div class="d-flex justify-content-between">
      <div class="title">
        <div class="xs-text1 dashline">Trusted Real Estate Care</div>
        <div class="lg-text">Latest Project on Sale</div>
      </div>
      <a href="" class="btn-buttonyellow py-1">View More</a>
    </div>

    <div class="row py-1 property-body">
      @foreach ($properties as $property)
      <div class="col-md-6 pb-1">
        <div class="property-container">
          @php

          $mainImages = !empty($property->main_image) ? json_decode($property->main_image, true) : [];
          $mainImage = !empty($mainImages) ? asset('' . $mainImages[0]) : asset('images/default-placeholder.png');
          @endphp

          <img src="{{ $mainImage }}" alt="Property Image"
            class="imagecontroller imagecontrollerheight imagecontrollermd">

          <div class="property-details">
            <div class="md-text1 p-0 m-0">{{ $property->title }}</div>
            <div class="md-text highlight text-center p-0 m-0">{{ $property->street }}, {{ $property->suburb }}</div>
            <div class="d-flex justify-content-between gap-3 p-0 mx-4">
              <p class="detail-item sm-text1">
                <span class="sm-text1">{{ $property->bedrooms }}</span><br />
                <i class="fa-solid fa-bed detail-icon"></i>
              </p>
              <p class="detail-item sm-text1">
                <span class="detail-number">{{ $property->bathrooms }}</span><br />
                <i class="fa-solid fa-bath detail-icon"></i>
              </p>
              <p class="detail-item sm-text1">
                <span class="sm-text1">{{ $property->area }} sq ft</span><br />
                <i class="fa-solid fa-ruler-combined detail-icon"></i>
              </p>
            </div>
            <p class="extra-small-text1 px-2">{{ Str::limit($property->description, 150, '...') }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Sub button section -->
<section class="container">
  <div class="property-container d-flex justify-content-center align-self-center gap-3 flex-wrap">
    <div class="btn-buttongreen">
      <i class="fa-solid fa-house customicons customiconssmall"></i> Sale
    </div>
    <div class="btn-buttongreen">
      <i class="fa-solid fa-house customicons customiconssmall"></i> Condos
    </div>
    <div class="btn-buttongreen">
      <i class="fa-solid fa-house customicons customiconssmall"></i> Sale
    </div>
    <div class="btn-buttongreen">
      <i class="fa-solid fa-house customicons customiconssmall"></i> Condos
    </div>
    <div class="btn-buttongreen">
      <i class="fa-solid fa-house customicons customiconssmall"></i> Sale
    </div>
  </div>
</section>

--}}