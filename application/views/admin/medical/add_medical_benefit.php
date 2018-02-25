<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">
				<div class="row">
					<div class="col-md-5">Add Medical Assistance Benefit
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2"><div class="text-right">
						<?php 
						echo date('Y')?></div>
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color: #f7f7f7">
				<div class="well well-sm" style="background-color: #def0d8;">
					* Eligible for <?php echo number_format((float)$current_medical_settings['max_benefit'], 2, '.', ',');; ?> amount of Medical Assistance Benefit.
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<table class="table table-striped table-bordered table-condensed table-hover">
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
	
				<div class="alert alert-<?php echo $this->session->flashdata('msg2');?> alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">Add Medical Assistance Information</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-1"></div>
										<div class="col-md-10">
											<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
											echo form_open(base_url().'index.php/medical/add_medical_benefit/'.$employee_id,$attributes); ?>
											<table class="table table-condensed table-hover" id="field-row-container">
												<tr>
													<th width="30%" style="vertical-align:middle">Receipt Date</th>
													<th width="30%" style="vertical-align:middle">Receipt Number</th>
													<th width="30%" style="vertical-align:middle">Amount</th>
													<th width="10%" style="vertical-align:middle"><a class="btn add-field-row">Add <span class="glyphicon glyphicon-plus-sign"></span></a></th>
												</tr>
												<tr id="field-row-0">
													<td><div class="input-group datetimepickeredit">
 														<input data-format="MM/dd/yyyy" type="text" class="form-control input-sm" placeholder="mm/dd/yyyy" id="receipt_date[0]" name="receipt_date[0]">
  														<span class="input-group-addon">
  															<span class="glyphicon glyphicon-calendar"></span>
  														</span>
													</div></td>
													<td><input value="<?php echo set_value('receipt_number[]'); ?>" class="form-control input-sm" type="input" id="receipt_number[0]" name="receipt_number[0]"/></td>
													<td colspan="2"><input value="0.00" class="form-control input-sm" type="input" id="amount[0]" name="amount[0]" style="text-align: right;"/></td>
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
											<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
											<input type="hidden" name="date_submitted" value="<?php echo date('Y-m-d H:i:s'); ?>">
											<input type="hidden" name="status" value="<?php echo 'Approved'; ?>">
											<input type="hidden" name="year_id" value="<?php echo $year['year_id']; ?>">
											<input type="hidden" name="employee_type_id" value="<?php echo $employee_type; ?>">
											<input type="hidden" name="employee_status_id" value="<?php echo $status; ?>">
											<input type="hidden" name="length_of_service" value="<?php echo $length_of_service; ?>">
											<input type="hidden" name="base_benefit_id" value="<?php echo $current_medical_settings['base_benefit_id']; ?>">
											<input type="hidden" name="amount_left" value="<?php echo $amount_left; ?>">
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-10">	
													<button type="submit" name="submit" class="btn btn-primary">Submit</button>
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