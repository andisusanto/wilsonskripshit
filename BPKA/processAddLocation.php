<?php
include_once('../SystemClasses/Location.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Location = new Location($Conn);
   $Location->Code = $_POST['Code'];
	$Location->Name = $_POST['Name'];

   $Location->Save();
   $Conn->Commit();
   header('location:location.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>