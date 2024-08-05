@extends('partials.header')
@section('title', 'Frequently Ask Question')

@section('makeFaqs')
    <style>
        #mytextarea {
            max-width: 100%;
        }

        .img-responsive {
            max-width: 100%;
            height: auto;
        }
    </style>
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Create FAQ's</h1>

                    <div class="container mt-4 mb-4">
                        <div class="row justify-content-md-center">
                            <div class="container shadow border rounded-4" style="padding: 20px;">
                                <div>
                                    {{-- <form method="POST" action="{{ route('faq.store') }}"> --}}
                                    <form action="{{ route('faq.store') }}" method="POST" class="flex flex-col">
                                        @csrf
                                        @method('post')
                                        <div class="row ">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="question" class="fw-semibold">Question <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="" name="question"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row  pt-3">
                                            <div class="form-group">
                                                <label for="body" class="fw-semibold">Answer <span
                                                        class="text-danger">*</span></label>
                                                <textarea id="" name="answer" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-block mb-5 mt-4">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="cancel" id="cancelFaqs" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('tinymce/tinymce.js') }}" referrerpolicy="origin"></script>
    <script>
        //For Close button
        document.getElementById("cancelFaqs").addEventListener("click", function() {
        window.location.href = "{{ route('view.faqs') }}";
    });
    </script>
@endsection
