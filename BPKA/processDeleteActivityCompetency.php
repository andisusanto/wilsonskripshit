<?php
include_once('../SystemClasses/ActivityCompetency.php');
$Conn = Connection::get_DefaultConnection();
try {
   ActivityCompetency::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:editActivity.php?Id='.$_GET['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>