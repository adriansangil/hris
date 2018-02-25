<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">
				<div class="row">
					<div class="col-md-3"><?php echo $title.' ('.$count.')'; ?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color: #f7f7f7">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-condensed table-hover">
									<thead>
									<tr>
										<th width="15%"><span class="glyphicon glyphicon-user"></span> Employee</th>
										<th width="15">Date Submitted</th>
										<th width="15%">Amount</th>
										<th width="15%">Details</th>
										<th width="30%">Remarks</th>
										<th width="10%">Status</th>
									</tr>
									</thead>
									<?php if (count($medical_history)<1){
											?> 
											<tr>
												<td colspan="6">
													&nbsp; <br />
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
													</div>
												</td>
											</tr>
										
										
									<?php } foreach ($medical_history as $history): ?>
									<tr class="<?php if($history['status'] == 'Pending'){
										echo 'warning';
									}
									elseif($history['status'] == 'Approved'){
										echo 'success';
									}
									else{
										echo 'danger';
									}?>">
										<td style="vertical-align:middle;"><a href="<?php echo base_url().'index.php/my_medical/my_medical_summary';?>"><?php echo $history['first_name'].' '.$history['last_name'];?></a></td>
										<td style="vertical-align:middle;"><?php echo date('M d, Y', strtotime($history['date_submitted']));?></td>
										<td style="vertical-align:middle;"><?php echo number_format((float)$history['amount'], 2, '.', ',');?></td>
										<td style="vertical-align:middle;">
											<a href="#" data-toggle="modal" data-target="#myModal<?php echo $history['medical_id'];?>"><div class="text-left"><span class="glyphicon glyphicon-edit"></span><small> View</small></div></a>
											<div class="modal fade" id="myModal<?php echo $history['medical_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header" style="">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel"><?php echo $history['first_name'].' '.$history['last_name']; ?>'s Medical Assistance Information - <?php echo date('M d, Y', strtotime($history['date_submitted'])); ?></h4>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-offset-1 col-md-10">
																	<table class="table table-condensed table-hover">
																		<tr>
																			<th><div class="text-center">Receipt Date</div></th>
																			<th><div class="text-center">Receipt Number</div></th>
																			<th><div class="text-center">Receipt Amount</div></th>
																		</tr>
																		<?php $total = 0;
																		foreach($receipt as $r):
																			if($r['medical_id']==$history['medical_id']){ ?>
																			<tr>
																				<td><div class="text-center"><?php echo date('M d, Y', strtotime($r['receipt_date'])); ?></div></td>
																				<td><div class="text-center"><?php echo $r['receipt_number']; ?></div></td>
																				<td><div class="text-center"><?php echo number_format((float)$r['receipt_amount'], 2, '.', ','); ?></div></td>
																			</tr>
																		<?php $total = $total + $r['receipt_amount'];
																		}
																		endforeach; ?>
																		<tr>
																			<td colspan="3">&nbsp;</td>
																		</tr>
																		<tr class="success">
																			<th colspan="2">TOTAL</th>
																			<th><div class="text-center"><?php echo number_format((float)$total, 2, '.', ','); ?></div></th>
																		</tr>
																	</table>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
														</div>
													</div><!-- /.modal-content -->
												</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</td>
										<td style="vertical-align:middle;"><small><textarea rows="4" cols ="50" readonly style="border: 1px solid #ccc; border-radius: 4px;"><?php echo $history['remarks'];?></textarea></small></td>
										<td style="vertical-align:middle;"><?php echo $history['status'];?></td>
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

