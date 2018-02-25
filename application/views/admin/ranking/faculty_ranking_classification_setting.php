<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
				<div class="row">
					<div class="col-md-5"><span><?php echo 'Faculty Ranking Classification'?></span>
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
					<div class="col-md-12"></div>	
							<div class="panel-body">
								<table class="table table-bordered table-condensed table-hover" >
									<tr >
										<th width="10%"><div class="text-center">Rank</div></th>
										<th width="5%"><div class="text-center">Level</div></th>
										<th width="10%"><div class="text-center">Point Range</div></th>
										<th width="55%"><div class="text-center">Minimum Qualification</div></th>
										<th width="10%"><div class="text-center">Salary</div></th>
										<th width="10%"><div class="text-center">Action</div></th>
									</tr>
									<?php 
									$rowspan_count = 0;
									$prev_id = 0;
									foreach($faculty_classification as $classified):?>
									<tr>
										<?php if($prev_id != $classified['faculty_rank_id']){ ?>
											<td rowspan="4" style="vertical-align:middle"><div class="text-center"><?php echo $classified['faculty_rank_description'];?></div></td>
												<?php
										 }?>
										<td style="vertical-align:middle"><div class="text-center"><?php echo $classified['level'];?></div></td>
										<td  style="vertical-align:middle"><div class="text-center"><?php echo $classified['min_point_range_f'].' - '.$classified['max_point_range_f'];?></div></td>
										
											<td style="vertical-align:middle"><div class="text-center"><?php 
											if($classified['level_description'] == "MASTER's DEGREE IN THE FIELD"){
												echo "MASTER's DEGREE";
											}
											elseif($classified['level_description'] == "DOCTORAL DEGREE IN THE FIELD"){
												echo "DOCTORAL DEGREE";
											}
											else{
												echo $classified['level_description']; 
											}
											if($classified['teaching_exp']){
												echo ' and '.$classified['teaching_exp'].' year/s teaching experience';
											}
											if($classified['managerial_exp']){
												echo ' or '.$classified['managerial_exp'].' year/s of managerial experience';
											}
											?></div></td>
										<td><div class="text-center"><?php echo number_format((float)$classified['faculty_salary'], 2, '.', ',');?></div></td>
										<td><div class="text-center"><a href="" data-toggle="modal" data-target="#myModal<?php echo $classified['faculty_rank_classification_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a></div>
											<div class="modal fade" id="myModal<?php echo $classified['faculty_rank_classification_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/faculty_ranking_classification',$attributes) ?>
														<div class="modal-header" style="">
														    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														    <h4 class="modal-title" id="myModalLabel">Edit this Faculty Ranking Classification?</h4>
														</div>
														<div class="modal-body">
														   	<div class="form-group">
																<label class="col-sm-5 control-label">Rank</label> 
																<div class="col-sm-6">
																	<p class="form-control-static"><?php echo $classified['faculty_rank_description']; ?></p>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-5 control-label">Level</label> 
																<div class="col-sm-6">
																	<p class="form-control-static"><?php echo $classified['level']; ?></p>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-5 control-label">Education Level</label> 
																<div class="col-sm-6">
																	<select name="educ_level" class="form-control input-sm">
																	<?php foreach ($educ_level as $educ): 
																		if($classified['education_level_id'] == $educ['education_level_id']){?>
																		<option value="<?php echo $educ['education_level_id']; ?>" name="educ_level" selected><small>
																			<?php 
																			if($educ['level_description'] == "MASTER's DEGREE IN THE FIELD"){
																				echo "MASTER's DEGREE";
																			}
																			elseif($educ['level_description'] == "DOCTORAL DEGREE IN THE FIELD"){
																				echo "DOCTORAL DEGREE";
																			}
																			else{
																				echo $educ['level_description'];
																			}
																			 ?></small></option>
																			<?php }
																		else{?>				
																		<option value="<?php echo $educ['education_level_id']; ?>" name="educ_level"><small><?php 
																		if($educ['level_description'] == "MASTER's DEGREE IN THE FIELD"){
																			echo "MASTER's DEGREE";
																		}
																		elseif($educ['level_description'] == "DOCTORAL DEGREE IN THE FIELD"){
																			echo "DOCTORAL DEGREE";
																		}
																		else{
																			echo $educ['level_description'];
																		}
																		 ?></small></option>
																		<?php } ?>
																	<?php endforeach ?>
																	</select>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-5 control-label">Teaching Experience</label> 
																<div class="col-sm-6">
																	<div class="input-group">
																		<input placeholder="teaching exp" value="<?php echo $classified['teaching_exp']; ?>" class="form-control input-sm" type="input" name="teaching_exp" />
																		<span class="input-group-addon">
															  				<small>Year/s</small>
															  			</span>
															  		</div>
																</div>
															</div>
															<?php if($classified['faculty_rank_description'] == 'Full Professor'){ ?>
															<div class="form-group">
																<label class="col-sm-5 control-label">Managerial Experience</label> 
																<div class="col-sm-6">
																	<div class="input-group">
																		<input placeholder="managerial exp" value="<?php echo $classified['managerial_exp']; ?>" class="form-control input-sm" type="input" name="managerial_exp" />
																		<span class="input-group-addon">
															  				<small>Year/s</small>
															  			</span>
															  		</div>
																</div>
															</div>
															<?php } ?>
															<div class="form-group">
																<label class="col-sm-5 control-label">Minimum Points</label> 
																<div class="col-sm-6">
																	<input placeholder="min points" value="<?php echo $classified['min_point_range_f']; ?>" class="form-control input-sm" type="input" name="min_points" />
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-5 control-label">Maximum Points</label> 
																<div class="col-sm-6">
																	<input placeholder="max points" value="<?php echo $classified['max_point_range_f']; ?>" class="form-control input-sm" type="input" name="max_points" />
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-5 control-label">Salary</label> 
																<div class="col-sm-6">
																	<input placeholder="salary" value="<?php  echo number_format((float)$classified['faculty_salary'], 2, '.', ''); ?>" class="form-control input-sm" type="input" name="salary" />
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<input type="hidden" name="faculty_rank_id" value="<?php echo $classified['faculty_rank_classification_id'];?>">
															<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
															<?php if($classified['faculty_rank_description'] == 'Full Professor'){ ?>
															<button type="submit" name="edit_classification_full" class="btn btn-primary btn-sm" value="edit_classification_full" >Edit</button>	
															<?php }
															else{ ?>
															<button type="submit" name="edit_classification" class="btn btn-primary btn-sm" value="edit_classification" >Edit</button>	
															<?php } ?>
														</div>
												   		</form>
													</div><!-- /.modal-content -->
												</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</td>
									</tr>
									<?php 
									$prev_id = $classified['faculty_rank_id'];
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