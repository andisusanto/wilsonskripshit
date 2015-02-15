<?php
include_once('../SystemClasses/Activity.php');
$Conn = Connection::get_DefaultConnection();
try {
   Activity::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:activity.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>