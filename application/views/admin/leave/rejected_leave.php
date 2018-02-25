<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
				<div class="row">
					<div class="col-md-3"><?php echo $leave_title.' ('.$count.')'; ?></span>
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
								<table class="table table-condensed table-hover">
									<thead>
									<tr>
										<th width="14%"><span class="glyphicon glyphicon-user"></span> Employee</th>
										<th width="8%">Type</th>
										<th width="13%">Date Submitted</th>
										<th width="10%">From</th>
										<th width="10%">To</th>
										<th width="8%">Duration</th>
										<th width="27%">Notes</th>
										<th width="10%">Date Decided</th>
									</tr>
									</thead>
									<?php if (count($rejected_request)<1){
											?> 
											<tr>
												<td colspan="8">
													&nbsp; <br />
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
													</div>
												</td>
											</tr>
										
										
									<?php } foreach ($rejected_request as $request): ?>
									<tr class="danger">
										<td style="vertical-align: middle;"><a href="<?php echo base_url().'index.php/leave/employee_leave_summary/'.$request['employee_id'];?>"><?php echo $request['first_name'].' '.$request['last_name'];?></a></td>
										<td style="vertical-align: middle;"><?php echo $request['type'];?></td>
										<td style="vertical-align: middle;"><?php echo date('M d, Y', strtotime($request['date_submitted']));?></td>
										<td style="vertical-align: middle;"><?php echo date('M d, Y', strtotime($request['leave_start_date']));?></td>
										<td style="vertical-align: middle;"><?php echo date('M d, Y', strtotime($request['leave_end_date']));?></td>
										<td style="vertical-align: middle;"><?php  if($request['duration'] > 1)
												   {
												   echo $request['duration'].' days';
												   }
												   else
												   {
												   echo $request['duration'].' day';
												   }
												   ?>
												   </td>
										<td style="vertical-align: middle;"><small><textarea rows="5" cols ="50" readonly style="border: 1px solid #ccc; border-radius: 4px;"><?php echo $request['remarks'];?></textarea></small></td>
										<td style="vertical-align: middle;"><?php echo date('M d, Y', strtotime($request['date_decided']));?></td>
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

