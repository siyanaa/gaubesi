<style>
  .herosection{
    background:rgba(124, 158, 119, 0.15);


  }
  .carousel-item {
  transition: transform 2.8s ease, opacity 0.5s ease; /* Adjust the timing as needed */
}


  .carousel-control-prev,
.carousel-control-next {
    background: var(--green);
    height:5vh;
    width:5vh;
    padding: 0.2rem;
    border-radius: var(--radius100);
    position: absolute;
    top: 6.5rem;
   
}
  .lg-text span {
    transform: translateY(20px);
    transition: transform 0.7s ease;
  }


  .lg-text span {
    opacity: 0;
  }


  .lg-text span.visible {
    transform: translateY(0);
    opacity: 1;
  }
  @media (max-width:600px) {
 .carousel-control-prev{
  top:12rem;
 }
 .carousel-control-next{
  top:12rem;


 }


 .carousel-inner{
  height: 28vh;


 }








}
@media (max-width:340px) {


 .carousel-inner{
  height: 30vh;


 }


}


</style>


<section class="container-fluid p-0 m-0 herosection">
  <div class="container py-5">
    <div class="row px-2 d-flex justify-content-center align-items-center">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="false">
        <div class="carousel-inner mb-2">
          @foreach($categories as $index => $product)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
              <div class="d-flex justify-content-center align-items-center gap-4">
                <div class="d-flex flex-column col-md-6"> <!-- Center text -->
                  <p class="xs-text p-0 m-0">{{ $product->title }}</p>
                  <p class="lg-texts extralg-texts pb-2" id="description-{{ $index }}">{{ $product->description }}</p>
                  <button class="btn-buttonoutline mt-2">Shop Now</button>
                </div>
                <!-- Use decoded image path here -->
                <img class="lgimage-lg col-md-8 needhide" src="{{ asset($product->decodedImage) }}" alt="Category Image">
              </div>
            </div>
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </a>
      </div>
    </div>
  </div>
</section>



<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script>
  function animateDescription(element) {
    const text = element.textContent.trim();
    element.innerHTML = ""; // Clear current content


    // Create a span for each letter and append it to the paragraph
    Array.from(text).forEach((letter, index) => {
      const span = document.createElement('span');
      span.textContent = letter === " " ? "\u00A0" : letter; // Handle spaces
      span.style.opacity = 0; // Start with hidden letters
      span.style.display = 'inline-block'; // Make it inline-block for positioning
      span.style.transition = `opacity 0.5s ease ${index * 0.1}s`; // Delay each letter's appearance
      element.appendChild(span);


      // Use setTimeout to trigger the transition after the DOM updates
      setTimeout(() => {
        span.style.opacity = 1; // Change opacity to 1 to fade in
      }, 10);
    });


    // Reset the animation after 10 seconds
    setTimeout(() => {
      Array.from(element.children).forEach((span, index) => {
        setTimeout(() => {
          span.style.opacity = 0;
        }, index * 50);
      });


   
      setTimeout(() => {
        animateDescription(element);
      }, text.length * 50 + 2000);
    },20000);
  }


  document.addEventListener("DOMContentLoaded", function() {
    const descriptions = document.querySelectorAll('[id^="description-"]');
    descriptions.forEach((element) => {
      animateDescription(element);
    });
  });
</script>



