<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<h4><b>Period</b></h4>

			<div class="panel panel-default">
				<div class="panel-body">	
					
					<a href="addPeriod.php" class="btn btn-secondary btn-icon btn-icon-standalone">
						<i class="fa-plus"></i>
						<span>Add New Period</span>
					</a>

					<script type="text/javascript">
						jQuery(document).ready(function($)
						{
							$("#viewdata").dataTable({
								aLengthMenu: [
									[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]
								],
							});
						});
					</script>
							
					<table id="viewdata" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Code</th>
								<th>Name</th>
								<th>Note</th>
								<th>Active</th>
								<th>Action</th>
							</tr>
						</thead>
							
						<tbody>
							<?php
					           include_once('../SystemClasses/Period.php');
					           $Conn = Connection::get_DefaultConnection();
					           $Periods = Period::LoadCollection($Conn);
					           foreach($Periods as $Period){ ?>
							<tr>
								<td><?php echo $Period->Code; ?></td>
		                		<td><?php echo $Period->Name; ?></td>
		                		<td><?php echo $Period->Note; ?></td>
		                		<td><?php echo $Period->Active == 1 ? 'Active' : 'InActive' ; ?></td>
		                		<td>
		                			<a href="processSetPeriodActive.php?Id=<?php echo $Period->get_Id(); ?>" class="btn btn-info btn-sm btn-icon icon-left fa-check-square-o">
		                				Set Active
		                			</a>

		                			<a href="editPeriod.php?Id=<?php echo $Period->get_Id(); ?>" class="btn btn-secondary btn-sm btn-icon icon-left fa-edit">
										Edit
									</a>
											
									<a href="processDeletePeriod.php?Id=<?php echo $Period->get_Id(); ?>" class="btn btn-danger btn-sm btn-icon icon-left fa-close">
										Delete
									</a>
									
		                		</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
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