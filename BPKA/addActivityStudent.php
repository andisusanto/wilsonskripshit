<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Add Activity Student</h4>
				</div>
				<div class="panel-body">	
					
					<form role="form" class="form-horizontal validate" action="processAddActivityStudent.php" method="POST" id="frmAddActivityStudent" name="frmAddActivityStudent" enctype="multipart/form-data">
						<input type="hidden" name="Pid" value="<?php echo $_GET['Pid'] ?>">
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Student</label>
							<div class="col-sm-10">
								<select class="form-control" name="Student">
									<?php
							           include_once('../SystemClasses/Student.php');
							           $Conn = Connection::get_DefaultConnection();
					           			$Students = Student::LoadCollection($Conn);
							           foreach ($Students as $Student) { ?>
							               <option value=" <?php echo $Student->get_Id();?>"> <?php echo $Student->Name;?></option>
							           <?php }?>
							       ?>
								</select>
							</div>
						</div>
						<div class="form-group-separator"></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">ParticipantType</label>
							<div class="col-sm-10">
								<select class="form-control" name="ParticipantType">
									<?php
							           include_once('../SystemClasses/ParticipantType.php');
							           $Conn = Connection::get_DefaultConnection();
					           			$ParticipantTypes = ParticipantType::LoadCollection($Conn);
							           foreach ($ParticipantTypes as $ParticipantType) { ?>
							               <option value=" <?php echo $ParticipantType->get_Id();?>"> <?php echo $ParticipantType->Name;?></option>
							           <?php }?>
							       ?>
								</select>
							</div>
						</div>
						<div class="form-group-separator"></div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-5">Note</label>
							<div class="col-sm-10">
								<textarea class="form-control" cols="5" id="field-5" name="Note"></textarea>
							</div>
						</div>

						<div class="form-group-separator"></div>

						<a class="btn btn-primary btn-icon btn-icon-standalone" href="editActivity.php?Id=<?php echo $_GET['Pid'] ?>">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmAddActivityStudent">
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