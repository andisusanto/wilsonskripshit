<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Edit Activity Participant</h4>
				</div>
				<div class="panel-body">	
					
					<?php
						include_once('../SystemClasses/ActivityParticipant.php');
						$Conn = Connection::get_DefaultConnection();
						$ActivityParticipant = ActivityParticipant::GetObjectByKey($Conn, $_GET['Id']);
					?>

					<form role="form" class="form-horizontal validate" action="processEditActivityParticipant.php" method="POST" id="frmEditActivityParticipant" name="frmEditActivityParticipant" enctype="multipart/form-data">
						<input type="hidden" name="Id" value="<?php echo $ActivityParticipant->get_Id();?>">
						<input type="hidden" name="Pid" value="<?php echo $_GET['Pid'] ?>">

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
							<label class="col-sm-2 control-label">Registration Limit</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo $ActivityParticipant->RegistrationLimit ?>" name="RegistrationLimit" data-validate="number" placeholder="Registration Limit" aria-invalid="false" aria-describedby="number-error"><span id="number-error" class="validate-has-error" style="display: none;"></span>
							</div>
						</div>
						<div class="form-group-separator"></div>
				
						<div class="form-group">
							<label class="col-sm-2 control-label">Available Seats</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo $ActivityParticipant->AvailableSeat ?>" name="AvailableSeat" data-validate="number" placeholder="Available Seats" aria-invalid="false" aria-describedby="number-error"><span id="number-error" class="validate-has-error" style="display: none;"></span>
							</div>
						</div>
						<div class="form-group-separator"></div>

						<a class="btn btn-primary btn-icon btn-icon-standalone" href="editActivity.php?Id=<?php echo $_GET['Pid'] ?>">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmEditActivityParticipant">
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