<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Add Student</h4>
				</div>
				<div class="panel-body">	
					
					<form role="form" class="form-horizontal validate" action="processAddStudent.php" method="POST" id="frmAddStudent" name="frmAddStudent" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Student No</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-1" data-validate="required" data-message-required="Student No must not be empty" placeholder="Student No" name="No">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-2">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-2" placeholder="Name" data-validate="required" data-message-required="Name must not be empty" name="Name">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Gender</label>
							<div class="col-sm-10">
								<select class="form-control" name="Gender">
									<option value="0">Male</option>
									<option value="1">Female</option>
								</select>
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Fields Of Study</label>
							<div class="col-sm-10">
								<select class="form-control" name="FieldsOfStudy">
									<?php
							           include_once('../SystemClasses/FieldsOfStudy.php');
							           $Conn = Connection::get_DefaultConnection();
					           			$FieldsOfStudys = FieldsOfStudy::LoadCollection($Conn);
							           foreach ($FieldsOfStudys as $FieldsOfStudy) { ?>
							               <option value=" <?php echo $FieldsOfStudy->get_Id();?>"> <?php echo $FieldsOfStudy->Name;?></option>
							           <?php }?>
							       ?>
								</select>
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-7">Email</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-7" data-validate="email" placeholder="Email" name="Email">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-3">Username</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-3" data-validate="required" data-message-required="Username must not be empty" placeholder="Username" name="Username">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-4">ID Card No</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-4" placeholder="IDCardNo" name="IDCardNo">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-5">Contact No 01</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-5" placeholder="ContactNo01" name="ContactNo01">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-6">Contact No 02</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-6" placeholder="ContactNo02" name="ContactNo02">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-6">Address</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-6" placeholder="Address" name="Address">
							</div>
						</div>


						<div class="form-group-separator"></div>

						<a class="btn btn-primary btn-icon btn-icon-standalone" href="student.php">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmAddStudent">
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