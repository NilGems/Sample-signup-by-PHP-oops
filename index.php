<?php
	session_start();
	class helper{
		protected $errors;
		protected $data;
		function __construct(){
		  $this->errors=isset($_SESSION["form_error"]) && is_array($_SESSION["form_error"])?$_SESSION["form_error"]:NULL;
		  $this->data=isset($_SESSION["form_data"]) && is_array($_SESSION["form_data"])?$_SESSION["form_data"]:NULL;
		  if(is_array($this->errors)):unset($_SESSION["form_error"]);endif;
		  if(is_array($this->data)):unset($_SESSION["form_data"]);endif;
		}
		public function getE($key=NULL){
		  //Get filtered single error
		  if(is_array($this->errors) && is_string($key) && array_key_exists($key,$this->errors) && !empty(trim($this->errors[$key]," "))){
			return $this->errors[$key];
		  }
		  return NULL;
		}
		public function getD($key=NULL){
		  //Get filtered Data
		  if(is_array($this->data) && is_string($key) &&  array_key_exists($key,$this->data) && !empty(trim($this->data[$key]," "))){
			return $this->data[$key];
		  }
		  return NULL;
		}
	}
	$sc=new helper();
?>
<!Doctype HTML>
<html>
<head>
	<title>Sample copy</title>
	<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css"/>
	<script src="jquery-3.1.1.min.js"></script>
	<script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" style="margin-top:50px;">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">Sample signup</h3>
				  </div>
				  <div class="panel-body">
				    <form class="form-horizontal" action="form_action.php" method="post">
					<div class="form-group">
						<div class="col-md-12<?php echo $sc->getE("fname")?' has-error':NULL;?>">
							<label class="control-label" for="fname">First name</label>
							<input name="fname" id="fname" class="form-control" type="text" value="<?php echo $sc->getD("fname");?>"/>
							<?php if($sc->getE("fname")):?>
								<span class="help-block"><?php echo $sc->getE("fname");?></span>
							<?php endif;?>
						</div>
						<div class="col-md-12<?php echo $sc->getE("lname")?' has-error':NULL;?>">
							<label class="control-label" for="lname">Last name</label>
							<input name="lname" id="lname" class="form-control" type="text" value="<?php echo $sc->getD("lname");?>"/>
							<?php if($sc->getE("lname")):?>
								<span class="help-block"><?php echo $sc->getE("lname");?></span>
							<?php endif;?>
						</div>	
						<div class="col-md-12<?php echo $sc->getE("email")?' has-error':NULL;?>">
							<label class="control-label" for="email">Email address</label>
							<input name="email" class="form-control" id="email" type="email" value="<?php echo $sc->getD("email");?>"/>
							<?php if($sc->getE("email")):?>
								<span class="help-block"><?php echo $sc->getE("email");?></span>
							<?php endif;?>
						</div>
						<div class="col-md-12<?php echo $sc->getE("password")?' has-error':NULL;?>">
							<label class="control-label" for="password">Password</label>
							<input name="password" class="form-control" id="password" type="password" value="<?php echo $sc->getD("password");?>"/>
							<?php if($sc->getE("password")):?>
								<span class="help-block"><?php echo $sc->getE("password");?></span>
							<?php endif;?>
						</div>
						<div class="col-md-12<?php echo $sc->getE("cpassword")?' has-error':NULL;?>">
							<label class="control-label" for="cpassword">Confirm password</label>
							<input name="cpassword" class="form-control" id="cpassword" type="password" value="<?php echo $sc->getD("cpassword");?>"/>
							<?php if($sc->getE("cpassword")):?>
								<span class="help-block"><?php echo $sc->getE("cpassword");?></span>
							<?php endif;?>
						</div>
					</div>
					<input type="hidden" name="signup_form" value="1"/>
					<div class="form-group">
						<?php if($sc->getE("main")):?>
						<div class="bg-primary" style="padding:15px"><?php echo $sc->getE("main");?></div>
						<?php endif;?>
						<div class="col-md-12">
							<button class="btn btn-primary" type="submit">Signup</button>
						</div>
					</div>
				    </form>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>

