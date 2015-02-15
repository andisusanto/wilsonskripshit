<?php
include_once('../SystemClasses/Competency.php');
$Conn = Connection::get_DefaultConnection();
try {
      $Competency = new Competency($Conn);
$Competency->Name = $_POST['Name'];
$Competency->Code = $_POST['Code'];
$Competency->Description = $_POST['Description'];

   $Competency->Save();
   $Conn->Commit();
   header('location:competency.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>