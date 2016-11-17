<?php
function api_request($endpoint, $data) {
	$postData = [];
	foreach ( $data AS $k => $v ) $postData[] = urlencode($k).'='.urlencode($v);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://'.BANK_SERVER.$endpoint);
	curl_setopt($ch, CURLOPT_POST, count($data));
	curl_setopt($ch, CURLOPT_POSTFIELDS, implode('&', $postData));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);

	$result = curl_exec($ch);

	curl_close($ch);

	return json_decode($result, true);
}

function send_slack($message, $extra=[]) {
	$data = $extra + [
		'text' => $message,
		'link_names' => 1
	];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, SLACK_POST_URI);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, ['payload' => json_encode($data)]);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($ch);
	curl_close($ch);
}