@extends("frontend.layouts.master")
@section("content")
<!-- same for contact and blog page but used the style of contact -->
<style>
  .blog_contact_section {
    position: relative;
  }
  .extra-lg-lg {
    font-size: 92px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 2px;
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
  .officeinfo{
    background: var(--off-green);
    color: var(--pure-white);
    height:18vh;
    align-items: center;
    text-align: center;
  }
  .greenbackground {
    background: var(--off-green);
    color: var(--pure-white);
  }
  .iconslarge {
    font-size: 24px;
  }
  .map-image {
    height: 80vh;
    width: 100%;
    object-fit: cover;
  }
  .contactbutton {
    background: #000;
    color: white;
    padding: 0.6rem;
  }
  @media (max-width: 700px) {
    .extra-lg-lg {
      font-size: 50px;
    }
    .blog_contact_heroimage {
      bottom:0.8rem;
    }
    .map-image {
      height:40vh;
    }
    .blog_contact_heroimage_container::before {
      top:-0.8rem;
    }
  }
</style>
<section class="container-fluid pt-2">
  <div class="container">
    <div class="row blog_contact_section">
      <h1 class="extra-lg-lg text-center pb-0 mb-0">Contact</h1>
      <div class="blog_contact_heroimage_container">
        <img src="{{asset('image/house1.png')}}" alt="" class="blog_contact_heroimage p-0 m-0">
      </div>
    </div>
  </div>
</section>
<!-- detailsection -->
<section class="container-fluid contact my-3">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center gap-2">
      @foreach ($siteSettings as $siteSetting)
        <div class="col-md-3 officeinfo d-flex flex-column align-items-center rounded py-3">
          <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-location-dot iconslarge"></i>
            <h2 class="md-text whitehighlight py-2">Office Address</h2>
          </div>
          <p class="sm-text whitehighlight">
            @if(is_array($addresses = json_decode($siteSetting->office_address, true)) && !empty($addresses))
              {{ implode(', ', $addresses) }}
            @else
              {{ $siteSetting->office_address ?? 'No address available' }}
            @endif
          </p>
        </div>
        <div class="col-md-3 officeinfo d-flex flex-column align-items-center rounded py-3">
          <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-envelope iconslarge"></i>
            <h2 class="md-text whitehighlight py-2">Office Email</h2>
          </div>
          <p class="sm-text whitehighlight">
            @if(is_array($emails = json_decode($siteSetting->office_email, true)) && !empty($emails))
              {{ implode(', ', $emails) }}
            @else
              {{ $siteSetting->office_email ?? 'No email available' }}
            @endif
          </p>
        </div>
        <div class="col-md-3 officeinfo d-flex flex-column align-items-center rounded py-3">
          <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-phone iconslarge"></i>
            <h2 class="md-text whitehighlight py-2">Office Contact</h2>
          </div>
          <p class="sm-text whitehighlight">
            @if(is_array($contacts = json_decode($siteSetting->office_contact, true)) && !empty($contacts))
              {{ implode(', ', $contacts) }}
            @else
              {{ $siteSetting->office_contact ?? 'No contact available' }}
            @endif
          </p>
        </div>
      @endforeach
    </div>
  </div>
</section>
<section class="container-fluid py-4">
  <div class="row d-flex justify-content-center align-items-center mx-2">
      <div class="col-md-4 greenbackground px-4 m-2 order-md-1 order-2 rounded py-3">
          <div class="d-flex flex-column gap-2">
              <form action="{{ route('contact.store') }}" method="POST" class="d-flex flex-column gap-2">
                  @csrf
                  <div class="d-flex flex-column">
                      <label for="name" class="xs-text pb-1">User Name</label>
                      <input type="text" name="name" id="name" class="input @error('name') is-invalid @enderror"
                             placeholder="Enter your name"
                             value="{{ Auth::check() ? Auth::user()->name : old('name') }}"
                             {{ Auth::check() ? 'readonly' : 'required' }} />
                      @error('name')
                          <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="d-flex flex-column">
                      <label for="email" class="xs-text pb-1">Email Address</label>
                      <input type="email" name="email" id="email" class="input @error('email') is-invalid @enderror"
                             placeholder="Enter your email"
                             value="{{ Auth::check() ? Auth::user()->email : old('email') }}"
                             {{ Auth::check() ? 'readonly' : 'required' }} />
                      @error('email')
                          <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="d-flex flex-column">
                      <label for="message" class="xs-text pb-1">Message</label>
                      <textarea name="message" id="message" class="textarea @error('message') is-invalid @enderror"
                                placeholder="Enter your message" required>{{ old('message') }}</textarea>
                      @error('message')
                          <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                  </div>
                  <button type="submit" class="mt-1 contactbutton rounded">Submit</button>
              </form>
          </div>
      </div>
      <div class="col-md-6 order-md-2 order-1">
          <img src="{{ asset('image/map.png') }}" alt="" class="map-image">
      </div>
  </div>
</section>
@endsection