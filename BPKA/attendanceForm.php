<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Activity Student Attendance</h4>
				</div>
				<div class="panel-body">	
					
					<?php
						include_once('../SystemClasses/ActivityStudent.php');
						include_once('../SystemClasses/Student.php');
						include_once('../SystemClasses/ParticipantType.php');
						$Conn = Connection::get_DefaultConnection();
						$ActivityStudents = ActivityStudent::LoadCollection($Conn, "Status = 1 AND Activity = ".$_GET['Pid']);
					?>

					<form role="form" class="form-horizontal validate" action="processStudentAttendance.php" method="POST" id="frmStudentAttendance" name="frmStudentAttendance" enctype="multipart/form-data">
						<input type="hidden" name="Pid" value="<?php echo $_GET['Pid'] ?>">

						<table class="table table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Student Name</th>
										<th>Participant Type</th>
										<th>Attend</th>
									</tr>
								</thead>
										
								<tbody>
						<?php 
							$counter = 0;
							foreach ($ActivityStudents as $ActivityStudent) {
								$counter++;
						?>	
							
									<tr>
										<td><?php echo $counter ?></td>
										<td><?php echo Student::GetObjectByKey($Conn, $ActivityStudent->Student)->Name; ?></td>
										<td><?php echo ParticipantType::GetObjectByKey($Conn, $ActivityStudent->ParticipantType)->Name; ?></td>
										<td>
											<input type="hidden" name="StudentAttendance[<?php echo $ActivityStudent->get_Id(); ?>]" value="0">
											<input type="checkbox" <?php if ($ActivityStudent->Attended == 1) echo 'checked' ?>  class="iswitch-lg iswitch-purple" name="StudentAttendance[<?php echo $ActivityStudent->get_Id(); ?>]" value="1">
										</td>
									</tr>
							
						<?php 
							}
						?>

							</tbody>
						</table>
						
						<a class="btn btn-primary btn-icon btn-icon-standalone" href="editActivity.php?Id=<?php echo $_GET['Pid'] ?>">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmStudentAttendance">
							<i class="fa-save"></i>
							<span>Submit</span>
						</button>
					</form>
					
				</div>
			</div>	

			<?php include('footer.php'); ?>
		</div>
		
	</div>
	
	<?php include_once('script.php') ?>

</body>
</html>