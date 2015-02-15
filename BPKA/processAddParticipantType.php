<?php
include_once('../SystemClasses/ParticipantType.php');
$Conn = Connection::get_DefaultConnection();
try {
   $ParticipantType = new ParticipantType($Conn);
   $ParticipantType->Code = $_POST['Code'];
	$ParticipantType->Name = $_POST['Name'];

   $ParticipantType->Save();
   $Conn->Commit();
   header('location:participantType.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>