<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
				<div class="row">
					<div class="col-md-3"><?php echo 'Holidays ('.$holiday_count.')';?>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
				<!-- Alert Message-->
				<?php if($this->session->flashdata('msg')){ ?>
				<div class="row">&nbsp;</div>	
				<div class="alert alert-<?php echo $this->session->flashdata('msg2');?> alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
				<div class="row">
					<div class="text-center">
						<div class="col-sm-12">
							<?php $attributes = array('class' => 'form-inline', 'role' => 'form');
							echo form_open('leave/holidays',$attributes) ?>
								<div class="form-group">
									<input placeholder="Name of Holiday" class="form-control input-sm" type="input" name="desc" value="<?php echo set_value('desc'); ?>"/>
								</div>
								<div class="form-group">
									<select class="form-control input-sm" name="type_id">				
										<?php foreach($all_holiday_type as $holiday_type): ?>
											<option value="<?php echo $holiday_type['holiday_type_id']?>"><?php echo $holiday_type['description'];?></option>
										<?php endforeach?>
									</select>
								</div>
								<div class="form-group">
									<div class="input-group" style="width: 175px;" id="datetimepickeradd">
 										<input data-format="MM/dd/yyyy" type="text" class="form-control input-sm" placeholder="mm/dd/yyyy" name="date">
  										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
								</div>
								<div class="form-group">
									&nbsp; &nbsp; <button type="submit" name="add_holiday" value="add_holiday" class="btn btn-primary btn-sm">Add Holiday</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">&nbsp;</div>
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-condensed table-hover">
									<thead>
									<tr>
										<th width="30%"> Holiday</th>
										<th width="20%"> Type</th>
										<th width="30%"> Date</th>
										<th width="20%" colspan="2" class="text-center"><span class="glyphicon glyphicon-pencil"></span> Action</th>
									</tr>
									</thead>
									<?php if (count($all_holidays)<1){
											?> 
											<tr>
												<td colspan="5">
													&nbsp; <br />
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
													</div>
												</td>
											</tr>
										<?php } foreach ($all_holidays as $holiday): ?>
									<tr>
										<td><?php echo $holiday['holiday'];?></td>
										<td><?php echo $holiday['description'];?></td>
										<td><?php echo $holiday['month'].' '.$holiday['day'];?></td>
										<td><a href="" data-toggle="modal" data-target="#myModaledit<?php echo $holiday['holiday_id'];?>"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a>
											<div class="modal fade" id="myModaledit<?php echo $holiday['holiday_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('leave/holidays',$attributes) ?>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Edit this holiday?</h4>
														</div>
														<div class="modal-body">
																<div class="form-group">
																	<label class="col-sm-3 control-label">Name of Holiday</label> 
																	<div class="col-sm-8">
																		<input placeholder="" value="<?php echo $holiday['holiday']; ?>" class="form-control input-sm" type="input" name="holiday_name" />
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-3 control-label">Holiday Type</label> 
																	<div class="col-sm-8">
																		<select class="form-control input-sm" name="type_id">				
																		<?php foreach($all_holiday_type as $holiday_type): 
																			if($holiday['holiday_type_id'] == $holiday_type['holiday_type_id']){?>
																				<option value="<?php echo $holiday['holiday_type_id']?>" selected><?php echo $holiday['description'];?></option>
																				<?php }
																				 else{ ?>
																			<option value="<?php echo $holiday_type['holiday_type_id']?>"><?php echo $holiday_type['description'];?></option>
																		<?php } endforeach?>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-3 control-label">Holiday Date</label>
																	<div class="col-sm-8">
																	<div class="input-group datetimepickeredit">
 																		<input data-format="MM/dd/yyyy" type="text" class="form-control input-sm" placeholder="mm/dd/yyyy" name="date" value="">
  																		<span class="input-group-addon">
  																			<span class="glyphicon glyphicon-calendar"></span>
  																		</span>
																	</div>
																	</div>
																</div>
																<input type="hidden" name="holiday_id" value="<?php echo $holiday['holiday_id'] ?>">
															<!--<button type="submit" class="btn btn-default" name="submit">Add Employee</button>-->
														</div>
														<div class="modal-footer">
															<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
															<button type="submit" name="edit_holiday" value="edit_holiday" class="btn btn-primary btn-sm">Edit</button>
														</div>
														</form>	
													</div>
												</div>
											</div>
										</td>
										<td><a href="" data-toggle="modal" data-target="#myModal<?php echo $holiday['holiday_id'];?>"><span class="glyphicon glyphicon-trash"></span><small> Delete</small></a>
											<div class="modal fade" id="myModal<?php echo $holiday['holiday_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Delete this holiday?</h4>
														</div>
														<div class="modal-body">
															<table width="100%">
																<tr>
																	<td>Holiday:</td>
																	<td><?php echo $holiday['holiday'];?></td>
																</tr>
																<tr>
																	<td>Type:</td>
																	<td><?php echo $holiday['description'];?></td>
																</tr>
																<tr>
																	<td>Date:</td>
																	<td><?php echo $holiday['month'].' '.$holiday['day'];?></td>
																</tr>
															</table>	
														</div>
														<div class="modal-footer">
															<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
															<a href="<?php echo base_url().'index.php/leave/delete_holiday/'.$holiday['holiday_id']?>" class="btn btn-danger btn-sm" role="button">Delete</a>
														</div>
													</div>
												</div>
											</div>		
										</td>
									</tr>
										<?php endforeach ?> 
								</table>
							</div>
						</div>	
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
		</div>
	</div>
</div>	