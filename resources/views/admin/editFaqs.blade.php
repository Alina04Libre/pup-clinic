@extends('partials.header')
@section('question', 'Frequently ask question')

@section('editFaqs')
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-4">Edit Faq's</h1>

                    <div class="container mt-4 mb-4">
                        <div class="row justify-content-md-center">
                            <div class="container shadow border rounded-4" style="padding: 20px;">
                                <div>
                                    <form method="POST" action="{{ route('update.faqs', ['id' => $faq->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="question" class="fw-semibold">Question <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="question" name="question"
                                                        class="form-control" value="{{ $faq->question }}" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="answer" class="fw-semibold">Answer <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="answer" name="answer" class="form-control"
                                                        value="{{ $faq->answer }}" required>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-block mb-5 mt-4">
                            <button type="submit" class="btn btn-success">Update</button>
                            <button type="cancel" id="cancelFaq" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('tinymce/tinymce.js') }}" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#mytextarea',
            object_resizing: false,
            branding: false,
            height: 630,
            width: 'auto',
            plugins: 'autoresize lists link image media autosave emoticons',
            autoresize_overflow_padding: 50,
            image_class_list: [{
                question: 'img-responsive',
                value: 'img-responsive'
            }],
            toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor emoticons | link image media | removeformat',
            automatic_uploads: true,
            images_upload_url: '/uploadImage',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), {
                            question: file.name
                        });
                    };
                };
                input.click();
            }
        });
        //For Close button
        document.getElementById("cancelFaq").addEventListener("click", function() {
            window.location.href = "{{ url('/view-faq') }}";
        });

        function openFilePicker(callback) {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';

            fileInput.onchange = function() {
                const file = fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imageData = e.target.result;
                        const imageAlt = file.name;
                        // Make an AJAX request to the 'uploadImage' route to upload the image

                        // Add the CSRF token to your AJAX request headers
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        // Make the AJAX request to upload the image
                        $.ajax({
                            url: '/uploadImage', // Replace with the correct route URL
                            method: 'POST',
                            data: {
                                image: imageData
                            },
                            success: function(response) {
                                const imageUrl = response.imageUrl;

                                // Call the callback function with the uploaded image URL
                                callback(imageUrl, {
                                    alt: imageAlt
                                });
                            },
                            error: function(error) {
                                // Handle any errors here
                                console.error(error);
                            }
                        });

                    };
                    reader.readAsDataURL(file);
                }
            };

            fileInput.click();
        }
    </script>
@endsection
