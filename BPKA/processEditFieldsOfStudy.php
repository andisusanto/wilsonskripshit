<?php
include_once('../SystemClasses/FieldsOfStudy.php');
$Conn = Connection::get_DefaultConnection();
try {
   $FieldsOfStudy = FieldsOfStudy::GetObjectByKey($Conn, $_POST['Id']);
   $FieldsOfStudy->Code = $_POST['Code'];
	$FieldsOfStudy->Name = $_POST['Name'];
	$FieldsOfStudy->IndonesianName = $_POST['IndonesianName'];

   $FieldsOfStudy->Update();
   $Conn->Commit();
  header('location:fieldsOfStudy.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>