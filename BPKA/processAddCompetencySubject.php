<?php
include_once('../SystemClasses/CompetencySubject.php');
$Conn = Connection::get_DefaultConnection();
try {
      $CompetencySubject = new CompetencySubject($Conn);

$CompetencySubject->Competency = $_POST['Pid'];
$CompetencySubject->Subject = $_POST['Subject'];

   $CompetencySubject->Save();
   $Conn->Commit();
   header('location:editCompetency.php?Id='.$_POST['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>