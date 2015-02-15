<?php
session_start();
include_once('../SystemClasses/CompetencyPoint.php');
$Conn = Connection::get_DefaultConnection();
try {
      $CompetencyPoint = new CompetencyPoint($Conn);

$CompetencyPoint->Competency = $_POST['Pid'];
$CompetencyPoint->Point = $_POST['Point'];
$CompetencyPoint->ParticipantType = $_POST['ParticipantType'];
$CompetencyPoint->Admin = $_SESSION['CurrentUserId'];
$CompetencyPoint->LastUpdate = date('Y-m-d H:i:s');
$CompetencyPoint->Period = $_POST['Period'];

   $CompetencyPoint->Save();
   $Conn->Commit();
   header('location:editCompetency.php?Id='.$_POST['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>