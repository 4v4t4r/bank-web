<?php
$title = 'Transaction Logs: Federal Bank';
$curnav = 'Transaction Logs';

require './includes/config.php';
require './includes/session.php';
require './includes/header.php';

if ( !$curuser->isLoggedIn() ) {
	header('Location: /login.php');
	die;
}

if ( !isset($_GET['account']) ) {
	header('Location: /accounts.php');
	die;
}

$notice = '';
if (
	!empty($_POST) &&
	isset($_POST['account']) && 
	isset($_POST['pin']) && is_numeric($_POST['pin']) && 
	isset($_POST['newpin']) && is_numeric($_POST['newpin'])
) {
	$change = api_request('/changePin', [
		'session' => $curuser->getSessionKey(),
		'account' => $_POST['account'],
		'pin' => $_POST['pin'],
		'newpin' => $_POST['newpin']
	]);
	
	$notice = '<div class="alert '.($change['code'] != 200 ? 'alert-danger' : 'alert-success').'">'.$change['message'].'</div>';
}
?>

<div class="container">
	<h2>PIN Change - Account #<?=$_GET['account'];?></h2>

	<?=$notice?>

	<p>If you do not remember your PIN, you can purchase the PIN reset service from White Team.</p>

	<form class="form-horizontal" method="post">
		<div class="form-group">
			<label for="newpin" class="col-sm-2 control-label">Account Number</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="account" value="<?=htmlentities($_GET['account'])?>" readonly="readonly">
			</div>
		</div>
		<div class="form-group">
			<label for="newpin" class="col-sm-2 control-label">Current PIN</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="pin" placeholder="Current Account PIN">
			</div>
		</div>

		<div class="form-group">
			<label for="newpin" class="col-sm-2 control-label">New PIN</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="newpin" placeholder="New Account PIN">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Create New Account</button>
			</div>
		</div>
	</form>	
</div>

<?php require './includes/footer.php'; ?>