<?php
$title = 'Purchase Confirmation: Federal Bank';
$curnav = 'Purchase';

require './includes/config.php';
require './includes/session.php';
require './includes/header.php';

if ( !isset($_GET['item']) || !isset($products[$_GET['item']]) || $products[$_GET['item']]['enabled'] == false ) {
	header('Location: /purchase.php');
}

$notice = '';
if ( 
	isset($_POST['srcAcc']) && 
	isset($_POST['pin']) && is_numeric($_POST['pin'])
) {
	$req = api_request('/transfer', [
		'session' => $curuser->getSessionKey(),
		'src'  => $_POST['srcAcc'],
		'dst'  => WHITE_TEAM_ACCOUNT,
		'amount'  => $products[$_GET['item']]['cost'],
		'pin'     => $_POST['pin']
	]);
	
	$notice = '<div class="alert '.($req['code'] == 200 ? 'alert-success' : 'alert-danger').'">'.$req['message'].'</div>';

	if ( $req['code'] == 200 ) {
		$notice .= '<div class="alert alert-info">'.$products[$_GET['item']]['on_purchase'].'</div>';

		if ( isset($products[$_GET['item']]['slack_message']) ) {
			$message = sprintf($products[$_GET['item']]['slack_message'], $curuser->username);

			send_slack($message);
		}
	}
}

$item = $products[$_GET['item']];
$accounts = api_request('/accounts', ['session' => $curuser->getSessionKey()]);
if ( $accounts['code'] != 200 ) die('Fatal Error: Contact White Team and get James');
?>

<div class="container">
	<h2>Purchase Confirmation - <?=$item['name']?></h2>

	<?=$notice?>

	<form class="form-horizontal" method="post">
		<div class="form-group">
			<label for="srcAcc" class="col-sm-2 control-label">Source Account</label>
			<div class="col-sm-10">
				<select class="form-control" name="srcAcc">
					<?php foreach ( $accounts['accounts'] AS $account ): ?>
						<option value="<?=$account['id']?>">
							#<?=$account['id']?> - BALANCE: <?=money_format('%.2n', $account['balance'])?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="amount" class="col-sm-2 control-label">Amount</label>
			<div class="col-sm-10">
				<div class="input-group">
					<div class="input-group-addon">$</div>
					<input type="text" class="form-control" id="amount" name="amount" value="<?=$item['cost']?>" readonly="readonly">
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