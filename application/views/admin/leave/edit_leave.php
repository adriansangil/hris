<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-3">Edit Leave Type</div>
					<div class="col-md-5"></div>
					<div class="col-md-4">
						<div class="text-right">
								<a href="<?php echo base_url().'index.php/leave/leave_type' ?>" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span>  Leave Type Settings</a>
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
									echo form_open('leave/edit_leave_type/'.$leave['leave_type_id'],$attributes) ?>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="FirstName">Leave Type</label> 
											<div class="col-sm-5">
												<input placeholder="<?php echo $leave['type']; ?>" class="form-control input-sm" type="input" name="ltype" />
											</div>
											<div class="col-sm-5">
												<span class="help-block"><span class="text-danger small"><?php echo form_error('ltype')?></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="MiddleName">Description</label> 
											<div class="col-sm-5">
												<textarea placeholder="<?php echo $leave['description']; ?>" class="form-control" rows="3" name="desc" type="input"></textarea>
											</div>
											<div class="col-sm-5">
												<span class="help-block"><span class="text-danger small"><?php echo form_error('desc')?></span>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-4 col-sm-10">	
												<button type="submit" name="submit" class="btn btn-default">Edit Leave</button>
											</div>
										</div>	
										<input type="hidden" name="type_id" value="<?php echo $leave['leave_type_id'] ?>">
									<!--<button type="submit" class="btn btn-default" name="submit">Add Employee</button>-->
										</form>
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
