<?php
session_start();

require 'api.php';
require 'user.php';

// Global variables...sorry
if ( !isset($_SESSION['username']) ) $_SESSION['username'] = NULL;
if ( !isset($_SESSION['password']) ) $_SESSION['password'] = NULL;
if ( !isset($_SESSION['session']) ) $_SESSION['session'] = NULL;

$curuser = new User($_SESSION['username'], $_SESSION['password'], $_SESSION['session']);