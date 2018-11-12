<?php $body_class = "Homepage"; ?>
<?php require_once 'header.php'; ?>
	<div class="container-fluid p-0">
		<div class="row no-gutters">
			<div class="col-7 gradient left gradient-primary vh100"></div>
			<div class="col-5">
				<section class="HomeContentSection">
					<form action="#" class="loginForm">
						<div class="container-fluid p-0">
							<div class="row">
								<div class="col-4">
									<input type="text" name="loginusername" id="loginusername" placeholder="Username" required />
								</div>
								<div class="col-4">
									<input type="password" name="loginpassword" placeholder="Password" required />
								</div>
								<div class="col-4">
									<input type="submit" name="loginForm" value="Login" class="submit loginBtn btn border primary">
								</div>
							</div>
						</div>
					</form>
					<div class="legend">
						<p class="lgray">The best place to complain about the world.</p>
						<h2 class="medgray f300">Join now.</h2>
					</div>
					<form action="#" class="registerForm">
						<fieldset>
							<legend class="text"><strong>Sign up now</strong></legend>
							<div class="form-control">
								<label for="email">E-mail</label>
								<input class="textinput" type="email" required name="email" id="email" />
							</div>
							<div class="form-control">
								<label for="username">Username</label>
								<input class="textinput" type="text" required name="username" id="username" />
							</div>
							<div class="form-control">
								<label for="password">Password</label>
								<input class="textinput" type="password" required name="password" id="password" />
							</div>
							<div class="form-control">
								<input type="submit" value="Register" class="submit register btn gradient gradient-primary">
							</div>
						</fieldset>
					</form>
				</section>
			</div>
		</div>
	</div>
<?php require_once 'footer.php'; ?>
