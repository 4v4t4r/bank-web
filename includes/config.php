<?php
# Required for formatting money
setlocale(LC_MONETARY, 'en_US.UTF-8');

# BANK INFO
define('BANK_SERVER', '128.205.44.159:5000');

# WHITE TEAM ACCOUNT
define('WHITE_TEAM_ACCOUNT', '3141592653');

# Slack API
define('SLACK_POST_URI', 'https://hooks.slack.com/services/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');

# Products
$products = [
	[
		'enabled' => true,

		'name' => 'KVM Console',
		'desc' => 'KVM Console access to a server',
		'cost' => 2500,

		'on_purchase' => 'Purchased! Please tell a White Team member to redeem this!',
		'slack_message' => '@james @jered: KVM Console access was just purchased by %s',
	],
	[
		'enabled' => true,

		'name' => 'White Team Help #1',
		'desc' => 'White Team help on an inject',
		'cost' => 5000,

		'on_purchase' => 'Purchased! Please tell a White Team member to redeem this!',
		'slack_message' => '@james @jered @a-a-ron @stefanja @evangers: White Team help on inject was just purchased by %s',
	],
	[
		'enabled' => true,

		'name' => 'White Team Help #2',
		'desc' => 'White Team assistance on fixing a machine',
		'cost' => 7500,

		'on_purchase' => 'Purchased! Please tell a White Team member to redeem this!',
		'slack_message' => '@james @jered @a-a-ron @stefanja @evangers: White Team help on fixing box was just purchased by %s',
	],
	[
		'enabled' => true,

		'name' => 'Revert VM',
		'desc' => 'Revert a machine back to a pre-competition snapshot',
		'cost' => 10000,

		'on_purchase' => 'Purchased! Please tell a White Team member to redeem this!',
		'slack_message' => '@james @jered: Revert VM was just purchased by %s',
		//'callback' => 'http://192.168.1.50:8080/revert?ticket=%s',
	],
	[
		'enabled' => true,

		'name' => 'Red Team Advice',
		'desc' => 'Red Team advice on securing a box',
		'cost' => 15000,

		'on_purchase' => 'Purchased! Please tell a White Team member to redeem this!',
		'slack_message' => '@james @becausealex: Red Team advice was just purchased by %s',
	],
	[
		'enabled' => true,

		'name' => 'Red Team Immunity',
		'desc' => 'Red Team immunity for 15 minutes',
		'cost' => 25000,

		'on_purchase' => 'Purchased! Please tell a White Team member to redeem this!',
		'slack_message' => '@james @becausealex: Red Team immunity was just purchased by %s',
	],
	[
		'enabled' => true,

		'name' => 'Winner!',
		'desc' => 'Win the competition!',
		'cost' => 150000,

		'on_purchase' => '...how did you do that?',
		'slack_message' => '@james: %s bought win the competition....',
	]
];

# Navigation
$navLeft = [
	[
		'name' => 'Home',
		'url' => '/'
	],
	[
		'name' => 'Transfer',
		'url' => '/transfer.php',
		'show' => function($user) {
			return $user->isLoggedIn();
		}

	],
	[
		'name' => 'Purchase',
		'url' => '/purchase.php',
		'show' => function($user) {
			return $user->isLoggedIn();
		}
	]
];

$navRight = [
	[
		'name' => 'Login',
		'url' => '/login.php',
		'show' => function($user) {
			return !$user->isLoggedIn();
		}
	],
	[
		'name' => 'myAccount',
		'url' => '/accounts.php',
		'show' => function($user) {
			return $user->isLoggedIn();
		}
	],
	[
		'name' => 'Logout',
		'url' => '/logout.php',
		'show' => function($user) {
			return $user->isLoggedIn();
		}
	],
];
