<?php

session_start();

$rolecheck = $_SESSION['role'];


if ($rolecheck == 'Student') {
	header("Location: student_homepage.php");
}else if ($rolecheck == 'Faculty') {
	header("Location: faculty_homepage.php");
}else if ($rolecheck == 'Advisor') {
	header("Location: advisor_homepage.php");
}else if ($rolecheck == 'Admin') {
	header("Location: admin_homepage.php");
} else header("Location: unauthorized.php");



?>