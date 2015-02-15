<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Edit Period</h4>
				</div>
				<div class="panel-body">	
					
					<?php
						include_once('../SystemClasses/Period.php');
						$Conn = Connection::get_DefaultConnection();
						$Period = Period::GetObjectByKey($Conn, $_GET['Id']);
					?>

					<form role="form" class="form-horizontal" action="processEditPeriod.php" method="POST" id="frmAddPeriod" name="frmAddPeriod" enctype="multipart/form-data">
						<input type="hidden" name="Id" value="<?php echo $Period->get_Id();?>">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Code</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-1" placeholder="Code" name="Code" value="<?php echo $Period->Code ?>">
							</div>
						</div>
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-2">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-2" placeholder="Name" name="Name" value="<?php echo $Period->Name ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-6">Note</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-6" placeholder="Note" name="Note" value="<?php echo $Period->Note ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<a class="btn btn-primary btn-icon btn-icon-standalone" href="period.php">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmAddPeriod">
							<i class="fa-save"></i>
							<span>Save</span>
						</button>
					</form>
					
				</div>
			</div>	

			<?php include('footer.php'); ?>
		</div>
		
	</div>
	
	<!-- Bottom Scripts -->
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/TweenMax.min.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/xenon-api.js"></script>
	<script src="assets/js/xenon-toggles.js"></script>

	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/xenon-custom.js"></script>

	<script src="assets/js/datatables/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/datatables/dataTables.bootstrap.js"></script>
	<script src="assets/js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
	<script src="assets/js/datatables/tabletools/dataTables.tableTools.min.js"></script>

</body>
</html>