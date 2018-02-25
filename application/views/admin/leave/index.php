<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
				<div class="row">
					<div class="col-md-3"><?php echo $leave_title.' ('.$count.')'; ?>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
				<!-- Alert Message! -->
				<?php if($this->session->flashdata('msg')){ ?>
				<div class="row">&nbsp;</div>	
				<div class="alert alert-<?php echo $this->session->flashdata('msg2');?> alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
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
										<th width="10%"><div class="text-center"><span class="glyphicon glyphicon-pencil"></span> Action</div></th>
									</tr>
									</thead>
									<?php if (count($all_leave_request)<1){
											?> 
											<tr>
												<td colspan="8">
													&nbsp; <br />
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
													</div>
												</td>
											</tr>
										
										
									<?php } foreach ($all_leave_request as $request): ?>
									<tr class="warning" id="request<?php echo $request['leave_id'];?>">
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
												   ?></td>
										<td style="vertical-align: middle;"><small><textarea rows="4" cols ="50" readonly style="border: 1px solid #ccc; border-radius: 4px;"><?php echo $request['remarks'];?></textarea></small></td>
										<td style="vertical-align: middle;">
											<a href="" data-toggle="modal" data-target="#myModal<?php echo $request['leave_id'];?>"><div class="text-center"><span class="glyphicon glyphicon-edit"></span><small> View</small></div></a>
											<div class="modal fade" id="myModal<?php echo $request['leave_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Decide on this Leave Request?</h4>
														</div>
														<div class="modal-body">
															<table width="100%">
																<tr>
																	<td>Employee Name:</td>
																	<td><?php echo $request['first_name'].' '.$request['last_name'];?></td>
																</tr>
																<tr>
																	<td>Leave Type:</td>
																	<td><?php echo $request['type'];?></td>
																</tr>
																<tr>
																	<td>Date Submitted:</td>
																	<td><?php echo date('M d, Y', strtotime($request['date_submitted']));?></td>
																</tr>
																	<td>Leave Date:</td>
																	<td>From: <?php echo date('M d, Y', strtotime($request['leave_start_date']));?> To: <?php echo date('M d, Y', strtotime($request['leave_end_date']));?></td>
																</tr>
																<tr>
																	<td>&nbsp;</td>
																	<td>&nbsp;</td>
																</tr>
																<tr>
																	<td>Notes:</td>
																	<?php echo form_open(base_url().'index.php/leave/pending_leave'); ?>
																	<td><small><textarea name="notes" rows="5" cols="40" style="border: 1px solid #ccc; border-radius: 4px;"><?php echo $request['remarks'];?></textarea></small></td>
																</tr>
															</table>
														</div>
														<div class="modal-footer">
															<div class="form-group">
																<div class="col-sm-6"></div>
																<div class="col-sm-4">
																	<select name="decision" class="form-control">				
																		<option value="Approved"><?php echo 'Approve' ?></option>
																		<option value="Rejected"><?php echo 'Reject' ?></option>
																	</select>
																</div>
																<input type="hidden" name="academic_year_id" value="<?php echo $request['academic_year_id'] ?>">
																<input type="hidden" name="base_leave_id" value="<?php echo $request['base_leave_id'] ?>">
																<input type="hidden" name="duration" value="<?php echo $request['duration'] ?>">
																<input type="hidden" name="employee_id" value="<?php echo $request['employee_id'] ?>">
																<input type="hidden" name="leave_type" value="<?php echo $request['type'] ?>">
																<input type="hidden" name="leave_id" value="<?php echo $request['leave_id'] ?>">
																<input type="hidden" name="date_decided" value="<?php echo date('Y-m-d H:i:s'); ?>">
															<div class="col-sm-2">
																<button type="submit" name="submit" class="btn btn-primary">Submit</button>
															</div>
															</div>
														</div>
														</form>
													</div>
												</div>
											</div>
										</td>
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

