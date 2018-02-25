<?php 

?>
<table class="table table-condensed table-striped">
		<tr>
			<th><span class="glyphicon glyphicon-user"></span> Name</th>
			<th><span class="glyphicon glyphicon-home"></span> Address</th>
			<th><span class="glyphicon glyphicon-phone"></span> Mobile Number</th>
			<th><span class="glyphicon glyphicon-envelope"></span> Work Email</th>
		</tr>
		<?php foreach ($all_employees as $employee): ?>
		<tr>
			<td><a href="employee/view/<?php echo $employee['employee_id'] ?>"><?php echo $employee['first_name']." ".$employee['last_name']; ?></a></td>
			<td><?php echo $employee['address'] ?></td>
			<td><?php echo $employee['mobile_num'] ?></td>
			<td><?php echo $employee['work_email'] ?></td>
		</tr>
		<?php endforeach ?>
	</table>


