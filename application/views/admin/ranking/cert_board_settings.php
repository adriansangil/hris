<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
				<div class="row">
					<div class="col-md-6"><?php echo 'Certifications / Board / Government Examination Passed Settings'?></span>
					</div>
					<div class="col-md-2">
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
				<?php echo validation_errors(); ?>
				<!-- Alert Message! -->
				<?php if($this->session->flashdata('msg')){ ?>
				<div class="alert alert-success alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
				<div class="row">
					<div class="col-md-offset-2 col-md-8">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
								<div class="row">
									<div class="col-md-3"><?php echo 'Faculty'?></span>
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
										<th width="75%">BOARD / GOV'T EXAMINATION PASSED</th>
										<th width="15%"><div class="text-center">Points</div></th>
										<th width="20%"><div class="text-center">Action</div></th>
									</tr>
									</thead>
									<?php foreach ($cert_faculty_board as $setting):?>
									<tr>
										<td><?php echo $setting['cert_detail']?></td>
										<td><div class="text-center"><?php echo $setting['cert_points']?></div></td>
										<td><div class="text-center">
											<a href="" data-toggle="modal" data-target="#myModal<?php echo $setting['certification_board_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a>
											<div class="modal fade" id="myModal<?php echo $setting['certification_board_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/certification_board_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Certification / Exam Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-5 control-label">Certification / Exam Type</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $setting['cert_type']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-5 control-label">Certification / Exam Detail</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $setting['cert_detail']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-5 control-label" >Points</label> 
																<div class="col-sm-5">
																	<input value="<?php echo $setting['cert_points']; ?>" class="form-control input-sm" type="input" name="points" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="cert_board_id" value="<?php echo $setting['certification_board_id']; ?>">
										      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										      			<button type="submit" name="submit" class="btn btn-primary">Edit</button>	
										     			</div>
										     			</form>
										   			</div><!-- /.modal-content -->
										  		</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</div></td>
									</tr>
									<?php endforeach;?>									
									<tr>
										<th>INDUSTRY CERTIFICATIONS</th>
										<th></th>
										<th></th>
									</tr>
									<?php foreach ($cert_faculty_industry as $setting):?>
									<tr>
										<td><?php echo $setting['cert_detail']?></td>
										<td><div class="text-center"><?php echo $setting['cert_points']?></div></td>
										<td><div class="text-center">
											<a href="" data-toggle="modal" data-target="#myModal<?php echo $setting['certification_board_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a>
											<div class="modal fade" id="myModal<?php echo $setting['certification_board_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/certification_board_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Certification / Exam Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label" >Certification / Exam Type</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $setting['cert_type']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" >Certification / Exam Detail</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $setting['cert_detail']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" >Points</label> 
																<div class="col-sm-5">
																	<input value="<?php echo $setting['cert_points']; ?>" class="form-control input-sm" type="input" name="points" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="cert_board_id" value="<?php echo $setting['certification_board_id']; ?>">
										      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										      			<button type="submit" name="submit" class="btn btn-primary">Edit</button>	
										     			</div>
										     			</form>
										   			</div><!-- /.modal-content -->
										  		</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</div></td>
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

