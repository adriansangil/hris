<div class="row">
	<div class="col-md-12">
		<div class="text-center">
			<?php $attributes = array('class' => 'form-horizontal');
			echo form_open('employee/search_employee',$attributes) ?>
			<div class="form-group">
				<div class="col-sm-offset-3 col-md-4">
					<div class="input-group">
						<label class="sr-only" for="search">Employee Name</label>
						<input type="input" class="form-control input-sm" id="search" placeholder="Enter name here." name="namesearch">			
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default btn-sm" name="submit">Search</button>
						</span>
					</div>
				</div>
				<div class="col-md-4">
					<div class="text-left">
					<a href="<?php echo base_url().'index.php/employee/addemployee' ?>" class="btn btn-primary btn-sm" role="button">Add Employee</a>
					</div>
				</div>
			</div>
			</form>
		</div>	
	</div>
</div>


