@extends('partials.header')
@section('title', 'OPEN CONSULTATION')
@section('walk_in')

<!-- ======= Hero Section ======= -->
<section id="banner-hero" class="d-flex flex-column justify-content-end align-items-center">
    <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">
        <div class="carousel-item active">
            <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">ONLINE CONSULTATION</h2>
                <p class="animate__animated fanimate__adeInUp">Open from 3:00 PM to 5:00 PM</p>
            </div>
        </div>
    </div>
</section>

<main>
    <!-- Display if the current time is between 3:00 PM and 5:00 PM -->
    @if(now()->isBetween('00:00:00', '17:00:00'))

        @php
            $link = json_decode($zoomLink->list, true);
        @endphp
        @foreach ($link as $key => $value)
            <div class="container px-4 mb-4 mt-5">
                <div class="row justify-content-center text-center alert alert-info ">
                    <div class="col-12 px-0">
                        <h5>Click the link below to join the Zoom link for open consultation</h5>
                        <a href="{{ $value }}" target="_blank" style="color: #007bff; text-decoration: none;">{{ $value }}</a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="container-fluid px-4" style="margin-bottom:200px;">
            <div class="container-fluid px-4">
                <div class="container">
                    <div class="card mb-4">
                        <div class="card-header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                            </svg>
                            Schedule Staff for Today
                        </div>
                        <div class="card-body table-responsive">
                            @if ($staffSchedules->isEmpty())
                            <div class="row justify-content-center text-center">
                                <div class="col-12">
                                    <h4>No staff schedules available for today.</h4>
                                </div>
                            </div>
                            @else
                            <div class="datatable-container">
                                <table id="availableStaff" class="table table-hover" style="width:100%">
                                    <thead class="table-danger">
                                        <tr>
                                            <th scope="col">DOCTOR</th>
                                            <th scope="col">AVAILABLE TIME</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($staffSchedules as $schedule)
                                        <?php
                                        $doctor = $schedule->doctor;

                                        // Fetch "For Checkup" appointments for the specific doctor
                                        $appointments = \App\Models\Appointment::where('doctor_id', $doctor->id)
                                            ->where('status', 'For Checkup')
                                            ->where('appointment_date', '>=', now()->toDateString()) // Consider only future appointments
                                            ->orderBy('appointment_time')
                                            ->get();

                                        $start = \Carbon\Carbon::parse($schedule->start_time);
                                        $end = \Carbon\Carbon::parse($schedule->end_time);

                                        $allTimeSlots = [];
                                        $currentSlot = $start->copy();

                                        // Generate all 30-minute slots
                                        while ($currentSlot <= $end) {
                                            $allTimeSlots[] = $currentSlot->copy();
                                            $currentSlot->addMinutes(30);
                                        }

                                        // Remove slots with "For Checkup" appointments
                                        foreach ($appointments as $appointment) {
                                            $appointmentStart = $appointment->appointment_time;
                                            $appointmentEnd = $appointmentStart->copy()->addMinutes(30);

                                            $allTimeSlots = array_filter($allTimeSlots, function ($slot) use ($appointmentStart, $appointmentEnd) {
                                                return !($slot >= $appointmentStart && $slot < $appointmentEnd);
                                            });
                                        }

                                        $availableTimeSlots = array_map(function ($slot) {
                                            return $slot->format('h:i A');
                                        }, $allTimeSlots);
                                        ?>
                                        <tr>
                                            <td class="fw-normal mb-1">
                                                {{ $doctor ? $doctor->name . ' ' . $doctor->last_name . '' : 'Not Available' }}
                                            </td>
                                            <td class="fw-normal mb-1">
                                                @if (empty($availableTimeSlots))
                                                    Not Available
                                                @else
                                                    @foreach ($availableTimeSlots as $timeSlot)
                                                        {{ $timeSlot }}
                                                    <br>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <!-- Display a message if the current time is outside the specified range -->
        <div class="container mt-5 mb-4" style="margin-top: 50px; margin-bottom:200px;">
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
                                            <h4 class="mt-3">The Zoom link for open consultation is only available from 3:00 PM to 5:00 PM.</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</main>

@endsection
