@extends('partials.header')
@section('title', 'ANNOUNCEMENTS')

@section('view_announcements')
<!-- ======= Hero Section ======= -->
<section id="banner-hero" class="d-flex flex-column justify-content-end align-items-center">
    <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">
        <div class="carousel-item active">
            <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">ANNOUNCEMENTS</h2>
            </div>
        </div>
    </div>
</section>
<!-- End Hero -->

<main>
    <div class="container-fluid px-4" style="margin-top: 50px; margin-bottom:200px;">
        <div class="container">
            <div class="row mt-4 mb-4 d-flex align-items-center">
                @if ($announcements->isEmpty())
                <div class="container mt-5 mb-4">
                    <div class="row justify-content-md-center">
                        <div class="container">
                            <div class="card shadow rounded-4 bg-info-subtle">
                                <div class="card-body">
                                    <div class="card-title d-flex justify-content-center mt-4 mb-4">
                                        <div>
                                            <div class="row justify-content-center text-center">
                                                <div class="col-12">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                    </svg>
                                                    <h3 class="mt-3">No Announcement has been made.</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
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
@endsection