<?php
include_once('../SystemClasses/Period.php');
$Conn = Connection::get_DefaultConnection();
try {
    $Period = Period::GetObjectByKey($Conn, $_POST['Id']);
  
$Period->Name = $_POST['Name'];
$Period->Code = $_POST['Code'];
$Period->Note = $_POST['Note'];

   $Period->Update();
   $Conn->Commit();
  header('location:period.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>