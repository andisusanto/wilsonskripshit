<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<h4><b>Subject of Study</b></h4>

			<div class="panel panel-default">
				<div class="panel-body">	
					
					<a href="addSubject.php" class="btn btn-secondary btn-icon btn-icon-standalone">
						<i class="fa-plus"></i>
						<span>Add New Subject of Study</span>
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
								<th>Fields of Study</th>
								<th>Action</th>
							</tr>
						</thead>
							
						<tbody>
							<?php
					           include_once('../SystemClasses/Subject.php');
					           $Conn = Connection::get_DefaultConnection();
					           $Subjects = Subject::LoadCollection($Conn);
					           foreach($Subjects as $Subject){ ?>
							<tr>
								<td><?php echo $Subject->Code; ?></td>
		                		<td><?php echo $Subject->Name; ?></td>
		                		<td>
		                			<?php
		                				include_once('../SystemClasses/FieldsOfStudy.php');
		                				$FieldsOfStudy = FieldsOfStudy::GetObjectByKey($Conn, $Subject->FieldsOfStudy);
		                				echo $FieldsOfStudy->Name;
		                			?>
		                		</td>
		                		<td>
		                			<a href="editSubject.php?Id=<?php echo $Subject->get_Id(); ?>" class="btn btn-secondary btn-sm btn-icon icon-left fa-edit">
										Edit
									</a>
											
									<a href="processDeleteSubject.php?Id=<?php echo $Subject->get_Id(); ?>" class="btn btn-danger btn-sm btn-icon icon-left fa-close">
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