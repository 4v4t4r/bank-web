<?php
session_start();
session_destroy();

$_SESSION['username'] = $_SESSION['password'] = $_SESSION['session'] = NULL;

header('Location: /');
die;