<?php
$title = 'myAccount: Federal Bank';
$curnav = 'myAccount';

require './includes/config.php';
require './includes/session.php';
require './includes/header.php';

if ( !$curuser->isLoggedIn() ) {
	header('Location: /login.php');
	die;
}

if ( !empty($_POST) && is_numeric($_POST['pin']) ) {
	$create = api_request('/newAccount', ['session' => $curuser->getSessionKey(), 'pin' => $_POST['pin']]);
	if ( $create['code'] != 200 ) die('Fatal Error: Contact White Team and get James');
}

$accounts = api_request('/accounts', ['session' => $curuser->getSessionKey()]);
if ( $accounts['code'] != 200 ) die('Fatal Error: Contact White Team and get James');
?>

<div class="container">
	<h2>myAccount - Account Information</h2>

	<table class="table table-striped">
		<thead>
			<tr>
				<td>Account Number</td>
				<td>Balance</td>
				<td>Actions</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $accounts['accounts'] AS $account ): ?>
			<tr>
				<td>#<?=$account['id']?></td>
				<td><?=money_format('%.2n', $account['balance'])?></td>
				<td>
					<a href="/transfer.php?from=<?=$account['id']?>" class="btn btn-xs btn-primary">Transfer Money</a>
					<a href="/logs.php?account=<?=$account['id']?>" class="btn btn-xs btn-info">View Transactions</a>
					<a href="/pin.php?account=<?=$account['id']?>" class="btn btn-xs btn-danger">Change PIN</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<h3>Create a new account</h3>
	<p>This will create a new account under your username.</p>
	<form class="form-horizontal" method="post">
		<div class="form-group">
			<label for="newpin" class="col-sm-2 control-label">New PIN</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="pin" placeholder="New Account PIN">
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