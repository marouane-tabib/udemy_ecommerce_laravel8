-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2022 at 05:08 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `udemy_ecommerce`
--

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`) VALUES
(1, 'Afghanistan', 0),
(2, 'Aland Islands', 0),
(3, 'Albania', 0),
(4, 'Algeria', 0),
(5, 'American Samoa', 0),
(6, 'Andorra', 0),
(7, 'Angola', 0),
(8, 'Anguilla', 0),
(9, 'Antarctica', 0),
(10, 'Antigua And Barbuda', 0),
(11, 'Argentina', 0),
(12, 'Armenia', 0),
(13, 'Aruba', 0),
(14, 'Australia', 0),
(15, 'Austria', 0),
(16, 'Azerbaijan', 0),
(17, 'The Bahamas', 0),
(18, 'Bahrain', 0),
(19, 'Bangladesh', 0),
(20, 'Barbados', 0),
(21, 'Belarus', 0),
(22, 'Belgium', 0),
(23, 'Belize', 0),
(24, 'Benin', 0),
(25, 'Bermuda', 0),
(26, 'Bhutan', 0),
(27, 'Bolivia', 0),
(28, 'Bosnia and Herzegovina', 0),
(29, 'Botswana', 0),
(30, 'Bouvet Island', 0),
(31, 'Brazil', 0),
(32, 'British Indian Ocean Territory', 0),
(33, 'Brunei', 0),
(34, 'Bulgaria', 0),
(35, 'Burkina Faso', 0),
(36, 'Burundi', 0),
(37, 'Cambodia', 0),
(38, 'Cameroon', 0),
(39, 'Canada', 0),
(40, 'Cape Verde', 0),
(41, 'Cayman Islands', 0),
(42, 'Central African Republic', 0),
(43, 'Chad', 0),
(44, 'Chile', 0),
(45, 'China', 0),
(46, 'Christmas Island', 0),
(47, 'Cocos (Keeling) Islands', 0),
(48, 'Colombia', 0),
(49, 'Comoros', 0),
(50, 'Congo', 0),
(51, 'Democratic Republic of the Congo', 0),
(52, 'Cook Islands', 0),
(53, 'Costa Rica', 0),
(54, 'Cote D\'Ivoire (Ivory Coast)', 0),
(55, 'Croatia', 0),
(56, 'Cuba', 0),
(57, 'Cyprus', 0),
(58, 'Czech Republic', 0),
(59, 'Denmark', 0),
(60, 'Djibouti', 0),
(61, 'Dominica', 0),
(62, 'Dominican Republic', 0),
(63, 'East Timor', 0),
(64, 'Ecuador', 0),
(65, 'Egypt', 0),
(66, 'El Salvador', 0),
(67, 'Equatorial Guinea', 0),
(68, 'Eritrea', 0),
(69, 'Estonia', 0),
(70, 'Ethiopia', 0),
(71, 'Falkland Islands', 0),
(72, 'Faroe Islands', 0),
(73, 'Fiji Islands', 0),
(74, 'Finland', 0),
(75, 'France', 0),
(76, 'French Guiana', 0),
(77, 'French Polynesia', 0),
(78, 'French Southern Territories', 0),
(79, 'Gabon', 0),
(80, 'Gambia The', 0),
(81, 'Georgia', 0),
(82, 'Germany', 0),
(83, 'Ghana', 0),
(84, 'Gibraltar', 0),
(85, 'Greece', 0),
(86, 'Greenland', 0),
(87, 'Grenada', 0),
(88, 'Guadeloupe', 0),
(89, 'Guam', 0),
(90, 'Guatemala', 0),
(91, 'Guernsey and Alderney', 0),
(92, 'Guinea', 0),
(93, 'Guinea-Bissau', 0),
(94, 'Guyana', 0),
(95, 'Haiti', 0),
(96, 'Heard Island and McDonald Islands', 0),
(97, 'Honduras', 0),
(98, 'Hong Kong S.A.R.', 0),
(99, 'Hungary', 0),
(100, 'Iceland', 0),
(101, 'India', 0),
(102, 'Indonesia', 0),
(103, 'Iran', 0),
(104, 'Iraq', 0),
(105, 'Ireland', 0),
(106, 'Israel', 0),
(107, 'Italy', 0),
(108, 'Jamaica', 0),
(109, 'Japan', 0),
(110, 'Jersey', 0),
(111, 'Jordan', 0),
(112, 'Kazakhstan', 0),
(113, 'Kenya', 0),
(114, 'Kiribati', 0),
(115, 'North Korea', 0),
(116, 'South Korea', 0),
(117, 'Kuwait', 0),
(118, 'Kyrgyzstan', 0),
(119, 'Laos', 0),
(120, 'Latvia', 0),
(121, 'Lebanon', 0),
(122, 'Lesotho', 0),
(123, 'Liberia', 0),
(124, 'Libya', 0),
(125, 'Liechtenstein', 0),
(126, 'Lithuania', 0),
(127, 'Luxembourg', 0),
(128, 'Macau S.A.R.', 0),
(129, 'Macedonia', 0),
(130, 'Madagascar', 0),
(131, 'Malawi', 0),
(132, 'Malaysia', 0),
(133, 'Maldives', 0),
(134, 'Mali', 0),
(135, 'Malta', 0),
(136, 'Man (Isle of)', 0),
(137, 'Marshall Islands', 0),
(138, 'Martinique', 0),
(139, 'Mauritania', 0),
(140, 'Mauritius', 0),
(141, 'Mayotte', 0),
(142, 'Mexico', 0),
(143, 'Micronesia', 0),
(144, 'Moldova', 0),
(145, 'Monaco', 0),
(146, 'Mongolia', 0),
(147, 'Montenegro', 0),
(148, 'Montserrat', 0),
(149, 'Morocco', 0),
(150, 'Mozambique', 0),
(151, 'Myanmar', 0),
(152, 'Namibia', 0),
(153, 'Nauru', 0),
(154, 'Nepal', 0),
(155, 'Bonaire, Sint Eustatius and Saba', 0),
(156, 'Netherlands', 0),
(157, 'New Caledonia', 0),
(158, 'New Zealand', 0),
(159, 'Nicaragua', 0),
(160, 'Niger', 0),
(161, 'Nigeria', 0),
(162, 'Niue', 0),
(163, 'Norfolk Island', 0),
(164, 'Northern Mariana Islands', 0),
(165, 'Norway', 0),
(166, 'Oman', 0),
(167, 'Pakistan', 0),
(168, 'Palau', 0),
(169, 'Palestinian Territory Occupied', 0),
(170, 'Panama', 0),
(171, 'Papua new Guinea', 0),
(172, 'Paraguay', 0),
(173, 'Peru', 0),
(174, 'Philippines', 0),
(175, 'Pitcairn Island', 0),
(176, 'Poland', 0),
(177, 'Portugal', 0),
(178, 'Puerto Rico', 0),
(179, 'Qatar', 0),
(180, 'Reunion', 0),
(181, 'Romania', 0),
(182, 'Russia', 0),
(183, 'Rwanda', 0),
(184, 'Saint Helena', 0),
(185, 'Saint Kitts And Nevis', 0),
(186, 'Saint Lucia', 0),
(187, 'Saint Pierre and Miquelon', 0),
(188, 'Saint Vincent And The Grenadines', 0),
(189, 'Saint-Barthelemy', 0),
(190, 'Saint-Martin (French part)', 0),
(191, 'Samoa', 0),
(192, 'San Marino', 0),
(193, 'Sao Tome and Principe', 0),
(194, 'Saudi Arabia', 0),
(195, 'Senegal', 0),
(196, 'Serbia', 0),
(197, 'Seychelles', 0),
(198, 'Sierra Leone', 0),
(199, 'Singapore', 0),
(200, 'Slovakia', 0),
(201, 'Slovenia', 0),
(202, 'Solomon Islands', 0),
(203, 'Somalia', 0),
(204, 'South Africa', 0),
(205, 'South Georgia', 0),
(206, 'South Sudan', 0),
(207, 'Spain', 0),
(208, 'Sri Lanka', 0),
(209, 'Sudan', 0),
(210, 'Suriname', 0),
(211, 'Svalbard And Jan Mayen Islands', 0),
(212, 'Swaziland', 0),
(213, 'Sweden', 0),
(214, 'Switzerland', 0),
(215, 'Syria', 0),
(216, 'Taiwan', 0),
(217, 'Tajikistan', 0),
(218, 'Tanzania', 0),
(219, 'Thailand', 0),
(220, 'Togo', 0),
(221, 'Tokelau', 0),
(222, 'Tonga', 0),
(223, 'Trinidad And Tobago', 0),
(224, 'Tunisia', 0),
(225, 'Turkey', 0),
(226, 'Turkmenistan', 0),
(227, 'Turks And Caicos Islands', 0),
(228, 'Tuvalu', 0),
(229, 'Uganda', 0),
(230, 'Ukraine', 0),
(231, 'United Arab Emirates', 0),
(232, 'United Kingdom', 0),
(233, 'United States', 0),
(234, 'United States Minor Outlying Islands', 0),
(235, 'Uruguay', 0),
(236, 'Uzbekistan', 0),
(237, 'Vanuatu', 0),
(238, 'Vatican City State (Holy See)', 0),
(239, 'Venezuela', 0),
(240, 'Vietnam', 0),
(241, 'Virgin Islands (British)', 0),
(242, 'Virgin Islands (US)', 0),
(243, 'Wallis And Futuna Islands', 0),
(244, 'Western Sahara', 0),
(245, 'Yemen', 0),
(246, 'Zambia', 0),
(247, 'Zimbabwe', 0),
(248, 'Kosovo', 0),
(249, 'Curaçao', 0),
(250, 'Sint Maarten (Dutch part)', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
