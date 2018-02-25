<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
				<div class="row">
					<div class="col-md-5"><span><?php echo 'List of Eligible Employees for Re-ranking'?></span>
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
										<div class="text-right">
											<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-sm" role="button">Re-rank Employees</a>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="text-center">
										<div class="form-group">
											<div class="col-sm-offset-4 col-sm-4">	
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<table class="table table-striped table-bordered table-condensed table-hover">
											<tr>
												<th width="19%"><span class="glyphicon glyphicon-user"></span> Name</th>
												<th width="8%"> Type</th>
												<th width="15%"> Position</th>
												<th width="18%"><span class="glyphicon glyphicon-home"></span> Address</th>
												<th width="15%"><span class="glyphicon glyphicon-phone"></span> Mobile Number</th>
												<th width="15%"><span class="glyphicon glyphicon-envelope"></span> Work Email</th>
											</tr>
											
											<?php if(count($list_employee) < 1){ ?>
											<tr>
												<th colspan="8">
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
													</div>
												</th>
											</tr>
											<?php } foreach($list_employee as $summary):?>
											<tr>
												<td><a href="<?php echo base_url().'index.php/ranking/employee_ranking/'.$summary['emp_id']; ?>"><?php echo $summary['first_name'].' '.$summary['last_name']; ?></a></td>
												<td><?php echo $summary['employee_type'];?></td>
												<td><?php echo $summary['position'];?></td>
												<td><?php echo $summary['address'];?></td>
												<td><?php echo $summary['mobile_num'];?></td>
												<td><?php echo $summary['work_email'];?></td>
											</tr></div></td>
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
				  <li class="list-group-item"><small>[2] All faculty employees need to have educational attainment before re-ranking will work.</small></li>
				  <li class="list-group-item"><small>[3] Update all settings inline with the latest policy (points, point range, weight multipliers, etc.).</small></li>
				</ul>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
				<a href="<?php echo base_url().'index.php/ranking/rerank_employee'?>" class="btn btn-primary btn-sm" role="button">Re-rank</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->