<?php
include_once('../SystemClasses/ActivityStudent.php');
$Conn = Connection::get_DefaultConnection();
try {
   ActivityStudent::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:editActivity.php?Id='.$_GET['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>