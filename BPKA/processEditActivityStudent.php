<?php
include_once('../SystemClasses/ActivityStudent.php');
$Conn = Connection::get_DefaultConnection();
try {
   $ActivityStudent = ActivityStudent::GetObjectByKey($Conn, $_POST['Id']);

$ActivityStudent->Activity = $_POST['Pid'];
$ActivityStudent->Note= $_POST['Note'];
$ActivityStudent->Student = $_POST['Student'];
$ActivityStudent->ParticipantType = $_POST['ParticipantType'];


   $ActivityStudent->Update();
   $Conn->Commit();
  header('location:editActivity.php?Id='.$_POST['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>