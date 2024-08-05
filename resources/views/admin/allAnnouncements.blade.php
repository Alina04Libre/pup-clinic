@extends('partials.header')
@section('title', 'ANNOUNCEMENTS')

@section('announcements')
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="row mt-4 mb-4 d-flex align-items-center ">
                    <div class="col">
                        <h1>Announcements</h1>
                    </div>
                    @can('make-announcements')
                    <div class="col">
                        <div class="d-flex justify-content-end align-items-center">
                            <button type="button" onclick="window.location.href='/announcements';" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                </svg>
                                Create Announcement
                            </button>
                        </div>
                    </div>
                    @endcan
                </div>

                <div class="row mb-5">
                    <div class="appoint-maintain">
                        <div class="card mb-4">
                            <div class="card-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">
                                    <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49a68.14 68.14 0 0 0-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 74.663 74.663 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199V2.5zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0zm-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233c.18.01.359.022.537.036 2.568.189 5.093.744 7.463 1.993V3.85zm-9 6.215v-4.13a95.09 95.09 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A60.49 60.49 0 0 1 4 10.065zm-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68.019 68.019 0 0 0-1.722-.082z" />
                                </svg>
                                Announcements
                            </div>

                            <div class="card-body table-responsive">
                                @if ($announcements->isEmpty())
                                <div class="row justify-content-center text-center">
                                    <div class="col-12">
                                        <h3>No Announcement has been made.</h3>
                                        @can('make-announcements')
                                        <p>You may create an announcement using the button below.</p>
                                        <button type="button" onclick="window.location.href='/announcements';" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                            </svg>
                                            Create Announcement
                                        </button>
                                        @endcan
                                    </div>
                                </div>

                                @else
                                <div class="datatable-container">
                                    <table id="announcement" class="table table-hover align-middle mb-0 bg-white">
                                        <thead class="table-danger">
                                            <tr>
                                                <th scope="col">Title</th>
                                                <th scope="col">Written By</th>
                                                <th scope="col">Created At</th>
                                                <th scope="col">Action</th>
                                                @can('make-announcements')
                                                    <th scope="col">Show</th>
                                                @endcan
                                            </tr>
                                        </thead>

                                        @foreach ($announcements as $announcement)
                                            @if($announcement->is_active || Gate::allows('make-announcements'))
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold mb-1">{{ $announcement->title }}</td>
                                                    <td class="fw-normal mb-1">{{ $announcement->written_by }}</td>
                                                    <td>{{ date('F j, Y g:i A', strtotime($announcement->created_at)) }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewAnnouncementModal{{ $announcement->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                            </svg>
                                                            View
                                                        </a>

                                                        <!-- Unique modal for each announcement -->
                                                        <div class="modal fade" id="viewAnnouncementModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="viewAnnouncementModalLabel{{ $announcement->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <div class="d-flex flex-column col-sm-6">
                                                                            <h4 class="fw-bold">{{ $announcement->title }}</h4>
                                                                            <p class="card-subtitle mb-2 text-body-secondary">
                                                                                <i>Written By </i>
                                                                                {{ $announcement->written_by }}
                                                                            </p>
                                                                        </div>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="px-3">
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

                                                                                                                                foreach ($dom->getElementsByTagName('img') as $image)
                                                                                                                                {
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
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @can('make-announcements')                                                                               
                                                        <a href="{{ route('edit.announcement', ['id' => $announcement->id]) }}" class="btn btn-warning">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                            </svg>
                                                            Edit
                                                        </a>
                                                    
                                                        <form method="POST" id="deleteForm" action="{{ route('delete.announcement', ['id' => $announcement->id]) }}" class="d-inline" onsubmit="confirmDelete(event);">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                                </svg>
                                                                Delete
                                                            </button>
                                                        </form>
                                               
                                                    </td>
                                                   
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch{{ $announcement->id }}" {{ $announcement->is_active ? 'checked' : '' }} onchange="toggleActiveStatus({{ $announcement->id }})">
                                                            <label class="custom-control-label" for="customSwitch{{ $announcement->id }}"></label>
                                                        </div>
                                                    </td>
                                                    @endcan
                                                </tr>
                                            </tbody>
                                            @endif
                                        @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    new DataTable('#announcement');
</script>


<script>
    function toggleActiveStatus(announcementId) {
        console.log('Toggle Active Status Request:', announcementId);
        $.ajax({
            type: 'POST',
            url: '/update-announcement-status/' + announcementId,
            data: {
                _token: '{{ csrf_token() }}', // Add CSRF token
                // Include any additional data if needed
            },
            success: function(response) {
                console.log(response);

                // Update the UI based on the new status
                var newStatus = response.new_status;
                var switchElement = $('#customSwitch' + announcementId);
                switchElement.prop('checked', newStatus);

                // Handle any additional UI updates or show a message
            },
            error: function(error) {
                console.error(error);
                // Handle error, e.g., show an error message
            }
        });
    }

    function confirmDelete(event) {
        event.preventDefault(); // Prevent the default form submission

        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, submit the form
                document.getElementById('deleteForm').submit();
            } else {
                // If the user cancels, do nothing
            }
        });
    }
</script>
@endsection