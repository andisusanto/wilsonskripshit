<?php
include_once('../SystemClasses/Location.php');
$Conn = Connection::get_DefaultConnection();
try {
   Location::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:location.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>