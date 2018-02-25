<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
				<div class="row">
					<div class="col-md-5"><span><?php echo 'Ranking Summary for Faculty Employees'?></span>
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
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
								<div class="row">
									<div class="col-md-5">Last Ranking: <?php 
									if($rerank == 'None'){
										echo $rerank;
									}
									else{
										echo date('l jS \of F Y', strtotime($rerank));
									} ?>
									</div>
									<div class="col-md-3">
									</div>
									<div class="col-md-4">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">&nbsp;</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="text-center">
										<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
										echo form_open(base_url().'index.php/ranking/ranking_summary',$attributes); ?>
										<div class="form-group">
											<div class="col-sm-offset-4 col-sm-4">
												<div class="input-group">
														<select class="form-control input-sm" name="search_rank_date">				
															<?php foreach ($all_rank as $rank): ?>
															<option value="<?php echo $rank['rank_date_id'];?>"><?php if($rank['rank_date'] != null){echo date('M d Y', strtotime($rank['rank_date']));}?></option>
															<?php endforeach ?>
														</select>
													<span class="input-group-btn"><button type="submit" name="submit" class="btn btn-sm btn-default">Search</button></span>
												</div>
											</div>
										</div>
										</form>
									</div>
								</div>
							</div>	
							<div class="panel-body">
								<table class="table table-striped table-bordered table-condensed table-hover">
									<tr>
										<th rowspan="1" width="20%"><div class="text-center">Faculty</div></th>
										<th colspan="2" width="15%"><div class="text-center">Educational Attainment</div></th>
										<th colspan="2" width="15%"><div class="text-center">Work Experience</div></th>
										<th colspan="2" width="15%"><div class="text-center">Certifications/Exams Passed</div></th>
										<th rowspan="1" width="10%"><div class="text-center">Total</div></th>
										<th rowspan="1" width="15%"><div class="text-center">Rank</div></th>
										<th rowspan="1" width="10%"><div class="text-center">Salary</div></th>
									</tr>
									
									<?php if(count($faculty_ranking_summary) < 1){ ?>
									<tr>
										<th colspan="10">
											<div class="alert alert-warning">
												<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
											</div>
										</th>
									</tr>
									<?php } foreach ($faculty_ranking_summary as $summary):?>
									<tr>
										<td><div class="text-center"><a href="<?php echo base_url().'index.php/ranking/employee_ranking/'.$summary['emp_id']; ?>"><?php echo $summary['first_name'].' '.$summary['last_name']; ?></a></div></td>
										<td><div class="text-center" width="7%"><?php echo $summary['educ_attain'];?></div></td>
										<td class="success"><div class="text-center" width="8%"><?php echo $summary['educ_attain']*$summary['educ_multiplier'];?></div></td>
										<td><div class="text-center" width="7%"><?php echo $summary['work_exp'];?></div></td>
										<td class="success"><div class="text-center" width="8%"><?php echo $summary['work_exp']*$summary['work_multiplier'];?></div></td>
										<td><div class="text-center" width="7%"><?php echo $summary['cert_passed'];?></div></td>
										<td class="success"><div class="text-center" width="8%"><?php echo $summary['cert_passed']*$summary['cert_multiplier'];?></div></td>
										<td><div class="text-center"><?php echo $summary['total_rank_points'];?></div></td>
										<td><div class="text-center"><?php echo $summary['rank_position'];?></div></td>
										<td><div class="text-center"><?php echo number_format((float)$summary['rank_salary'], 2, '.', ',');?></div></td>
									</tr>
									</tr>
									<?php endforeach ?>
								</table>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Are you sure you want to do employee re-ranking?</h4>
			</div>
			<div class="modal-body">
				&nbsp;Before Clicking The Rerank button below: <br />
				<br />
				<ul class="list-group">
				  <li class="list-group-item"><small>[1] Check if all employee information are up-to-date. (Educational attainment, Work Experience, Certificates, employee type, etc.). </small></li>
				  <li class="list-group-item"><small>[2] All faculty employees need to have educational attainment before reranking will work.</small></li>
				  <li class="list-group-item"><small>[3] Update all settings inline with the latest policy (points, point range, weight multipliers, etc.).</small></li>
				</ul>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
				<a href="<?php echo base_url().'index.php/ranking/rerank_employee'?>" class="btn btn-primary btn-sm" role="button">Rerank</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->