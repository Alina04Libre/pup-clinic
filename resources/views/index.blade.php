@extends('partials.header')
@section('title', 'FAQs')

@section('faqs')
    <!-- ======= Hero Section ======= -->
    <section id="banner-hero" class="d-flex flex-column justify-content-end align-items-center">
        <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">
            <div class="carousel-item active">
                <div class="carousel-container">
                    <h2 class="animate__animated animate__fadeInDown">FAQ's</h2>
                    <p class="animate__animated animate__fadeInUp">PUP MEDICAL CLINIC</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero -->


    <div class="page-section">
        <!-- First Grid -->
        <div class="page-section bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1>FAQ's about Clinical Trials</h1>
                        <h5 class="w3-padding-32">This section outlines common inquiries typically posed by individuals
                            considering participation of potential clinical participants.</h5>

                        {{-- //need to add clear seaech --}}
                        <form action="{{ route('index', request()->query()) }}" class="search-box">
                            <input class="search-input" name="q" type="text" value="{{ $search_param }}"
                                placeholder="Search something..">
                            <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                        </form>


                        <!-- Accordion -->
                        <style>
                            /* Custom CSS for accordion button when expanded */
                            .accordion-button:not(.collapsed) {
                                background-color: #800000;
                                /* Red background color */
                                color: #fff;
                                /* White text color */
                                border-color: #800000;
                                /* Ensure border matches the background */
                                box-shadow: 0 4px 8px rgba(255, 210, 0, 1);
                                /* Add shadow */
                            }

                            .page-section {
                                padding-top: 10px;
                                /* Adjust the value as per your design needs */
                            }


                            /* Optional: To change the background color when hovered */
                            .accordion-button:not(.collapsed):hover {
                                background-color: #800000;
                                /* Darker red on hover */
                                color: #fff;
                            }


                            /* Search Bar */

                            /* You just need to get this field - start */

                            .search-box {
                                width: auto;
                                position: relative;
                                display: flex;
                                bottom: 0;
                                left: 0;
                                right: 0;
                                margin: auto;
                            }

                            .search-input {
                                width: 100%;
                                font-family: 'Montserrat', sans-serif;
                                font-size: 16px;
                                padding: 15px 45px 15px 15px;
                                background-color: #bdc3c7; 
                                color: #6c6c6c;
                                border-radius: 6px;
                                border: none;
                                transition: all .4s;
                            }

                            .search-input:focus {
                                border: none;
                                outline: none;
                                box-shadow: 0 1px 12px #800000;
                                -moz-box-shadow: 0 1px 12px #800000;
                                -webkit-box-shadow: 0 1px 12px #800000;
                            }

                            .search-btn {
                                background-color: transparent;
                                font-size: 18px;
                                padding: 6px 9px;
                                margin-left: -45px;
                                border: none;
                                color: #6c6c6c;
                                transition: all .4s;
                                z-index: 10;
                            }

                            .search-btn:hover {
                                transform: scale(1.2);
                                cursor: pointer;
                                color: black;
                            }

                            .search-btn:focus {
                                outline: none;
                                color: black;
                            }
                        </style>

                        <div class="accordion py-3" id="faqAccordion">
                            <!-- FAQ Items -->
                            <div class="accordion-item" data-clicks="0">

                                @foreach ($faqs as $index => $faq)
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                                            aria-controls="collapse{{ $index }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <!-- End Accordion -->
                    </div>
                    <div class="col-lg-6 text-center " >
                        <div class="img-place custom-img-1 ">
                            <img src="assets/img/missionn.png" loading="lazy" alt="" width="80%" height="100%" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
                    // Expand accordion on click
                    $('.accordion-button').on('click', function() {
                                let $parent = $(this).closest('.accordion-item');
                                let clicks = parseInt($parent.attr('data-clicks')) + 1;
                                $parent.attr('data-clicks', clicks);

                                // Reorder accordion items based on number of clicks
                                let $accordion = $('#faqAccordion');
