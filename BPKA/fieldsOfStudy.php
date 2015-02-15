<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<h4><b>Fields of Study</b></h4>

			<div class="panel panel-default">
				<div class="panel-body">	
					
					<a href="addFieldsOfStudy.php" class="btn btn-secondary btn-icon btn-icon-standalone">
						<i class="fa-plus"></i>
						<span>Add New Fields of Study</span>
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
								<th>Indonesian Name</th>
								<th>Action</th>
							</tr>
						</thead>
							
						<tbody>
							<?php
					           include_once('../SystemClasses/FieldsOfStudy.php');
					           $Conn = Connection::get_DefaultConnection();
					           $FieldsOfStudys = FieldsOfStudy::LoadCollection($Conn);
					           foreach($FieldsOfStudys as $FieldsOfStudy){ ?>
							<tr>
								<td><?php echo $FieldsOfStudy->Code; ?></td>
		                		<td><?php echo $FieldsOfStudy->Name; ?></td>
		                		<td><?php echo $FieldsOfStudy->IndonesianName; ?></td>
		                		<td>
		                			<a href="editFieldsOfStudy.php?Id=<?php echo $FieldsOfStudy->get_Id(); ?>" class="btn btn-secondary btn-sm btn-icon icon-left fa-edit">
										Edit
									</a>
											
									<a href="processDeleteFieldsOfStudy.php?Id=<?php echo $FieldsOfStudy->get_Id(); ?>" class="btn btn-danger btn-sm btn-icon icon-left fa-close">
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
	
	<?php include_once('script.php') ?>

</body>
</html>