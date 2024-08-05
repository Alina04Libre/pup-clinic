-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 09:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pupclinic-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `written_by` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `consent_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `concern` text NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `new_appointment_date` date DEFAULT NULL,
  `new_appointment_time` time DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `reason_for_declining` varchar(255) DEFAULT NULL,
  `reason_for_resched` varchar(255) DEFAULT NULL,
  `nurse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_attachment`
--

CREATE TABLE `appointment_attachment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `attachment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `mime_type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Mabini', NULL, NULL),
(2, 'NDC Compound', NULL, NULL),
(3, 'M.H. Del Pilar', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checkups`
--

CREATE TABLE `checkups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `prescription` varchar(255) NOT NULL,
  `disposition` varchar(255) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `documents` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consent_form`
--

CREATE TABLE `consent_form` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `guardian` varchar(255) NOT NULL,
  `guardian_relation` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `consent_agreement` text NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `abbreviation` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `abbreviation`, `created_at`, `updated_at`) VALUES
(1, 'Bachelor of Science in information Technology', 'BSIT', NULL, NULL),
(2, 'Bachelor of Science in Office Administration', 'BSOA', NULL, NULL),
(3, 'Bachelor of Public Administration', 'BPA', NULL, NULL),
(4, 'Bachelor of Science in Computer Science', 'BSCS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `abbreviation` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `abbreviation`, `created_at`, `updated_at`) VALUES
(1, 'College of Accountancy and Finance', 'CAF', NULL, NULL),
(2, 'College of Business Administration', 'CBA', NULL, NULL),
(3, 'College of Political Science and Public Administration', 'CPSPA', NULL, NULL),
(4, 'College of Computer and Information Sciences', 'CCIS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenances`
--

CREATE TABLE `maintenances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`list`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `course` varchar(255) DEFAULT NULL,
  `strand` varchar(255) DEFAULT NULL,
  `year_level` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contactPerson_number` varchar(255) NOT NULL,
  `blood_type` varchar(255) DEFAULT NULL,
  `is_pwd` tinyint(1) DEFAULT NULL,
  `patient_photo` varchar(2048) DEFAULT NULL,
  `childhood_illness` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`childhood_illness`)),
  `childhood_illness_specify` varchar(255) DEFAULT NULL,
  `previous_hospitalization` varchar(255) DEFAULT NULL,
  `operation_surgery` varchar(255) DEFAULT NULL,
  `current_medications` varchar(255) DEFAULT NULL,
  `allergies` varchar(255) DEFAULT NULL,
  `family_history` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`family_history`)),
  `family_history_specify` varchar(255) DEFAULT NULL,
  `history_cigarette` varchar(255) DEFAULT NULL,
  `history_alcohol` varchar(255) DEFAULT NULL,
  `history_travel` varchar(255) DEFAULT NULL,
  `vital_signs` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `hr` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `rr` varchar(255) DEFAULT NULL,
  `temp` varchar(255) DEFAULT NULL,
  `bmi` varchar(255) DEFAULT NULL,
  `bp` varchar(255) DEFAULT NULL,
  `head` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`head`)),
  `ears` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ears`)),
  `eyes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`eyes`)),
  `throat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`throat`)),
  `chest` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`chest`)),
  `x_ray` varchar(255) DEFAULT NULL,
  `breast` varchar(255) DEFAULT NULL,
  `murmur` varchar(255) DEFAULT NULL,
  `rhythm` varchar(255) DEFAULT NULL,
  `abdomen` varchar(255) DEFAULT NULL,
  `geneto_urinary` varchar(255) DEFAULT NULL,
  `extremities` varchar(255) DEFAULT NULL,
  `vertebral_column` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`vertebral_column`)),
  `skin` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skin`)),
  `scars` varchar(255) DEFAULT NULL,
  `working_impression` varchar(255) DEFAULT NULL,
  `fit` varchar(255) DEFAULT NULL,
  `work_up` varchar(255) DEFAULT NULL,
  `referred_to` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`referred_to`)),
  `referred_to_others` varchar(255) DEFAULT NULL,
  `physician_name` varchar(255) DEFAULT NULL,
  `nurse_name` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `signature_photo_path` varchar(2048) DEFAULT NULL,
  `followUp` date DEFAULT NULL,
  `is_medical_record_complete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medical_records`
--

INSERT INTO `medical_records` (`id`, `user_id`, `name`, `course`, `strand`, `year_level`, `department`, `address`, `contact_number`, `age`, `gender`, `civil_status`, `contact_person`, `contactPerson_number`, `blood_type`, `is_pwd`, `patient_photo`, `childhood_illness`, `childhood_illness_specify`, `previous_hospitalization`, `operation_surgery`, `current_medications`, `allergies`, `family_history`, `family_history_specify`, `history_cigarette`, `history_alcohol`, `history_travel`, `vital_signs`, `height`, `hr`, `weight`, `rr`, `temp`, `bmi`, `bp`, `head`, `ears`, `eyes`, `throat`, `chest`, `x_ray`, `breast`, `murmur`, `rhythm`, `abdomen`, `geneto_urinary`, `extremities`, `vertebral_column`, `skin`, `scars`, `working_impression`, `fit`, `work_up`, `referred_to`, `referred_to_others`, `physician_name`, `nurse_name`, `remarks`, `signature_photo_path`, `followUp`, `is_medical_record_complete`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 'Ma. Fidelyn Ocasion Palus ', 'Bachelor of Science in information Technology', NULL, 'Fourth Year', NULL, '71 Bravo st. Brgy. Upper Signal Village Taguig City', '09472891137', '21', 'Female', 'Single', 'Guardian Person', '095557777914', 'O', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL),
(2, 10, 'Mary Cielo Contreras Aguilar ', 'Bachelor of Science in information Technology', NULL, 'Fourth Year', NULL, '1 Salazar st. Brgy. Upper Signal Village Taguig City', '09472891132', '22', 'Female', 'Single', 'Guardian Person', '095557777914', 'A', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL),
(3, 11, 'Jana Enigma Sevilla Baruc ', 'Bachelor of Science in information Technology', NULL, 'Fourth Year', NULL, '2 Salazar st. Brgy. Upper Signal Village Taguig City', '09472899874', '22', 'Female', 'Single', 'Guardian Person', '095557777914', 'AB', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL),
(4, 12, 'Ma. Kathlene Tipay Japson ', 'Bachelor of Science in information Technology', NULL, 'Fourth Year', NULL, '3 Salazar st. Brgy. Upper Signal Village Taguig City', '09472899810', '21', 'Female', 'Single', 'Guardian Person', '095557777914', 'A', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL),
(5, 13, 'Princess T Villa-Villa ', 'Bachelor of Science in information Technology', NULL, 'Fourth Year', NULL, '12 Salazar st. Brgy. Central Signal Village Taguig City', '09111111111', '22', 'Female', 'Single', 'Guardian Person', '095557777914', 'O', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL),
(6, 14, 'Althea A Dabu ', 'Bachelor of Science in information Technology', NULL, 'Fourth Year', NULL, '12 Salazar st. Brgy. Central Signal Village Taguig City', '09111111489', '22', 'Female', 'Single', 'Guardian Person', '095557777914', 'B-', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL),
(7, 15, 'Jeric C Posedio ', 'Bachelor of Science in information Technology', NULL, 'Fourth Year', NULL, '12 Salazar st. Brgy. Central Signal Village Taguig City', '09111111489', '22', 'Female', 'Single', 'Guardian Person', '095557737914', 'O', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL),
(8, 16, 'Jonathan A Amoranto ', 'Bachelor of Science in information Technology', NULL, 'Fourth Year', NULL, '12 Salazar st. Brgy. Central Signal Village Taguig City', '09111111489', '21', 'Female', 'Single', 'Guardian Person', '095557737914', 'A', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL),
(9, 17, 'Hasmin A Esah ', 'Bachelor of Science in information Technology', NULL, 'Fourth Year', NULL, '12 Salazar st. Brgy. Central Signal Village Taguig City', '09111111489', '21', 'Female', 'Single', 'Guardian Person', '095557737914', 'O', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL),
(10, 18, 'Michael Rae A Ricamata ', 'Bachelor of Science in information Technology', NULL, 'Fourth Year', NULL, '12 Salazar st. Brgy. Central Signal Village Taguig City', '09111111489', '21', 'Female', 'Single', 'Guardian Person', '095557737914', 'O', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL),
(11, 19, 'Bailyn A Kabib ', 'Bachelor of Science in information Technology', NULL, 'Fourth Year', NULL, '12 Salazar st. Brgy. Central Signal Village Taguig City', '09111111489', '22', 'Female', 'Single', 'Guardian Person', '095557737914', 'RhD+', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL),
(12, 20, 'Angela Perez Dela Cruz ', NULL, 'Science, Technology, Engineering and Mathematics', 'Grade 11', NULL, '13 Salazar st. Brgy. Central Signal Village Taguig City', '09111122489', '22', 'Female', 'Single', 'Guardian Person', '095557737914', 'RhD-', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:23', '2024-05-23 09:24:23', NULL),
(13, 21, 'Faculty Tester PUP One User ', NULL, NULL, NULL, 'College of Business Administration', '12 Salazar st. Brgy. Upper Signal Village Taguig City', '09472891135', '33', 'Female', 'Single', 'Guardian Person', '095557777914', 'AB', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:23', '2024-05-23 09:24:23', NULL),
(14, 22, 'Faculty Tester PUP Two User ', NULL, NULL, NULL, 'College of Business Administration', '12 Salazar st. Brgy. Upper Signal Village Taguig City', '09472891135', '33', 'Male', 'Single', 'Guardian Person', '095557777914', 'AB', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:24:23', '2024-05-23 09:24:23', NULL),
(15, 23, 'Allysa L Naomie', NULL, NULL, NULL, 'College of Accountancy and Finance', 'taguig', '12345678', '23', 'Female', 'Divorced', 'jfdsaj', '123456', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:30:03', '2024-05-23 09:30:03', NULL),
(16, 24, 'Kurdapya C Allysa', NULL, NULL, NULL, 'College of Political Science and Public Administration', 'test', '12345', '18', 'Female', 'Divorced', 'sbdfa', '234567', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:38:18', '2024-05-23 09:38:18', NULL),
(17, 25, 'tel a bal', NULL, NULL, NULL, 'College of Business Administration', 'test', '2131', '10', 'Female', 'Single', 'test', '2131', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:45:05', '2024-05-23 09:45:05', NULL),
(18, 26, 'Vinz L. Mera', NULL, NULL, NULL, 'College of Accountancy and Finance', 'test', '23421', '5', 'Male', 'Single', 'fdsaf', 'e234', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 09:47:26', '2024-05-23 09:47:26', NULL),
(19, 27, 'Callie S Res', NULL, NULL, NULL, 'College of Business Administration', 'test', '12444323', '17', 'Female', 'Single', 'fsdadfs', '1323', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-23 14:13:10', '2024-05-23 14:13:10', NULL),
(20, 28, 'Moham A Mad', 'Bachelor of Science in information Technology', NULL, 'Third Year', NULL, 'test', '46546', '21', 'Male', 'Single', 'Henry Sy', '1234', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-24 02:16:17', '2024-05-24 02:16:17', NULL),
(21, 29, 'Vinz L Merano', NULL, NULL, NULL, 'College of Accountancy and Finance', 'sucat', '091546351352', '15', 'Male', 'Single', 'Vnz', '8465', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-05-24 07:02:49', '2024-05-24 07:02:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_08_25_164535_create_course_table', 1),
(2, '2013_08_27_154149_create_department_table', 1),
(3, '2013_1_12_000000_create_user_category_table', 1),
(4, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2022_08_27_151724_create_branch_table', 1),
(9, '2023_06_12_142645_create_school_year_table', 1),
(10, '2023_06_12_144511_create_strand_table', 1),
(11, '2023_08_27_143257_create_satelite_table', 1),
(12, '2023_08_29_021128_create_permission_tables', 1),
(13, '2023_08_31_100831_create_maintenances_table', 1),
(14, '2023_09_22_011055_create_year_level_table', 1),
(15, '2023_10_13_180206_create_sessions_table', 1),
(16, '2023_10_28_083743_create_users_table', 1),
(17, '2023_10_30_154913_create_appointments_table', 1),
(18, '2023_10_31_223404_create_attachments_table', 1),
(19, '2023_10_31_224237_create_appointment_attachment_table', 1),
(20, '2023_11_01_131356_create_schedule_assignments_table', 1),
(21, '2023_11_03_170356_create_announcements_table', 1),
(22, '2023_11_22_010515_create_medical_records_table', 1),
(23, '2023_11_22_034507_create_checkups_table', 1),
(24, '2023_11_30_112119_create_walk_in_checkups', 1),
(25, '2024_05_08_000643_create_verification_tokens_table', 1),
(26, '2024_05_14_151619_create_consent_form_table', 1),
(27, '2024_05_24_999999_add_active_status_to_users', 2),
(28, '2024_05_24_999999_add_avatar_to_users', 2),
(29, '2024_05_24_999999_add_dark_mode_to_users', 2),
(30, '2024_05_24_999999_add_messenger_color_to_users', 2),
(31, '2024_05_24_999999_create_chatify_favorites_table', 2),
(32, '2024_05_24_999999_create_chatify_messages_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 9),
(5, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 11),
(5, 'App\\Models\\User', 12),
(5, 'App\\Models\\User', 13),
(5, 'App\\Models\\User', 14),
(5, 'App\\Models\\User', 15),
(5, 'App\\Models\\User', 16),
(5, 'App\\Models\\User', 17),
(5, 'App\\Models\\User', 18),
(5, 'App\\Models\\User', 19),
(5, 'App\\Models\\User', 20),
(5, 'App\\Models\\User', 21),
(5, 'App\\Models\\User', 22),
(5, 'App\\Models\\User', 23),
(5, 'App\\Models\\User', 24),
(5, 'App\\Models\\User', 25),
(5, 'App\\Models\\User', 26),
(5, 'App\\Models\\User', 27),
(5, 'App\\Models\\User', 28),
(5, 'App\\Models\\User', 29);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view-medical-records', 'web', '2024-05-23 09:27:02', '2024-05-23 09:27:02'),
(2, 'edit-medical-records', 'web', '2024-05-23 09:27:02', '2024-05-23 09:27:02'),
(3, 'view-dashboard', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(4, 'make-announcements', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(5, 'edit-announcements', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(6, 'make-healthform', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(7, 'view-checkups', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(8, 'doctor-checkups', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(9, 'manage-pending-appointments', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(10, 'nurse-pending-appointments', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(11, 'doctor-pending-appointments', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(12, 'nurse-history-appointments', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(13, 'doctor-history-appointments', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(14, 'view-appointments', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(15, 'view-appointment-history', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(16, 'manage-roles-and-permissions', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(17, 'manage-staff-schedule', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(18, 'manage-users', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(19, 'access-maintenance', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(20, 'nurse-checkups', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(21, 'nurse-all-checkups', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(22, 'doctor-all-checkups', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(23, 'all-checkups', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03'),
(24, 'staff-dashboard', 'web', '2024-05-23 09:27:03', '2024-05-23 09:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2024-05-23 09:22:33', '2024-05-23 09:22:33'),
(2, 'admin', 'web', '2024-05-23 09:22:33', '2024-05-23 09:22:33'),
(3, 'doctor', 'web', '2024-05-23 09:22:33', '2024-05-23 09:22:33'),
(4, 'nurse', 'web', '2024-05-23 09:22:33', '2024-05-23 09:22:33'),
(5, 'regular_user', 'web', '2024-05-23 09:22:33', '2024-05-23 09:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(2, 1),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(7, 1),
(8, 3),
(9, 1),
(9, 2),
(10, 4),
(11, 3),
(12, 4),
(13, 3),
(14, 1),
(15, 1),
(15, 2),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 4),
(21, 4),
(22, 3),
(23, 1),
(24, 3),
(24, 4);

-- --------------------------------------------------------

--
-- Table structure for table `satelite`
--

CREATE TABLE `satelite` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satelite`
--

INSERT INTO `satelite` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'MAIN', NULL, NULL),
(2, 'CEA', NULL, NULL),
(3, 'ITECH', NULL, NULL),
(4, 'COC', NULL, NULL),
(5, 'HASMIN', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_assignments`
--

CREATE TABLE `schedule_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nurse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `satellite` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '2020-2021', NULL, NULL),
(2, '2021-2022', NULL, NULL),
(3, '2022-2023', NULL, NULL),
(4, '2023-2024', NULL, NULL),
(5, '2024-2025', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `strand`
--

CREATE TABLE `strand` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `abbreviation` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `strand`
--

INSERT INTO `strand` (`id`, `name`, `abbreviation`, `created_at`, `updated_at`) VALUES
(1, 'Science, Technology, Engineering and Mathematics', 'STEM', NULL, NULL),
(2, 'Accountancy, Business and Management Strand', 'ABM', NULL, NULL),
(3, 'Humanities and Social Sciences Strand', 'HUMSS', NULL, NULL),
(4, 'Information Communications Technology', 'ICT', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `extension` varchar(255) DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `user_category_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `age` smallint(5) UNSIGNED NOT NULL,
  `birth_month` tinyint(3) UNSIGNED NOT NULL,
  `birth_day` tinyint(3) UNSIGNED NOT NULL,
  `birth_year` smallint(5) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `strand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `year_level` bigint(20) UNSIGNED DEFAULT NULL,
  `sex` varchar(255) NOT NULL,
  `civil_tatus` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contact_person_number` varchar(255) NOT NULL,
  `is_medical_record_complete` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `messenger_color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `middle_name`, `last_name`, `extension`, `student_id`, `user_category_id`, `department_id`, `age`, `birth_month`, `birth_day`, `birth_year`, `course_id`, `strand_id`, `year_level`, `sex`, `civil_tatus`, `email`, `password`, `email_verified_at`, `phone_number`, `address`, `contact_person`, `contact_person_number`, `is_medical_record_complete`, `remember_token`, `profile_photo_path`, `created_at`, `updated_at`, `deleted_at`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(1, 'SuperAdmin', 'PUP', 'Clinic', NULL, NULL, 2, NULL, 28, 1, 1, 1995, NULL, NULL, NULL, 'Female', 'Single', 'pispupclinic@gmail.com', '$2y$10$cTgbtw3GOYYl2eHrlsOtMOo2LFVenDW3c0qIWeck4iZ89qBnkweoG', NULL, '09472821587', '15 Bravo st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(2, 'Admin', 'PUP', 'Clinic', NULL, NULL, 2, NULL, 28, 1, 1, 1995, NULL, NULL, NULL, 'Male', 'Single', 'pup_admin@gmail.com', '$2y$10$FwSzjE1tFC3Lf1SGczPyQuwhM1hKfMqiUhjtCJN2GLXQxsE45MQea', NULL, '09472841887', '16 Bravo st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(3, 'Doctor One', 'PUP', 'Clinic', NULL, NULL, 2, NULL, 28, 1, 1, 1995, NULL, NULL, NULL, 'Male', 'Single', 'pispupdoc1@gmail.com', '$2y$10$ALpnBhqnHFlDRK5pKfL2LeZi90MG7iALmOThmp1BzXanfNUmqBjhS', NULL, '09772841887', '16 Bravo st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(4, 'Nurse One', 'PUP', 'Clinic', NULL, NULL, 2, NULL, 28, 1, 1, 1995, NULL, NULL, NULL, 'Female', 'Single', 'pispupnurse1@gmail.com', '$2y$10$4cffi54utYyr0esLOPovAeeU2BJc3.4.M7TqD98hFReyI5Hyzs6GO', NULL, '09472848887', '16 Bravo st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(5, 'Doctor Two', 'PUP', 'Clinic', NULL, NULL, 2, NULL, 28, 1, 1, 1995, NULL, NULL, NULL, 'Female', 'Married', 'pup_doctor2@gmail.com', '$2y$10$O9DDmvwytRPC9Mh23BVbiO6oeh0dJrnRO1hXVj.NXyonpJl3LBOyO', NULL, '09772841887', '16 Bravo st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(6, 'Doctor Three', 'PUP', 'Clinic', 'Jr.', NULL, 2, NULL, 28, 1, 1, 1995, NULL, NULL, NULL, 'Male', 'Married', 'pup_doctor3@gmail.com', '$2y$10$j/s5epw.vbgRshBAFwN5oenbFd651ulmcK9NN4VHgfNGBUrd7bVCO', NULL, '09772841887', '16 Bravo st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(7, 'Nurse Two', 'PUP', 'Clinic', NULL, NULL, 2, NULL, 28, 1, 1, 1995, NULL, NULL, NULL, 'Female', 'Single', 'pup_nurse2@gmail.com', '$2y$10$16WzszoWlny/cX6Jtr6U/.C77eb/Tr2fvx6w5rmthzdskqkImLGF6', NULL, '09472848887', '16 Bravo st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(8, 'Nurse Three', 'PUP', 'Clinic', NULL, NULL, 2, NULL, 28, 1, 1, 1995, NULL, NULL, NULL, 'Female', 'Single', 'pup_nurse3@gmail.com', '$2y$10$xwJ2AN4h7JVY0JZPaHIxkepQ8vEBHrIdzMCHv43VYU4CHYVMxwBFa', NULL, '09472848887', '16 Bravo st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(9, 'Ma. Fidelyn', 'Ocasion', 'Palus', NULL, '2020-00217-TG-0', 1, NULL, 21, 8, 26, 2002, 1, NULL, 4, 'Female', 'Single', 'palusma.fidelyn@yahoo.com', '$2y$10$19FZPKujoZqKsCnpTSeCDORSp0o3SjUTWHL6arfXrHb3w9JsIFy2W', NULL, '09472891137', '71 Bravo st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(10, 'Mary Cielo', 'Contreras', 'Aguilar', NULL, '2020-00137-TG-0', 1, NULL, 22, 11, 16, 2001, 1, NULL, 4, 'Female', 'Single', 'aguilar.mrycielo@gmail.com', '$2y$10$APhzV93MQOlB5ufRUUpFe.9Y3Db7HdmFyw.ERvgVvZ1tXMvREx/u.', NULL, '09472891132', '1 Salazar st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(11, 'Jana Enigma', 'Sevilla', 'Baruc', NULL, '2020-00224-TG-0', 1, NULL, 22, 11, 13, 2001, 1, NULL, 4, 'Female', 'Single', 'jaebaruc@gmail.com', '$2y$10$mhegA7j53qOmCc9evDWCC.TINMWwJ.UJ9.GXWX3KrQorknJfeeF3G', NULL, '09472899874', '2 Salazar st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(12, 'Ma. Kathlene', 'Tipay', 'Japson', NULL, '2020-00284-TG-0', 1, NULL, 21, 2, 15, 2002, 1, NULL, 4, 'Female', 'Single', 'kathlene1515@gmail.com', '$2y$10$ZRXTikehavPGY19BBK3fDOyHte/wbQTtgjmpRDD9/Jhc.QIroQt4.', NULL, '09472899810', '3 Salazar st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(13, 'Princess', 'T', 'Villa-Villa', NULL, '2020-00441-TG-0', 1, NULL, 22, 9, 20, 2001, 1, NULL, 4, 'Female', 'Single', 'lpiiviil@gmail.com', '$2y$10$BkyUBA/YFEylY8mjk/yTRearl.tlyEJouddjGQpZLT1zhVbPL0z7m', NULL, '09111111111', '12 Salazar st. Brgy. Central Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(14, 'Althea', 'A', 'Dabu', NULL, '2020-00268-TG-0', 1, NULL, 22, 3, 21, 2002, 1, NULL, 4, 'Female', 'Single', 'dabu.althea@gmail.com', '$2y$10$H6QNB1KVltKlMPZyzkEwOOFLT0ssCWxAE0pAeic6.P03NsYmhyp0K', NULL, '09111111489', '12 Salazar st. Brgy. Central Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:21', '2024-05-23 09:24:21', NULL, 0, 'avatar.png', 0, NULL),
(15, 'Jeric', 'C', 'Posedio', NULL, '2020-00275-TG-0', 1, NULL, 22, 1, 29, 2002, 1, NULL, 4, 'Female', 'Single', 'jericposedio66@gmail.com', '$2y$10$7AyODpovXDNp9jOTzGR86eVjHIeU/7QyKG2qjVnSMgP2DXxHKSWA6', NULL, '09111111489', '12 Salazar st. Brgy. Central Signal Village Taguig City', 'Guardian Person', '095557737914', 0, NULL, NULL, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL, 0, 'avatar.png', 0, NULL),
(16, 'Jonathan', 'A', 'Amoranto', NULL, '2020-00349-TG-0', 1, NULL, 21, 6, 8, 2002, 1, NULL, 4, 'Female', 'Single', 'jonathanamoradoamoranto@gmail.com', '$2y$10$yLSDIaq5R9O0qK48iQmMnO.1CKuhNmF7xHSQvYr8fYbXPYCSAVNjC', NULL, '09111111489', '12 Salazar st. Brgy. Central Signal Village Taguig City', 'Guardian Person', '095557737914', 0, NULL, NULL, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL, 0, 'avatar.png', 0, NULL),
(17, 'Hasmin', 'A', 'Esah', NULL, '2020-00253-TG-0', 1, NULL, 21, 6, 19, 2002, 1, NULL, 4, 'Female', 'Single', 'hmesah19@gmail.com', '$2y$10$3BecxhwTzoISQUnfbNNqb.QMgq17fq8U3h/ufZ1IWl.LKJHhRqGrq', NULL, '09111111489', '12 Salazar st. Brgy. Central Signal Village Taguig City', 'Guardian Person', '095557737914', 0, NULL, NULL, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL, 0, 'avatar.png', 0, NULL),
(18, 'Michael Rae', 'A', 'Ricamata', NULL, '2020-00418-TG-0', 1, NULL, 21, 3, 1, 2002, 1, NULL, 4, 'Female', 'Single', 'michaellangpogi@gmail.com', '$2y$10$vxWG/8rCuiEmC7C7.Sx00ONQNXF/pApuwRrpsXeo/xLC.IEAzCroy', NULL, '09111111489', '12 Salazar st. Brgy. Central Signal Village Taguig City', 'Guardian Person', '095557737914', 0, NULL, NULL, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL, 0, 'avatar.png', 0, NULL),
(19, 'Bailyn', 'A', 'Kabib', NULL, '2020-00184-TG-0', 1, NULL, 22, 10, 18, 2001, 1, NULL, 4, 'Female', 'Single', 'bailynkabib16@gmail.com', '$2y$10$Gtdkx.ob3ZeodwqfEqkFXOHWDMyfKayw2M2yZmIkWN2x/D.ZUs9Y.', NULL, '09111111489', '12 Salazar st. Brgy. Central Signal Village Taguig City', 'Guardian Person', '095557737914', 0, NULL, NULL, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL, 0, 'avatar.png', 0, NULL),
(20, 'Angela', 'Perez', 'Dela Cruz', NULL, '2020-00123-TG-0', 1, NULL, 22, 10, 18, 2001, NULL, 1, 6, 'Female', 'Single', 'angeladelacruz@gmail.com', '$2y$10$/shgQXVC5bFKduoNfsGonOd9SFkgnd8jabKTKNCPm09LQd5tZ9rD2', NULL, '09111122489', '13 Salazar st. Brgy. Central Signal Village Taguig City', 'Guardian Person', '095557737914', 0, NULL, NULL, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL, 0, 'avatar.png', 0, NULL),
(21, 'Faculty Tester', 'PUP One', 'User', NULL, NULL, 2, 2, 33, 11, 16, 2001, NULL, NULL, NULL, 'Female', 'Single', 'pispupfaculty@gmail.com', '$2y$10$Ipqem.Mzjbx5IMuHHrW0/ur./pLuGBlLnjqGi0hnJwNWmYSYdT36C', NULL, '09472891135', '12 Salazar st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL, 0, 'avatar.png', 0, NULL),
(22, 'Faculty Tester', 'PUP Two', 'User', NULL, NULL, 2, 2, 33, 11, 16, 1990, NULL, NULL, NULL, 'Male', 'Single', 'pispupfaculty2@gmail.com', '$2y$10$Ks98echLUTSJXQgmzKdnL.heRBJuCYrDnwd4c.JjHFLR.frAh5bOi', NULL, '09472891135', '12 Salazar st. Brgy. Upper Signal Village Taguig City', 'Guardian Person', '095557777914', 0, NULL, NULL, '2024-05-23 09:24:22', '2024-05-23 09:24:22', NULL, 0, 'avatar.png', 0, NULL),
(29, 'Vinz', 'L', 'Merano', NULL, NULL, 2, 1, 15, 6, 24, 2013, NULL, NULL, NULL, 'Male', 'Single', 'beingalvinmerano@gmail.com', '$2y$10$SmHQocWa.C/AM9pv.cjLxeokNUwdhZzcMD2q9ZGajUsOYroodLrzK', '2024-05-24 07:03:07', '091546351352', 'sucat', 'Vnz', '8465', 0, NULL, NULL, '2024-05-24 07:02:49', '2024-05-24 07:04:45', NULL, 0, 'avatar.png', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE `user_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Student', NULL, NULL),
(2, 'Faculty', NULL, NULL),
(3, 'Employee', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `verification_tokens`
--

CREATE TABLE `verification_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(512) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `walk_in_checkups`
--

CREATE TABLE `walk_in_checkups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nurse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `prescription` varchar(255) NOT NULL,
  `complaint` varchar(255) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `documents` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `year_level`
--

CREATE TABLE `year_level` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `year_level`
--

INSERT INTO `year_level` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'First Year', NULL, NULL),
(2, 'Second Year', NULL, NULL),
(3, 'Third Year', NULL, NULL),
(4, 'Fourth Year', NULL, NULL),
(5, 'Fifth Year', NULL, NULL),
(6, 'Grade 11', NULL, NULL),
(7, 'Grade 12', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appointments_unique_id_unique` (`unique_id`),
  ADD KEY `appointments_user_id_foreign` (`user_id`),
  ADD KEY `appointments_nurse_id_foreign` (`nurse_id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `appointment_attachment`
--
ALTER TABLE `appointment_attachment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_attachment_appointment_id_foreign` (`appointment_id`),
  ADD KEY `appointment_attachment_attachment_id_foreign` (`attachment_id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_appointment_id_foreign` (`appointment_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkups`
--
ALTER TABLE `checkups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkups_appointment_id_foreign` (`appointment_id`);

--
-- Indexes for table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consent_form`
--
ALTER TABLE `consent_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consent_form_appointment_id_foreign` (`appointment_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medical_records_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `satelite`
--
ALTER TABLE `satelite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_assignments`
--
ALTER TABLE `schedule_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_assignments_doctor_id_foreign` (`doctor_id`),
  ADD KEY `schedule_assignments_nurse_id_foreign` (`nurse_id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `strand`
--
ALTER TABLE `strand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_student_id_unique` (`student_id`),
  ADD KEY `users_user_category_id_foreign` (`user_category_id`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_course_id_foreign` (`course_id`),
  ADD KEY `users_strand_id_foreign` (`strand_id`),
  ADD KEY `users_year_level_foreign` (`year_level`);

--
-- Indexes for table `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification_tokens`
--
ALTER TABLE `verification_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verification_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `walk_in_checkups`
--
ALTER TABLE `walk_in_checkups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `walk_in_checkups_patient_id_foreign` (`patient_id`),
  ADD KEY `walk_in_checkups_doctor_id_foreign` (`doctor_id`),
  ADD KEY `walk_in_checkups_nurse_id_foreign` (`nurse_id`);

--
-- Indexes for table `year_level`
--
ALTER TABLE `year_level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointment_attachment`
--
ALTER TABLE `appointment_attachment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `checkups`
--
ALTER TABLE `checkups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consent_form`
--
ALTER TABLE `consent_form`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `satelite`
--
ALTER TABLE `satelite`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule_assignments`
--
ALTER TABLE `schedule_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `strand`
--
ALTER TABLE `strand`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_category`
--
ALTER TABLE `user_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `verification_tokens`
--
ALTER TABLE `verification_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `walk_in_checkups`
--
ALTER TABLE `walk_in_checkups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `year_level`
--
ALTER TABLE `year_level`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_nurse_id_foreign` FOREIGN KEY (`nurse_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `appointment_attachment`
--
ALTER TABLE `appointment_attachment`
  ADD CONSTRAINT `appointment_attachment_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointment_attachment_attachment_id_foreign` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `checkups`
--
ALTER TABLE `checkups`
  ADD CONSTRAINT `checkups_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `consent_form`
--
ALTER TABLE `consent_form`
  ADD CONSTRAINT `consent_form_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `medical_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedule_assignments`
--
ALTER TABLE `schedule_assignments`
  ADD CONSTRAINT `schedule_assignments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedule_assignments_nurse_id_foreign` FOREIGN KEY (`nurse_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `users_strand_id_foreign` FOREIGN KEY (`strand_id`) REFERENCES `strand` (`id`),
  ADD CONSTRAINT `users_user_category_id_foreign` FOREIGN KEY (`user_category_id`) REFERENCES `user_category` (`id`),
  ADD CONSTRAINT `users_year_level_foreign` FOREIGN KEY (`year_level`) REFERENCES `year_level` (`id`);

--
-- Constraints for table `verification_tokens`
--
ALTER TABLE `verification_tokens`
  ADD CONSTRAINT `verification_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `walk_in_checkups`
--
ALTER TABLE `walk_in_checkups`
  ADD CONSTRAINT `walk_in_checkups_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `walk_in_checkups_nurse_id_foreign` FOREIGN KEY (`nurse_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `walk_in_checkups_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
