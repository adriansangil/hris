<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-3">Edit Holiday</div>
					<div class="col-md-5"></div>
					<div class="col-md-4">
						<div class="text-right">
								<a href="<?php echo base_url().'index.php/leave/holidays' ?>" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>  Holiday Settings</a>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-1"></div>
										<div class="col-md-10">
									<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
									echo form_open('leave/edit_holiday/'.$holiday['holiday_id'],$attributes) ?>
										<div class="form-group">
											<label class="col-sm-2 control-label">Description</label> 
											<div class="col-sm-5">
												<input value="<?php echo $holiday['description']; ?>" class="form-control input-sm" type="input" name="desc" />
											</div>
											<div class="col-sm-5">
												<span class="help-block"><span class="text-danger small"><?php echo form_error('desc')?></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Type</label> 
											<div class="col-sm-5">
												<select class="form-control input-sm" name="type_id">				
												<?php foreach($all_holiday_type as $holiday_type): 
													if($holiday['holiday_type_id'] == $holiday_type['holiday_type_id']){
														}
														else{ ?>
													<option value="<?php echo $holiday_type['holiday_type_id']?>"><?php echo $holiday_type['description'];?></option>
												<?php } endforeach?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Date</label> 
											<div class="col-sm-5">
												<input type="date" name="date" class="form-control" value="<?php echo $holiday['date']?>">
											</div>
											<div class="col-sm-5">
												<span class="help-block"><span class="text-danger small"><?php echo form_error('date')?></span>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">	
												<button type="submit" name="submit" class="btn btn-default">Edit Holiday</button>
											</div>
										</div>
										<input type="hidden" name="holiday_id" value="<?php echo $holiday['holiday_id'] ?>">
									<!--<button type="submit" class="btn btn-default" name="submit">Add Employee</button>-->
										</form>
										</div>
									</div>	
									<div class="col-md-1"></div>
								</div>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
