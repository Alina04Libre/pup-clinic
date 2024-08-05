@extends('partials.header')
@section('title', 'USER DASHBOARD')

@section('user_dashboard')
@csrf
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex flex-column justify-content-end align-items-center">
  <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">
    <!-- Slide 1 -->
    <div class="carousel-item active">
      <div class="carousel-container">
        <h2>PUP-Medical <span>Clinic</span></h2>
        <p>Where Health and Education, Unite for a Better Future</p>
        <a href="{{ route('consent.create') }}" class="btn-get-started">Make Appointment</a>
      </div>
    </div>
  </div>


  <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
    <defs>
      <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
    </defs>
    <g class="wave1">
      <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
    </g>
    <g class="wave2">
      <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
    </g>
    <g class="wave3">
      <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
    </g>
  </svg>

</section>
<!-- End Hero -->

<!-- ======= 3 container ======= -->
<div class="pt-0">
  <!-- First Grid -->
  <div class="page-section pt-5 pb-0">
    <div class="container">
    <div class="row gx-5">
  <div class="col-lg-4 col-md-6">
    <div class="card mb-4" style="border: none; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-calendar-heart" viewBox="0 0 16 16" style="fill: #dc3545;">
              <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM1 14V4h14v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1m7-6.507c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
            </svg>
          </div>
          <div>
            <p class="fs-5 ms-4 mb-0">Schedule your Appointment</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6">
    <div class="card mb-4" style="border: none; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16" style="fill: #dc3545;">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
              <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
            </svg>
          </div>
          <div>
            <p class="fs-5 ms-4 mb-0">For Non Emergency Check-ups</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6">
    <div class="card mb-4" style="border: none; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-chat-right-heart" viewBox="0 0 16 16" style="fill: #dc3545;">
              <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z" />
              <path d="M8 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z" />
            </svg>
          </div>
          <div>
            <p class="fs-5 ms-4 mb-0">Open Consultation Available</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>
  </div>
</div>



<!-- ======= About Section ======= -->
<section id="about" class="about">
  <div class="container">

    <div class="section-title">
      <h2>About</h2>
      <p>PUP-MEDICAL CLINIC</p>
    </div>

    <div class="row content">
      <div class="col-lg-6">
        <p>
          Welcome to the PUP Sta. Mesa Clinic, your trusted healthcare partner within the
          Polytechnic University of the Philippines (PUP) community.
        </p>
        <ul>
          <li><i class="ri-check-double-line"></i> Our clinic is dedicated to providing high-quality medical services to</li>
          <li><i class="ri-check-double-line"></i> faculty members,administrative employees, and students. With a focus</li>
          <li><i class="ri-check-double-line"></i> on comprehensive care and wellness,we offer a range of services aimed</li>
          <li><i class="ri-check-double-line"></i> at ensuring your health and wellbeing.</li>
        </ul>
      </div>
      <div class="col-lg-6 pt-4 pt-lg-0">
        <p>
          Within the nurturing atmosphere of the PUP Sta. Mesa Clinic, we strive to create a seamless healthcare
          experience that combines advanced medical practices with a deep understanding of the unique
          needs of our diverse community.
        </p>
        <a href="{{ url('aboutUs') }}" class="btn-learn-more">Learn More</a>
      </div>
    </div>

  </div>
</section>
<!-- End About Section -->


<!-- ======= Announcement Section ======= -->
<section id="announcement">
  <div class="container">
    <main>
      @if ($announcements->isEmpty())
      <div class="container mt-5 mb-4">
        <div class="row justify-content-md-center">
          <div class="container">
          </div>
        </div>
      </div>
      @else
      <div class="section-title mb-0 pb-0">
        <h2>Announcements</h2>
        <p>PUP-MEDICAL CLINIC</p>
      </div>
      <div class="container-fluid px-4" style="margin-top: 50px; margin-bottom:200px;">
        <div class="container">
          <div class="row mt-4 mb-4 d-flex align-items-center">
            <div class="container">
              <div class="row row-cols-lg-2 row-cols-md-1 g-3 mb-5 d-flex justify-content-center">
                @foreach ($announcements as $announcement)
                @if($announcement->is_active || Gate::allows('make-announcements'))
                <div class="col">
                  <div class="card shadow rounded-4">
                    <div class="card-body">
                      <div class="card-title d-flex justify-space-between mb-0">
                        <div class="d-flex flex-column col">
                          <h4 class="fw-bold">{{ $announcement->title }}</h4>
                          <p class="card-subtitle mb-2 text-body-secondary">
                            <i>Written By </i>
                            {{ $announcement->written_by }}
                          </p>
                        </div>
                      </div>

                      <div class="px-3">
                        <hr class="mt-0 mb-4">
                        @php
                        $text = strip_tags($announcement->body, '<img><iframe><a>
                            <p><strong><span><s><br><em>
                                      <hr><br>
                                      <blockquote>
                                        <h1>
                                          <h2>
                                            <li>
                                              <ul>
                                                <ol>');
                                                  $images = [];

                                                  // Extract image URLs from the announcement
                                                  $dom = new DOMDocument();
                                                  $dom->loadHTML($announcement->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

                                                  foreach ($dom->getElementsByTagName('img') as $image) {
                                                  $images[] = $image->getAttribute('src');
                                                  }
                                                  @endphp

                                                  <div class="announcement-image-container">
                                                    {!! $text !!}
                                                  </div>

                                                  <hr class=" mt-3 mb-0">
                                                  <p class="text-body-secondary"><small>Created at: {{ date('F j, Y g:i A', strtotime($announcement->created_at)) }}</small></p>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </main>
    <div>
</section>
@endsection