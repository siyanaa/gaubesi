<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- for advantage  -->
<script>
  $(document).ready(function () {
    // Initialize Owl Carousel
    $(".custom-carousel").owlCarousel({
      autoWidth: true,
      loop: true,
      margin: 3, // Adjust margin if needed
    });

    // Toggle active class on click
    $(".custom-carousel .item").click(function () {
      $(".custom-carousel .item").not($(this)).removeClass("active");
      $(this).toggleClass("active");
    });
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.accordion-button').forEach(button => {
      button.addEventListener('click', function () {
        const targetId = this.getAttribute('data-bs-target');
        const targetElement = document.querySelector(targetId);

        // Toggle 'show' class to manage visibility
        if (targetElement.classList.contains('show')) {
          targetElement.classList.remove('show');
        } else {
          // Remove 'show' class from all other elements
          document.querySelectorAll('.accordion-collapse').forEach(collapse => {
            collapse.classList.remove('show');
          });
          targetElement.classList.add('show');
        }
      });
    });
  });
</script>







<script>
  const swiper = new Swiper('.swiper', {
    direction: 'horizontal',
    loop: true,
    spaceBetween: 0, // Set space between slides to 0

    // Autoplay configuration
    autoplay: {
      delay: 3000, // Delay in ms between slides
      disableOnInteraction: false, // Autoplay will not stop after interaction
    },

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // Responsive breakpoints
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 2
      },
      1024: {
        slidesPerView: 3
      },
      1200: {
        slidesPerView: 4 // Add this line if you want 4 slides for larger screens
      }
    }
  });
</script>
