<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>
<div class="row">
<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#337bb8; color: #fff;">
				<div class="row">
					<div class="col-md-3">My Profile Information</div>
					<div class="col-md-5"></div>
				</div>
			</div>
			<div class="panel-body" style="background-color:#f7f7f7">
				<div class="row">
					<div class="col-md-2">
						<div class="row">
							<div class="col-md-12">
								<img src="<?php echo base_url().'images/user-image.png' ?>" alt="user-image" class="img-thumbnail" width="165px;" style="min-height:165px;height:165px;">
							</div>
						</div>
					</div>
					<div class="col-md-10">
						<div class="row">
							<div class="col-md-12">
								<div class="panel-group" id="accordion">
									<div class="panel panel-default">
									    <div class="panel-heading" style="background-color:#337bb8; color: #fff;">
									      	<h4 class="panel-title">
									        	<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									          	Personal Information
									        	</a>
									      	</h4>
									    </div>
									   	<div id="collapseOne" class="panel-collapse collapse in">
									      	<div class="panel-body">
									        	<table width="50%">
													<tr>
														<td width="40%" >Name:</td>
														<td><?php echo $employee['first_name'].' '.$employee['middle_name'].' '.$employee['last_name'];?></td>
													</tr>
													<tr>
														<td>Address: </td>
														<td><?php echo $employee['address'];?></td>
													</tr>
													<tr>
														<td>Gender: </td>
														<td><?php echo $employee['gender'];?></td>
													</tr>
													<tr>
														<td>Birthday: </td>
														<td><?php echo 'Work In Progress'?></td>
													</tr>
													<tr>
														<td>Mobile Number:</td>
														<td><?php echo $employee['mobile_num'];?></td>
													</tr>
													<tr>
														<td>Email address:</td>
														<td><?php echo $employee['work_email'];?></td>
													</tr>
												</table>
      										</div>
									    </div>
									</div>
									<div class="panel panel-default">
									    <div class="panel-heading" style="background-color:#337bb8; color: #fff;">
									      	<h4 class="panel-title">
									        	<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									        	Job Details
									       		</a>
									      	</h4>
									    </div>
									    <div id="collapseTwo" class="panel-collapse collapse">
									      	<div class="panel-body">
        										<table width="50%">
													<tr>
														<td width="40%">Employee Type:</td>
														<td><?php echo $employee['employee_type'];?></td>
													</tr>
													<tr>
														<td>Position:</td>
														<td>Work in Progress!</td>
													</tr>
													<tr>
														<td>Status:</td>
														<td><?php echo $employee['employee_status'];?></td>
													</tr>
													<tr>
														<td>Start Date:</td>
														<td><?php echo date('F d, Y', strtotime($employee['start_date']));?></td>
													</tr>
												</table>
										    </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>