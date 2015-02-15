<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Edit Activity</h4>
				</div>
				<div class="panel-body">	
					<?php
						include_once('../SystemClasses/Activity.php');
						$Conn = Connection::get_DefaultConnection();
						$Activity = Activity::GetObjectByKey($Conn, $_GET['Id']);
					?>

					<form role="form" class="form-horizontal validate" action="processEditActivity.php" method="POST" id="frmEditActivity" name="frmEditActivity" enctype="multipart/form-data">
						<input type="hidden" name="Id" value="<?php echo $Activity->get_Id();?>">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Code</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-1" data-validate="required" data-message-required="Activity Code must not be empty" placeholder="Code" name="Code" value="<?php echo $Activity->Code ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-2">Title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-2" placeholder="Title" data-validate="required" data-message-required="Title must not be empty" name="Title" value="<?php echo $Activity->Title ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Period</label>
							<div class="col-sm-10">
								<select class="form-control" name="Period">
									<?php
										include_once('../SystemClasses/Period.php');
          								$Periods = Period::LoadCollection($Conn);
          								foreach ($Periods as $Period) {
       										if($Activity->Period==$Period->get_Id()){
      											$isSelected = 'selected';
          									}else{
								            	$isSelected = '';
								          	}
								            echo "<option value=".$Period->get_Id()." $isSelected>".$Period->Code."</option>";
								        }
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
          								$Locations = Location::LoadCollection($Conn);
          								foreach ($Locations as $Location) {
       										if($Activity->Location==$Location->get_Id()){
      											$isSelected = 'selected';
          									}else{
								            	$isSelected = '';
								          	}
								            echo "<option value=".$Location->get_Id()." $isSelected>".$Location->Name."</option>";
								        }
								    ?>
								</select>
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Date</label>
							<div class="col-sm-10">
								<div class="input-group">
									<input type="text" name="Date" data-validate="required" data-message-required="Date must not be empty" class="form-control datepicker" data-format="yyyy-mm-dd" value="<?php echo $Activity->Date ?>">
									<div class="input-group-addon">
										<a href="#"><i class="linecons-calendar"></i></a>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Start</label>
							<div class="col-sm-10">
								<div class="input-group input-group-minimal">
									<input type="text" name="Start" class="form-control timepicker" data-template="dropdown" data-show-seconds="true" data-default-time="07:00 AM" data-show-meridian="false" data-minute-step="5" data-second-step="5"  value="<?php echo $Activity->Start ?>"/>
									<div class="input-group-addon">
										<a href="#"><i class="linecons-clock"></i></a>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">End</label>
							<div class="col-sm-10">
								<div class="input-group input-group-minimal">
									<input type="text" name="End" class="form-control timepicker" data-template="dropdown" data-show-seconds="true" data-default-time="08:00 AM" data-show-meridian="false" data-minute-step="5" data-second-step="5"  value="<?php echo $Activity->End ?>"/>
									<div class="input-group-addon">
										<a href="#"><i class="linecons-clock"></i></a>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group-separator"></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Activity Type</label>
							<div class="col-sm-10">
								<select name="Type" class="form-control" >
								<?php 
									if($Activity->Type == 0){
										echo '<option value="0" selected>Seminar</option>';
										echo '<option value="1">Competition</option>';
									}else{
										echo '<option value="0">Seminar</option>';
										echo '<option value="1" selected>Competition</option>';
									}
								?>
								</select>
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-5">Description</label>
							<div class="col-sm-10">
								<textarea class="form-control" cols="5" id="field-5" name="Description"><?php echo $Activity->Description ?></textarea>
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-5">Note</label>
							<div class="col-sm-10">
								<textarea class="form-control" cols="5" id="field-5" name="Note"><?php echo $Activity->Note ?></textarea>
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-5">Publish</label>
							<div class="form-block col-sm-4">
								<input type="checkbox" <?php if ($Activity->Publish == 1) echo 'checked' ?> class="iswitch-lg iswitch-purple" name="Publish" value="1">
							</div>
							<label class="col-sm-2 control-label" for="field-5">Closed</label>
							<div class="form-block col-sm-4">
								<input type="checkbox" <?php if ($Activity->Closed == 1) echo 'checked' ?>  class="iswitch-lg iswitch-purple" name="Closed" value="1">
							</div>
						</div>
						
						<div class="form-group-separator"></div>

						<a class="btn btn-primary btn-icon btn-icon-standalone" href="activity.php">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmEditActivity">
							<i class="fa-save"></i>
							<span>Save</span>
						</button>
					</form>
					
				</div>
			</div>	

			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#ActivityParticipant" data-toggle="tab">
								<span class="visible-xs"><i class="fa-users"></i></span>
								<span class="hidden-xs">Participants</span>
							</a>
						</li>
						<li>
							<a href="#ActivityCompetency" data-toggle="tab">
								<span class="visible-xs"><i class="fa-bullseye"></i></span>
								<span class="hidden-xs">Competencies</span>
							</a>
						</li>
						<li>
							<a href="#ActivityStudent" data-toggle="tab">
								<span class="visible-xs"><i class="fa-bullseye"></i></span>
								<span class="hidden-xs">Students</span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="ActivityParticipant">
							<div>
								<a href="addActivityParticipant.php?Pid=<?php echo $Activity->get_Id(); ?>" class="btn btn-secondary btn-icon btn-icon-standalone">
									<i class="fa-plus"></i>
									<span>New Activity Participant</span>
								</a>

								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										$("#viewdataactivityparticipant").dataTable({
											aLengthMenu: [
												[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]
											],
										});
									});
								</script>
										
								<table id="viewdataactivityparticipant" class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>ParticipantType</th>
											<th>Available Seats</th>
											<th>Open Registration Seats</th>
											<th>Action</th>
										</tr>
									</thead>
										
									<tbody>
										<?php
								           include_once('../SystemClasses/ActivityParticipant.php');
								           $Conn = Connection::get_DefaultConnection();
								           $ActivityParticipants = ActivityParticipant::LoadCollection($Conn, "Activity = ".$_GET['Id']);
								           foreach($ActivityParticipants as $ActivityParticipant){ ?>
										<tr>
											<td>
					                			<?php
					                				include_once('../SystemClasses/ParticipantType.php');
					                				$ParticipantType = ParticipantType::GetObjectByKey($Conn, $ActivityParticipant->ParticipantType);
					                				echo $ParticipantType->Name;
					                			?>
					                		</td>
					                		<td><?php echo $ActivityParticipant->AvailableSeat; ?></td>
					                		<td><?php echo $ActivityParticipant->RegistrationLimit; ?></td>
					                		<td>
					                			<a href="editActivityParticipant.php?Pid=<?php echo $Activity->get_Id(); ?>&Id=<?php echo $ActivityParticipant->get_Id(); ?>" class="btn btn-secondary btn-sm btn-icon icon-left fa-edit">
													Edit
												</a>
														
												<a href="processDeleteActivityParticipant.php?Pid=<?php echo $Activity->get_Id(); ?>&Id=<?php echo $ActivityParticipant->get_Id(); ?>" class="btn btn-danger btn-sm btn-icon icon-left fa-close">
													Delete
												</a>
												
					                		</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="ActivityCompetency">
							<div>
								<a href="addActivityCompetency.php?Pid=<?php echo $Activity->get_Id(); ?>" class="btn btn-secondary btn-icon btn-icon-standalone">
									<i class="fa-plus"></i>
									<span>New Activity Competency</span>
								</a>

								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										$("#viewdataactivitycompetency").dataTable({
											aLengthMenu: [
												[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]
											],
										});
									});
								</script>
										
								<table id="viewdataactivitycompetency" class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Competency</th>
											<th>Action</th>
										</tr>
									</thead>
										
									<tbody>
										<?php
								           include_once('../SystemClasses/ActivityCompetency.php');
								           $Conn = Connection::get_DefaultConnection();
								           $ActivityCompetencys = ActivityCompetency::LoadCollection($Conn, "Activity = ".$_GET['Id']);
								           foreach($ActivityCompetencys as $ActivityCompetency){ ?>
										<tr>
											<td>
												<?php
					                				include_once('../SystemClasses/Competency.php');
					                				$Competency = Competency::GetObjectByKey($Conn, $ActivityCompetency->Competency);
					                				echo $Competency->Name;
					                			?>
											</td>
					                		
					                		<td>
					                			
												<a href="processDeleteActivityCompetency.php?Pid=<?php echo $Activity->get_Id(); ?>&Id=<?php echo $ActivityCompetency->get_Id(); ?>" class="btn btn-danger btn-sm btn-icon icon-left fa-close">
													Delete
												</a>
												
					                		</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="ActivityStudent">
							<div>
								<a href="addActivityStudent.php?Pid=<?php echo $Activity->get_Id(); ?>" class="btn btn-secondary btn-icon btn-icon-standalone">
									<i class="fa-plus"></i>
									<span>New Activity Student</span>
								</a>

								<a href="attendanceForm.php?Pid=<?php echo $Activity->get_Id(); ?>" class="btn btn-orange btn-icon btn-icon-standalone">
									<i class="fa-list"></i>
									<span>Attendance Form</span>
								</a>

								<a href="processCalculateActivityCompetencyPoint.php?Pid=<?php echo $Activity->get_Id(); ?>" class="btn btn-turquoise btn-icon btn-icon-standalone">
									<i class="fa-calculator"></i>
									<span>Calculate Competency Point</span>
								</a>

								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										$("#viewdataactivitystudent").dataTable({
											aLengthMenu: [
												[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]
											],
										});
									});
								</script>
										
								<table id="viewdataactivitystudent" class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Student</th>
											<th>Participant Type</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
										
									<tbody>
										<?php
								           include_once('../SystemClasses/ActivityStudent.php');
								           $Conn = Connection::get_DefaultConnection();
								           $ActivityStudents = ActivityStudent::LoadCollection($Conn, "Activity = ".$_GET['Id']);
								           foreach($ActivityStudents as $ActivityStudent){ ?>
										<tr>
											<td>
												<?php
					                				include_once('../SystemClasses/Student.php');
					                				$Student = Student::GetObjectByKey($Conn, $ActivityStudent->Student);
					                				echo $Student->Name;
					                			?>
											</td>

											<td>
												<?php
					                				include_once('../SystemClasses/ParticipantType.php');
					                				$ParticipantType = ParticipantType::GetObjectByKey($Conn, $ActivityStudent->ParticipantType);
					                				echo $ParticipantType->Name;
					                			?>
											</td>

											<td>
												<?php
					                				$ActivityStudentStatus = $ActivityStudent->Status;
					                				if($ActivityStudentStatus == 0){
					                					echo "Pending";
					                				}
					                				elseif($ActivityStudentStatus == 1){
					                					echo "Approved";
					                				}
					                				elseif($ActivityStudentStatus == 2){
					                					echo "Cancelled";
					                				}
					                			?>
											</td>
					                		
					                		<td>
					                			
					                			<?php if($ActivityStudentStatus == 0 || $ActivityStudentStatus == 2){ ?>
					                			<a href="processSetActivityStudentStatus.php?Pid=<?php echo $Activity->get_Id(); ?>&Id=<?php echo $ActivityStudent->get_Id(); ?>" class="btn btn-purple btn-sm btn-icon icon-left fa-edit">
													Approve
												</a>
												<?php } elseif ($ActivityStudentStatus == 1){ ?>
												<a href="processSetActivityStudentStatus.php?Pid=<?php echo $Activity->get_Id(); ?>&Id=<?php echo $ActivityStudent->get_Id(); ?>" class="btn btn-purple btn-sm btn-icon icon-left fa-edit">
													Cancel
												</a>
												<?php } ?>

					                			<a href="editActivityStudent.php?Pid=<?php echo $Activity->get_Id(); ?>&Id=<?php echo $ActivityStudent->get_Id(); ?>" class="btn btn-secondary btn-sm btn-icon icon-left fa-edit">
													Edit
												</a>

												<a href="processDeleteActivityStudent.php?Pid=<?php echo $Activity->get_Id(); ?>&Id=<?php echo $ActivityStudent->get_Id(); ?>" class="btn btn-danger btn-sm btn-icon icon-left fa-close">
													Delete
												</a>
												
					                		</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include('footer.php'); ?>
		</div>
		
	</div>
	<?php include_once('script.php') ?>

</body>
</html>