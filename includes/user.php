<?php
class User {
	public $username = NULL;
	public $password = NULL;
	public $session = NULL;

	public function __construct($user=NULL, $pass=NULL, $session=NULL) {
		$this->username = $user;
		$this->password = $pass;
		$this->session = $session;
	}

	public function isLoggedIn() {
		return $this->username != NULL;
	}

	public function attemptLogin($user, $pass) {
		$req = api_request('/login', ['username' => $user, 'password' => $pass]);

		if ( $req['code'] != 200 ) {
			return $req['message'];
		}

		// Save everything
		$this->username = $_SESSION['username'] = $user;
		$this->password = $_SESSION['password'] = $pass;
		$this->session  = $_SESSION['session']  = $req['session'];

		return '';
	}

	public function getSessionKey() {
		if ( !empty($this->session) ) {
			$sess = $this->session;

			$this->session = $_SESSION['session'] = NULL;

			return $sess;
		} else {
			$req = api_request('/login', ['username' => $this->username, 'password' => $this->password]);

			if ( $req['code'] != 200 ) {
				die('Really fatal error - Invalid User/Pass.  Contact White Team, and ask for James.');
			}

			return $req['session'];
		}
	}
}
