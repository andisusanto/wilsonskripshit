<?php
include_once('../SystemClasses/StudentCompetency.php');
$Conn = Connection::get_DefaultConnection();
try {
   


$Query = "DELETE FROM StudentCompetency WHERE Activity = ".$_GET['Pid']."
			INSERT INTO StudentCompetency (Student, Activity, Competency, Point, Lockfield)
			SELECT ActivityStudent.Student, Activity.Id, Competency.Id, Competency.Point, 0
			FROM Activity
			INNER JOIN ActivityStudent ON ActivityStudent.Activity = Activity.Id
			INNER JOIN ActivityCompetency ON ActivityCompetency.Activity = Activity.Id
			INNER JOIN Student ON Student.Id = ActivityStudent.Student
			INNER JOIN (
			  SELECT Competency.Id, CompetencyPoint.ParticipantType, CompetencyPoint.Period, CompetencyPoint.Point
			  FROM Competency
			  INNER JOIN CompetencyPoint ON CompetencyPoint.Competency = Competency.Id
			) AS Competency ON Competency.ParticipantType = ActivityStudent.ParticipantType AND Competency.Period = Activity.Period
			WHERE Activity.Id = ".$_GET['Pid']." AND ActivityStudent.Attended = 1
		";
		
		$Conn->query($Query);
		$Conn->Commit();
	//header('location:StudentCompetencyByActivity.php?Activity='.$_GET['Pid']);
} catch (Exception $e) {
   include('../SystemClasses/errorHandler.php');
}
?>