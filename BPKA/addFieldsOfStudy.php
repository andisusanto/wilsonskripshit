<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Add New Fields of Study</h4>
				</div>
				<div class="panel-body">	
					
					<form role="form" class="form-horizontal validate" action="processAddFieldsOfStudy.php" method="POST" id="frmAddFieldsOfStudy" name="frmAddFieldsOfStudy" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Code</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-1" data-validate="required" data-message-required="Code must not be empty" placeholder="Code" name="Code">
							</div>
						</div>
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-2">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-2" data-validate="required" data-message-required="Name must not be empty" placeholder="Name" name="Name">
							</div>
						</div>
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-3">Indonesian Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-3" data-validate="required" data-message-required="Indonesian Name must not be empty" placeholder="IndonesianName" name="IndonesianName">
							</div>
						</div>
						<div class="form-group-separator"></div>

						<a class="btn btn-primary btn-icon btn-icon-standalone" href="fieldsOfStudy.php">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmAddFieldsOfStudy">
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