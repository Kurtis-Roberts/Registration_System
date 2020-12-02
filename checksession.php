<?php
session_start();
if (!isset($_SESSION['user'])){
	header("Location: index.php");
	exit();
}else {
	$user = $_SESSION['user'];
	$urole = $_SESSION['role'];
	$found = 0;
	foreach ($proles as $prole){
		if($urole == $prole) $found = 1;
	}
}
	if(!$found) header("Location: unauthorized.php");


?>