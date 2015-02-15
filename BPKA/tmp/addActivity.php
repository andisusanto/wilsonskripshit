<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Add Activity</h4>
				</div>
				<div class="panel-body">	
					
					<form role="form" class="form-horizontal validate" action="processAddActivity.php" method="POST" id="frmAddActivity" name="frmAddActivity" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Code</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-1" data-validate="required" data-message-required="Activity Code must not be empty" placeholder="Code" name="Code">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-2">Title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-2" placeholder="Title" data-validate="required" data-message-required="Title must not be empty" name="Title">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Period</label>
							<div class="col-sm-10">
								<select class="form-control" name="Period">
									<?php
							           include_once('../SystemClasses/Period.php');
							           $Conn = Connection::get_DefaultConnection();
					           			$Periods = Period::LoadCollection($Conn);
							           foreach ($Periods as $Period) { ?>
							               <option value=" <?php echo $Period->get_Id();?>"> <?php echo $Period->Code;?></option>
							           <?php }?>
							       ?>
								</select>
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Location</label>
							<div class="col-sm-10">
								<select class="form-control" name="Location">
									<?php
							           include_once('../SystemClasses/Location.php');
							           $Conn = Connection::get_DefaultConnection();
					           			$Locations = Location::LoadCollection($Conn);
							           foreach ($Locations as $Location) { ?>
							               <option value=" <?php echo $Location->get_Id();?>"> <?php echo $Location->Name;?></option>
							           <?php }?>
							       ?>
								</select>
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Start</label>
							<div class="col-sm-10">
								<div class="date-and-time">
									<input type="text" class="form-control datepicker" data-format="yyyy-MM-dd hh:mm:ss">
									</div>
							</div>
						</div>
						<div class="form-group-separator"></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Activity Type</label>
							<div class="col-sm-10">
								<select class="form-control" name="Type">
									<option value="0">Seminar</option>
									<option value="1">Competition</option>
								</select>
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-5">Description</label>
							<div class="col-sm-10">
								<textarea class="form-control" cols="5" id="field-5" name="Description"></textarea>
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
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-5">Publish</label>
							<div class="form-block col-sm-4">
								<input type="checkbox" checked class="iswitch-lg iswitch-purple" name="Publish">
							</div>
							<label class="col-sm-2 control-label" for="field-5">Closed</label>
							<div class="form-block col-sm-4">
								<input type="checkbox" checked class="iswitch-lg iswitch-purple" name="Closed">
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

						<a class="btn btn-primary btn-icon btn-icon-standalone" href="activity.php">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmAddActivity">
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