<?php
include_once('../SystemClasses/Location.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Location = Location::GetObjectByKey($Conn, $_POST['Id']);
   $Location->Code = $_POST['Code'];
	$Location->Name = $_POST['Name'];

   $Location->Update();
   $Conn->Commit();
  header('location:location.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>