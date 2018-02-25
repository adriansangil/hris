<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
				<div class="row">
					<div class="col-md-3"><?php echo 'Work Experience Settings'?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
				<div class="well" style="background-color:#def0d8;">
					* <strong>Note:</strong> For Faculty, 1 year teaching experience is equivalent to 2 years of industry experience by default.
				</div>
				<?php if(validation_errors()){ ?>
					<div class="alert alert-danger alert-dismissable">
			 			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<div class="text-center"><p>Edit Failed:</p><?php echo validation_errors(); ?></div>
					</div>
				<?php }?>
				<!-- Alert Message! -->
				<?php if($this->session->flashdata('msg')){ ?>	
				<div class="alert alert-<?php echo $this->session->flashdata('msg2'); ?> alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
				<div class="row">
					<div class="col-md-offset-2 col-md-8">
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
										<th width="50%">Years of experience</th>
										<th width="25%"><div class="text-center">Work Type</div></th>
										<th width="15%"><div class="text-center">Points</div></th>
										<th width="10%"><div class="text-center">Action</div></th>
									</tr>
									</thead>
									<?php foreach($work_faculty as $work):?>
									<tr>
										<td>
											<?php if($work['work_max_months'] == 999)
											{
												$min_year_work =$work['work_min_months']/12;

												if(is_numeric( $min_year_work ) && floor( $min_year_work ) != $min_year_work){
												echo number_format((float)$min_year_work, 1, '.', '').' years & above';
												}
												else {
													echo $min_year_work.' years & above';
												}
											}
											else
											{
												$min_year_work =$work['work_min_months']/12;
												$max_year_work =$work['work_max_months']/12;
												if($max_year_work <=1){
													//round of to 1 decimal place min year
													if(is_numeric( $min_year_work ) && floor( $min_year_work ) != $min_year_work){
													echo number_format((float)$min_year_work, 1, '.', '').' - ';
													}
													else {
														echo $min_year_work.' - ';
													}
													//round of to 1 decimal place max year
													if(is_numeric( $max_year_work ) && floor( $max_year_work ) != $max_year_work){
													echo number_format((float)$max_year_work, 1, '.', '').' year';
													}
													else {
														echo $max_year_work.' year';
													}
												}
												else{
											 		//round of to 1 decimal place min year
													if(is_numeric( $min_year_work ) && floor( $min_year_work ) != $min_year_work){
													echo number_format((float)$min_year_work, 1, '.', '').' - ';
													}
													else {
														echo $min_year_work.' - ';
													}
													//round of to 1 decimal place max year
													if(is_numeric( $max_year_work ) && floor( $max_year_work ) != $max_year_work){
													echo number_format((float)$max_year_work, 1, '.', '').' years';
													}
													else {
														echo $max_year_work.' years';
													}
											 	}
											}?>
										</td>
										<td><div class="text-center"><?php echo $work['work_type'];?></div></td>
										<td><div class="text-center"><?php echo $work['work_points'];?></div></td>
										<td><div class="text-center">
											<a href="" data-toggle="modal" data-target="#myModal<?php echo $work['work_experience_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a></div>
											<div class="modal fade" id="myModal<?php echo $work['work_experience_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('ranking/work_experience_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Work Experience Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label">Minimum Month</label> 
																<div class="col-sm-5">
																	<div class="input-group">
																		<input placeholder="min month" value="<?php echo $work['work_min_months']; ?>" class="form-control input-sm" type="input" name="min_month" />
																		<span class="input-group-addon">
														  					<small>Month/s</small>
														  				</span>
																	</div>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Maximum Month</label> 
																<div class="col-sm-5">
																	<div class="input-group">	
																		<input placeholder="max month" value="<?php echo $work['work_max_months']; ?>" class="form-control input-sm" type="input" name="max_month" />
																		<span class="input-group-addon">
														  					<small>Month/s</small>
														  				</span>
																	</div>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Points</label> 
																<div class="col-sm-5">
																	<input placeholder="points" value="<?php echo $work['work_points']; ?>" class="form-control input-sm" type="input" name="points" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="work_setting_id" value="<?php echo $work['work_experience_id']; ?>">
										      			<input type="hidden" name="etype" value="<?php echo $work['employee_type_id']; ?>">
										      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										      			<button type="submit" name="submit" class="btn btn-primary">Edit</button>	
										     			</div>
										     			</form>
										   			</div><!-- /.modal-content -->
										  		</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</td>
									</tr>
								<?php endforeach; ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

