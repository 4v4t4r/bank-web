<?php
$title = 'Federal Bank';
$curnav = 'Home';

require './includes/config.php';
require './includes/session.php';
require './includes/header.php';

$count = 0;
?>

<link href="/assets/css/purchase.css" rel="stylesheet" />

<div class="container">
	<div class="jumbotron">
		<h2>Welcome to the Federal Bank!</h2>

		<p>We take pride in providing the best service to our clients.</p>
	</div>

	<div class="row">
	<?php foreach ( $products AS $i => $product ): if ( !$product['enabled'] ) continue; ?>
		<div class="col-md-3">
			<div class="db-wrapper">
				<div class="db-pricing-seven">
					<ul>
						<li class="price">
							<i class="glyphicon glyphicon-console"></i>
							<?=$product['name']?>
						</li>

						<li><?=$product['desc']?></li>
						<li><strong>PRICE</strong>: <?=money_format('%.2n', $product['cost'])?></li>
					</ul>
					<div class="pricing-footer">

						<a href="/purchase_confirm.php?item=<?=$i?>" class="btn btn-default btn-lg">BUY <i class="glyphicon glyphicon-play-circle"></i></a>
					</div>
				</div>
			</div>
		</div>

	<?php if ( $count++ % 4 == 3 ): ?>
	</div>
	<div class="row">
	<?php endif; ?>
	<?php endforeach; ?>
	</div>
</div>

<?php require './includes/footer.php'; ?>