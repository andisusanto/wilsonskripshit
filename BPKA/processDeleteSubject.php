<?php
include_once('../SystemClasses/Subject.php');
$Conn = Connection::get_DefaultConnection();
try {
   Subject::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:subject.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>