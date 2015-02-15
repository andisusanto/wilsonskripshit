<?php
include_once('../SystemClasses/ActivityCompetency.php');
$Conn = Connection::get_DefaultConnection();
try {
      $ActivityCompetency = new ActivityCompetency($Conn);

$ActivityCompetency->Activity = $_POST['Pid'];
$ActivityCompetency->Competency = $_POST['Competency'];

   $ActivityCompetency->Save();
   $Conn->Commit();
   header('location:editActivity.php?Id='.$_POST['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>