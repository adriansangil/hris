<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
				<div class="row">
					<div class="col-md-4"><?php echo 'Base Points Settings'?></span>
					</div>
					<div class="col-md-4">
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
				<?php echo validation_errors(); ?>
				<!-- Alert Message! -->
				<?php if($this->session->flashdata('msg')){ ?>
				<div class="alert alert-<?php echo $this->session->flashdata('msg2'); ?> alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
				<div class="row">
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
								<div class="row">
									<div class="col-md-3"><?php echo 'Faculty';?></span>
									</div>
									<div class="col-md-5">
									</div>
									<div class="col-md-4">
									</div>
								</div>
							</div>	
							<div class="panel-body">
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th width="50%">Criteria</th>
											<th width="25%">Details</th>
											<th width="15%"><div class="text-center">Points</div></th>
											<th width="10%"><div class="text-center">Action</div></th>
										</tr>
									</thead>
									<?php foreach($faculty_base_points as $faculty_base): ?>
									<tr>
										<td><?php echo $faculty_base['criteria_description'];?></td>
										<td><?php echo $faculty_base['base_description'];?></td>
										<td><div class="text-center"><?php echo $faculty_base['base_points'];?></div></td>
										<td>
											<div class="text-center"><a href="" data-toggle="modal" data-target="#myModalbase<?php echo $faculty_base['base_points_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a></div>
											<div class="modal fade" id="myModalbase<?php echo $faculty_base['base_points_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/base_points_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Base Points Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label">Criteria</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $faculty_base['criteria_description']; ?></p>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Details</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $faculty_base['base_description']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Points</label> 
																<div class="col-sm-5">
																	<input placeholder="points" value="<?php echo $faculty_base['base_points']; ?>" class="form-control input-sm" type="input" name="points" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="base_id" value="<?php echo $faculty_base['base_points_id']; ?>">
										      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										      			<button type="submit" name="edit_base" value="edit_base" class="btn btn-primary">Edit</button>	
										     			</div>
										     			</form>
										   			</div><!-- /.modal-content -->
										  		</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</td>
									</tr>
									<?php endforeach;?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
