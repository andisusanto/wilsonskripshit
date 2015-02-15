<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<?php 
				include_once('../SystemClasses/Student.php');
				include_once('../SystemClasses/Competency.php');
				include_once('../SystemClasses/Activity.php');
				$Conn = Connection::get_DefaultConnection();
				$Activity = Activity::GetObjectByKey($Conn, $_GET['Activity']);
			 ?>

			<h4><b>Activity [<?php echo $Activity->Title ?>]</b></h4>

			<div class="panel panel-default">
				<div class="panel-body">	
					
					<a class="btn btn-primary btn-icon btn-icon-standalone" href="editActivity.php?Id=<?php echo $_GET['Activity'] ?>">
						<i class="fa-arrow-left"></i>
						<span>Back to Activity</span>
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
								<th>Student</th>
								<th>Competency</th>
								<th>Point</th>
							</tr>
						</thead>
							
						<tbody>
							<?php
					           
								include_once('../SystemClasses/StudentCompetency.php');
					           
					           $StudentCompetencys = StudentCompetency::LoadCollection($Conn, $_GET['Activity']);
					           foreach($StudentCompetencys as $StudentCompetency){ ?>
							<tr>
								<td><?php echo Student::GetObjectByKey($Conn, $StudentCompetency->Student)->Name; ?></td>
		                		<td><?php echo Competency::GetObjectByKey($Conn, $StudentCompetency->Competency)->Name; ?></td>
		                		<td><?php echo $StudentCompetency->Point ?></td>
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