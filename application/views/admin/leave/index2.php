<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-3">
							<?php echo 'Employee List' ?> <span class="badge"><?php echo $employee_num?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-4">
						<div class="text-right">
							<a href="<?php echo '/hris/index.php/employee/addemployee' ?>" class="btn btn-default btn-sm" role="button">Add Employee</a>
								<!--<a href="#" class="btn btn-danger btn-default" data-toggle="modal" data-target="#myModal">Delete</a> -->
						</div>
					</div>
				</div>	
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="text-center">
							<form class="form-inline" role="form">
							
								<div class="form-group">
									<label class="sr-only" for="exampleInputEmail2">Employee Name</label>
									<input type="input" class="form-control" id="exampleInputEmail2" placeholder="Enter your name!" name="fnamesearch">
								</div>

								<button type="submit" class="btn btn-default" name="submit">Search</button>
						
						<!--<input type="submit" name="submit" value="Create news item" /> -->
							
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">&nbsp;</div>
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th><span class="glyphicon glyphicon-user"></span> Name</th>
											<th><span class="glyphicon glyphicon-home"></span> Address</th>
											<th><span class="glyphicon glyphicon-phone"></span> Mobile Number</th>
											<th><span class="glyphicon glyphicon-envelope"></span> Work Email</th>
											<th colspan="2" class="text-center"><span class="glyphicon glyphicon-pencil"></span> Action</th>						
										</tr>
									</thead>
										<?php foreach ($all_employees as $employee): ?>
										<tr>
											<td><a href="<?php echo base_url().'index.php/employee/view/'.$employee['employee_id'] ?>"><?php echo $employee['first_name']." ".$employee['last_name']; ?></a></td>
											<td><?php echo $employee['address'] ?></td>
											<td><?php echo $employee['mobile_num'] ?></td>
											<td><?php echo $employee['work_email'] ?></td>
											<td><a href="#"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a></td>
											<td><a href="#"><span class="glyphicon glyphicon-trash"></span><small> Delete</small></a></td>
										</tr>
										<?php endforeach ?>
										
										

								</table>
							</div>
						</div>		
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>		
		</div>
	</div>
</div>