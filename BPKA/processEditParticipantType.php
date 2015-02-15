<?php
include_once('../SystemClasses/ParticipantType.php');
$Conn = Connection::get_DefaultConnection();
try {
   $ParticipantType = ParticipantType::GetObjectByKey($Conn, $_POST['Id']);
   $ParticipantType->Code = $_POST['Code'];
	$ParticipantType->Name = $_POST['Name'];

   $ParticipantType->Update();
   $Conn->Commit();
  header('location:participantType.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>