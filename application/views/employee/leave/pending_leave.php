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
								<?php if($this->session->flashdata('msg')){ ?>
									<div class="row">&nbsp;</div>	
									<div class="alert alert-<?php echo $this->session->flashdata('msg2');?> alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
									</div>
								<?php	} ?>

								<table class="table table-condensed table-hover">
									<thead>
									<tr>
										<th width="8%">Type</th>
										<th width="15%">Date Submitted</th>
										<th width="10%">From</th>
										<th width="10%">To</th>
										<th width="10%">Duration</th>
										<th width="30%">Notes</th>
										<th width="8%"> Status</th>
										<th width="9%"><div class="text-center"><span class="glyphicon glyphicon-pencil"></span> Action</div></th>
									</tr>
									</thead>
									<?php if (count($leave_history)<1){
											?> 
											<tr>
												<td colspan="9">
													&nbsp; <br />
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
													</div>
												</td>
											</tr>
										
										
									<?php } foreach ($leave_history as $history): ?>
									<tr class="warning" id="request<?php echo $history['leave_id'];?>">
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
										<td style="vertical-align: middle;"><div class="text-center"><a href="" data-toggle="modal" data-target="#myModal<?php echo $history['leave_id']?>"><span class="glyphicon glyphicon-trash"></span><small> Delete</small></a></div>
											<div class="modal fade" id="myModal<?php echo $history['leave_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Delete this Pending Request?</h4>
														</div>
														<div class="modal-body">
															<table width="100%">
																<tr>
																	<td>Leave Type:</td>
																	<td><?php echo $history['type'];?></td>
																</tr>
																<tr>
																	<td>Date Submitted:</td>
																	<td><?php echo date('M d, Y', strtotime($history['date_submitted']));?></td>
																</tr>
																<tr>
																	<td>Leave Date:</td>
																	<td>From: <?php echo date('M d, Y', strtotime($history['leave_start_date']));?> To: <?php echo date('M d, Y', strtotime($history['leave_end_date']));?></td>
																</tr>
																<tr>
																	<td>Duration:</td>
																	<td><?php  if($history['duration'] > 1)
																	   {
																	   echo $history['duration'].' days';
																	   }
																	   else
																	   {
																	   echo $history['duration'].' day';
																	   }
																	   ?>
																	</td>
																</tr>
																<tr>
																	<td>&nbsp;</td>
																	<td>&nbsp;</td>
																</tr>
																<tr>
																	<td>Notes:</td>
																	<td><small><textarea name="notes" rows="5" cols="40" style="border: 1px solid #ccc; border-radius: 4px;"><?php echo $history['remarks'];?></textarea></small></td>
																</tr>
															</table>	
														</div>
														<div class="modal-footer">
															<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
															<a href="<?php echo base_url().'index.php/my_leave/delete_pending_request/'.$history['leave_id']?>" class="btn btn-danger btn-sm" role="button">Delete</a>
														</div>
													</div>
												</div>
											</div>
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

