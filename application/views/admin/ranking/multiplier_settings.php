<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
				<div class="row">
					<div class="col-md-4"><?php echo 'Weight Multiplier Settings'?></span>
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
											<th width="75%">Criteria</th>
											<th width="15%"><div class="text-center">Multiplier</div></th>
											<th width="10%"><div class="text-center">Action</div></th>
										</tr>
									</thead>
									<?php foreach($faculty_weight_multiplier as $faculty_weight): ?>
									<tr>
										<td><?php echo $faculty_weight['criteria_description']?></td>
										<td><div class="text-center"><?php echo number_format((float)$faculty_weight['weight'], 2, '.', '');?></div></td>
										<td>
											<div class="text-center"><a href="" data-toggle="modal" data-target="#myModalweight<?php echo $faculty_weight['weight_multiplier_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a></div>
											<div class="modal fade" id="myModalweight<?php echo $faculty_weight['weight_multiplier_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/weight_multiplier_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Weight Multiplier Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label">Criteria</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $faculty_weight['criteria_description']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Weight Multiplier</label> 
																<div class="col-sm-5">
																	<input placeholder="multiplier" value="<?php echo number_format((float)$faculty_weight['weight'], 2, '.', ''); ?>" class="form-control input-sm" type="input" name="multiplier" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="weight_id" value="<?php echo $faculty_weight['weight_multiplier_id']; ?>">
										      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										      			<button type="submit" name="edit_weight" value="edit_weight" class="btn btn-primary">Edit</button>	
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
