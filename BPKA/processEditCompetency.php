<?php
include_once('../SystemClasses/Competency.php');
$Conn = Connection::get_DefaultConnection();
try {
    $Competency = Competency::GetObjectByKey($Conn, $_POST['Id']);
  
$Competency->Name = $_POST['Name'];
$Competency->Code = $_POST['Code'];
$Competency->Description = $_POST['Description'];

   $Competency->Update();
   $Conn->Commit();
  header('location:competency.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>