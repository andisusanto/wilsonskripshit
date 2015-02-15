<?php
include_once('../SystemClasses/ActivityStudent.php');
$Conn = Connection::get_DefaultConnection();
try {

	if (isset($_POST['StudentAttendance'])) {
		if ($_POST['StudentAttendance']) {
			foreach ( $_POST['StudentAttendance'] as $key=>$value ) {
				$ActivityStudent = ActivityStudent::GetObjectByKey($Conn, $key);
				$ActivityStudent->Attended = $value;
				$ActivityStudent->Update();
			}
			$Conn->Commit();
		}
	}
header('location:editActivity.php?Id='.$_POST['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>