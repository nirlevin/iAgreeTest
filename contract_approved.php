<?php

	session_start();
	
	include_once("services.php");
	include_once("global_defs.php");
	include_once("contracts/services.php");
	
	date_default_timezone_set(WEBSITE_TIMEZONE);
	
	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
    }
	
	/* Fetch the contract object according to its ID */
	if(isset($_GET['rid'])) {
		$rid = basicParse($_GET['rid']);
		$contractId = getContractIdByRandomId($rid);
		
		$contract = getContractById($contractId);
	}

	/* Agree on the contract */
	if(isset($user) && isset($contract)) {
		
		if(isset($_POST['contract_agreed'])) {

			$error = array(); //this array will store all error messages
			
			$agreementData['first_name'] = trim($_POST['my_first_name']);
			$agreementData['last_name'] = trim($_POST['my_last_name']);
			$agreementData['identity_number'] = trim($_POST['my_identity_number']);
			$agreementData['phone'] = trim($_POST['my_phone']);
			$agreementData['address'] = trim($_POST['my_address']);
			
			$idScanUploaded = !(empty($_FILES['my_id_img']['tmp_name']) || (getimagesize($_FILES['my_id_img']['tmp_name']) == false));
			
			if($idScanUploaded) {
				
				/* parse uploaded ID scan */
				if($_FILES['my_id_img']['size'] > SCANNED_ID_IMAGE_MAX_SIZE_BYTES) {
					$error[] = 'Your image is too large. Max image size is ' . (SCANNED_ID_IMAGE_MAX_SIZE_BYTES / 1000000.0) . "MB.";
				} else {
					$id_scan = $_FILES['my_id_img'];
				}
				
			} else {
				
				$idScanExists = (!empty($_POST['party_id_scan_exists']));
				if($idScanExists) {
					/* do nothing. all OK */
				} else {
					/* ID scan doesn't exist and needed to be uploaded */
					$error[] = 'Please select a scanned image of your ID card.';
				}
				
			}
			
			
			if (empty($error)) { //if the array is empty, it means no error found
		 
				$agreedSuccessfully = agreeOnContract($contract['id'], $user['email'], $agreementData, $id_scan);
				
				if(!$agreedSuccessfully) {
					$error[] = 'You could not complete your request due to a system error. We apologize for any inconvenience.';
				}

			}
			
			if(empty($error)) {
				
				/* Go to 'my contracts' page */
				header('Location: my_contracts.php');
				
			}
			
		}
		
		/* Cancel the user agreement on this contract */
		if(isset($_POST['contract_disagreed'])) {
			
			$error = array(); //this array will store all error messages
			
			$disagreedSuccessfully = disagreeOnContract($contract['id'], $user['email']);
			
			if(!$disagreedSuccessfully) {
				$error[] = 'You could not complete your request due to a system error. We apologize for any inconvenience.';
			}
			
		}
		
	} else {
		
		$error[] = 'Illegal inputs.';
		
	}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" href="style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
		iAgree
	</title>
</head>
<body>

	<h1>Error (500)</h1>
	
	<?php echoOrderedList($error) ?>

</body>
</html>