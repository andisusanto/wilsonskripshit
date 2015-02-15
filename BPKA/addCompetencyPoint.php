<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Add Compentency Point</h4>
				</div>
				<div class="panel-body">	
					
					<form role="form" class="form-horizontal validate" action="processAddCompetencyPoint.php" method="POST" id="frmAddCompetencyPoint" name="frmAddCompetencyPoint" enctype="multipart/form-data">
						<input type="hidden" name="Pid" value="<?php echo $_GET['Pid'] ?>">
						<div class="form-group">
							<label class="col-sm-2 control-label">Period</label>
							<div class="col-sm-10">
								<select class="form-control" name="Period">
									<?php
							           include_once('../SystemClasses/Period.php');
							           $Conn = Connection::get_DefaultConnection();
					           			$Periods = Period::LoadCollection($Conn, "Active = 1");
							           foreach ($Periods as $Period) { ?>
							               <option value=" <?php echo $Period->get_Id();?>"> <?php echo $Period->Code;?></option>
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
							<label class="col-sm-2 control-label">Points</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="Point" data-validate="number" placeholder="Points" aria-invalid="false" aria-describedby="number-error"><span id="number-error" class="validate-has-error" style="display: none;"></span>
							</div>
						</div>
						<div class="form-group-separator"></div>

						<a class="btn btn-primary btn-icon btn-icon-standalone" href="editCompetency.php?Id=<?php echo $_GET['Pid'] ?>">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmAddCompetencyPoint">
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