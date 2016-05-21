<?php

	session_start();
	
	include_once("services.php");
	
	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
    } 
	
	if(isset($user, $_GET['rid'])) {
		
		$rid = basicParse($_GET['rid']);
		$contractId = getContractIdByRandomId($rid);
		
		$contract = getContractById($contractId);	//fetch from db

		$parties = getPartiesByContractId($contractId);
		foreach($parties as $party) {
			if($party['role'] == 'landlord') {
				$contract['landlord'][]['email'] = $party['email'];
			} 
			
			else if(($party['role'] == 'tenant') && ($contract['insurance_option'] != 3)) {
				$contract['tenant'][]['email'] = $party['email'];
			}
	
	
			if($party['email'] == $user['email']) {
				$contract['role'] = $party['role'];
				$contract['my_first_name'] = $party['first_name'];
				$contract['my_last_name'] = $party['last_name'];
				$contract['my_email'] = $party['email'];
				$contract['my_identity_number'] = $party['identity_number'];
				$contract['my_phone'] = $party['phone'];
				$contract['my_address'] = $party['address'];
				$_SESSION['temp_id_img'] = $user['scanned_id'];
			}
		}
		
		$_SESSION['saved_contract'] = $contract;
		
		header('Location: property_description.php?rid=' . $rid);
		
	} else {
		
		header('Location: my_contracts.php');
		
	}

?>