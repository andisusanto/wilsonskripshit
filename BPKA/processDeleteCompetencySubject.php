<?php
include_once('../SystemClasses/CompetencySubject.php');
$Conn = Connection::get_DefaultConnection();
try {
   CompetencySubject::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:editCompetency.php?Id='.$_GET['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>