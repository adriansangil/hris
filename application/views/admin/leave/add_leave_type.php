<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-3">Add Leave Type</div>
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
									
										<div class="col-md-12">

									<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
									echo form_open('leave/add_leave_type',$attributes) ?>
										<div class="form-group">
											<label class="col-sm-2 control-label">Leave Type</label> 
											<div class="col-sm-5">
												<input placeholder="" class="form-control input-sm" type="input" name="ltype" />
											</div>
											<div class="col-sm-5">
												<span class="help-block"><span class="text-danger small"><?php echo form_error('ltype')?></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Description</label> 
											<div class="col-sm-5">
												<textarea placeholder="" class="form-control" rows="3" name="desc" type="input"></textarea>
											</div>
											<div class="col-sm-5">
												<span class="help-block"><span class="text-danger small"><?php echo form_error('desc')?></span>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">	
												<button type="submit" name="submit" class="btn btn-default">Add Leave</button>
											</div>
										</div>
									</form>
									</div>
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
