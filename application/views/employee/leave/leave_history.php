<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
				<div class="row">
					<div class="col-md-3"><?php echo $leave_title; ?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-condensed table-hover table-striped">
									<thead>
									<tr>
										<th width="10%">Type</th>
										<th width="20%">Date Submitted</th>
										<th width="10%">From</th>
										<th width="10%">To</th>
										<th width="10%">Duration</th>
										<th width="30%">Notes</th>
										<th width="10%"> Status</th>
									</tr>
									</thead>
									<?php if (count($leave_history)<1){
											?> 
											<tr>
												<td colspan="7">
													&nbsp; <br />
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
													</div>
												</td>
											</tr>
										
										
									<?php } foreach ($leave_history as $history): ?>
									<tr
										<?php if ($history['status'] == 'Approved'){
											echo 'class="success"';
										}
										elseif($history['status'] == 'Rejected'){
											echo 'class="danger"';
										}
										else{
											echo 'class="warning"';
										}?> id="request<?php echo $history['leave_id'];?>">
										<td style="vertical-align: middle;"><?php echo $history['type'];?></td>
										<td style="vertical-align: middle;"><?php echo date('M d, Y', strtotime($history['date_submitted']));?></td>
										<td style="vertical-align: middle;"><?php echo date('M d, Y', strtotime($history['leave_start_date']));?></td>
										<td style="vertical-align: middle;"><?php echo date('M d, Y', strtotime($history['leave_end_date']));?></td>
										<td style="vertical-align: middle;"><?php  if($history['duration'] > 1)
												   {
												   echo $history['duration'].' days';
												   }
												   else
												   {
												   echo $history['duration'].' day';
												   }
												   ?>
												   </td>
										<td style="vertical-align: middle;"><small><textarea rows="4" cols ="50" readonly style="border: 1px solid #ccc; border-radius: 4px;"><?php echo $history['remarks'];?></textarea></small></td>
										<td style="vertical-align: middle;"><?php echo $history['status'];?></td>
									</tr>
									<?php endforeach ?>
								</table>
								<div class=text-center>
									<?php echo $links; ?>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

