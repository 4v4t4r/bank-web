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

$logs = api_request('/transfers', ['session' => $curuser->getSessionKey(), 'account' => $_GET['account']]);
if ( $logs['code'] != 200 ) die('Fatal Error: Contact White Team and get James ('.$logs['message'].'');
?>

<div class="container">
	<h2>Transaction Logs - Account #<?=$_GET['account'];?></h2>

	<table class="table table-striped">
		<thead>
			<tr>
				<td>Type</td>
				<td>Source Account</td>
				<td>Destination Account</td>
				<td>Amount</td>
				<td>Time</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $logs['transactions'] AS $trans ): ?>
			<tr>
				<td><?=$trans['type']?></td>
				<td>#<?=$trans['src']?></td>
				<td>#<?=$trans['dst']?></td>
				<td><?=money_format('%.2n', $trans['amount'])?></td>
				<td><?=$trans['time']?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?php require './includes/footer.php'; ?>