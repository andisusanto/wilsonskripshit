<?php
include_once('../SystemClasses/Competency.php');
$Conn = Connection::get_DefaultConnection();
try {
   Competency::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:competency.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>