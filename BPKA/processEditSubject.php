<?php
include_once('../SystemClasses/Subject.php');
$Conn = Connection::get_DefaultConnection();
try {
   $Subject = Subject::GetObjectByKey($Conn, $_POST['Id']);
   $Subject->Code = $_POST['Code'];
	$Subject->Name = $_POST['Name'];
	$Subject->FieldsOfStudy = $_POST['FieldsOfStudy'];

   $Subject->Update();
   $Conn->Commit();
  header('location:subject.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>