<?php
include_once('../SystemClasses/ParticipantType.php');
$Conn = Connection::get_DefaultConnection();
try {
   ParticipantType::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:participantType.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>