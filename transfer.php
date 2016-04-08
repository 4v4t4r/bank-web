<?php
$title = 'Transfer: Federal Bank';
$curnav = 'Transfer';

require './includes/config.php';
require './includes/session.php';
require './includes/header.php';

$acc = '';
if ( isset($_GET['from']) ) $acc = $_GET['from'];

$notice = '';
if ( 
	isset($_POST['srcAcc']) && 
	isset($_POST['dstAcc']) &&
	isset($_POST['amount']) && is_numeric($_POST['amount']) && 
	isset($_POST['pin']) && is_numeric($_POST['pin'])
) {
	$req = api_request('/transfer', [
		'session' => $curuser->getSessionKey(),
		'src'  => $_POST['srcAcc'],
		'dst'  => $_POST['dstAcc'],
		'amount'  => $_POST['amount'],
		'pin'     => $_POST['pin']
	]);
	
	$notice = '<div class="alert '.($req['code'] == 200 ? 'alert-success' : 'alert-danger').'">'.$req['message'].'</div>';
}
?>

<div class="container">
	<h2>Account Balance Transfer</h2>

	<?=$notice?>

	<form class="form-horizontal" method="post">
		<div class="form-group">
			<label for="srcAcc" class="col-sm-2 control-label">Source Account</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="srcAcc" name="srcAcc" value="<?=$acc?>" placeholder="#0000000000">
			</div>
		</div>

		<div class="form-group">
			<label for="dstAcc" class="col-sm-2 control-label">Destination Account</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="dstAcc" name="dstAcc" value="" placeholder="#0000000000">
			</div>
		</div>

		<div class="form-group">
			<label for="amount" class="col-sm-2 control-label">Amount</label>
			<div class="col-sm-10">
				<div class="input-group">
					<div class="input-group-addon">$</div>
					<input type="text" class="form-control" id="amount" name="amount" value="" placeholder="1000">
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="pin" class="col-sm-2 control-label">PIN</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="pin" name="pin" placeholder="PIN">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Send Money!</button>
			</div>
		</div>
	</form>
</div>

<?php require './includes/footer.php'; ?>