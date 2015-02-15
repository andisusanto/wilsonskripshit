<?php
session_start();
include_once('../SystemClasses/ActivityParticipant.php');
$Conn = Connection::get_DefaultConnection();
try {
      $ActivityParticipant = new ActivityParticipant($Conn);

$ActivityParticipant->Activity = $_POST['Pid'];
$ActivityParticipant->AvailableSeat= $_POST['AvailableSeat'];
$ActivityParticipant->ParticipantType = $_POST['ParticipantType'];
$ActivityParticipant->RegistrationLimit =  $_POST['RegistrationLimit'];


   $ActivityParticipant->Save();
   $Conn->Commit();
   header('location:editActivity.php?Id='.$_POST['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>