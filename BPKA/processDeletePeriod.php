<?php
include_once('../SystemClasses/Period.php');
$Conn = Connection::get_DefaultConnection();
try {
   Period::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:period.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>