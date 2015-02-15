<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<h4><b>Participant Type</b></h4>

			<div class="panel panel-default">
				<div class="panel-body">	
					
					<a href="addParticipantType.php" class="btn btn-secondary btn-icon btn-icon-standalone">
						<i class="fa-plus"></i>
						<span>Add New Participant Type</span>
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
								<th>Action</th>
							</tr>
						</thead>
							
						<tbody>
							<?php
					           include_once('../SystemClasses/ParticipantType.php');
					           $Conn = Connection::get_DefaultConnection();
					           $ParticipantTypes = ParticipantType::LoadCollection($Conn);
					           foreach($ParticipantTypes as $ParticipantType){ ?>
							<tr>
								<td><?php echo $ParticipantType->Code; ?></td>
		                		<td><?php echo $ParticipantType->Name; ?></td>
		                		<td>
		                			<a href="editParticipantType.php?Id=<?php echo $ParticipantType->get_Id(); ?>" class="btn btn-secondary btn-sm btn-icon icon-left fa-edit">
										Edit
									</a>
											
									<a href="processDeleteParticipantType.php?Id=<?php echo $ParticipantType->get_Id(); ?>" class="btn btn-danger btn-sm btn-icon icon-left fa-close">
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