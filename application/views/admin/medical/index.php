<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">
				<div class="row">
					<div class="col-md-4"><?php echo $title.' ('.$count.')'; ?></span>
					</div>
					<div class="col-md-4">
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
										<th width="15%"><span class="glyphicon glyphicon-user"></span> Employee</th>
										<th width="15">Date Submitted</th>
										<th width="15%">Amount</th>
										<th width="15%">Details</th>
										<th width="30%">Remarks</th>
										<th width="10%"><div class="text-center"><span class="glyphicon glyphicon-pencil"></span> Action</div></th>
									</tr>
									</thead>
									<?php if (count($medical_request)<1){
											?> 
											<tr>
												<td colspan="7">
													&nbsp; <br />
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
													</div>
												</td>
											</tr>
										
										
									<?php } foreach ($medical_request as $request): ?>
									<tr class="warning" id="request<?php echo $request['medical_id'];?>">
										<td style="vertical-align:middle;"><a href="<?php echo base_url().'index.php/my_medical/my_medical_summary';?>"><?php echo $request['first_name'].' '.$request['last_name'];?></a></td>
										<td style="vertical-align:middle;"><?php echo date('M d, Y', strtotime($request['date_submitted']));?></td>
										<td style="vertical-align:middle;"><?php echo number_format((float)$request['amount'], 2, '.', ',');?></td>
										<td style="vertical-align:middle;">
											<a href="#" data-toggle="modal" data-target="#myModal<?php echo $request['medical_id'];?>"><div class="text-left"><span class="glyphicon glyphicon-edit"></span><small> View</small></div></a>
											<div class="modal fade" id="myModal<?php echo $request['medical_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header" style="">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Medical Assistance Receipt Information - <?php echo date('M d, Y', strtotime($request['date_submitted'])); ?></h4>
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
																			if($r['medical_id']==$request['medical_id']){ ?>
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
										<td style="vertical-align:middle;"><small><textarea rows="4" cols ="50" readonly style="border: 1px solid #ccc; border-radius: 4px;"><?php echo $request['remarks'];?></textarea></small></td>
										<td style="vertical-align:middle;">
											<a href="" data-toggle="modal" data-target="#myModaldecide<?php echo $request['medical_id'];?>"><div class="text-center"><span class="glyphicon glyphicon-edit"></span><small> View</small></div></a>
											<div class="modal fade" id="myModaldecide<?php echo $request['medical_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Decide on this Medical Assistance Request?</h4>
														</div>
														<div class="modal-body">
															<table class="table table-condensed table-bordered table-hover">
																<tr class="success">
																	<th colspan="2"><div class="text-center">Medical Assistance Benefit</div></th>
																</tr>
																<tr>
																	<th><div class="text-center">Amount left</div></th>
																	<th><div class="text-center">Amount used / Amount Entitled</div></th>
																</tr>
																<tr>
																	<td><div class="text-center"><?php $amount_left = $request['max_benefit']-$request['benefit_consumed'];
																	echo number_format((float)$amount_left, 2, '.', ','); ?></div></td>
																	<td><div class="text-center"><?php echo number_format((float)$request['benefit_consumed'], 2, '.', ',').' / '.number_format((float)$request['max_benefit'], 2, '.', ',');?></div></td>			
																</tr>
															</table>
															<table width="100%">
																<tr>
																	<td>Employee Name:</td>
																	<td><?php echo $request['first_name'].' '.$request['last_name'];?></td>
																</tr>
																</tr>
																	<td>Amount Requested:</td>
																	<td><?php echo number_format((float)$request['amount'], 2, '.', ',');?></td>
																</tr>
																<tr>
																	<td>&nbsp;</td>
																	<td>&nbsp;</td>
																</tr>
																<tr>
																	<td style="vertical-align:middle;">Notes:</td>
																	<?php echo form_open(base_url().'index.php/medical/pending_medical_request'); ?>
																	<td style="vertical-align:middle;"><small><textarea name="notes" rows="4" cols="50" style="border: 1px solid #ccc; border-radius: 4px;"><?php echo $request['remarks'];?></textarea></small></td>
																</tr>
																<tr>
																	<td>&nbsp;</td>
																	<td>&nbsp;</td>
																</tr>
																</tr>
																	<td>Grant Amount</td>
																	<td><input placeholder="" value="0.00" class="form-control input-sm" style="width:74%" type="input" name="amount_granted" /></td>
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
																<input type="hidden" name="amount" value="<?php echo $amount_left; ?>">
																<input type="hidden" name="amount" value="<?php echo $request['amount'] ?>">
																<input type="hidden" name="year_id" value="<?php echo $request['year_id'] ?>">
																<input type="hidden" name="employee_id" value="<?php echo $request['employee_id'] ?>">
																<input type="hidden" name="medical_id" value="<?php echo $request['medical_id'] ?>">
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

