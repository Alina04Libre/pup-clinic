@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consent Form</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    @include('cdn')
    <!-- custom css file link -->

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- -------------------- -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script src="{{ asset('js/consent.js') }}?v=1"></script>



</head>

<body>
    <!--CONSENT FORM-->
    <div class="appoint-bg" id="consent">
        <div class="consent-form">
            <div class="appointmentform ms-2 me-2">
                <form method="POST" action="{{ route('consent-form.store') }}" class="needs-validation" id="consent-form" style="padding-top: 20px;" novalidate>
                    @csrf
                    <!-- Validation Errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-outline-secondary" role="button" href="{{ url('/userdashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </a>
                    </div>
                    <h1 class="text-center text-2xl font-semibold mb-4" style="padding-top: 10px;">HEALTHCARE CONSENT FORM for TELEMEDICINE</h1>
                    <div class="bg-info-subtle text-emphasis-info p-4 rounded-3 mb-4">
                        <p class="mb-2" style="font-size: 12px;">MEDICAL SERVICES DEPARTMENT - POLYTECHNIC UNIVERSITY OF THE PHILIPPINES
                            Telemedicine is the use of telephone, cellphone, computer or electronic gadget that will enable the patient to communicate with the physicians for the purpose of diagnosis, treatment, management, education, and follow up care when a face to face consultation is not possible.
                            This may involve live two way audio and video, patient pictures, medical images, patient's medical records and other things that may be pertinent to the consultation.
                            Electronic systems will utilize network and software security protocols to protect patient identity, privacy and confidentiality and to safeguard data and prevent corruption of data against intentional or unintentional corruption.
                            Through the use of telemedicine, the patients will be able to obtain a medical evaluation/impression of their condition, specific prescription on what to take, instructions on what laboratory and imaging tests do.
                        </p>
                        <p class="mb-1" style="font-size: 12px;">
                            (Ang telemedicine ay ang paggamit ng telepono, cellphone, computer o electronic gadget na magbibigay-daan sa pasyente na makipag-ugnayan sa mga doktor para sa layunin ng diagnosis, paggamot, pagbigay ng tagubilin, edukasyon, at follow up na pangangalaga kapag ang isang harapang konsultasyon ay imposible.
                            Ito ay maaaring may kasamang live na two way na audio at video, mga larawan ng pasyente, mga medikal na larawan, mga rekord ng medikal ng pasyente at iba pang bagay na maaaring nauugnay sa konsultasyon.
                            Gagamitin ng mga electronic system , network at software security protocols para protektahan ang pagkakakilanlan ng pasyente, privacy at confidentiality at para pangalagaan ang data at maiwasan ang corruption ng data laban sa sinadya o hindi sinasadyang katiwalian.
                            Sa pamamagitan ng paggamit ng telemedicine, ang mga pasyente ay makakakuha ng medikal evaluation/impression ng kanilang kondisyon, partikular na reseta sa kung ano ang dapat gawin, mga tagubilin sa kung ano ang ginagawa ng laboratoryo at mga pagsusuri sa imaging.)
                        </p>
                    </div>

                    <div class="m-2">
                        <div class="mb-3">
                            <div class="row">
                                <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                    <div class="col mb-3">
                                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" style="background-color: #f0f0f0;" class="form-control" value="{{ $user->name ?? '' }} {{ $user->middle_name ?? '' }} {{ $user->last_name ?? '' }}" id="exampleFormControlInput1" readonly />
                                    </div>
                                    <div class="col mb-3">
                                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                        <input type="text" name="email" value="{{ $user->email ?? '' }}" placeholder="Enter your email" style="background-color: #f0f0f0;" class="form-control" readonly />
                                    </div>
                                </div>

                                <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                    <label for="gender" class="form-label col">Gender (Kasarian) <span class="text-danger">*</span></label>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="male" name="gender" value="Male" {{ old('gender', $user->sex) == 'Male' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="female" name="gender" value="Female" {{ old('gender', $user->sex) == 'Female' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="other" name="gender" value="Other" {{ old('gender', $user->sex) == 'Other' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="other">Other</label>
                                        <div class="invalid-feedback">Select your gender</div>
                                    </div>

                                </div>

                                <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                    <label for="you" class="form-label col">Are you <span class="text-danger">*</span></label>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="user_type_ademp" name="user_type" value="Administrative Employee" {{ old('user_type') == 'Administrative Employee' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="user_type_ademp">an Administrative Employee</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="user_type_student" name="user_type" value="Student" {{ old('user_type') == 'Student' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="user_type_student">a Student</label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input type="radio" class="form-check-input" id="user_type_faculty" name="user_type" value="Faculty Member" {{ old('user_type') == 'Faculty Member' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="user_type_faculty">a Faculty Member</label>
                                        <div class="invalid-feedback">This is a required question</div>
                                    </div>
                                </div>

                                <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                    <label for="age" class="form-label mb-0">Age <span class="text-danger">*</span></label>
                                    <p class="mt-0 fst-italic" style="font-size: 12px;">(if below 18 years of age, parent or guardian should accomplish the rest of the questionnaire.)
                                        (Kung ang edad ay nasa 18 pababa, ang magulang o ang tagapagalaga ang siyang dapat na sumagot sa questionnaire)
                                    </p>
                                    <input type="number" class="form-control" id="age" name="age" value="<?php echo $age; ?>" required>
                                    <div class="invalid-feedback">
                                        Please provide your age.
                                    </div>
                                </div>

                                <div class="card pe-0 ps-0 mb-3" id="guardiansSection" style="display: none;">
                                    <div class="card-header text-bg-primary">GUARDIANS</div>
                                    <div class="card-body">
                                        <p class="card-text" style="font-size: 13px;">For Guardians of patients 18 years and below, Please fill up the rest of the questionnaire for the patient. If not type N.A. (Para sa mga magulang o tagapagalaga ng pasyente na may edad na 18 pababa, ang magsagot ng HEALTH CONSENT para sa pasyente. at kung lagpas sa edad ng 18 pababa maglagay lamang ng N.A.)</p>
                                    </div>
                                </div>

                                <div class="bg-white text-dark p-3 rounded-3 mb-3" id="guardianInfo">
                                    <label for="guardian" class="form-label mb-1">Name of Parent or Guardian <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="guardian" name="guardian" required>
                                    <p style="font-size: 13px;">(Last Name, First Name, M.I.)</p>
                                    <div class="invalid-feedback">
                                        This is a required question.
                                    </div>
                                </div>

                                <div class="bg-white text-dark p-3 rounded-3 mb-3" id="relationInfo">
                                    <label for="guardian_relation" class="form-label">Relation to the patient (Relasyon sa pasyente) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="guardian_relation" name="guardian_relation" required>
                                    <div class="invalid-feedback">
                                        This is a required question.
                                    </div>
                                </div>

                                <div class="bg-white text-dark p-3 rounded-3 mb-3" id="phoneInfo">
                                    <label for="phone" class="form-label">Contact Number (Numero) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                    <div class="invalid-feedback">
                                        This is a required question.
                                    </div>
                                </div>


                                <!--CONSENT FORM-->
                                <div class="card pe-0 ps-0 mb-3">
                                    <div class="card-header text-bg-primary ">Health Consent Form Proper</div>
                                    <div class="card-body bg-primary-subtle">
                                        <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                            <p class="card-text" style="font-size: 13px;">
                                                <b>1. </b> I have the right to be informed about my personal information that will be entered into the system and the purpose(s) for which they will be processed.
                                                (May karapatan akong malaman ang tungkol sa aking personal na impormasyon na ipapasok sa system at ang (mga) layunin kung saan sila ipoproseso.)
                                            </p>
                                        </div>
                                        <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                            <p class="card-text" style="font-size: 13px;">
                                                <b>2. </b> In the course of the online consultation, PUP MEDICAL SERVICES DEPARTMENT (PUP-MSD) will process my Personal information & Sensitive Personal Information which includes collection, recording, retrieval, use, retention, & disposal/destruction.
                                                (Sa online na konsultasyon, ipoproseso ng PUP MEDICAL SERVICES DEPARTMENT (PUP-MSD) ang aking Personal na impormasyon at Sensitibong Personal na Impormasyon na kinabibilangan ng pangongolekta, pagtatala, pagkuha, paggamit, pagpapanatili, at pagtatapon/pagsira.)
                                            </p>
                                        </div>
                                        <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                            <p class="card-text" style="font-size: 13px;">
                                                <b>3. </b> My PERSONAL DATA include, birthdate, address, nationality, sex, religious affiliation, contact information, medical information, medication, medical history & other information which are relevant for the purpose of diagnoses & treatment in the PUP-MSD.
                                                (Kasama sa aking PERSONAL DATA ang, petsa ng kapanganakan, address, nasyonalidad, kasarian, kaugnayan sa relihiyon, impormasyon sa pakikipag-ugnayan, impormasyong medikal, gamot, kasaysayan ng medikal at iba pang impormasyon na may kaugnayan para sa layunin ng mga diagnosis at paggamot sa PUP-MSD.)
                                            </p>
                                        </div>
                                        <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                            <p class="card-text" style="font-size: 13px;">
                                                <b>4. </b> I may be asked to show certain body parts as may be considered important to form a diagnosis. This is in view of the fact that the physician/ dentist will not be in the same room as I am and my physician/ dentist will not be able to perform necessary physical examination on me.
                                                (Maaaring hilingin sa akin na ipakita ang ilang bahagi ng katawan na maaaring ituring na mahalaga upang bumuo ng diagnosis. Ito ay dahil sa katotohanan na ang manggagamot/dentista ay wala sa parehong silid tulad ko at ang aking manggagamot/dentista ay hindi makakagawa ng kinakailangang pisikal na pagsusuri sa akin.)
                                            </p>
                                        </div>
                                        <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                            <p class="card-text" style="font-size: 13px;">
                                                <b>5. </b> I understand there are potential risks in using this technology, including technical difficulties, interruptions, poor transmission, of images which may lead to misdiagnosis and consequently mistreatment, no access to paper charts/ medical records, delays and deficiencies, due to malfunction of electronic equipment and software, unauthorised access leading to breach of data privacy and confidentiality.
                                                (Naiintindihan ko na may mga potensyal na panganib sa paggamit ng teknolohiyang ito, kabilang ang mga teknikal na problema, pagkaantala, mabagal at malabong paghahatid ng mga larawan na maaaring humantong sa maling pagsusuri at dahil dito ay maling pagtrato, walang access sa mga paper chart/mga medikal/ dental na rekord, mga pagkaantala at mga kakulangan, dahil sa malfunction ng electronic equipment at software, hindi awtorisadong pag-access na humahantong sa paglabag sa privacy at pagiging kumpidensyal ng data.)
                                            </p>
                                        </div>
                                        <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                            <p class="card-text" style="font-size: 13px;">
                                                <b>6. </b> In case of urgent concern, It is the doctor's/ dentists responsibility to refer me to the nearest hospital in cases he/she deems my concern to be urgent and would warrant immediate action and management by doctors. My doctor's/ dentist's responsibility ends with the conclusion of the telemedicine/teledentistry consultation.
                                            </p>
                                        </div>
                                        <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                            <p class="card-text" style="font-size: 13px;">
                                                <b>7. </b> I am giving my consent to the processing of my PERSONAL DATA available to hospital, its affiliate, as well as members of its medical staff, nurses & allied healthcare personnel, if deemed necessary.
                                                (Ibinibigay ko ang aking pahintulot sa pagpoproseso ng aking PERSONAL DATA na makukuha sa ospital, sa kaakibat nito, gayundin sa mga miyembro ng mga medikal na kawani nito, mga nars at kaalyadong tauhan ng pangangalagang pangkalusugan, kung itinuring na kinakailangan)
                                            </p>
                                        </div>
                                        <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                            <p class="card-text" style="font-size: 13px;">
                                                <b>8. </b> Since the telemedicine/ teledentistry consultants and I are in a different location and do not have the opportunity to meet face to face, they will only rely on information provided by me, my caregiver, and the onsite healthcare providers. The PUP- MSD healthcare personnel cannot be responsible for advice, recommendations and/ or decisions based on incomplete or inaccurate information provided by me or other persons mentioned above.
                                                (Dahil ang mga telemedicine/ teledentistry consultant at ako ay nasa ibang lokasyon at walang pagkakataong makipagkita nang harapan, aasa lamang sila sa impormasyong ibinigay ko, ang aking tagapag-alaga, at ang onsite na mga tagapagbigay ng pangangalagang pangkalusugan. Ang mga tauhan ng pangangalagang pangkalusugan ng PUP- MSD ay hindi maaaring maging responsable para sa payo, rekomendasyon at/o mga desisyon batay sa hindi kumpleto o hindi tumpak na impormasyong ibinigay ko o ng ibang mga taong nabanggit sa itaas)
                                            </p>
                                        </div>
                                        <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                            <p class="card-text" style="font-size: 13px;">
                                                <b>9. </b> I am giving my consent in the processing of my PERSONAL DATA as provided under the standards of the DOH in Health Information Management & R.A. 10173 otherwise known as the "Data Privacy Act of 2012".
                                                (Ibinibigay ko ang aking pahintulot sa pagproseso ng aking PERSONAL DATA gaya ng ibinigay sa ilalim ng mga pamantayan ng DOH sa Health Information Management & R.A. 10173 o mas kilala bilang "Data Privacy Act of 2012".)
                                            </p>
                                        </div>
                                        <div class="bg-white text-dark p-3 rounded-3 mb-3">
                                            <p class="card-text" style="font-size: 13px;">
                                                <b>10. </b> I hereby confirm that I VOLUNTARILY & TRUTHFULLY filled out this form as I seek ONLINE MEDICAL or DENTAL Consultation on PUP-MSD.
                                                (Sa pamamagitan nito, kinukumpirma ko na KUSANG-LOOB at PAWANG KATOTOHANAN kong sinagot ang form na ito habang ako ay sumasailalim ng ONLINE MEDICAL o DENTAL Consultation sa PUP-MSD.)
                                            </p>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="consent_agreement" id="consent_agreement" value="1" required>
                                            <label class="form-check-label fw-bold" for="consent_agreement">
                                                I hereby read and agreed to all the terms and conditions stated above. <span class="text-danger">*</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="consent_form_submit" id="consent-form-submit" class="btn btn-outline-success mx-2 my-2">Submit and Make Appointment</button>
                                    <button type="button" id="cancelButton" class="btn btn-outline-danger mx-2 my-2">Cancel</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<?php

    // Get the user's birthdate from the database or wherever it's stored
    $birth_year = $user->birth_year;
    $birth_month = $user->birth_month;
    $birth_day = $user->birth_day;

    // Create a DateTime object for the birthdate
    $birthdate = new DateTime("$birth_year-$birth_month-$birth_day");

    // Get the current date
    $currentDate = new DateTime();

    // Calculate the difference between the current date and the birthdate
    $age = $birthdate->diff($currentDate)->y;

?>

</html>
