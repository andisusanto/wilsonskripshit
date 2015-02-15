<?php
include_once('../SystemClasses/ActivityParticipant.php');
$Conn = Connection::get_DefaultConnection();
try {
   ActivityParticipant::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:editActivity.php?Id='.$_GET['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>