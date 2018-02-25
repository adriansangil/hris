<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
				<div class="row">
					<div class="col-md-3"><?php echo 'Educational Attainment Settings'?></span>
					</div>
					<div class="col-md-5">
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
					<div class="col-md-offset-1 col-md-10">
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
										<th width="75%">TECHNICAL-VOCATIONAL GRADUATE</th>
										<th width="15%"><div class="text-center">Points</div></th>
										<th width="10%"><div class="text-center">Action</div></th>
									</tr>
									</thead>
									<?php foreach($tech_vocational_faculty as $tech_faculty):?>
									<tr>
										<td><?php echo $tech_faculty['detail']?></td>
										<td><div class="text-center"><?php echo $tech_faculty['educ_points']?></div></td>
										<td><div class="text-center">
											<a href="" data-toggle="modal" data-target="#myModal<?php echo $tech_faculty['educational_attainment_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a>
											<div class="modal fade" id="myModal<?php echo $tech_faculty['educational_attainment_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/education_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Education Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Education Level</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $tech_faculty['level_description']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Education Detail</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $tech_faculty['detail']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Points</label> 
																<div class="col-sm-5">
																	<input value="<?php echo $tech_faculty['educ_points']; ?>" class="form-control input-sm" type="input" name="points" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="education_setting_id" value="<?php echo $tech_faculty['educational_attainment_id']; ?>">
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
										<th>BACHELOR's DEGREE</th>
										<th></th>
										<th></th>
									</tr>
									<?php foreach($bachelor_faculty as $bs_faculty):?>
									<tr>
										<td><?php echo $bs_faculty['detail']?></td>
										<td><div class="text-center"><?php echo $bs_faculty['educ_points']?></div></td>
										<td><div class="text-center">
											<a href="" data-toggle="modal" data-target="#myModal<?php echo $bs_faculty['educational_attainment_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a>
											<div class="modal fade" id="myModal<?php echo $bs_faculty['educational_attainment_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/education_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Education Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Education Level</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $bs_faculty['level_description']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Education Detail</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $bs_faculty['detail']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Points</label> 
																<div class="col-sm-5">
																	<input value="<?php echo $bs_faculty['educ_points']; ?>" class="form-control input-sm" type="input" name="points" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="education_setting_id" value="<?php echo $bs_faculty['educational_attainment_id']; ?>">
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
										<th>MASTER's DEGREE IN ANOTHER FIELD</th>
										<th></th>
										<th></th>
									</tr>
									<?php foreach($masters_other_faculty as $ms_other_faculty):?>
									<tr>
										<td><?php echo $ms_other_faculty['detail']?></td>
										<td><div class="text-center"><?php echo $ms_other_faculty['educ_points']?></div></td>
										<td><div class="text-center">
											<a href="" data-toggle="modal" data-target="#myModal<?php echo $ms_other_faculty['educational_attainment_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a>
											<div class="modal fade" id="myModal<?php echo $ms_other_faculty['educational_attainment_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/education_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Education Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Education Level</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $ms_other_faculty['level_description']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Education Detail</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $ms_other_faculty['detail']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Points</label> 
																<div class="col-sm-5">
																	<input value="<?php echo $ms_other_faculty['educ_points']; ?>" class="form-control input-sm" type="input" name="points" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="education_setting_id" value="<?php echo $ms_other_faculty['educational_attainment_id']; ?>">
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
										<th>MASTER's DEGREE IN THE FIELD</th>
										<th></th>
										<th></th>
									</tr>
									<?php foreach($masters_faculty as $ms_faculty):?>
									<tr>
										<td><?php echo $ms_faculty['detail']?></td>
										<td><div class="text-center"><?php echo $ms_faculty['educ_points']?></div></td>
										<td><div class="text-center">
											<a href="" data-toggle="modal" data-target="#myModal<?php echo $ms_faculty['educational_attainment_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a>
											<div class="modal fade" id="myModal<?php echo $ms_faculty['educational_attainment_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/education_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Education Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Education Level</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $ms_faculty['level_description']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Education Detail</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $ms_faculty['detail']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Points</label> 
																<div class="col-sm-5">
																	<input value="<?php echo $ms_faculty['educ_points']; ?>" class="form-control input-sm" type="input" name="points" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="education_setting_id" value="<?php echo $ms_faculty['educational_attainment_id']; ?>">
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
										<th>DOCTORAL DEGREE IN ANOTHER FIELD</th>
										<th></th>
										<th></th>
									</tr>
									<?php foreach($doctorate_other_faculty as $doc_other_faculty):?>
									<tr>
										<td><?php echo $doc_other_faculty['detail']?></td>
										<td><div class="text-center"><?php echo $doc_other_faculty['educ_points']?></div></td>
										<td><div class="text-center">
											<a href="" data-toggle="modal" data-target="#myModal<?php echo $doc_other_faculty['educational_attainment_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a>
											<div class="modal fade" id="myModal<?php echo $doc_other_faculty['educational_attainment_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/education_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Education Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Education Level</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $doc_other_faculty['level_description']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Education Detail</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $doc_other_faculty['detail']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Points</label> 
																<div class="col-sm-5">
																	<input value="<?php echo $doc_other_faculty['educ_points']; ?>" class="form-control input-sm" type="input" name="points" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="education_setting_id" value="<?php echo $doc_other_faculty['educational_attainment_id']; ?>">
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
										<th>DOCTORAL DEGREE IN THE FIELD</th>
										<th></th>
										<th></th>
									</tr>
									<?php foreach($doctorate_faculty as $doc_faculty):?>
									<tr>
										<td><?php echo $doc_faculty['detail']?></td>
										<td><div class="text-center"><?php echo $doc_faculty['educ_points']?></div></td>
										<td><div class="text-center">
											<a href="" data-toggle="modal" data-target="#myModal<?php echo $doc_faculty['educational_attainment_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a>
											<div class="modal fade" id="myModal<?php echo $doc_faculty['educational_attainment_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/education_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Education Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Education Level</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $doc_faculty['level_description']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Education Detail</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $doc_faculty['detail']; ?></p>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label" for="FirstName">Points</label> 
																<div class="col-sm-5">
																	<input value="<?php echo $doc_faculty['educ_points']; ?>" class="form-control input-sm" type="input" name="points" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="education_setting_id" value="<?php echo $doc_faculty['educational_attainment_id']; ?>">
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

