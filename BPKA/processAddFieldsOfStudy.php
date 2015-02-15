<?php
include_once('../SystemClasses/FieldsOfStudy.php');
$Conn = Connection::get_DefaultConnection();
try {
   $FieldsOfStudy = new FieldsOfStudy($Conn);
   $FieldsOfStudy->Code = $_POST['Code'];
	$FieldsOfStudy->Name = $_POST['Name'];
	$FieldsOfStudy->IndonesianName = $_POST['IndonesianName'];

   $FieldsOfStudy->Save();
   $Conn->Commit();
   header('location:fieldsOfStudy.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>