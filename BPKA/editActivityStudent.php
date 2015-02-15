<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Edit Activity Student</h4>
				</div>
				<div class="panel-body">	
					
					<?php
						include_once('../SystemClasses/ActivityStudent.php');
						$Conn = Connection::get_DefaultConnection();
						$ActivityStudent = ActivityStudent::GetObjectByKey($Conn, $_GET['Id']);
					?>

					<form role="form" class="form-horizontal validate" action="processEditActivityStudent.php" method="POST" id="frmEditActivityStudent" name="frmEditActivityStudent" enctype="multipart/form-data">
						<input type="hidden" name="Id" value="<?php echo $ActivityStudent->get_Id();?>">
						<input type="hidden" name="Pid" value="<?php echo $_GET['Pid'] ?>">

						<div class="form-group">
							<label class="col-sm-2 control-label">Student</label>
							<div class="col-sm-10">
								<select class="form-control" name="Student">
									<?php
										include_once('../SystemClasses/Student.php');
          								$Students = Student::LoadCollection($Conn);
          								foreach ($Students as $Student) {
       										if($ActivityParticipant->Student==$Student->get_Id()){
      											$isSelected = 'selected';
          									}else{
								            	$isSelected = '';
								          	}
								            echo "<option value=".$Student->get_Id()." $isSelected>".$Student->Name."</option>";
								        }
								    ?>
								</select>
							</div>
						</div>
						<div class="form-group-separator"></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Participant Type</label>
							<div class="col-sm-10">
								<select class="form-control" name="ParticipantType">
									<?php
										include_once('../SystemClasses/ParticipantType.php');
          								$ParticipantTypes = ParticipantType::LoadCollection($Conn);
          								foreach ($ParticipantTypes as $ParticipantType) {
       										if($ActivityParticipant->ParticipantType==$ParticipantType->get_Id()){
      											$isSelected = 'selected';
          									}else{
								            	$isSelected = '';
								          	}
								            echo "<option value=".$ParticipantType->get_Id()." $isSelected>".$ParticipantType->Name."</option>";
								        }
								    ?>
								</select>
							</div>
						</div>
						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-5">Note</label>
							<div class="col-sm-10">
								<textarea class="form-control" cols="5" id="field-5" name="Note"><?php echo $ActivityStudent->Note ?></textarea>
							</div>
						</div>
						<div class="form-group-separator"></div>

						<a class="btn btn-primary btn-icon btn-icon-standalone" href="editActivity.php?Id=<?php echo $_GET['Pid'] ?>">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmEditActivityStudent">
							<i class="fa-save"></i>
							<span>Save</span>
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