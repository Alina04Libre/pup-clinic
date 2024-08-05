@extends('partials.header')
@section('title', 'ABOUT US')

@section('about')
 <!-- ======= Hero Section ======= -->
    <section id="banner-hero" class="d-flex flex-column justify-content-end align-items-center">
        <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">
            <div class="carousel-item active">
                <div class="carousel-container">
                    <h2 class="animate__animated animate__fadeInDown">ABOUT US</h2>
                    <p class="animate__animated fanimate__adeInUp">PUP MEDICAL CLINIC</p>
                    </div>
            </div>
        </div>
    </section>
    <!-- End Hero -->

    <div>
        <div class="page-section pt-0">
            <!-- First Grid -->
            <div class="page-section bg-light">
                <div class="container ">
                    <div class="row align-items-center">
                        <div class="col-lg-6 py-3 ">
                            <h1>Mission</h1>
                            <h5 class="w3-padding-32">Our mission is to deliver professional Medical Services through:</h5>
                            <p class="text-grey mb-4">
                            </p><ul>
                                    <li>The promotion or the preservation of health through preventive measures;</li>
                                    <li>The enhancement of health and total well-being of mankind through the therapeutic means and</li>
                                    <li>The maintenance of quality health care services</li>
                                </ul>
                            <p></p>

                        </div>
                        <div class="col-lg-6 text-center">
                            <div class="img-place custom-img-1">
                                <img src="assets/img/missionn.png" loading="lazy" alt="" width="80%" height="80%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Second Grid -->
            <div class="page-section">
                <div class="container ">
                    <div class="row align-items-center">
                        <div class="col-lg-6 text-center">
                            <div class="img-place custom-img-1">
                                <img src="assets/img/services1.png" loading="lazy" alt="" width="80%" height="80%">
                            </div>
                        </div>
                        <div class="col-lg-6 py-3">
                            <h1 class="subhead">Vision</h1>
                            <p class="text-grey mb-4">
                                The PUP Medical Services envisioned to create a highly productive Community where everybody recognizes value of optimum well-being and responsible behavior.
                            </p>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Third Grid -->
            <div class="page-section bg-light">
                <div class="container ">
                    <div class="row align-items-center">
                        <div class="col-lg-6 py-3">
                            <h1>PUP MSD offers  Medical Services: </h1>

                            <p class="text-grey mb-4">
                            </p><ol>
                                <li>Free medical consultation and treatment.</li>
                                <li>First Aid Treatment of emergency cases.</li>
                                <li>Transport patient and referral to tertiary hospital.</li>
                                <li>Referral to hospital for laboratory and to other physicians’ in their specialized field.</li>
                                <li>Annual medical examination of faculty members and administrative employees.</li>
                                <li>Issuance of medical certificate and other forms of clearance after evaluation and examination of the patient.</li>
                                <li>Medical missions, bloodletting, vaccination</li>
                                </ol>
                            <p></p>

                        </div>
                        <div class="col-lg-6 text-center" data-wow-delay="400ms">
                            <div class="img-place custom-img-1">
                                <img src="assets/img/visionn.png" loading="lazy" alt="" width="80%" height="80%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fourth Grid -->
            <div class="page-section">
                <div class="container ">
                    <div class="row align-items-center">
                        <div class="col-lg-6 text-center">
                            <div class="img-place custom-img-1">
                                <img src="assets/img/services2.png" loading="lazy" alt="" width="80%" height="80%">
                            </div>
                        </div>
                        <div class="col-lg-6 py-3">
                            <h1 class="subhead">Medical Service Provided</h1>
                            <p class="text-grey mb-4">
                            </p><ol>
                                <li>Consultation and Treatment Services for Non-Emergency Medical Cases of Faculty and Administrative Employees.</li>
                                <li>Consultation and Treatment of Emergency Cases (face-to-face) non-pandemic for faculty and admin employee.</li>
                                <li>Consultation and treatment of non-emergency case (face-to-face).</li>
                                <li>Consultation and Treatment Services for Emergency Medical Cases of Faculty and Administrative Employees.</li>
                                <li>Consultation and Treatment Services for Emergency Medical Cases of Students.</li>
                                <li>Consultation and Treatment Services for Non-Emergency Medical Cases of Students and Dependents.</li>
                                <li>Inquiries on medical concern.</li>
                                <li>Issuance of Annual Medical Clearance Medical Clearance for Off-Campus of Students, Issuance of Follow-up of Students referred during Enrollment.</li>
                                <li>Issuance of Medical Certificate for Sick Note/ Excuse Slip.</li>
                                <li>Issuance of Medical Clearance (Annual (Faculty and Admin) For laboratory classes (for students), For off-campus activities (for students), (For OJT classes (for students), 
                                (For sick note/ excuse slip (student/ faculty/ admin), (For travel (student, faculty and admin employees), (Incoming freshmen/ transferees/returning students) enrollment), (Other purpose), 
                                for enrollment, for Laboratory Classes for Food-Handlers, for Off-Campus Activity of Student, for On-the-Job-training of Students).</li>
                                <li>Teleconsultation</li>
                                </ol>
                            <p></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection