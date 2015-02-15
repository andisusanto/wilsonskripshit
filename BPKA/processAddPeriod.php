<?php
include_once('../SystemClasses/Period.php');
$Conn = Connection::get_DefaultConnection();
try {
      $Period = new Period($Conn);
$Period->Name = $_POST['Name'];
$Period->Code = $_POST['Code'];
$Period->Note = $_POST['Note'];
$Period->Active = 0;

   $Period->Save();
   $Conn->Commit();
   header('location:period.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>