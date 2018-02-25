<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
				<div class="row">
					<div class="col-md-5"><span><?php echo 'Staff Ranking Classification'?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
			<?php if($this->session->flashdata('msg')){ ?>
				<div class="alert alert-<?php echo $this->session->flashdata('msg2');?> alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>	
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
							</div>	
							<div class="panel-body">
								<table class="table table-bordered table-condensed table-hover" >
									<tr >
										<th width="10%"><div class="text-center">Job Grade</div></th>
										<th width="10%"><div class="text-center">Point Range</div></th>
										<th width="10%"><div class="text-center">Skill</div></th>
										<th width="10%"><div class="text-center">Level</div></th>
										<th width="40%"><div class="text-center">Positions</div></th>
										<th width="10%"><div class="text-center">Salary</div></th>
										<th width="10%"><div class="text-center">Action</div></th>
									</tr>
									<?php 
									$rowspan_count = 0;
									$prev_id = 0;
									foreach($staff_classification as $classified):?>
									<tr>
										<?php if($prev_id != $classified['staff_job_grade_id']){ ?>
											<td rowspan="<?php if($classified['job_description'] == 'Unskilled' || $classified['job_description'] == 'Semi-skilled' || $classified['job_description'] == 'Management')
												{
													echo '1';
												}
												else{
													echo '4';
												}
													?>" style="vertical-align:middle"><div class="text-center"><?php echo $classified['grade'];?></div></td>
												<?php
										 }?>
										<td  style="vertical-align:middle"><div class="text-center"><?php echo $classified['min_point_range'].' - '.$classified['max_point_range'];?></div></td>
										<?php if($prev_id != $classified['staff_job_grade_id']){ ?>
											<td rowspan="<?php if($classified['job_description'] == 'Unskilled' || $classified['job_description'] == 'Semi-skilled' || $classified['job_description'] == 'Management')
												{
													echo '1';
												}
												else{
													echo '4';
												}
													?>" style="vertical-align:middle"><div class="text-center"><?php echo $classified['job_description'];?></div></td>
										<?php }?>
										<td style="vertical-align:middle"><div class="text-center"><?php echo $classified['level'];?></div></td>
										<?php if($prev_id != $classified['staff_job_grade_id']){ ?>
											<td rowspan="<?php if($classified['job_description'] == 'Unskilled' || $classified['job_description'] == 'Semi-skilled' || $classified['job_description'] == 'Management')
												{
													echo '1';
												}
												else{
													echo '4';
												}
													?>" style="vertical-align:middle"><div class="text-center">
													<?php foreach($position as $job):
														if($classified['staff_job_grade_id'] == $job['staff_job_grade_id']){
															echo $job['position'].'<br />';
														}
													endforeach;
													?></div></td>
										<?php }?>
										<td style="vertical-align:middle"><div class="text-center"><?php echo number_format((float)$classified['staff_salary'], 2, '.', ',');?></div></td>
										<td style="vertical-align:middle"><div class="text-center"><a href="" data-toggle="modal" data-target="#myModal<?php echo $classified['staff_rank_classification_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a></div>
											<div class="modal fade" id="myModal<?php echo $classified['staff_rank_classification_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/staff_ranking_classification',$attributes) ?>
														<div class="modal-header" style="">
														    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														    <h4 class="modal-title" id="myModalLabel">Edit this Staff Ranking Classification?</h4>
														</div>
														<div class="modal-body">
														   	<div class="form-group">
																<label class="col-sm-4 control-label">Job Grade</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $classified['grade']; ?></p>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Skill</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $classified['job_description']; ?></p>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Level</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $classified['level']; ?></p>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Minimum Points</label> 
																<div class="col-sm-7">
																	<input placeholder="min points" value="<?php echo $classified['min_point_range']; ?>" class="form-control input-sm" type="input" name="min_points"
																	<?php if($classified['grade'] == 'I' || $classified['grade'] == 'II' || $classified['grade'] == 'VIII'){
																		echo 'disabled';
																	}?>
																	 />
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Maximum Points</label> 
																<div class="col-sm-7">
																	<input placeholder="max points" value="<?php echo $classified['max_point_range']; ?>" class="form-control input-sm" type="input" name="max_points" 
																	<?php if($classified['grade'] == 'I' || $classified['grade'] == 'II' || $classified['grade'] == 'VIII'){
																		echo 'disabled';
																	}?>
																	/>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Salary</label> 
																<div class="col-sm-7">
																	<input placeholder="salary" value="<?php echo number_format((float)$classified['staff_salary'], 2, '.', ''); ?>" class="form-control input-sm" type="input" name="salary" />
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<input type="hidden" name="staff_rank_id" value="<?php echo $classified['staff_rank_classification_id'];?>">
															<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
															<button type="submit" name="<?php if($classified['grade'] == 'I' || $classified['grade'] == 'II' || $classified['grade'] == 'VIII'){
																		echo 'edit_classification_s';
																	}
																	else{
																		echo 'edit_classification';
																	}?>" class="btn btn-primary btn-sm" value="<?php if($classified['grade'] == 'I' || $classified['grade'] == 'II' || $classified['grade'] == 'VIII'){
																		echo 'edit_classification_s';
																	}
																	else{
																		echo 'edit_classification';
																	}?>" >Edit</button>	
														</div>
												   		</form>
													</div><!-- /.modal-content -->
												</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</td>
									</tr>
									<?php 
									$prev_id = $classified['staff_job_grade_id'];
									endforeach; ?>
								</table>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	