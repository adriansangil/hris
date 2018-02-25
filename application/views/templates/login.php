<!DOCTYPE html>
<html>
	<head>
		<title>Login Page - H R I S</title>
		<link rel="icon" type="image/ico" href="<?php echo base_url().'/images/favicon.ico' ?>">
		<link href="<?php echo base_url().'/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet">
	</head>
	
	<body style="background-color: #ebebeb;">
		<div class="container">
			<div style="height: 125px;"></div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="panel panel-default" style="background-color: #222; border-radius: 5px;">
					<div class="panel-heading" style="background-color: #fff;">
						<div class="row">
							<div class="col-md-12">&nbsp;</div> 
						</div>
						<div class="row">
							<div class="col-md-12"><div class="text-center"><img src="<?php echo base_url().'images/ici-hris-logo.png'?>" class="img-rounded"></a></div></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="text-center">&nbsp; 
									<span style="color: red"><small>
									<!-- Alert Message-->
									<?php if($this->session->flashdata('msg')){ ?>
										<?php echo $this->session->flashdata('msg').'
										<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>';
									} ?>
									</small></span>
								</div>
							</div> 
						</div>
					</div>
					<div class="panel-body" >
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-8">	
								<?php $attributes = array('class' => 'form-horizontal');
								echo form_open(base_url().'index.php/login/validate_credentials',$attributes) ?>
									<div class="form-group">
										<div class="col-sm-12">
											<input placeholder="Username" value="<?php echo set_value('username'); ?>" class="form-control" type="input" name="username"/>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<input placeholder="Password" value="" class="form-control" type="password" name="password"/>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">	
											<div class="text-right"><button type="submit" name="submit" class="btn btn-primary">Log in</button></div>
										</div>
									</div>
								</form>
							</div>
							<div class="col-md-2"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
		</div>
		<script type="text/javascript" src="/hris/bootstrap/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="/hris/bootstrap/js/bootstrap.js"></script>		
	</body>
</html>