<?php
include_once('../SystemClasses/CompetencyPoint.php');
$Conn = Connection::get_DefaultConnection();
try {
   $CompetencyPoint = CompetencyPoint::GetObjectByKey($Conn, $_POST['Id']);

$CompetencyPoint->Competency = $_POST['Pid'];
$CompetencyPoint->Point = $_POST['Point'];
$CompetencyPoint->ParticipantType = $_POST['ParticipantType'];
$CompetencyPoint->Admin = $_SESSION['CurrentUserId'];
$CompetencyPoint->LastUpdate = date('Y-m-d H:i:s');
$CompetencyPoint->Period = $_POST['Period'];

   $CompetencyPoint->Update();
   $Conn->Commit();
  header('location:editCompetency.php?Id='.$_POST['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>