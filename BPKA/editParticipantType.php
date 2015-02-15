<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Edit Participant Type</h4>
				</div>
				<div class="panel-body">	
					
					<?php
						include_once('../SystemClasses/ParticipantType.php');
						$Conn = Connection::get_DefaultConnection();
						$ParticipantType = ParticipantType::GetObjectByKey($Conn, $_GET['Id']);
					?>

					<form role="form" class="form-horizontal validate" action="processEditParticipantType.php" method="POST" id="frmAddParticipantType" name="frmAddParticipantType" enctype="multipart/form-data">
						<input type="hidden" name="Id" value="<?php echo $ParticipantType->get_Id();?>">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Code</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-1" data-validate="required" data-message-required="Code must not be empty" placeholder="Code" name="Code" value="<?php echo $ParticipantType->Code ?>">
							</div>
						</div>
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-2">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-2" data-validate="required" data-message-required="Name must not be empty" placeholder="Name" name="Name" value="<?php echo $ParticipantType->Name ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<a class="btn btn-primary btn-icon btn-icon-standalone" href="participantType.php">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmAddParticipantType">
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