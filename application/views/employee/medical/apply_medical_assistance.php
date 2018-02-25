<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">
				<div class="row">
					<div class="col-md-5">Request Medical Assistance
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2"><div class="text-right">
						<?php 
						echo date('M d, Y');?></div>
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color: #f7f7f7">
				<div class="well well-sm" style="background-color: #def0d8;">
					* Eligible for <?php echo number_format((float)$current_medical_settings['max_benefit'], 2, '.', ','); ?> amount of Medical Assistance Benefit.
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<table class="table table-bordered table-condensed table-hover">
							<tr class="success">
								<th colspan="2"><div class="text-center">Medical Assistance Benefit</div></th>
							</tr>
							<tr>
								<th><div class="text-center">Amount left</div></th>
								<th><div class="text-center">Amount used / Amount Entitled</div></th>
							</tr>
							<tr>
								<td><div class="text-center"><?php $amount_left = $current_medical_settings['max_benefit']-$medical_summary['benefit_consumed'];
								echo number_format((float)$amount_left, 2, '.', ','); ?></div></td>
								<td><div class="text-center"><?php echo number_format((float)$medical_summary['benefit_consumed'], 2, '.', ',').' / '.number_format((float)$current_medical_settings['max_benefit'], 2, '.', ',');?></div></td>			
							</tr>
						</table>
					</div>
					<div class="col-md-2"></div>
				</div>
				<?php if($this->session->flashdata('msg')){ ?>
				<div class="row">&nbsp;
				</div>	
				<div class="alert alert-<?php echo $this->session->flashdata('msg2');?> alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">Medical Assistance Request Information</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-1"></div>
										<div class="col-md-10">
											<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
											echo form_open(base_url().'index.php/my_medical/apply_medical_assistance',$attributes); ?>
											<table class="table table-condensed table-hover" id="field-row-container">
												<tr>
													<th width="30%" style="vertical-align:middle">Receipt Date</th>
													<th width="30%" style="vertical-align:middle">Receipt Number</th>
													<th width="20%" style="vertical-align:middle">Amount</th>
													<th width="20%" style="vertical-align:middle"><a href="#" class="add-field-row"><small>add <span class="glyphicon glyphicon-plus-sign"></span></small></a> &nbsp; <a a href="#" class="delete-field-row"><small>delete <span class="glyphicon glyphicon-minus-sign"></span></small></a></th>
												</tr>
												<tr id="field-row-0" class="clonedinput">
													<td><div class="input-group datetimepickeredit">
 														<input data-format="MM/dd/yyyy" type="text" class="form-control input-sm" placeholder="mm/dd/yyyy" id="receipt_date[0]" name="receipt_date[0]">
  														<span class="input-group-addon">
  															<span class="glyphicon glyphicon-calendar"></span>
  														</span>
													</div></td>
													<td><input placeholder="OR Number" value="<?php echo set_value('receipt_number[]'); ?>" class="form-control input-sm" type="input" id="receipt_number[0]" name="receipt_number[0]"/></td>
													<td colspan="2"><input value="0.00" placeholder="Amount" class="form-control input-sm" type="input" id="amount[0]" name="amount[0]" style="text-align: right;"/></td>
												</tr>
											</table>
											<table class="table table-condensed table-hover">
												<tr>
													<td width="30%"><span class="help-block"><span class="text-danger small"><?php echo form_error('receipt_date[]')?></span></td>
													<td width="30%"><span class="help-block"><span class="text-danger small"><?php echo form_error('receipt_number[]')?></span></td>
													<td width="40%" colspan="2"><span class="help-block"><span class="text-danger small"><?php echo form_error('amount[]')?></span></td>
												</tr>
											</table>
											<div class="form-group">
												<label class="col-sm-3 control-label">Reason</label> 
												<div class="col-sm-4">
													<small><textarea rows="3" class="form-control" name="reason" value="<?php echo set_value('reason'); ?>"></textarea></small>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('reason')?></span>
												</div>
											</div>
											<input type="hidden" name="date_submitted" value="<?php echo date('Y-m-d H:i:s'); ?>">
											<input type="hidden" name="status" value="<?php echo 'Pending'; ?>">
											<input type="hidden" name="year_id" value="<?php echo $year['year_id']; ?>">
											<input type="hidden" name="employee_type_id" value="<?php echo $employee_type; ?>">
											<input type="hidden" name="employee_status_id" value="<?php echo $status; ?>">
											<input type="hidden" name="length_of_service" value="<?php echo $length_of_service; ?>">
											<input type="hidden" name="amount_left" value="<?php echo $amount_left; ?>">
											<input type="hidden" name="base_benefit_id" value="<?php echo $current_medical_settings['base_benefit_id']; ?>">
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-10">
													<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-primary" role="button">Submit Request</a>
													<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header" style="">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	<h4 class="modal-title" id="myModalLabel">Are you sure you want to submit this request?</h4>
																</div>
																<div class="modal-body">
																	* Make sure all details of the medical request are correct before clicking the submit request button below.
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
																	<button type="submit" name="submit" class="btn btn-primary btn-sm">Submit Request</button>
																</div>
															</div><!-- /.modal-content -->
														</div><!-- /.modal-dialog -->
													</div><!-- /.modal -->
												</div>
											</div>
											</form>
										</div>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	


