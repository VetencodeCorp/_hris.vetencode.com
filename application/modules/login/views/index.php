<!DOCTYPE html>
<html lang="en">
	<head>
		<?= $this->load->view('themes/stylesheet');?>
		<link href="<?= base_url();?>assets/css/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">
	</head>

	<body class="grey darken-1">
		<div id="login-page" class="row">
			<div class="col s12 card-panel">
				<div id="form-login" data-url="<?= base_url();?>login/auth">
					<div class="row no-margin">
						<div class="input-field col s12 center">
							<img src="<?= base_url();?>assets/images/logo.png" alt="" class="responsive-img valign profile-image-login">
							<p class="center login-form-text">
								V E T E N C O D E
							</p>
						</div>
					</div>
					<div class="row no-margin">
						<div class="input-field col s12">
							<input id="phone" name="phone" type="text">
							<label for="phone" class="center-align">No. HP</label>
						</div>
					</div>
					<div class="row no-margin">
						<div class="input-field col s12">
							<input id="password" type="password">
							<label for="password">Password</label>
						</div>
					</div>
					<div class="row no-margin">
						<div class="input-field col s12">
							<button class="btn-submit col s12" data-href="<?= base_url();?>dashboard" id="btn-login">Login</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?= $this->load->view('themes/script');?> 
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/login.js"></script>
	</body>

</html>