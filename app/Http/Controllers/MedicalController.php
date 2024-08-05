<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\Appointment;
use App\Models\Checkup;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use TCPDF;

class MedicalController extends Controller
{
    //
    public function store(Request $request, $patientId)
    {
        $validator = null;

        try {

            // Fetch the user's name components from the users table
            $userData = User::where('id', $patientId)->select('name', 'middle_name', 'last_name')->first();
            $userStrand = User::where('users.id', $patientId)
                ->join('strand', 'users.strand_id', '=', 'strand.id')
                ->value('strand.name');
            $userCourse = User::where('users.id', $patientId)
                ->join('course', 'users.course_id', '=', 'course.id')
                ->value('course.course_name');
            $userYear = User::where('users.id', $patientId)
                ->join('year_level', 'users.year_level', '=', 'year_level.id')
                ->value('year_level.name');
            $userDepartment = User::where('users.id', $patientId)
                ->join('department', 'users.department_id', '=', 'department.id')
                ->value('department.name');
            $userAddress = User::where('id', $patientId)->value('address');
            $userContactNum = User::where('id', $patientId)->value('phone_number');
            $userAge = User::where('id', $patientId)->value('age');
            $userGender = User::where('id', $patientId)->value('sex');
            $userStatus = User::where('id', $patientId)->value('civil_tatus');
            $userContactPer = User::where('id', $patientId)->value('contact_person_number');
            $userContactPerson = User::where('id', $patientId)->value('contact_person');
            $userPhotoPath = User::where('id', $patientId)->value('profile_photo_path');

            // Combining the name to create the full name
            $userName = $userData->name . ' ' . $userData->middle_name . ' ' . $userData->last_name;

            $validator = Validator::make($request->all(), [
                'childhood_illness.*' => 'in:Asthma,Heart Disease,Seizure Disorder,Chicken Pox,Measles,Hyperventilation,Others',
                'childhood_illness_specify' => 'required_if:childhood_illness.*,Others',
                'family-history.*' => 'in:Diabetes,Hypertension,PTB,Cancer,others,Hyperventilation,Others',
                'others_text' => 'required_if:family-history.*,others',
                'height' => 'nullable',
                'weight' => 'nullable',
                'bmi' => 'nullable',
                'bp' => 'nullable',
                'hr' => 'nullable',
                'rr' => 'nullable',
                'temp' => 'nullable',
                'head' => 'nullable|array',
                'head.*' => 'in:wound,mass,alopecia',
                'eyes' => 'nullable|array',
                'eyes.*' => 'in:without-glasses,with-glasses,anicteric-sclera,pink-palpebral-conjunctiva',
                'ears' => 'nullable|array',
                'ears.*' => 'in:no-gross-deformity,no-discharge',
                'throat' => 'nullable|array',
                'throat.*' => 'in:no-tpc,no-lymphadenopathy,no-mass-throat',
                'lungs' => 'nullable|array',
                'lungs.*' => 'in:Normal,Wheeze,Rales',
                'xray-result' => 'nullable|in:Normal,With Findings',
                'findings-textbox' => 'required_if:xray-result,With Findings',
                'breast-exam' => 'nullable|in:Normal',
                'murmur' => 'nullable|in:Present,Absent',
                'rhythm' => 'nullable|in:Regular,Irregular',
                'abdomen' => 'nullable|in:Normal',
                'genitoUrinary' => 'nullable',
                'extremities-exam' => 'nullable|in:No Deformities',
                'vertebral-exam' => 'nullable|in:Normal,With Deformity',
                'deformity-textbox' => 'required_if:vertebral-exam,With Deformity',
                'skin' => 'nullable|array',
                'skin.*' => 'in:Pallor,Rashes, Lesions',
                'scars' => 'nullable|in:Absent,Present',
                'workingImpression' => 'nullable',
                'fit' => 'nullable',
                'forWorkUp' => 'nullable',
                'referred' => 'nullable|array',
                'referred.*' => 'in:Cardio,Derma,ENT,Optha,Pulmo,Others',
                'referred_to_others' => 'required_if:referred.*,Others',
                'followUpOn' => 'nullable|date',
                'physicianName' => 'required_if:role,doctor',
                'nurseName' => 'required_if:role,nurse',
                'remarks' => 'nullable',
                'signatureImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                // Add validation rules for other fields

            ], [
                'nurseName.required_if' => 'The Nurse Name field is required.',
                'physicianName.required_if' => 'The Physician Name field is required.',
            ]);
            $validator->messages()->add('nurseName.required', 'The Nurse Name field is required.');
            $validator->messages()->add('physicianName.required', 'The Physician Name field is required.');

            if ($validator->fails()) {
                // If validation fails, redirect back with errors
                return redirect()->back()->withErrors($validator)->withInput();
            }

            Log::info('Starting the database transaction');
            DB::beginTransaction();

            $medicalRecord = MedicalRecord::firstOrNew(['user_id' => $patientId]);
            $medicalRecord->user_id = $patientId;
            $medicalRecord->name = $userName;
            $medicalRecord->strand = $userStrand;
            $medicalRecord->course = $userCourse;
            $medicalRecord->year_level = $userYear;
            $medicalRecord->department = $userDepartment;
            $medicalRecord->address = $userAddress;
            $medicalRecord->contact_number = $userContactNum;
            $medicalRecord->contact_person = $userContactPerson;
            $medicalRecord->contactPerson_number = $userContactPer;
            $medicalRecord->age = $userAge;
            $medicalRecord->gender = $userGender;
            $medicalRecord->civil_status = $userStatus;
            $medicalRecord->patient_photo = $userPhotoPath;

            $childhoodIllness = $request->input('childhood_illness', []);

            // Check if "Others" is checked and "Specify" textbox is filled
            if (in_array('Others', $childhoodIllness) && $request->filled('childhood_illness_specify')) {
                // Add the specified value to the childhood_illness array
                $childhoodIllness[] = $request->input('childhood_illness_specify');
                $medicalRecord->childhood_illness_specify = $request->input('childhood_illness_specify');
            } elseif (!in_array('Others', $childhoodIllness)) {
                // If "Others" is not checked, set childhood_illness_specify to null
                $medicalRecord->childhood_illness_specify = null;
            }

            // Ensure that the array is not empty before saving
            if (!empty($childhoodIllness)) {
                $medicalRecord->childhood_illness = $childhoodIllness;
            } else {
                // If no childhood illnesses are selected, set childhood_illness to null
                $medicalRecord->childhood_illness = null;
            }

            $medicalRecord->previous_hospitalization = $request->input('previous_hospitalization');
            $medicalRecord->operation_surgery = $request->input('operation_surgery');
            $medicalRecord->current_medications = $request->input('medications');
            $medicalRecord->allergies = $request->input('allergies');

            $medicalRecord->family_history = $request->input('family-history');
            // Check if "Others" is checked and "Specify" textbox is filled for family history
            if (in_array('Others', $request->input('family-history', [])) && $request->filled('others_text')) {
                // Add the specified value to the family_history array
                $familyHistory = $request->input('family-history', []);
                $familyHistory[] = 'Others';
                $medicalRecord->family_history_specify = $request->input('others_text');
            } else {
                // If "Others" is not checked, set family_history_specify to null
                $medicalRecord->family_history_specify = null;
            }

            // Ensure that the array is not empty before saving family history
            $medicalRecord->family_history = $request->input('family-history', []);

            if (empty($medicalRecord->family_history)) {
                // If no family history is selected, set family_history to null
                $medicalRecord->family_history = null;
            }

            $medicalRecord->history_cigarette = $request->input('cigarette-smoking');
            $medicalRecord->history_alcohol = $request->input('alcohol-drinking');
            $medicalRecord->history_travel = $request->input('travelled-abroad');
            $medicalRecord->vital_signs = $request->input('patient-condition');
            $medicalRecord->height = $request->input('height');
            $medicalRecord->weight = $request->input('weight');
            $medicalRecord->bmi = $request->input('bmi');
            $medicalRecord->bp = $request->input('bp');
            $medicalRecord->hr = $request->input('hr');
            $medicalRecord->rr = $request->input('rr');
            $medicalRecord->temp = $request->input('temp');
            $medicalRecord->head = $request->input('head');
            $medicalRecord->eyes = $request->input('eyes');
            $medicalRecord->ears = $request->input('ears');
            $medicalRecord->throat = $request->input('throat');
            $medicalRecord->chest = $request->input('lungs');

            // Retrieve the value from the radio button
            $xrayResult = $request->input('xray-result');

            // Check if the radio button selected "With Findings" and the findings textbox is filled
            if ($xrayResult === 'With Findings' && $request->filled('findings-textbox')) {
                $medicalRecord->x_ray = $request->input('findings-textbox');
            } else {
                // If "With Findings" is not selected or the textbox is empty, set x_ray to the selected value
                $medicalRecord->x_ray = $xrayResult;
            }


            $medicalRecord->breast = $request->input('breast-exam');
            $medicalRecord->murmur = $request->input('murmur');
            $medicalRecord->rhythm = $request->input('rhythm');
            $medicalRecord->abdomen = $request->input('abdomen');
            $medicalRecord->geneto_urinary = $request->input('genitoUrinary');
            $medicalRecord->extremities = $request->input('extremities-exam');

            // Retrieve the value from the radio button
            $vertibalResult = $request->input('vertebral-exam');
            // Check if the radio button selected With Deformity" and the findings textbox is filled
            if ($vertibalResult === 'With Deformity' && $request->filled('deformity-textbox')) {
                $medicalRecord->vertebral_column = $request->input('deformity-textbox');
            } else {
                // If "With Deformity" is not selected or the textbox is empty, set vertebral-exam to the selected value
                $medicalRecord->vertebral_column = $vertibalResult;
            }

            $medicalRecord->skin = $request->input('skin');
            $medicalRecord->scars = $request->input('scars');
            $medicalRecord->working_impression = $request->input('workingImpression');
            $medicalRecord->fit = $request->input('fit');
            $medicalRecord->work_up = $request->input('forWorkUp');

            $referredTo = $request->input('referred', []);
            $referredToOthers = null;

            // Check if "Others" is checked and "Specify" textbox is filled
            if (in_array('Others', $referredTo) && $request->filled('referred_text')) {
                // Add the specified value to the referredToOthers variable
                $referredToOthers = $request->input('referred_text');
            }

            // Ensure that the array is not empty before saving
            if (!empty($referredTo)) {
                $medicalRecord->referred_to = $referredTo;
            } else {
                $medicalRecord->referred_to = null; // Set to null if no referrals are selected
            }

            // Save the specified value to the referred_to_others column
            $medicalRecord->referred_to_others = $referredToOthers;

            $medicalRecord->followUp = $request->input('followUpOn');
            $medicalRecord->nurse_name = $request->input('nurseName');
            $medicalRecord->physician_name = $request->input('physicianName');
            $medicalRecord->remarks = $request->input('remarks');
            $medicalRecord->signature_photo_path = $request->input('signatureImage');

            // Check if a new signature image is uploaded
            if ($request->hasFile('signatureImage')) {
                // Get the old image path
                $oldImagePath = $medicalRecord->signature_photo_path;

                // Store the new image
                $imagePath = $request->file('signatureImage')->store('signature', 'public');
                // Debugging: Log messages to check the flow
                // error_log('Old Image Path: ' . $oldImagePath);
                // error_log('New Image Path: ' . $imagePath);
                // Check if an old image path exists and is not null
                if ($oldImagePath && Storage::disk('public')->exists('uploads/' . $oldImagePath)) {
                    // Delete the old image from the 'public/uploads' directory
                    Storage::disk('public')->delete('uploads/' . $oldImagePath);
                }


                // Update the user's profile_photo_path with the new image path
                $medicalRecord->signature_photo_path = $imagePath;
                $medicalRecord->save();
            }


            // $user = User::find($patientId);

            $excludedFields = ['strand', 'year_level', 'department', 'course', 'childhood_illness_specify', 'referred_to_others',
                'referred_text', 'patient_photo', 'family_history_specify', 'followUp', 'nurse_name', 'physician_name', 'signature_photo_path'];

            // Check if any field in the medical record (excluding excluded fields) is null
            $hasNullValues = false;
            foreach ($medicalRecord->getAttributes() as $key => $value) {
                    error_log("$key: $value");
                if (!in_array($key, $excludedFields) && ($value === null || $value === '')) {
                    $hasNullValues = true;
                    error_log("Null or empty value found in $key");
                    break;
                }
            }

            error_log("is_medical_record_complete: " . (!$hasNullValues ? 'true' : 'false'));

            // Update is_medical_record_complete based on the check
            $medicalRecord->is_medical_record_complete = !$hasNullValues;

            $medicalRecord->save();

            // Update the user's table
            $user = User::find($patientId);
            if ($user) {
                $user->is_medical_record_complete = !$hasNullValues;
                $user->save();
            }
            DB::commit();

            Log::info('Medical Record saved successfully!');
            Alert::success('Success', 'Medical Record saved successfully!');
            return redirect()->route('medical-record.view', ['patientId' => $patientId]);
        } catch (\Exception $e) {
            Log::error('Error while saving the Medical Record: ' . $e->getMessage());
            DB::rollBack();
            Alert::error('Error', 'There is an error saving the record!');
            return redirect()->back()->withErrors($validator);
        }
    }

    public function edit(Request $request, $patientId)
    {

        try {
            // Fetch the user's name components from the users table
            $userData = User::where('id', $patientId)->select('name', 'middle_name', 'last_name')->first();

            // Fetch the existing medical record
            $medicalRecord = MedicalRecord::where('user_id', $patientId)->first();

            // If the medical record doesn't exist, you can handle this as needed (e.g., create a new record).
            if (!$medicalRecord) {
                return redirect()->route('medical-record.create', ['patientId' => $patientId]);
            }

            // Combine the name to create the full name
            $userName = $userData->name . ' ' . $userData->middle_name . ' ' . $userData->last_name;
            $validator = Validator::make($request->all(), [
                'childhood_illness.*' => 'in:Asthma,Heart Disease,Seizure Disorder,Chicken Pox,Measles,Hyperventilation,Others',
                'childhood_illness_specify' => 'required_if:childhood_illness.*,Others',
                'patient-condition' => 'nullable|in:Not in Distress,In Distress',
                'height' => 'nullable',
                'weight' => 'nullable',
                'bmi' => 'nullable',
                'bp' => 'nullable',
                'hr' => 'nullable',
                'rr' => 'nullable',
                'temp' => 'nullable',
                'head' => 'nullable|array',
                'head.*' => 'in:wound,mass,alopecia',
                'eyes' => 'nullable|array',
                'eyes.*' => 'in:without-glasses,with-glasses,anicteric-sclera,pink-palpebral-conjunctiva',
                'ears' => 'nullable|array',
                'ears.*' => 'in:no-gross-deformity,no-discharge',
                'throat' => 'nullable|array',
                'throat.*' => 'in:no-tpc,no-lymphadenopathy,no-mass-throat',
                'lungs' => 'nullable|array',
                'lungs.*' => 'in:Normal,Wheeze,Rales',
                'xray-result' => 'nullable|in:Normal,With Findings',
                'findings-textbox' => 'required_if:xray-result,With Findings',
                'breast-exam' => 'nullable|in:Normal',
                'murmur' => 'nullable|in:Present,Absent',
                'rhythm' => 'nullable|in:Regular,Irregular',
                'abdomen' => 'nullable|in:Normal',
                'genitoUrinary' => 'nullable',
                'extremities-exam' => 'nullable|in:No Deformities',
                'vertebral-exam' => 'nullable|in:Normal,With Deformity',
                'deformity-textbox' => 'required_if:vertebral-exam,With Deformity',
                'skin' => 'nullable|array',
                'skin.*' => 'in:Pallor,Rashes, Lesions',
                'scars' => 'nullable|in:Absent,Present',
                'workingImpression' => 'nullable',
                'fit' => 'nullable',
                'forWorkUp' => 'nullable',
                'referred' => 'nullable|array',
                'referred.*' => 'in:Cardio,Derma,ENT,Optha,Pulmo,Others',
                'referred_to_others' => 'required_if:referred.*,Others',
                'followUpOn' => 'nullable|date',
                'physicianName' => 'required_if:role,doctor',
                'nurseName' => 'required_if:role,nurse',
                'remarks' => 'nullable',
                'signatureImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                // Add validation rules for other fields

            ], [
                'nurseName.required_if' => 'The Nurse Name field is required.',
                'physicianName.required_if' => 'The Physician Name field is required.',
            ]);
            $validator->messages()->add('nurseName.required', 'The Nurse Name field is required.');
            $validator->messages()->add('physicianName.required', 'The Physician Name field is required.');

            if ($validator->fails()) {
                // If validation fails, redirect back with errors
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Log::info('Starting the database transaction');
            DB::beginTransaction();

            // Update the medical record fields
            $medicalRecord->name = $userName;
            $childhoodIllness = $request->input('childhood_illness', []);
            // Check if "Others" is checked and "Specify" textbox is filled
            if (in_array('Others', $childhoodIllness) && $request->filled('childhood_illness_specify')) {
                // Add the specified value to the childhood_illness array
                $childhoodIllness[] = $request->input('childhood_illness_specify');
                $medicalRecord->childhood_illness_specify = $request->input('childhood_illness_specify');
            } else {
                // If "Others" is not checked, set childhood_illness_specify to null
                $medicalRecord->childhood_illness_specify = null;
            }

            // Ensure that the array is not empty before saving
            if (!empty($childhoodIllness)) {
                $medicalRecord->childhood_illness = $childhoodIllness;
            } else {
                // If no childhood illnesses are selected, set childhood_illness to null
                $medicalRecord->childhood_illness = null;
            }

            // Update other fields in a similar manner
            $medicalRecord->previous_hospitalization = $request->input('previous_hospitalization');
            $medicalRecord->operation_surgery = $request->input('operation_surgery');
            $medicalRecord->current_medications = $request->input('medications');
            $medicalRecord->allergies = $request->input('allergies');
            // Update family history
            $familyHistory = $request->input('family-history');

            // Ensure that $familyHistory is always an array
            $familyHistory = is_array($familyHistory) ? $familyHistory : [];

            // Check if "Others" is checked and "Specify" textbox is filled for family history
            if (in_array('Others', $familyHistory) && $request->filled('others_text')) {
                // Add the specified value to the family history array
                $familyHistory[] = 'Others';
                $medicalRecord->family_history_specify = $request->input('others_text');
            } else {
                // If "Others" is not checked, set family_history_specify to null
                $medicalRecord->family_history_specify = null;
            }

            // Ensure that the array is not empty before saving family history
            $medicalRecord->family_history = $familyHistory;

            if (empty($medicalRecord->family_history)) {
                // If no family history is selected, set family_history to null
                $medicalRecord->family_history = null;
            }


            $medicalRecord->history_cigarette = $request->input('cigarette-smoking');
            $medicalRecord->history_alcohol = $request->input('alcohol-drinking');
            $medicalRecord->history_travel = $request->input('travelled-abroad');
            $medicalRecord->vital_signs = $request->input('patient-condition');
            $medicalRecord->height = $request->input('height');
            $medicalRecord->weight = $request->input('weight');
            $medicalRecord->bmi = $request->input('bmi');
            $medicalRecord->bp = $request->input('bp');
            $medicalRecord->hr = $request->input('hr');
            $medicalRecord->rr = $request->input('rr');
            $medicalRecord->temp = $request->input('temp');
            $medicalRecord->head = $request->input('head');
            $medicalRecord->eyes = $request->input('eyes');
            $medicalRecord->ears = $request->input('ears');
            $medicalRecord->throat = $request->input('throat');
            $medicalRecord->chest = $request->input('lungs');

            // Retrieve the value from the radio button
            $xrayResult = $request->input('xray-result');

            // Check if the radio button selected "With Findings" and the findings textbox is filled
            if ($xrayResult === 'With Findings' && $request->filled('findings-textbox')) {
                $medicalRecord->x_ray = $request->input('findings-textbox');
            } else {
                // If "With Findings" is not selected or the textbox is empty, set x_ray to the selected value
                $medicalRecord->x_ray = $xrayResult;
            }

            $medicalRecord->breast = $request->input('breast-exam');
            $medicalRecord->murmur = $request->input('murmur');
            $medicalRecord->rhythm = $request->input('rhythm');
            $medicalRecord->abdomen = $request->input('abdomen');
            $medicalRecord->geneto_urinary = $request->input('genitoUrinary');
            $medicalRecord->extremities = $request->input('extremities-exam');

            // Retrieve the value from the radio button
            $vertibalResult = $request->input('vertebral-exam');
            // Check if the radio button selected With Deformity" and the findings textbox is filled
            if ($vertibalResult === 'With Deformity' && $request->filled('deformity-textbox')) {
                $medicalRecord->vertebral_column = $request->input('deformity-textbox');
            } else {
                // If "With Deformity" is not selected or the textbox is empty, set vertebral-exam to the selected value
                $medicalRecord->vertebral_column = $vertibalResult;
            }

            $medicalRecord->skin = $request->input('skin');
            $medicalRecord->scars = $request->input('scars');
            $medicalRecord->working_impression = $request->input('workingImpression');
            $medicalRecord->fit = $request->input('fit');
            $medicalRecord->work_up = $request->input('forWorkUp');

            $referredTo = $request->input('referred', []);
            $referredToOthers = null;

            // Check if "Others" is checked and "Specify" textbox is filled
            if (in_array('Others', $referredTo) && $request->filled('referred_text')) {
                // Add the specified value to the referredToOthers variable
                $referredToOthers = $request->input('referred_text');
            }

            // Ensure that the array is not empty before saving
            if (!empty($referredTo)) {
                $medicalRecord->referred_to = $referredTo;
            } else {
                $medicalRecord->referred_to = null; // Set to null if no referrals are selected
            }

            // Save the specified value to the referred_to_others column
            $medicalRecord->referred_to_others = $referredToOthers;

            $medicalRecord->followUp = $request->input('followUpOn');
            $medicalRecord->nurse_name = $request->input('nurseName');
            $medicalRecord->physician_name = $request->input('physicianName');
            $medicalRecord->remarks = $request->input('remarks');

            // Check if a new signature image is uploaded
            if ($request->hasFile('signatureImage')) {
                // Get the old image path
                $oldImagePath = $medicalRecord->signature_photo_path;

                // Store the new image
                $imagePath = $request->file('signatureImage')->store('signature', 'public');

                // Check if an old image path exists and is not null
                if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                    // Delete the old image from the 'public/uploads' directory
                    Storage::disk('public')->delete($oldImagePath);
                }

                // Update the user's signature_photo_path with the new image path
                $medicalRecord->signature_photo_path = $imagePath;
            }

            // Save the updated medical record
            $medicalRecord->save();

            $excludedFields = ['strand', 'year_level', 'department', 'course', 'childhood_illness_specify', 'referred_to_others', 'geneto_urinary',
                'referred_text', 'patient_photo', 'family_history_specify', 'followUp', 'nurse_name', 'physician_name', 'signature_photo_path', 'deleted_at'];

            // Check if any field in the medical record (excluding excluded fields) is null
            $hasNullValues = false;
            foreach ($medicalRecord->getAttributes() as $key => $value) {
                    error_log("$key: $value");
                if (!in_array($key, $excludedFields) && ($value === null || $value === '')) {
                    $hasNullValues = true;
                    error_log("Null or empty value found in $key");
                    break;
                }
            }

            error_log("is_medical_record_complete: " . (!$hasNullValues ? 'true' : 'false'));

            // Update is_medical_record_complete based on the check
            $medicalRecord->is_medical_record_complete = !$hasNullValues;

            $medicalRecord->save();

            // Update the user's table
            $user = User::find($patientId);
            if ($user) {
                $user->is_medical_record_complete = !$hasNullValues;
                $user->save();
            }

            DB::commit();

            Log::info('Medical Record updated successfully!');
            Alert::success('Success', 'Medical Record updated successfully!');
            return redirect()->route('medical-record.view', ['patientId' => $patientId]);
        } catch (\Exception $e) {
            Log::error('Error while updating the Medical Record: ' . $e->getMessage());
            DB::rollBack();
            Alert::error('Error', 'There is an error updating the record!');
            return redirect()->back()->withErrors($validator);
        }
    }


    // public function storeWithoutUser(Request $request)
    // {
    //     $validator = null;

    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required',
    //             'address' => 'required',
    //             'contact_number' => 'required',
    //             'age' => 'required',
    //             'gender' => 'required',
    //             'civil_status' => 'required',
    //             'contact_person' => 'required',
    //             'contactPerson_number' => 'required',
    //             // Add validation rules for other fields
    //         ]);

    //         if ($validator->fails()) {
    //             // If validation fails, redirect back with errors
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

    //         Log::info('Starting the database transaction');
    //         DB::beginTransaction();

    //         $medicalRecord = new MedicalRecord();

    //         $medicalRecord->name = $request->input('name');
    //         $medicalRecord->address = $request->input('address');
    //         $medicalRecord->contact_number = $request->input('contact_number');
    //         $medicalRecord->age = $request->input('age');
    //         $medicalRecord->gender = $request->input('gender');
    //         $medicalRecord->civil_status = $request->input('civil_status');
    //         $medicalRecord->contact_person = $request->input('contact_person');
    //         $medicalRecord->contactPerson_number = $request->input('contactPerson_number');

    //         // Set other fields based on your form input

    //         $medicalRecord->save();
    //         DB::commit();

    //         Log::info('Medical Record saved successfully!');
    //         Alert::success('Success', 'Medical Record saved successfully!');
    //         return redirect()->route('viewMedical');
    //     } catch (\Exception $e) {
    //         Log::error('Error while saving the Medical Record: ' . $e->getMessage());
    //         DB::rollBack();
    //         Alert::error('Error', 'There is an error saving the record!');
    //         return redirect()->back()->withErrors($validator);
    //     }
    // }

    public function generateMedicalRecordPDF($userId)
    {
        try {
            // Fetch the user's medical record based on the $userId parameter
            $user = User::with('medicalRecord')->find($userId);

            if (!$user || !$user->medicalRecord) {
                Log::error('User or medical record not found for user ID: ' . $userId);
                return response()->json(['error' => 'User or medical record not found'], 404);
            }
            // Get the user's medical record and checkups
            $medicalRecord = $user->medicalRecord;
            $checkups = Checkup::whereHas('appointment', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with('appointment')->get();

            // Create an array of medical record details
            $medicalRecordDetails = [
                'Name' => $medicalRecord->name,
                'Course' => $medicalRecord->course,
                'Strand' => $medicalRecord->strand,
                'Year Level' => $medicalRecord->year_level,
                'Department' => $medicalRecord->department,
                'Address' => $medicalRecord->address,
                'Contact Number' => $medicalRecord->contact_number,
                'Blood Type' => $medicalRecord->blood_type,
                'PWD' => $medicalRecord->is_pwd,
                'Age' => $medicalRecord->age,
                'Gender' => $medicalRecord->gender,
                'Civil Status' => $medicalRecord->civil_status,
                'Contact Person' => $medicalRecord->contact_person,
                'Contact Number Person' => $medicalRecord->contactPerson_number,
                'Photo' => $medicalRecord->patient_photo,
                'Childhood' => is_array($medicalRecord->childhood_illness) ? $medicalRecord->childhood_illness : [],
                'Previous Hospitalization' => $medicalRecord->previous_hospitalization,
                'Operation Surgery' => $medicalRecord->operation_surgery,
                'Current Medications' => $medicalRecord->current_medications,
                'Allergies' => $medicalRecord->allergies,
                'Family History' => is_array($medicalRecord->family_history) ? $medicalRecord->family_history : [],
                'Cigarette' => $medicalRecord->history_cigarette,
                'Alcohol' => $medicalRecord->history_alcohol,
                'Travel' => $medicalRecord->history_travel,
                'Vital Signs' => $medicalRecord->vital_signs,
                'Height' => $medicalRecord->height,
                'HR' => $medicalRecord->hr,
                'Weight' => $medicalRecord->weight,
                'RR' => $medicalRecord->rr,
                'Temp' => $medicalRecord->temp,
                'BMI' => $medicalRecord->bmi,
                'BP' => $medicalRecord->bp,
                'Head' => is_array($medicalRecord->head) ? $medicalRecord->head : [],
                'Ears' => is_array($medicalRecord->ears) ? $medicalRecord->ears : [],
                'Eyes' => is_array($medicalRecord->eyes) ? $medicalRecord->eyes : [],
                'Throat' => is_array($medicalRecord->throat) ? $medicalRecord->throat : [],
                'Chest' => is_array($medicalRecord->chest) ? $medicalRecord->chest : [],
                'X-Ray' => $medicalRecord->x_ray,
                'Breast' => $medicalRecord->breast,
                'Murmur' => $medicalRecord->murmur,
                'Rhythm' => $medicalRecord->rhythm,
                'Abdomen' => $medicalRecord->abdomen,
                'Urinary' => $medicalRecord->geneto_urinary,
                'Extremities' => $medicalRecord->extremities,
                'Vertebral' => $medicalRecord->vertebral_column,
                'Skin' => is_array($medicalRecord->skin) ? $medicalRecord->skin : [],
                'Scars' => $medicalRecord->scars,
                'Working Impression' => $medicalRecord->working_impression,
                'Fit' => $medicalRecord->fit,
                'Work' => $medicalRecord->work_up,
                'Referred' => is_array($medicalRecord->referred_to) ? $medicalRecord->referred_to : [],
                'Physician Name' => $medicalRecord->physician_name,
                'Remarks' => $medicalRecord->remarks,
                'Signature' => $medicalRecord->signature_photo_path,
                'Follow Up' => $medicalRecord->followUp,
                'Medical Record' => $medicalRecord->is_medical_record_complete,

                'Checkups' => $checkups->map(function ($checkup) {
                    $appointmentData = $checkup->appointment;
                    $nurse = User::find($appointmentData->nurse_id);
                    $nurseName = $nurse ? $nurse->name . ' ' . $nurse->last_name : 'N/A';
                    return [
                        'Name' => $checkup->name,
                        'Appointment ID' => $checkup->appointment->unique_id,
                        'Concern' => $checkup->appointment->concern,
                        'Appointment Date' => $checkup->appointment->appointment_date,
                        'Appointment Time' => $checkup->appointment->appointment_date,
                        'Appointment New Date' => $checkup->appointment->new_appointment_date,
                        'Appointment New Time' => $checkup->appointment->reason_for_resched,
                        'Reason for Declining' => $checkup->appointment->reason_for_declining,
                        'Nurse Name' => $nurseName,
                        'Physician Name' => $checkup->name,
                        'Prescription' => $checkup->prescription,
                        'Complaint' => $checkup->complaint,
                        'Diagnosis' => $checkup->diagnosis,
                        'Prescription Image' => $checkup->documents,
                        // Add more checkup details as needed
                    ];
                }),
            ];

            // Render the Blade view to an HTML string
            $view = view('pdf.medical_record', compact('medicalRecordDetails'));
            $html = $view->render();

            // Initialize TCPDF
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // Set document information
            $pdf->SetCreator('Your Name');
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Medical Record PDF');
            $pdf->SetSubject('Medical Record');
            $pdf->SetKeywords('Medical Record, PDF');

            $pdf->AddPage();

            // Define the filename for the PDF
            $filename = str_replace(' ', '_', $medicalRecord->name) . '_Medical_Record.pdf';

            // Output the medical record details to the PDF
            $pdf->writeHTML($html, true, false, true, false, '');

            // Save or directly download the PDF
            $pdf->Output(public_path('pdfs/medical/' . $filename), 'F');


            // Return a download response
            return response()->download(public_path('pdfs/medical/' . $filename), $filename);
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred while generating the PDF');
            // Log the exception for debugging
            // Log::error('Error generating PDF: ' . $e->getMessage());
            // return response()->json(['error' => 'An error occurred while generating the PDF'], 500);
        }
    }

    public function generateFilteredMedicalRecordsPDF(Request $request)
    {
        try {
            // Extract filters from the request
            $filters = $request->input('filters', []);

            // Fetch users with their medical records based on filters
            $users = $this->fetchUsersBasedOnFilters($filters);

            if ($users->isEmpty()) {
                // If there are no users matching the filters, return an appropriate response
                return response()->json(['error' => 'No matching records found'], 404);
            }

            // Initialize TCPDF
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // Set document information
            $pdf->SetCreator('Your Name');
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Medical Records PDF');
            $pdf->SetSubject('Medical Records');
            $pdf->SetKeywords('Medical Records, PDF');

            foreach ($users as $user) {
                // Check if the user has a medical record
                if (!$user->medicalRecord) {
                    // Log::warning('User ' . $user->id . ' does not have a medical record');
                    continue;
                }

                $medicalRecord = $user->medicalRecord;
                $medicalRecordDetails = [

                    // Create an array of medical record details
                    'Name' => $medicalRecord->name,
                    'Course' => $medicalRecord->course,
                    'Strand' => $medicalRecord->strand,
                    'Year Level' => $medicalRecord->year_level,
                    'Department' => $medicalRecord->department,
                    'Address' => $medicalRecord->address,
                    'Contact Number' => $medicalRecord->contact_number,
                    'Age' => $medicalRecord->age,
                    'Gender' => $medicalRecord->gender,
                    'Civil Status' => $medicalRecord->civil_status,
                    'Contact Person' => $medicalRecord->contact_person,
                    'Contact Number' => $medicalRecord->contactPerson_number,
                    'Photo' => $medicalRecord->patient_photo,
                    'Childhood' => is_array($medicalRecord->childhood_illness) ? $medicalRecord->childhood_illness : [],
                    'Previous Hospitalization' => $medicalRecord->previous_hospitalization,
                    'Operation Surgery' => $medicalRecord->operation_surgery,
                    'Current Medications' => $medicalRecord->current_medications,
                    'Allergies' => $medicalRecord->allergies,
                    'Family History' => is_array($medicalRecord->family_history) ? $medicalRecord->family_history : [],
                    'Cigarette' => $medicalRecord->history_cigarette,
                    'Alcohol' => $medicalRecord->history_alcohol,
                    'Travel' => $medicalRecord->history_travel,
                    'Vital Signs' => $medicalRecord->vital_signs,
                    'Height' => $medicalRecord->height,
                    'HR' => $medicalRecord->hr,
                    'Weight' => $medicalRecord->weight,
                    'RR' => $medicalRecord->rr,
                    'Temp' => $medicalRecord->temp,
                    'BMI' => $medicalRecord->bmi,
                    'BP' => $medicalRecord->bp,
                    'Head' => is_array($medicalRecord->head) ? $medicalRecord->head : [],
                    'Ears' => is_array($medicalRecord->ears) ? $medicalRecord->ears : [],
                    'Eyes' => is_array($medicalRecord->eyes) ? $medicalRecord->eyes : [],
                    'Throat' => is_array($medicalRecord->throat) ? $medicalRecord->throat : [],
                    'Chest' => is_array($medicalRecord->chest) ? $medicalRecord->chest : [],
                    'X-Ray' => $medicalRecord->x_ray,
                    'Breast' => $medicalRecord->breast,
                    'Murmur' => $medicalRecord->murmur,
                    'Rhythm' => $medicalRecord->rhythm,
                    'Abdomen' => $medicalRecord->abdomen,
                    'Urinary' => $medicalRecord->geneto_urinary,
                    'Extremities' => $medicalRecord->extremities,
                    'Vertebral' => $medicalRecord->vertebral_column,
                    'Skin' => is_array($medicalRecord->skin) ? $medicalRecord->skin : [],
                    'Scars' => $medicalRecord->scars,
                    'Working Impression' => $medicalRecord->working_impression,
                    'Fit' => $medicalRecord->fit,
                    'Work' => $medicalRecord->work_up,
                    'Referred' => is_array($medicalRecord->referred_to) ? $medicalRecord->referred_to : [],
                    'Physician Name' => $medicalRecord->physician_name,
                    'Remarks' => $medicalRecord->remarks,
                    'Signature' => $medicalRecord->signature_photo_path,
                    'Follow Up' => $medicalRecord->followUp,
                    'Medical Record' => $medicalRecord->is_medical_record_complete,
                ];

                // Render the Blade view to an HTML string
                $view = view('pdf.all_medical_record', compact('medicalRecordDetails'));
                $html = $view->render();

                // Add a new page for each user's medical record
                $pdf->AddPage();

                // Output the medical record details to the PDF
                $pdf->writeHTML($html, true, false, true, false, '');
            }

            $now = now(); // Get the current date and time
            $formattedDateTime = $now->format('Ymd_His'); // Format the date and time

            $filename = $formattedDateTime . '_Medical_Report.pdf';

            // Save or directly download the combined PDF
            $pdf->Output(public_path('pdfs/medical/' . $filename), 'F');

            // Return a response indicating success and the generated filename
            return response()->json([
                'success' => true,
                'generated_pdf' => asset('pdfs/medical/' . $filename),
                'file_name' => $filename,
            ]);
        } catch (\Exception $e) {
            Alert::error('Error', 'An error occurred while generating the PDF');
             Log::error('Error generating PDF: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while generating the PDF'], 500);
        }
    }

    private function fetchUsersBasedOnFilters($filters)
    {
        // Start with a base query
        $query = User::query();

        // Apply filters based on the array
        foreach ($filters as $filter) {
            $column = $filter['column'];
            $value = $filter['value'];

            // Use switch or if conditions to handle different columns
            switch ($column) {
                case 2: // Age filter
                    $query->where('age', $value);
                    break;
                case 3: // Course or Department filter
                    $query->where(function ($query) use ($value) {
                        $query->whereExists(function ($query) use ($value) {
                            $query->select(DB::raw(1))
                                ->from('course')
                                ->whereColumn('users.course_id', 'course.id')
                                ->where('abbreviation', $value);
                        })->orWhereHas('medicalRecord', function ($query) use ($value) {
                            $query->where('department', $value);
                        });
                    });
                    break;
                case 4: // Status filter
                    $query->where('is_medical_record_complete', $value);
                    break;
                    // Add more cases for additional filters as needed
            }
        }

        // Execute the query and return the results
        return $query->with('medicalRecord')->get();
    }
}
