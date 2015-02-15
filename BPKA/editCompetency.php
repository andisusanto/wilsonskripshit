<?php include('header.php'); ?>

<body class="page-body">

	<div class="page-container">

		<?php include('sidenav.php'); ?>

		<div class="main-content">
				
			<?php include('nav.php'); ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Edit Competency</h4>
				</div>
				<div class="panel-body">	
					
					<?php
						include_once('../SystemClasses/Competency.php');
						$Conn = Connection::get_DefaultConnection();
						$Competency = Competency::GetObjectByKey($Conn, $_GET['Id']);
					?>

					<form role="form" class="form-horizontal" action="processEditCompetency.php" method="POST" id="frmAddCompetency" name="frmAddCompetency" enctype="multipart/form-data">
						<input type="hidden" name="Id" value="<?php echo $Competency->get_Id();?>">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-1">Code</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-1" placeholder="Code" name="Code" value="<?php echo $Competency->Code ?>">
							</div>
						</div>
						<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-2">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-2" placeholder="Name" name="Name" value="<?php echo $Competency->Name ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-6">Description</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="field-6" placeholder="Description" name="Description" value="<?php echo $Competency->Description ?>">
							</div>
						</div>

						<div class="form-group-separator"></div>
						
						<a class="btn btn-primary btn-icon btn-icon-standalone" href="competency.php">
							<i class="fa-arrow-left"></i>
							<span>Cancel / Back</span>
						</a>

						<button class="btn btn-secondary btn-icon btn-icon-standalone pull-right" type="submit" form="frmAddCompetency">
							<i class="fa-save"></i>
							<span>Save</span>
						</button>
					</form>
					
				</div>
			</div>	


			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#CompetencyPoint" data-toggle="tab">
								<span class="visible-xs"><i class="fa-bullseye"></i></span>
								<span class="hidden-xs">Points</span>
							</a>
						</li>
						<li>
							<a href="#CompetencySubject" data-toggle="tab">
								<span class="visible-xs"><i class="fa-tasks"></i></span>
								<span class="hidden-xs">Subjects</span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="CompetencyPoint">
							<div>
								<a href="addCompetencyPoint.php?Pid=<?php echo $Competency->get_Id(); ?>" class="btn btn-secondary btn-icon btn-icon-standalone">
									<i class="fa-plus"></i>
									<span>New Competency Point</span>
								</a>

								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										$("#viewdatacompetencypoint").dataTable({
											aLengthMenu: [
												[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]
											],
										});
									});
								</script>
										
								<table id="viewdatacompetencypoint" class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Period</th>
											<th>Participant Type</th>
											<th>Point</th>
											<th>Action</th>
										</tr>
									</thead>
										
									<tbody>
										<?php
								           include_once('../SystemClasses/CompetencyPoint.php');
								           $Conn = Connection::get_DefaultConnection();
								           $CompetencyPoints = CompetencyPoint::LoadCollection($Conn, "Competency = ".$_GET['Id']);
								           foreach($CompetencyPoints as $CompetencyPoint){ ?>
										<tr>
											<td>
												<?php
					                				include_once('../SystemClasses/Period.php');
					                				$Period = Period::GetObjectByKey($Conn, $CompetencyPoint->Period);
					                				echo $Period->Code;
					                			?>
											</td>
					                		<td>
					                			<?php
					                				include_once('../SystemClasses/ParticipantType.php');
					                				$ParticipantType = ParticipantType::GetObjectByKey($Conn, $CompetencyPoint->ParticipantType);
					                				echo $ParticipantType->Name;
					                			?>
					                		</td>
					                		<td><?php echo $CompetencyPoint->Point; ?></td>
					                		<td>
					                			<a href="editCompetencyPoint.php?Pid=<?php echo $Competency->get_Id(); ?>&Id=<?php echo $CompetencyPoint->get_Id(); ?>" class="btn btn-secondary btn-sm btn-icon icon-left fa-edit">
													Edit
												</a>
														
												<a href="processDeleteCompetencyPoint.php?Pid=<?php echo $Competency->get_Id(); ?>&Id=<?php echo $CompetencyPoint->get_Id(); ?>" class="btn btn-danger btn-sm btn-icon icon-left fa-close">
													Delete
												</a>
												
					                		</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="CompetencySubject">
							<div>
								<a href="addCompetencySubject.php?Pid=<?php echo $Competency->get_Id(); ?>" class="btn btn-secondary btn-icon btn-icon-standalone">
									<i class="fa-plus"></i>
									<span>New Competency Subject</span>
								</a>

								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										$("#viewdatacompetencysubject").dataTable({
											aLengthMenu: [
												[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]
											],
										});
									});
								</script>
										
								<table id="viewdatacompetencysubject" class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Subject</th>
											<th>Action</th>
										</tr>
									</thead>
										
									<tbody>
										<?php
								           include_once('../SystemClasses/CompetencySubject.php');
								           $Conn = Connection::get_DefaultConnection();
								           $CompetencySubjects = CompetencySubject::LoadCollection($Conn, "Competency = ".$_GET['Id']);
								           foreach($CompetencySubjects as $CompetencySubject){ ?>
										<tr>
											<td>
												<?php
					                				include_once('../SystemClasses/Subject.php');
					                				$Subject = Subject::GetObjectByKey($Conn, $CompetencySubject->Subject);
					                				echo $Subject->Name;
					                			?>
											</td>
					                		
					                		<td>
					                			
												<a href="processDeleteCompetencySubject.php?Pid=<?php echo $Competency->get_Id(); ?>&Id=<?php echo $CompetencySubject->get_Id(); ?>" class="btn btn-danger btn-sm btn-icon icon-left fa-close">
													Delete
												</a>
												
					                		</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php include('footer.php'); ?>
		</div>
		
	</div>
	
	<?php include_once('script.php') ?>

</body>
</html>