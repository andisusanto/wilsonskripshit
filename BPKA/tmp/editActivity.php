<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Edit Student</h4>
				</div>
				<div class="panel-body">	
					
					<?php
						include_once('../SystemClasses/Student.php');
						$Conn = Connection::get_DefaultConnection();
						$Student = Student::GetObjectByKey($Conn, $_GET['Id']);
					?>

					<form role="form" class="form-horizontal validate" action="processEditStudent.php" method="POST" id="frmEditStudent" name="frmEditStudent" enctype="multipart/form-data">
						<input type="hidden" name="Id" value="<?php echo $Student->get_Id();?>">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Student No</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-1" data-validate="required" data-message-required="Student No must not be empty" placeholder="Student No" name="No" value="<?php echo $Student->No ?>">
							</div>
						</div>
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-2">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-2" data-validate="required" data-message-required="Name must not be empty" placeholder="Name" name="Name" value="<?php echo $Student->Name ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Gender</label>
							<div class="col-sm-10">
								<select class="form-control" name="Gender">
									<?php 
										if($Student->Gender == 0){
											echo '<option value="0" selected>Male</option>';
											echo '<option value="1">Female</option>';
										}else{
											echo '<option value="0">Male</option>';
											echo '<option value="1" selected>Female</option>';
										}
									?>
									
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
          								$FieldsOfStudys = FieldsOfStudy::LoadCollection($Conn);
          								foreach ($FieldsOfStudys as $FieldsOfStudy) {
       										if($Student->FieldsOfStudy==$FieldsOfStudy->get_Id()){
      											$isSelected = 'selected';
          									}else{
								            	$isSelected = '';
								          	}
								            echo "<option value=".$FieldsOfStudy->get_Id()." $isSelected>".$FieldsOfStudy->Name."</option>";
								        }
								    ?>
								</select>
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-7">Email</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-7" data-validate="email" placeholder="Email" name="Email" value="<?php echo $Student->Email ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-3">Username</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-3" data-validate="required" data-message-required="Username must not be empty" placeholder="Username" name="Username" value="<?php echo $Student->Username ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-4">ID Card No</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-4" placeholder="IDCardNo" name="IDCardNo" value="<?php echo $Student->IDCardNo ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-5">Contact No 01</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-5" placeholder="ContactNo01" name="ContactNo01" value="<?php echo $Student->ContactNo01 ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-6">Contact No 02</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-6" placeholder="ContactNo02" name="ContactNo02" value="<?php echo $Student->ContactNo02 ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-6">Address</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-6" placeholder="Address" name="Address" value="<?php echo $Student->Address ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<a class="btn btn-primary btn-icon btn-icon-standalone" href="subject.php">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmEditStudent">
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