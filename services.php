<?php
	
	function basicParse($val) {
		if(!isset($val) || (trim($val) == "")) {
			return null;
		} else {
			return htmlspecialchars(strip_tags(trim($val)));
		}
	}
	
	function getMySqlTable($query) {
		$mysqli = connect();
			
		if ($result = $mysqli->query($query)) {
			while($arr[] = mysqli_fetch_assoc($result));
			array_pop($arr);  // pop the last row off, which is an empty row
			
			$result->free();
		}
		
		$mysqli->close();
		
		return $arr;
	}
	
	function validateEmailAddress($email) {
		//regular expression for email validation
		return preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email);
	}
	
	function validateIdentityNumber($number) {
		//regular expression for a 9 digits identity number validation
		return preg_match("/^[0-9]{9}$/", $number);
	}
	
	function echoOrderedList($arrayList) {
		if (!empty($arrayList)) {
			if(count($arrayList) > 1) {
				echo '<div><ol>';
				foreach ($arrayList as $key => $values) {
					echo '<li>' . $values . '</li>';
				}
				echo '</ol></div>';
			} else {
				echo "<p>" . reset($arrayList) . "</p>"; //First element
			}
		}
	}

	function connect() {
		include dirname(__FILE__) . "/db_config.php";
		
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	
		/* check connection */
		if ($mysqli->connect_errno) {
			printf("Connection failed: %s\n", $mysqli->connect_error);
			exit();
		}
		
		$mysqli->query("SET NAMES 'UTF8'");
		
		return $mysqli;
	}
	
	function getCollateralsOptions($collateralsDb) {
		return getMySqlTable("SELECT * FROM $collateralsDb ORDER BY id ASC");
	}
	
	function getCollaterals($id,$x) {
		$mysqli = connect();
		
		if(!($id > 0)) {
			
			return null;
			
		} else {
	
			/* prepare for SQL statements */
			$id = $mysqli->real_escape_string($id);
			
			if ($result = $mysqli->query("SELECT * FROM $x WHERE id='$id'")) {
				$row = $result->fetch_assoc();
				$result->close();
			}
			
			$mysqli->close();
			
			return $row;
		
		}
	}
	
	
	
	function getAllContracts() {
		$mysqli = connect();
			
		if ($result = $mysqli->query("SELECT * FROM contracts ORDER BY id DESC")) {
			while($contractsArray[] = mysqli_fetch_assoc($result));
			array_pop($contractsArray);  // pop the last row off, which is an empty row
			
			$result->free();
		}
		
		$mysqli->close();
		
		foreach($contractsArray as &$contract) {
			$contract['parties'] = getPartiesByContractId($contract['id']);
		}
		
		return $contractsArray;
	}
	
	function getContractById($contractId) {
		$mysqli = connect();
		
		if(!($contractId > 0)) {
			
			return null;
			
		} else {
	
			/* prepare for SQL statements */
			$contractId = $mysqli->real_escape_string($contractId);
			
			if ($result = $mysqli->query("SELECT * FROM contracts WHERE id='$contractId'")) {
				$row = $result->fetch_assoc();
				$result->close();
			}
			
			$mysqli->close();
			
			return $row;
		
		}
	}
	
	function getUserByEmail($email, &$result) {
		$mysqli = connect();
	
		/* prepare for SQL statements */
		$email = $mysqli->real_escape_string($email);
		
		if ($result = $mysqli->query("SELECT * FROM users WHERE email='$email' LIMIT 1")) {
		
			if ($row = $result->fetch_assoc()) {
				$user = $row;
			}
			
			$result->close();
			
		}
		
		$mysqli->close();
		
		if($user == null) {
			$result = -1; //email doesn't exist
			return null;
		} else {
			$result = 0; //all ok
			return $user;
		}
	}
	
	function getPartiesByEmail($email) {
		$mysqli = connect();
	
		/* prepare for SQL statements */
		$email = $mysqli->real_escape_string($email);
		
		if ($result = $mysqli->query("SELECT * FROM parties WHERE email='$email' ORDER BY contract_id DESC")) {
			while($partiesArray[] = mysqli_fetch_assoc($result));
			array_pop($partiesArray);  // pop the last row off, which is an empty row
			
			$result->free();
		}
		
		$mysqli->close();
		
		return $partiesArray;
	}

	function getPartiesByContractId($contractId) {
		$mysqli = connect();
	
		/* prepare for SQL statements */
		$contractId = $mysqli->real_escape_string($contractId);
		
		if ($result = $mysqli->query("SELECT * FROM parties WHERE contract_id='$contractId'")) {
			while($partiesArray[] = mysqli_fetch_assoc($result));
			array_pop($partiesArray);  // pop the last row off, which is an empty row
			
			$result->free();
		}
		
		$mysqli->close();
		
		return $partiesArray;
	}
	
	function getPartyByEmailAndContractId($email, $contractId) {
		$mysqli = connect();
	
		/* prepare for SQL statements */
		$email = $mysqli->real_escape_string($email);
		$contractId = $mysqli->real_escape_string($contractId);
		
		if ($result = $mysqli->query("SELECT * FROM parties WHERE email='$email' AND contract_id='$contractId' LIMIT 1")) {
			$party = mysqli_fetch_assoc($result);
			$result->free();
		} else {
			$party = null;
		}
		
		$mysqli->close();
		
		return $party;
	}
	
	function getContractCreator($contractId) {
		$mysqli = connect();
	
		/* prepare for SQL statements */
		$contractId = $mysqli->real_escape_string($contractId);
		
		if ($result = $mysqli->query("SELECT * FROM parties WHERE is_creator=1 AND contract_id='$contractId' LIMIT 1")) {
			$party = mysqli_fetch_assoc($result);
			$result->free();
		} else {
			$party = null;
		}
		
		$mysqli->close();
		
		return $party;
	}
	
	function isPartyExists($email, $contractId) {
		$mysqli = connect();
	
		/* prepare for SQL statements */
		$email = $mysqli->real_escape_string($email);
		$contractId = $mysqli->real_escape_string($contractId);
		
		if ($result = $mysqli->query("SELECT COUNT(1) FROM parties WHERE email='$email' AND contract_id='$contractId'")) {
			$row = mysqli_fetch_array($result);
			$partiesCount = $row[0];
			$result->free();
		} else {
			$partiesCount = 0;
		}
		
		$mysqli->close();
		
		return ($partiesCount > 0);
	}
	
	
//MY		Send tenants screening request
	
	function sendTenantsScreeningRequest($user, $contract, $partiesEmails) {
		include_once('global_defs.php');
		
		$mailSent = 0;
		
		date_default_timezone_set(SENDER_TIMEZONE);

		$subject = $user['name']. ' מעוניין/נת לקבל את אישורך';
		
		$reviewContractUrl = WEBSITE_URL . 'view_contract_platinum.php?rid=' . $contract['rid'];
		
		
//MY		
		$contractAddress = $contract['street'] . ' ' . $contract['building'] . " דירה " . $contract['apartment'] . ", " . $contract['city'];

		$message = array();
		$handle = fopen(SCREENING_REQUEST_TEMPLATE_FILE, "r");
		if ($handle) {
			while (($line = fgets($handle)) !== false) {
				$message[] = $line;
			}

			fclose($handle);
		} else {
			return false;
		}  
		
		
		/* Replace the following place-holders in the template */
		$replacements = array(
			"contract_creator_name" => $user['name'],
			"contract_creator_email" => $user['email'],
			"contract_address" => $contractAddress,
			"contract_url" => $reviewContractUrl
		);
		
		$message = implode("\n\n", $message);
		foreach($replacements as $find => $replace) {
			$message = str_replace('[[' . $find . ']]', $replace, $message);
		}
		
		$headers[] = "From: " . $user['name'] . " via iAgree <" . SENDER_EMAIL_ADDRESS . ">";
		$headers[] = "Reply-To: " . $user['name'] . " via iAgree <" . SENDER_EMAIL_ADDRESS . ">";
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-Type: text/html; charset=UTF-8";
		$headers[] = "Subject: " . $subject;
		
		/* Send mail to all parties */
		foreach($partiesEmails as $toEmail) {
			if(mail($toEmail, $subject, $message, implode("\r\n", $headers))) {
				$mailSent++;
			}
		}

		return ($mailSent > 0);
	}
	
	
	
	
	
	function sendContractToParties($user, $contract, $partiesEmails) {
		include_once('global_defs.php');
		
		$mailSent = 0;
		
		date_default_timezone_set(SENDER_TIMEZONE);

		$subject = 'A new contract proposal for you!';
		
		$reviewContractUrl = WEBSITE_URL . 'view_contract.php?rid=' . $contract['rid'];

		$message = array();
		$handle = fopen(VIEW_CONTRACT_TEMPLATE_FILE, "r");
		if ($handle) {
			while (($line = fgets($handle)) !== false) {
				$message[] = $line;
			}

			fclose($handle);
		} else {
			return false;
		}  
		
		
		/* Replace the following place-holders in the template */
		$replacements = array(
			"contract_creator_name" => $user['name'],
			"contract_creator_email" => $user['email'],
			"contract_url" => $reviewContractUrl
		);
		
		$message = implode("\n\n", $message);
		foreach($replacements as $find => $replace) {
			$message = str_replace('[[' . $find . ']]', $replace, $message);
		}
		
		$headers[] = "From: " . $user['name'] . " via iAgree <" . SENDER_EMAIL_ADDRESS . ">";
		$headers[] = "Reply-To: " . $user['name'] . " via iAgree <" . SENDER_EMAIL_ADDRESS . ">";
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-Type: text/html; charset=UTF-8";
		$headers[] = "Subject: " . $subject;
		
		/* Send mail to all parties */
		foreach($partiesEmails as $toEmail) {
			if(mail($toEmail, $subject, $message, implode("\r\n", $headers))) {
				$mailSent++;
			}
		}

		return ($mailSent > 0);
	}
	
//MY	
	function sendContractToTenant($tenant, $contract) {
		include_once('global_defs.php');
		
		$mailSent = 0;
		
		date_default_timezone_set(SENDER_TIMEZONE);

		$subject = 'iAgree | חתימה על החוזה';
		
		$reviewContractUrl = WEBSITE_URL . 'sign_contract.php?rid=' . $contract['rid'];

		$message = array();
		$handle = fopen(TENANT_SIGN_MAIL_TEMPLATE, "r");
		if ($handle) {
			while (($line = fgets($handle)) !== false) {
				$message[] = $line;
			}

			fclose($handle);
		} else {
			return false;
		}  
		
		
		/* Replace the following place-holders in the template */
		$replacements = array(
			"tenant_name" => $tenant['first_name'],
			"tenant_email" => $tenant['email'],
			"contract_url" => $reviewContractUrl
		);
		
		$message = implode("\n\n", $message);
		foreach($replacements as $find => $replace) {
			$message = str_replace('[[' . $find . ']]', $replace, $message);
		}
		
		$headers[] = "From: iAgree <donotreply@iagree.co.il>";
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-Type: text/html; charset=UTF-8";
		$headers[] = "Subject: " . $subject;
		

			if(mail($tenant['email'], $subject, $message, implode("\r\n", $headers))) {
				$mailSent++;
			}

		return ($mailSent > 0);
	}
	
	
	
	
	function agreeOnContractPlatinum($contractId, $email, $agreementData) {
		$success = false;

//		if(($idScan == null) || ($agreementData['scanned_id'] = addScannedId($idScan))) {
			
			$mysqli = connect();
		
			/* prepare for SQL statements */
			$contractId = $mysqli->real_escape_string($contractId);
			$email = $mysqli->real_escape_string($email);

			/* prepare for SQL statements */
			foreach($agreementData as $key => &$value) {
				$value = $mysqli->real_escape_string($value);
				$updates[] = "$key='$value'";
			}
			
			/* Use 'implode' for preparing a list of fields and their values for the MySQL query */
			$implodedArray = implode(', ', $updates);
			
			$q = "UPDATE parties SET $implodedArray,agreed='1' WHERE email='$email' AND contract_id='$contractId'";
		
			if ($result = $mysqli->query($q)) {
				if($mysqli->affected_rows >= 0) {
					$success = true;
				}
			}
			
			$mysqli->close();
			
//		}
		
		return $success;
	}
	
	
	
	
	
	
	
	
	function agreeOnContract($contractId, $email, $agreementData, $idScan) {
		$success = false;

		if(($idScan == null) || ($agreementData['scanned_id'] = addScannedId($idScan))) {
			
			$mysqli = connect();
		
			/* prepare for SQL statements */
			$contractId = $mysqli->real_escape_string($contractId);
			$email = $mysqli->real_escape_string($email);

			/* prepare for SQL statements */
			foreach($agreementData as $key => &$value) {
				$value = $mysqli->real_escape_string($value);
				$updates[] = "$key='$value'";
			}
			
			/* Use 'implode' for preparing a list of fields and their values for the MySQL query */
			$implodedArray = implode(', ', $updates);
			
			$q = "UPDATE parties SET $implodedArray,agreed='1' WHERE email='$email' AND contract_id='$contractId'";
		
			if ($result = $mysqli->query($q)) {
				if($mysqli->affected_rows >= 0) {
					$success = true;
				}
			}
			
			$mysqli->close();
			
		}
		
		return $success;
	}
	
	
	function addScannedId($idScan) {
		$mysqli = connect();

		$image = addslashes($idScan['tmp_name']);
		$image = file_get_contents($image);
		$image = base64_encode($image);
				
		$mysqli->query("INSERT INTO scanned_ids (image) VALUES ('$image')");
		
		$insertId = $mysqli->insert_id;
		
		$mysqli->close();
		
		return $insertId;
	}
	
	function getScannedIdImageSrc($id)
	{
		$mysqli = connect();
		
		$id = $mysqli->real_escape_string($id);

		if ($result = $mysqli->query("SELECT * from scanned_ids WHERE id='$id'")) {
			$row = $result->fetch_assoc();
			$result->close();
		}
		
		$mysqli->close();
		
		if(isset($row)) {
			return "data:image;base64," . $row['image'];
		} else {
			return null;
		}
	}
	
	function disagreeOnContract($contractId, $email) {
		$success = false;
		$mysqli = connect();
	
		/* prepare for SQL statements */
		$contractId = $mysqli->real_escape_string($contractId);
		$email = $mysqli->real_escape_string($email);

		$q = "UPDATE parties SET agreed='0' WHERE email='$email' AND contract_id='$contractId'";
		
		if ($result = $mysqli->query($q)) {
			if($mysqli->affected_rows >= 0) {
				$success = true;
			}
		}
		
		$mysqli->close();
		
		return $success;
	}
	
	function signContract($contractId, $email) {
		$success = false;
		$mysqli = connect();
	
		/* prepare for SQL statements */
		$contractId = $mysqli->real_escape_string($contractId);
		$email = $mysqli->real_escape_string($email);

		$q = "UPDATE parties SET signed='1' WHERE email='$email' AND contract_id='$contractId'";
		
		if ($result = $mysqli->query($q)) {
			if($mysqli->affected_rows >= 0) {
				$success = true;
			}
		}
		
		$mysqli->close();
		
		return $success;
	}
	
	/* Convert date string from DD/MM/YYYY to YYYY-MM-DD */
	function convertDateToMySqlFormat($date) {
		if(empty($date)) {
			return null;
		} else {
			if(strpos($date, "/") === false) {
				return $date;
			} else {
				$date = explode("/", $date);
				return ($date[2] . "-" . $date[1] . "-" . $date[0]);		
			}
		}
	}
	
	/* Convert date string from YYYY-MM-DD to DD/MM/YYYY */
	function convertDateToDisplayFormat($date) {
		if(empty($date)) {
			return null;
		} else {
			if(strpos($date, "-") === false) {
				return $date;
			} else {
				$date = explode("-", $date);
				return ($date[2] . "/" . $date[1] . "/" . $date[0]);		
			}
		}
	}
	
	function addContract($contract) {
		$mysqli = connect();
		
		/* Map each datum to its field in the MySQL database */
		$contractData = array (
			'rid' => generateRandomContractId(),
		);

		$contract['start_date'] = convertDateToMySqlFormat($contract['start_date']);
		$contract['end_date'] = convertDateToMySqlFormat($contract['end_date']);
	
		/* prepare for SQL statements */
		foreach($contractData as $key => &$value) {
			$value = $mysqli->real_escape_string($value);
		}
		
		/* Use 'implode' for preparing a list of fields and their values for the MySQL query */
		$columns = implode(",", array_keys($contractData));
		$values  = "'" . implode("','", array_values($contractData)) . "'";
				
		$mysqli->query("INSERT INTO contracts ($columns) VALUES ($values)");

		$insertId = $mysqli->insert_id;
		
		$mysqli->close();
		
		if(!updateContract($insertId, $contract)) {
			deleteContract($insertId);
			return 0;
		} else {
			return $insertId;
		}
	}
	
	function updateContract($contractId, $editedContract) {
		$success = false;
		
		$editedContract['start_date'] = convertDateToMySqlFormat($editedContract['start_date']);
		$editedContract['end_date'] = convertDateToMySqlFormat($editedContract['end_date']);
		
		$mysqli = connect();
		
		/* Map each datum to its field in the MySQL database */
		$contractData = array (
			'rooms' => $editedContract['rooms'],
			'city' => $editedContract['city'],
			'street' => $editedContract['street'],
			'building' => $editedContract['building'],
			'apartment' => $editedContract['apartment'],
			'contents' => $editedContract['contents'],
			'air_conditioner_exists' => $editedContract['air_conditioner_exists'],
			'air_conditioner' => $editedContract['air_conditioner'],
			'microwave_exists' => $editedContract['microwave_exists'],
			'microwave' => $editedContract['microwave'],
			'washing_machine_exists' => $editedContract['washing_machine_exists'],
			'washing_machine' => $editedContract['washing_machine'],
			'fridge_exists' => $editedContract['fridge_exists'],
			'fridge' => $editedContract['fridge'],
			'oven_exists' => $editedContract['oven_exists'],
			'oven' => $editedContract['oven'],
			'television_exists' => $editedContract['television_exists'],
			'television' => $editedContract['television'],
			'animals' => $editedContract['animals'],
			'repairs' => $editedContract['repairs'],
			'defects' => $editedContract['defects'],
			'fee' => $editedContract['fee'],
			'billing_day' => $editedContract['billing_day'],
			'start_date' => $editedContract['start_date'],
			'end_date' => $editedContract['end_date'],
			'optional_extension' => $editedContract['optional_extension'],
			'collaterals' => $editedContract['collaterals'],
			'insurance_option' => $editedContract['insurance_option']
		);
		
		/* Handle furnitures */
		if($contractData['air_conditioner_exists'] == false) {
			$contractData['air_conditioner'] = null;
		}
		if($contractData['microwave_exists'] == false) {
			$contractData['microwave'] = null;
		}
		if($contractData['washing_machine_exists'] == false) {
			$contractData['washing_machine'] = null;
		}
		if($contractData['fridge_exists'] == false) {
			$contractData['fridge'] = null;
		}
		if($contractData['oven_exists'] == false) {
			$contractData['oven'] = null;
		}
		if($contractData['television_exists'] == false) {
			$contractData['television'] = null;
		}
		
		/* prepare for SQL statements */
		$contractId = $mysqli->real_escape_string($contractId);

		foreach($contractData as $key => &$value) {
			$value = $mysqli->real_escape_string($value);
			$updates[] = "$key='$value'";
		}
	
		$implodedArray = implode(',', $updates);
		
		$q = "UPDATE contracts SET $implodedArray WHERE id='$contractId'";
		
		if ($result = $mysqli->query($q)) {
			if($mysqli->affected_rows >= 0) {
				$success = true;
			}
		}
		
		$mysqli->close();
		
		return $success;
	}
	
	function deleteContract($contractId) {
		$mysqli = connect();
		
		/* prepare for SQL statements */
		$contractId = $mysqli->real_escape_string($contractId);
		
		$mysqli->query("DELETE FROM contracts WHERE id=$contractId");
		$mysqli->query("DELETE FROM parties WHERE contract_id=$contractId");
		
		$mysqli->close();
		
		return true;
	}
	
	function reAddParties($contractId, $partiesArray) {
		$partiesCount = 0;
		
		foreach($partiesArray as $party) {
			
			$partyExists = isPartyExists($party['email'], $contractId);
			if($partyExists) {
				$party['agreed'] = 0;
				$success = updateParty($contractId, $party['email'], $party);
				$partiesCount = $partiesCount + ($success ? 1 : 0);
			} else {
				$numAdded = addParties($contractId, array($party));
				$partiesCount = $partiesCount + $numAdded;
			}
			
		}
		
		return $partiesCount;
	}
	
	function addParties($contractId, $partiesArray) {
		$partiesCount = 0;
		
		$mysqli = connect();
	
		/* Insert each party separately */
		foreach($partiesArray as $i => &$party) {
			$party['contract_id'] = $contractId;
			
			/* prepare for SQL statements */
			foreach($party as $key => &$value) {
				$value = $mysqli->real_escape_string($value);
			}
			
			$columns = implode(",", array_keys($party));
			$values  = "'" . implode("','", array_values($party)) . "'";
				
			$mysqli->query("INSERT INTO parties ($columns) VALUES ($values)");

			if($mysqli->affected_rows > 0) {
				$partiesCount = $partiesCount + 1;
			}
		}

		$mysqli->close();
		
		return $partiesCount;
	}
	
	function updateParty($contractId, $email, $partyData) {
		$success = false;

		$mysqli = connect();

		/* prepare for SQL statements */
		$contractId = $mysqli->real_escape_string($contractId);
		$email = $mysqli->real_escape_string($email);

		foreach($partyData as $key => $value) {
			$value = $mysqli->real_escape_string($value);
			$updates[] = "$key='$value'";
		}
	
		$implodedArray = implode(',', $updates);
		
		$q = "UPDATE parties SET $implodedArray WHERE contract_id='$contractId' AND email='$email'";
		
		if ($result = $mysqli->query($q)) {
			if($mysqli->affected_rows >= 0) {
				$success = true;
			}
		}
		
		$mysqli->close();
		
		return $success;
	}
	
	function deleteParty($contractId, $partyEmail) {
		$mysqli = connect();
		
		/* prepare for SQL statements */
		$contractId = $mysqli->real_escape_string($contractId);
		$partyEmail = $mysqli->real_escape_string($partyEmail);
		
		$mysqli->query("DELETE FROM parties WHERE contract_id='$contractId' AND email='$partyEmail'");
		
		$mysqli->close();
		
		return true;
	}
	
	function setContractGuid($contractId, $guid) {
		$success = false;
		
		$mysqli = connect();
	
		/* prepare for SQL statements */
		$contractId = $mysqli->real_escape_string($contractId);
		$guid = $mysqli->real_escape_string($guid);
			
		$q = "UPDATE contracts SET hellosign_guid='$guid' WHERE id='$contractId'";
		
		if ($result = $mysqli->query($q)) {
			if($mysqli->affected_rows >= 0) {
				$success = true;
			}
		}
		
		$mysqli->close();
		
		return $success;
	}
	
	function generateRandomContractId($length = 20) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
	
	function getContractIdByRandomId($randomContractId) {
		$contractId = 0;
		
		$mysqli = connect();
	
		/* prepare for SQL statements */
		$randomContractId = $mysqli->real_escape_string($randomContractId);
		
		if ($result = $mysqli->query("SELECT * FROM contracts WHERE rid='$randomContractId'")) {
			$row = $result->fetch_assoc();
			$contractId = $row['id'];
			$result->close();
		}
		
		$mysqli->close();
		
		return $contractId;	
	}
	
	function getRandomIdByContractId($contractId) {
		$contract = getContractById($contractId);
		return $contract['rid'];	
	}
	
	function CountContractsCreatedBy($user) {
		$mysqli = connect();
		
		$email = $mysqli->real_escape_string($user['email']);
			
		if ($result = $mysqli->query("SELECT COUNT(1) FROM parties WHERE email='$email' AND is_creator=1")) {
			$row = mysqli_fetch_array($result);
			$contractsCreated = $row[0];
			$result->free();
		} else {
			$contractsCreated = 0;
		}
		
		$mysqli->close();
		
		return $contractsCreated;
	}
	
	function getContractIdByHelloSignGuid($hellosign_guid) {
		$contractId = 0;
		
		$mysqli = connect();
	
		/* prepare for SQL statements */
		$hellosign_guid = $mysqli->real_escape_string($hellosign_guid);
		
		if ($result = $mysqli->query("SELECT * FROM contracts WHERE hellosign_guid='$hellosign_guid'")) {
			$row = $result->fetch_assoc();
			$contractId = $row['id'];
			$result->close();
		}
		
		$mysqli->close();
		
		return $contractId;	
	}

	function uploadImage($img, $path, $user, $contractId) {
	
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = $path.$user."_".$contractId.".png";
		$success = file_put_contents($file, $data);
		move_uploaded_file($data, $file);
		$fp = fopen($file, 'w');
		fwrite($fp, $data);
		fclose($fp);
		return $file;
	}
		
	
?>