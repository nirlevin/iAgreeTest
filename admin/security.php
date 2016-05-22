<?

	function cryptPass($password) {
		$secret_word = 'iagree4all';
		
		return(md5($password . $secret_word));
	}

	function getUserPass($username) {
		$userList['maozy']['password'] = 'maozrules';
		$userList['asafmor']['password'] = 'capitano';

		if(isset($userList[$username]['password'])) {
			$retObj['password'] = $userList[$username]['password'];
			$retObj['mdpassword'] = cryptPass($retObj['password']);
			return $retObj;
		} else {
			return null;
		}
	}

	function validate($username, $password) {
		$userPass = getUserPass($username);

		if($userPass) {
			if($password == $userPass['password']) {
				return true;
			}
		}

		return false;
	}

	function mdValidate($username, $mdpassword) {
		$userPass = getUserPass($username);

		if($userPass) {
			if($mdpassword == $userPass['mdpassword']) {
				return true;
			}
		}

		return false;
	}

	if (($_REQUEST['username'] != '') && ($_REQUEST['password'] != '')) {
		if (validate($_REQUEST['username'], $_REQUEST['password'])) {
			setcookie('login', $_REQUEST['username'] . ',' . cryptPass($_REQUEST['password']));
		} else {
			 header('Location: login.php') ;
		}
	} else {
		if(isset($_COOKIE['login'])) {
			$up = explode(',', $_COOKIE['login']);
			if(!mdValidate($up[0], $up[1])) {
				 header('Location: login.php') ;
			}
		} else {
			 header('Location: login.php') ;
		}
	}

?>