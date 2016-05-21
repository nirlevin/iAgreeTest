<?php

	session_start();

	include_once("services.php");
	
	/**
	 * Array of contract fields.
	 */
	$fields = array (
		'role',
		'rooms',
		'city',
		'street',
		'building',
		'apartment',
		'contents',
		'air_conditioner_exists',
		'air_conditioner',
		'fridge_exists',
		'fridge',
		'microwave_exists',
		'microwave',
		'oven_exists',
		'oven',
		'washing_machine_exists',
		'washing_machine',
		'television_exists',
		'television',
		'animals',
		'repairs',
		'defects',
		'fee',
		'billing_day',
		'start_date',
		'end_date',
		'optional_extension',
		'collaterals',
		'insurance_option',
		'my_first_name',
		'my_last_name',
		'my_identity_number',
		'my_phone',
		'my_address',
		'my_email',
		'scanned_id',
		'landlord_email',
		'tenant1_email',
		'tenant2_email',
		'tenant3_email'
	);
	
	$my_details = array (
		'my_first_name',
		'my_last_name',
		'my_identity_number',
		'my_phone',
		'my_address',
		'my_email',
		'scanned_id'
	);

	/*
	 * Parse inputs and store in a session variable.
	 */
	foreach($fields as $field) {
		if(isset($_POST[$field])) {
		
			$parsedValue = trim($_POST[$field]);
			
			switch($field) {
			case 'landlord_email':
				if(!empty($parsedValue))
					$_SESSION['saved_contract']['landlord'][0]['email'] = $parsedValue;
				else
					unset($_SESSION['saved_contract']['landlord'][0]);
				break;
			case 'tenant1_email':
				if(!empty($parsedValue))
					$_SESSION['saved_contract']['tenant'][0]['email'] = $parsedValue;
				else
					unset($_SESSION['saved_contract']['tenant'][0]);
				break;
			case 'tenant2_email':
				if(!empty($parsedValue))
					$_SESSION['saved_contract']['tenant'][1]['email'] = $parsedValue;
				else
					unset($_SESSION['saved_contract']['tenant'][1]);
				break;
			case 'tenant3_email':
				if(!empty($parsedValue))
					$_SESSION['saved_contract']['tenant'][2]['email'] = $parsedValue;
				else
					unset($_SESSION['saved_contract']['tenant'][2]);
				break;
			default:
				$_SESSION['saved_contract'][$field] = $parsedValue;
				break;
			}
			
			if(in_array($field, $my_details)) {
				$role = $_SESSION['saved_contract']['role'];
				$modified_field_name = substr($field, 3);
				$_SESSION['saved_contract'][$role][0][$modified_field_name] = $parsedValue;
			}
			
		}
	}

	/*
	 * Deduce the next page to redirect to.
	 */
	$requested_location = basicParse($_REQUEST['location']);
	if(!empty($requested_location)) {
		$checkpoint_redirect = $requested_location;
	} else {
		$checkpoint_redirect = 'create_contract.php';
	}
	
	/*
	 * Prepare a random contract ID to pass on.
	 */
	$rid = basicParse($_GET['rid']);
	
	header('Location: ' . $checkpoint_redirect . (isset($rid) ? "?rid=$rid" : ""));

?>