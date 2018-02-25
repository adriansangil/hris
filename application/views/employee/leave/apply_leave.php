<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
				<div class="row">
					<div class="col-md-5">Request a Leave
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2"><div class="text-right">
						<?php 
						echo date('M d, Y');?></div>
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
				<div class="well well-sm" style="background-color: #def0d8;">
					* Eligible for <?php echo $current_sick_leave_settings['max_leave']; ?> Sick Leaves with pay (<?php echo $current_sick_leave_settings['max_convertible']; ?> maximum convertible) and <?php echo $current_vacation_leave_settings['max_leave']; ?> Vacation Leaves with pay (<?php echo $current_vacation_leave_settings['max_convertible']; ?> Maximum Convertible).
				</div>
				<table class="table table-striped table-bordered table-condensed table-hover">
					<tr class="success">
						<th colspan="4"><div class="text-center">Vacation Leave</div></th>
						<th colspan="4"><div class="text-center">Sick Leave</div></th>
					</tr>
					<tr>
						<th><div class="text-center">Remaining Leave Credits</div></th>
						<th><div class="text-center">Used</div></th>
						<th><div class="text-center">Leave without Pay</div></th>
						<th><div class="text-center">Convertible</div></th>
						<th><div class="text-center">Remaining Leave Credits</div></th>
						<th><div class="text-center">Used</div></th>
						<th><div class="text-center">Leave without Pay</div></th>
						<th><div class="text-center">Convertible</div></th>
					</tr>
					<tr>
						<td><div class="text-center"><?php echo $current_vacation_leave_settings['max_leave']-$leave_summary['vl'];?></div></td>
						<td><div class="text-center"><?php echo $leave_summary['vl'].' / '.$current_vacation_leave_settings['max_leave'];?></div></td>
						<td><div class="text-center"><?php echo $leave_summary['vl_lwop'];?></div></td>
						<td><div class="text-center"><?php 
							if($leave_summary['vl'] > $current_vacation_leave_settings['max_convertible']){
								$convertible = 0;
								echo $convertible;
							}
							else{
							echo $current_vacation_leave_settings['max_convertible']-$leave_summary['vl'];
							}
						?></div></td>
						<td><div class="text-center"><?php echo $current_sick_leave_settings['max_leave']-$leave_summary['sl'];?></div></td>
						<td><div class="text-center"><?php echo $leave_summary['sl'].' / '.$current_sick_leave_settings['max_leave'];?></div></td>
						<td><div class="text-center"><?php echo $leave_summary['sl_lwop'];?></div></td>
						<td><div class="text-center"><?php 
							if($leave_summary['sl'] > $current_sick_leave_settings['max_convertible']){
								$convertible = o;
								echo $convertible;
							}
							else{
							echo $current_sick_leave_settings['max_convertible']-$leave_summary['sl'];
							}
						?></div></td>
					</tr>
				</table>
				<?php if($this->session->flashdata('msg')){ ?>
				<div class="row">&nbsp;
				</div>	
				<div class="alert alert-danger alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">Leave Request Information</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-1"></div>
										<div class="col-md-10">
											<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
											echo form_open('my_leave/apply_leave',$attributes); ?>
											<div class="form-group">
												<label class="col-sm-3 control-label">Type of Leave</label> 
												<div class="col-sm-5">
												<select name="leavetype" class="form-control input-sm">
													<?php foreach ($leave_type as $type):?>
														<option value="<?php echo $type['leave_type_id']?>"><?php echo $type['type']; ?></option>
													<?php endforeach; ?>
												</select>
												</div>
												<div class="col-sm-4">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('leavetype')?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">From</label> 
												<div class="col-sm-3">
													<div class="input-group" id="datetimepickeradd">
 														<input data-format="MM/dd/yyyy" type="text" class="form-control input-sm" placeholder="mm/dd/yyyy" name="start_date" value="<?php echo set_value('start_date'); ?>">
  														<span class="input-group-addon">
  															<span class="glyphicon glyphicon-calendar"></span>
  														</span>
													</div>
												</div>
												<div class="col-sm-2">
													<select name="start_half" class="form-control input-sm">
														<option value="0" selected>A.M.</option>
														<option value="0.5">P.M.</option>
													</select>
												</div>
												<div class="col-sm-4">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('start_date')?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">To</label> 
												<div class="col-sm-3">
													<div class="input-group" id="datetimepickeredit">
 														<input data-format="MM/dd/yyyy" type="text" class="form-control input-sm" placeholder="mm/dd/yyyy" name="end_date" value="<?php echo set_value('end_date'); ?>">
  														<span class="input-group-addon">
  															<span class="glyphicon glyphicon-calendar"></span>
  														</span>
													</div>
												</div>
												<div class="col-sm-2">
													<select name="end_half" class="form-control input-sm">
														<option value="0.5">A.M.</option>
														<option value="0" selected>P.M.</option>
													</select>
												</div>
												<div class="col-sm-4">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('end_date')?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Reason</label> 
												<div class="col-sm-5">
													<small><textarea rows="3" class="form-control" name="reason" value="<?php echo set_value('reason'); ?>"></textarea></small>
												</div>
												<div class="col-sm-4">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('reason')?></span>
												</div>
											</div>
											<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
											<input type="hidden" name="date_submitted" value="<?php echo date('Y-m-d H:i:s'); ?>">
											<input type="hidden" name="status" value="<?php echo 'Pending'; ?>">
											<input type="hidden" name="year_id" value="<?php echo $year['academic_year_id']; ?>">
											<input type="hidden" name="employee_type_id" value="<?php echo $employee_type; ?>">
											<input type="hidden" name="employee_status_id" value="<?php echo $status; ?>">
											<input type="hidden" name="length_of_service" value="<?php echo $length_of_service; ?>">
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
																	* Make sure all details of the leave request are correct before clicking the submit request button below.
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