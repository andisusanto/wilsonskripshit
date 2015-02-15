<?php
include_once('../SystemClasses/Period.php');
$Conn = Connection::get_DefaultConnection();
try {

	$Periods = Period::LoadCollection($Conn);
	foreach ($Periods as $Period) { 
		$Period->Active = 0;
		$Period->Update();
	}

	$Period = Period::GetObjectByKey($Conn, $_GET['Id']);
   	$Period->Active = 1;
   	$Period->Update();
   
   $Conn->Commit();
  header('location:period.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>