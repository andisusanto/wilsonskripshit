<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Add Competency Subject</h4>
				</div>
				<div class="panel-body">	
					
					<form role="form" class="form-horizontal" action="processAddCompetencySubject.php" method="POST" id="frmAddCompetencySubject" name="frmAddCompetencySubject" enctype="multipart/form-data">
						
						<input type="hidden" name="Pid" value="<?php echo $_GET['Pid'] ?>">
						<div class="form-group">
							<label class="col-sm-2 control-label">Subject</label>
							<div class="col-sm-10">
								<select class="form-control" name="Subject">
									<?php
							           include_once('../SystemClasses/Subject.php');
							           $Conn = Connection::get_DefaultConnection();
					           			$Subjects = Subject::LoadCollection($Conn);
							           foreach ($Subjects as $Subject) { ?>
							               <option value=" <?php echo $Subject->get_Id();?>"> <?php echo $Subject->Name;?></option>
							           <?php }?>
							       ?>
								</select>
							</div>
						</div>


						<div class="form-group-separator"></div>

						<a class="btn btn-primary btn-icon btn-icon-standalone" href="editCompetency.php?Id=<?php echo $_GET['Pid'] ?>">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmAddCompetencySubject">
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