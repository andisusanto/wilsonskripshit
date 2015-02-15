<?php
include_once('../SystemClasses/FieldsOfStudy.php');
$Conn = Connection::get_DefaultConnection();
try {
   FieldsOfStudy::Delete($Conn, $_GET['Id']);
   $Conn->Commit();
   header('location:fieldsOfStudy.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>