<?php
include_once('../SystemClasses/Student.php');
$Conn = Connection::get_DefaultConnection();
try {
   Student::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:student.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>