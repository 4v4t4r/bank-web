<?php
$title = 'Login: Federal Bank';
$curnav = 'Login';

require './includes/config.php';
require './includes/session.php';
require './includes/header.php';

if ( $curuser->isLoggedIn() ) {
	header('Location: /accounts.php');
	die;
}

$message = '';

if ( !empty($_POST) && isset($_POST['username']) && isset($_POST['password'])) {
	$result = $curuser->attemptLogin($_POST['username'], $_POST['password']);

	if ( $curuser->isLoggedIn() ) {
		header('Location: /accounts.php');

		die;
	} else {
		$message = $result;
	}
}
?>

<div class="container">
	<h2>Please Sign In</h2>

	<?php if ( !empty($message) ): ?>
	<div class="alert alert-danger">
		<strong>ERROR:</strong> <?=$message?> 
	</div>
	<?php endif; ?>

	<form class="form-horizontal" method="post">
		<div class="form-group">
			<label for="username" class="col-sm-2 control-label">Username</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="username" name="username" placeholder="Username">
			</div>
		</div>

		<div class="form-group">
			<label for="password" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Sign in</button>
			</div>
		</div>
	</form>
</div>

<?php require './includes/footer.php'; ?>