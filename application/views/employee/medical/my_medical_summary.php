<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">
				<div class="row">
					<div class="col-md-5"><?php echo 'Medical Assistance Benefit Summary Profile - '.$employee['first_name'].' '.$employee['last_name']; ?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2"><div class="text-right">Status: <?php echo $status ?></div>
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color: #f7f7f7">
				<div class="well well-sm" style="background-color: #def0d8;">
					* Eligible for P <?php echo number_format((float)$current_medical_settings['max_benefit'], 2, '.', ','); ?> amount of Medical Assistance Benefit. 
				</div>	
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">
								<div class="row">
									<div class="col-md-3"><?php echo 'Year: '.$year['current_year']; ?></span>
									</div>
									<div class="col-md-5">
									</div>
									<div class="col-md-4">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">&nbsp;</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="text-center">
										<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
										echo form_open(base_url().'index.php/my_medical/my_medical_summary',$attributes); ?>
										<div class="form-group">
											<div class="col-sm-offset-4 col-sm-4">
												<div class="input-group">
														<select class="form-control input-sm" name="search_year_id">				
															<?php foreach ($all_year as $year): ?>
															<option value="<?php echo $year['year_id'];?>"><?php echo $year['current_year'];?></option>
															<?php endforeach ?>
														</select>
													<span class="input-group-btn"><button type="submit" name="submit" class="btn btn-sm btn-default">Search</button></span>
												</div>
											</div>
										</div>
										</form>
									</div>
								</div>
							</div>	
							<div class="panel-body">
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-10">
										<table class="table table-striped table-bordered table-condensed table-hover">
											<tr>
												<th width="20%"><div class="text-center">DATE SUBMITTED</div></th>
												<th width="20%"><div class="text-center">DETAILS</div></th>
												<th width="30%"><div class="text-center">MEDICAL ASSISTANCE BENEFIT</div></th>
												<th width="30%"><div class="text-center">REMARKS</div></th>
											</tr>
											<?php if(count($medical_summary) < 1){ ?>
											<tr>
												<th colspan="7">
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
													</div>
												</th>
											</tr>
											<?php } 
												$total_benefits = 0;

												foreach ($medical_summary as $summary): ?>
											<tr>
												<td><div class="text-center"><?php echo date('M d, Y', strtotime($summary['date_submitted']));?></div></td>
												<td><a href="#" data-toggle="modal" data-target="#myModal<?php echo $summary['medical_id'];?>"><div class="text-center"><span class="glyphicon glyphicon-edit"></span><small> View</small></div></a>
													<div class="modal fade" id="myModal<?php echo $summary['medical_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header" style="">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	<h4 class="modal-title" id="myModalLabel">Medical Assistance Receipt Information - <?php echo date('M d, Y', strtotime($summary['date_submitted'])); ?></h4>
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
																					if($r['medical_id']==$summary['medical_id']){ ?>
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
												<td><div class="text-center">
													<?php 
													$max_benefit_remaining = $summary['max_benefit'] - $total_benefits;
													if($max_benefit_remaining - $summary['amount'] >= 0)
													{
														echo number_format((float)$summary['amount'], 2, '.', ',');

														$total_benefits = $total_benefits +$summary['amount'];
													}?>

												</div></td>
												<td><div class="text-center"><?php echo $summary['remarks'];?></div></td>
											</tr>
											<?php endforeach ?>
											<tr  class="success">
												<th>TOTAL</th>
												<td></td>
												<td><div class="text-center"><?php echo number_format((float)$total_benefits, 2, '.', ','); ?> / <?php echo number_format((float)$current_medical_settings['max_benefit'], 2, '.', ','); ?></div></td>
												<td><div class="text-center"></div></td>
										</table>
									</div>
									<div class="col-md-1"></div>
								</div>	
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	