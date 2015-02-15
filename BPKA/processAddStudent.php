<?php
include_once('../SystemClasses/Student.php');
$Conn = Connection::get_DefaultConnection();
try {
      $Student = new Student($Conn);
   $Student->Address = $_POST['Address'];
$Student->ContactNo01 = $_POST['ContactNo01'];
$Student->ContactNo02 = $_POST['ContactNo02'];
$Student->Email = $_POST['Email'];
$Student->FieldsOfStudy = $_POST['FieldsOfStudy'];
$Student->Gender = $_POST['Gender'];
$Student->IDCardNo = $_POST['IDCardNo'];
$Student->Name = $_POST['Name'];
$Student->No = $_POST['No'];
$Student->Password = $_POST['No'];
$Student->Username = $_POST['Username'];

   $Student->Save();
   $Conn->Commit();
   header('location:student.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>