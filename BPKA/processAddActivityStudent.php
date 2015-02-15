<?php
session_start();
include_once('../SystemClasses/ActivityStudent.php');
$Conn = Connection::get_DefaultConnection();
try {
      $ActivityStudent = new ActivityStudent($Conn);

$ActivityStudent->Activity = $_POST['Pid'];
$ActivityStudent->Note= $_POST['Note'];
$ActivityStudent->Student = $_POST['Student'];
$ActivityStudent->Attended = 0;
$ActivityStudent->ParticipantType = $_POST['ParticipantType'];
$ActivityStudent->Status = 1;


   $ActivityStudent->Save();
   $Conn->Commit();
   header('location:editActivity.php?Id='.$_POST['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>