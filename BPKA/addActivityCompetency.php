<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Add  Activity Competency</h4>
				</div>
				<div class="panel-body">	
					
					<form role="form" class="form-horizontal" action="processAddActivityCompetency.php" method="POST" id="frmAddActivityCompetency" name="frmAddActivityCompetency" enctype="multipart/form-data">
						
						<input type="hidden" name="Pid" value="<?php echo $_GET['Pid'] ?>">
						<div class="form-group">
							<label class="col-sm-2 control-label">Competency</label>
							<div class="col-sm-10">
								<select class="form-control" name="Competency">
									<?php
							           include_once('../SystemClasses/Competency.php');
							           $Conn = Connection::get_DefaultConnection();
					           			$Competencys = Competency::LoadCollection($Conn);
							           foreach ($Competencys as $Competency) { ?>
							               <option value=" <?php echo $Competency->get_Id();?>"> <?php echo $Competency->Name;?></option>
							           <?php }?>
							       ?>
								</select>
							</div>
						</div>


						<div class="form-group-separator"></div>

						<a class="btn btn-primary btn-icon btn-icon-standalone" href="editActivity.php?Id=<?php echo $_GET['Pid'] ?>">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmAddActivityCompetency">
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