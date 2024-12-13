<section class="container-fluid indextestimonial">
  <div class="container  d-flex flex-column justify-content-center align-items-center">
    <div class="title">
      <div class="xs-text1 dashline">Trusted Real estate Care</div>
      <div class="lg-text">Testimonials we give</div>
    </div>
    <div class="content-body d-md-flex justify-content-center align-items-center pt-3">
    <button class="next-button mx-3 mt-2 largescr" id="forward" onclick="forward()"><i class="fa-solid fa-arrow-right "></i></button>    
    <div class="col-md-7">
        @foreach ($testimonials as $testimonial)
          <div class="card flex-md-row box-shadow  py-4 testimonialcard" id="grabcard">
            <div class="row px-4 rounded">
            <div class="img-container col-md-5">
              <img data-src="holder.js/200x250?theme=thumb" alt="" src="{{ asset('images/blogs/two.jpg')}}" />
            </div>
            <div class="card-body d-flex flex-column col-md-6">
              <strong class="mb-2 text-success">
              <img src="{{asset('image/dash.png')}}" alt="">

              </strong>
              <h3 class="mb-0 md-text">
              {{$testimonial->title}}
              </h3>
              <p class="sm-text mb-auto ">
              {{ strlen(strip_tags($testimonial->review)) > 200
        ? substr(strip_tags($testimonial->review), 0, 300) . "..."
        : strip_tags($testimonial->review) 
            }}
              </p>
              <div class="d-flex  pt-2">
              @php
        $images = json_decode($testimonial->image, true); // Decode the JSON array into a PHP array
        @endphp
              @if (!empty($images))
          @foreach ($images as $image)
        <img class="" data-src="holder.js/200x250?theme=thumb"
        src="{{ asset('storage/testimonials/' . basename($image)) }}" alt="Blog image"
        style="height:14vh; width:130px ;border-radius:8px;">
      @endforeach
        @else
        <p>No images available</p>
      @endif
              <div class="mx-4">
                <div class="md-text media-md-text ">{{$testimonial->title}}</div>
                <div class="sm-text">{{$testimonial->title}}</div>
              </div>
              </div>
            </div>
            </div>
          </div>
    @endforeach
      </div>

      <div class="d-flex mt-2 mx-2">
      <button class="next-button mx-2 smallscr" id="forward" onclick="forward()"><i class="fa-solid fa-arrow-right "></i></button>    
        <button class="next-button mx-2" id="backward" onclick="backward()"><i class="fa-solid fa-arrow-left "></i></button>
    </div>
    </div>
  </div>
</section>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    const cards = Array.from(document.querySelectorAll("#grabcard")); // Select all testimonial cards
    const forwardButton = document.getElementById("forward");
    const backwardButton = document.getElementById("backward");
    let currentIndex = 0;

    function updateDisplay() {
      cards.forEach((card, index) => {
        card.style.display = (index === currentIndex) ? 'block' : 'none';
      });
    }

    function forward() {
      if (currentIndex < cards.length - 1) {
        currentIndex++;
        updateDisplay();
      }
    }

    function backward() {
      if (currentIndex > 0) {
        currentIndex--;
        updateDisplay();
      }
    }

    forwardButton.addEventListener("click", forward);
    backwardButton.addEventListener("click", backward);

    // Initial display setup
    updateDisplay();
  });

</script>