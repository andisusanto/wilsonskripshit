<?php
include_once('../SystemClasses/Activity.php');
$Conn = Connection::get_DefaultConnection();
try {
    $Activity = Activity::GetObjectByKey($Conn, $_POST['Id']);
    $Activity->Code = $_POST['Code'];
    $Activity->Title = $_POST['Title'];
    $Activity->Description = $_POST['Description'];
    $Activity->Note = $_POST['Note'];
    $Activity->Date = $_POST['Date'];
    $Activity->Start = $_POST['Start'];
    $Activity->End = $_POST['End'];
    $Activity->Location = $_POST['Location'];
    $Activity->Period = $_POST['Period'];
    $Activity->Type = $_POST['Type'];
    $Activity->Publish = $_POST['Publish'];
    $Activity->Closed = $_POST['Closed'];
    $Activity->Admin = $_SESSION['CurrentUserId'];
    $Activity->LastUpdate = date('Y-m-d H:i:s');

   $Activity->Update();
   $Conn->Commit();
  header('location:activity.php');
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>