<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'SuperAdmin',
            'middle_name' => 'PUP',
            'last_name' => 'Clinic',
            'extension' => null,
            'user_category_id' => '2',
            'student_id' => null,
            'course_id' => null,
            'strand_id' => null,
            'year_level' => null,
            'age' => '28',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'pispupclinic@gmail.com',
            'phone_number' => '09472821587',
            'department_id' => null,
            'address' => '15 Bravo st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '1',
            'birth_day' => '1',
            'birth_year' => '1995',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '1',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('superadmin');

        User::create([
            'name' => 'Admin',
            'middle_name' => 'PUP',
            'last_name' => 'Clinic',
            'extension' => null,
            'user_category_id' => '2',
            'student_id' => null,
            'strand_id' => null,
            'year_level' => null,
            'course_id' => null,
            'age' => '28',
            'sex' => 'Male',
            'civil_tatus' => 'Single',
            'email' => 'pup_admin@gmail.com',
            'phone_number' => '09472841887',
            'department_id' => null,
            'address' => '16 Bravo st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '1',
            'birth_day' => '1',
            'birth_year' => '1995',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '2',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('admin');

        User::create([
            'name' => 'Doctor One',
            'middle_name' => 'PUP',
            'last_name' => 'Clinic',
            'extension' => null,
            'user_category_id' => '2',
            'student_id' => null,
            'course_id' => null,
            'strand_id' => null,
            'year_level' => null,
            'age' => '28',
            'sex' => 'Male',
            'civil_tatus' => 'Single',
            'email' => 'pispupdoc1@gmail.com',
            'phone_number' => '09772841887',
            'department_id' => null,
            'address' => '16 Bravo st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '1',
            'birth_day' => '1',
            'birth_year' => '1995',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '3',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('doctor');

        User::create([
            'name' => 'Nurse One',
            'middle_name' => 'PUP',
            'last_name' => 'Clinic',
            'extension' => null,
            'user_category_id' => '2',
            'student_id' => null,
            'course_id' => null,
            'strand_id' => null,
            'year_level' => null,
            'age' => '28',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'pispupnurse1@gmail.com',
            'phone_number' => '09472848887',
            'department_id' => null,
            'address' => '16 Bravo st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '1',
            'birth_day' => '1',
            'birth_year' => '1995',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '4',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('nurse');

        User::create([
            'name' => 'Doctor Two',
            'middle_name' => 'PUP',
            'last_name' => 'Clinic',
            'extension' => null,
            'user_category_id' => '2',
            'student_id' => null,
            'course_id' => null,
            'strand_id' => null,
            'year_level' => null,
            'age' => '28',
            'sex' => 'Female',
            'civil_tatus' => 'Married',
            'email' => 'pup_doctor2@gmail.com',
            'phone_number' => '09772841887',
            'department_id' => null,
            'address' => '16 Bravo st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '1',
            'birth_day' => '1',
            'birth_year' => '1995',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '3',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('doctor');

        User::create([
            'name' => 'Doctor Three',
            'middle_name' => 'PUP',
            'last_name' => 'Clinic',
            'extension' => 'Jr.',
            'user_category_id' => '2',
            'student_id' => null,
            'course_id' => null,
            'strand_id' => null,
            'year_level' => null,
            'age' => '28',
            'sex' => 'Male',
            'civil_tatus' => 'Married',
            'email' => 'pup_doctor3@gmail.com',
            'phone_number' => '09772841887',
            'department_id' => null,
            'address' => '16 Bravo st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '1',
            'birth_day' => '1',
            'birth_year' => '1995',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '3',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('doctor');

        User::create([
            'name' => 'Nurse Two',
            'middle_name' => 'PUP',
            'last_name' => 'Clinic',
            'extension' => null,
            'user_category_id' => '2',
            'student_id' => null,
            'course_id' => null,
            'strand_id' => null,
            'year_level' => null,
            'age' => '28',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'pup_nurse2@gmail.com',
            'phone_number' => '09472848887',
            'department_id' => null,
            'address' => '16 Bravo st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '1',
            'birth_day' => '1',
            'birth_year' => '1995',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '4',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('nurse');

        User::create([
            'name' => 'Nurse Three',
            'middle_name' => 'PUP',
            'last_name' => 'Clinic',
            'extension' => null,
            'user_category_id' => '2',
            'student_id' => null,
            'course_id' => null,
            'strand_id' => null,
            'year_level' => null,
            'age' => '28',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'pup_nurse3@gmail.com',
            'phone_number' => '09472848887',
            'department_id' => null,
            'address' => '16 Bravo st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '1',
            'birth_day' => '1',
            'birth_year' => '1995',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '4',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('nurse');

        $patient1 = User::create([
            'name' => 'Ma. Fidelyn',
            'middle_name' => 'Ocasion',
            'last_name' => 'Palus',
            'extension' => null,
            'user_category_id' => '1',
            'student_id' => '2020-00217-TG-0',
            'course_id' => '1',
            'strand_id' => null,
            'year_level' => '4',
            'age' => '21',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'palusma.fidelyn@yahoo.com',
            'phone_number' => '09472891137',
            'department_id' => null,
            'address' => '71 Bravo st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '8',
            'birth_day' => '26',
            'birth_year' => '2002',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient2 = User::create([
            'name' => 'Mary Cielo',
            'middle_name' => 'Contreras',
            'last_name' => 'Aguilar',
            'extension' => null,
            'user_category_id' => '1',
            'student_id' => '2020-00137-TG-0',
            'course_id' => '1',
            'strand_id' => null,
            'year_level' => '4',
            'age' => '22',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'aguilar.mrycielo@gmail.com',
            'phone_number' => '09472891132',
            'department_id' => null,
            'address' => '1 Salazar st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '11',
            'birth_day' => '16',
            'birth_year' => '2001',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient3 = User::create([
            'name' => 'Jana Enigma',
            'middle_name' => 'Sevilla',
            'last_name' => 'Baruc',
            'extension' => null,
            'user_category_id' => '1',
            'student_id' => '2020-00224-TG-0',
            'course_id' => '1',
            'strand_id' => null,
            'year_level' => '4',
            'age' => '22',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'jaebaruc@gmail.com',
            'phone_number' => '09472899874',
            'department_id' => null,
            'address' => '2 Salazar st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '11',
            'birth_day' => '13',
            'birth_year' => '2001',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient4 = User::create([
            'name' => 'Ma. Kathlene',
            'middle_name' => 'Tipay',
            'last_name' => 'Japson',
            'extension' => null,
            'user_category_id' => '1',
            'student_id' => '2020-00284-TG-0',
            'course_id' => '1',
            'strand_id' => null,
            'year_level' => '4',
            'age' => '21',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'kathlene1515@gmail.com',
            'phone_number' => '09472899810',
            'department_id' => null,
            'address' => '3 Salazar st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '02',
            'birth_day' => '15',
            'birth_year' => '2002',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient5 = User::create([
            'name' => 'Princess',
            'middle_name' => 'T',
            'last_name' => 'Villa-Villa',
            'extension' => null,
            'user_category_id' => '1',
            'student_id' => '2020-00441-TG-0',
            'course_id' => '1',
            'strand_id' => null,
            'year_level' => '4',
            'age' => '22',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'lpiiviil@gmail.com',
            'phone_number' => '09111111111',
            'department_id' => null,
            'address' => '12 Salazar st. Brgy. Central Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '09',
            'birth_day' => '20',
            'birth_year' => '2001',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient6 = User::create([
            'name' => 'Althea',
            'middle_name' => 'A',
            'last_name' => 'Dabu',
            'extension' => null,
            'user_category_id' => '1',
            'student_id' => '2020-00268-TG-0',
            'course_id' => '1',
            'strand_id' => null,
            'year_level' => '4',
            'age' => '22',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'dabu.althea@gmail.com',
            'phone_number' => '09111111489',
            'department_id' => null,
            'address' => '12 Salazar st. Brgy. Central Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '03',
            'birth_day' => '21',
            'birth_year' => '2002',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient7 = User::create([
            'name' => 'Jeric',
            'middle_name' => 'C',
            'last_name' => 'Posedio',
            'extension' => null,
            'user_category_id' => '1',
            'student_id' => '2020-00275-TG-0',
            'course_id' => '1',
            'strand_id' => null,
            'year_level' => '4',
            'age' => '22',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'jericposedio66@gmail.com',
            'phone_number' => '09111111489',
            'department_id' => null,
            'address' => '12 Salazar st. Brgy. Central Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '01',
            'birth_day' => '29',
            'birth_year' => '2002',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557737914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient8 = User::create([
            'name' => 'Jonathan',
            'middle_name' => 'A',
            'last_name' => 'Amoranto',
            'extension' => null,
            'user_category_id' => '1',
            'student_id' => '2020-00349-TG-0',
            'course_id' => '1',
            'strand_id' => null,
            'year_level' => '4',
            'age' => '21',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'jonathanamoradoamoranto@gmail.com',
            'phone_number' => '09111111489',
            'department_id' => null,
            'address' => '12 Salazar st. Brgy. Central Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '06',
            'birth_day' => '08',
            'birth_year' => '2002',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557737914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient9 = User::create([
            'name' => 'Hasmin',
            'middle_name' => 'A',
            'last_name' => 'Esah',
            'extension' => null,
            'user_category_id' => '1',
            'student_id' => '2020-00253-TG-0',
            'course_id' => '1',
            'strand_id' => null,
            'year_level' => '4',
            'age' => '21',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'hmesah19@gmail.com',
            'phone_number' => '09111111489',
            'department_id' => null,
            'address' => '12 Salazar st. Brgy. Central Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '06',
            'birth_day' => '19',
            'birth_year' => '2002',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557737914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient10 = User::create([
            'name' => 'Michael Rae',
            'middle_name' => 'A',
            'last_name' => 'Ricamata',
            'extension' => null,
            'user_category_id' => '1',
            'student_id' => '2020-00418-TG-0',
            'course_id' => '1',
            'strand_id' => null,
            'year_level' => '4',
            'age' => '21',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'michaellangpogi@gmail.com',
            'phone_number' => '09111111489',
            'department_id' => null,
            'address' => '12 Salazar st. Brgy. Central Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '03',
            'birth_day' => '01',
            'birth_year' => '2002',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557737914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient11 = User::create([
            'name' => 'Bailyn',
            'middle_name' => 'A',
            'last_name' => 'Kabib',
            'extension' => null,
            'user_category_id' => '1',
            'student_id' => '2020-00184-TG-0',
            'course_id' => '1',
            'strand_id' => null,
            'year_level' => '4',
            'age' => '22',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'bailynkabib16@gmail.com',
            'phone_number' => '09111111489',
            'department_id' => null,
            'address' => '12 Salazar st. Brgy. Central Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '10',
            'birth_day' => '18',
            'birth_year' => '2001',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557737914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient12 = User::create([
            'name' => 'Angela',
            'middle_name' => 'Perez',
            'last_name' => 'Dela Cruz',
            'extension' => null,
            'user_category_id' => '1',
            'student_id' => '2020-00123-TG-0',
            'course_id' => null,
            'strand_id' => '1',
            'year_level' => '6',
            'age' => '22',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'angeladelacruz@gmail.com',
            'phone_number' => '09111122489',
            'department_id' => null,
            'address' => '13 Salazar st. Brgy. Central Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '10',
            'birth_day' => '18',
            'birth_year' => '2001',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557737914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient13 = User::create([
            'name' => 'Faculty Tester',
            'middle_name' => 'PUP One',
            'last_name' => 'User',
            'user_category_id' => '2',
            'student_id' => null,
            'course_id' => null,
            'strand_id' => null,
            'year_level' => null,
            'age' => '33',
            'sex' => 'Female',
            'civil_tatus' => 'Single',
            'email' => 'pispupfaculty@gmail.com',
            'phone_number' => '09472891135',
            'department_id' => '2',
            'address' => '12 Salazar st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '11',
            'birth_day' => '16',
            'birth_year' => '2001',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            // 'user_type_id' => '5',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $patient14 = User::create([
            'name' => 'Faculty Tester',
            'middle_name' => 'PUP Two',
            'last_name' => 'User',
            'user_category_id' => '2',
            'student_id' => null,
            'course_id' => null,
            'strand_id' => null,
            'year_level' => null,
            'age' => '33',
            'sex' => 'Male',
            'civil_tatus' => 'Single',
            'email' => 'pispupfaculty2@gmail.com',
            'phone_number' => '09472891135',
            'department_id' => '2',
            'address' => '12 Salazar st. Brgy. Upper Signal Village Taguig City',
            'password' => Hash::make('password'),
            'birth_month' => '11',
            'birth_day' => '16',
            'birth_year' => '1990',
            'contact_person' => 'Guardian Person',
            'contact_person_number' => '095557777914',
            'is_medical_record_complete' => false,
            'profile_photo_path' => null,
        ])->assignRole('regular_user');

        $this->createMedicalRecord($patient1->id, false, 'O');
        $this->createMedicalRecord($patient2->id, false, 'A');
        $this->createMedicalRecord($patient3->id, false, 'AB');
        $this->createMedicalRecord($patient4->id, false, 'A');
        $this->createMedicalRecord($patient5->id, false, 'O');
        $this->createMedicalRecord($patient6->id, false, 'B-');
        $this->createMedicalRecord($patient7->id, true, 'O');
        $this->createMedicalRecord($patient8->id, false, 'A');
        $this->createMedicalRecord($patient9->id, false, 'O');
        $this->createMedicalRecord($patient10->id, true, 'O');
        $this->createMedicalRecord($patient11->id, false, 'RhD+');
        $this->createMedicalRecord($patient12->id, false, 'RhD-');
        $this->createMedicalRecord($patient13->id, false, 'AB');
        $this->createMedicalRecord($patient14->id, false, 'AB');
    }



    private function createMedicalRecord($userId, $isPwd, $bloodType)
    {
        $userData = User::where('id', $userId)->select('name', 'middle_name', 'last_name', 'extension')->first();
        $userStrand = User::where('users.id', $userId)->join('strand', 'users.strand_id', '=', 'strand.id')->value('strand.name');
        $userCourse = User::where('users.id', $userId)->join('course', 'users.course_id', '=', 'course.id')->value('course.course_name');
        $userYear = User::where('users.id', $userId)->join('year_level', 'users.year_level', '=', 'year_level.id')->value('year_level.name');
        $userDepartment = User::where('users.id', $userId)->join('department', 'users.department_id', '=', 'department.id')->value('department.name');
        $userAddress = User::where('id', $userId)->value('address');
        $userContactNum = User::where('id', $userId)->value('phone_number');
        $userAge = User::where('id', $userId)->value('age');
        $userGender = User::where('id', $userId)->value('sex');
        $userStatus = User::where('id', $userId)->value('civil_tatus');
        $userContactPer = User::where('id', $userId)->value('contact_person_number');
        $userContactPerson = User::where('id', $userId)->value('contact_person');
        $userPhotoPath = User::where('id', $userId)->value('profile_photo_path');

        $userName = $userData->name . ' ' . $userData->middle_name . ' ' . $userData->last_name . ' ' . $userData->extension;

        MedicalRecord::create([
            'user_id' => $userId,
            'name' => $userName,
            'strand' => $userStrand,
            'course' => $userCourse,
            'year_level' => $userYear,
            'department' => $userDepartment,
            'address' => $userAddress,
            'contact_number' => $userContactNum,
            'age' => $userAge,
            'gender' => $userGender,
            'civil_status' => $userStatus,
            'contact_person' => $userContactPerson,
            'contactPerson_number' => $userContactPer,
            'is_pwd' => $isPwd,
            'blood_type' => $bloodType,
            'patient_photo' => $userPhotoPath,
            // ... include other medical record fields
        ]);
    }
}
