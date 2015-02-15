<?php
include_once('../SystemClasses/ActivityStudent.php');
$Conn = Connection::get_DefaultConnection();
try {

	$ActivityStudent = ActivityStudent::GetObjectByKey($Conn, $_GET['Id']);
	if ($ActivityStudent->Status == 0 || $ActivityStudent->Status == 2) {
		$ActivityStudent->Status = 1;
	}
	elseif ($ActivityStudent->Status == 1) {
		$ActivityStudent->Status = 2;
	}
   	$ActivityStudent->Update();
   
   $Conn->Commit();
   header('location:editActivity.php?Id='.$_GET['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>