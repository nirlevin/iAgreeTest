<?php

	session_start();
	
	include_once("services.php");
	include_once("global_defs.php");
	
	date_default_timezone_set(WEBSITE_TIMEZONE);
	
	if(!isset($_SESSION['user'])) {
		
		header('Location: login.php?location=' . urlencode('review_contract.php'));
		
    } else if(CountContractsCreatedBy($_SESSION['user']) >= MAX_ALLOWED_CONTRACTS_PER_USER) {
		
		$error[] = 'You are not allowed to create more than ' . MAX_ALLOWED_CONTRACTS_PER_USER . ' contracts.';
		
	} else {
		
		$user = $_SESSION['user'];
		
		if(isset($_SESSION['saved_contract'])) {
			
			$contract = $_SESSION['saved_contract'];
			
			//edit an existing contract
			if(isset($_GET['rid'])) {
			
				/* Get the actual contract ID */
				$rid = basicParse($_GET['rid']);
				$contractId = getContractIdByRandomId($rid);
				
				updateContract($contractId, $contract);
				
				$previousParties = getPartiesByContractId($contractId);
				
			} else { //create a new contract
			
				/* Store the contract in the database */
				$contractId = addContract($contract);
				
				$previousParties = array(); //this is a new contract so no previous parties
				
			}
				
			if($contractId > 0) {
				
				$contract['rid'] = getRandomIdByContractId($contractId); //get the auto-generated 'rid'

				/* Prepare an array of submitted parties up to 4 parties.
				 * Each party has its email address and a role. */
				$partiesArray = array();
				
				foreach($contract['landlord'] as $landlord) {
					if(!empty($landlord['email'])) {
						$partiesArray[] = array ('email' => $landlord['email'], 'role' => 'landlord');
					}
				}
				foreach($contract['tenant'] as $tenant) {
					if(!empty($tenant['email'])) {
						$partiesArray[] = array ('email' => $tenant['email'], 'role' => 'tenant');
					}
				}

				/* Add all parties with 'agreed' flag as false */
				$result = reAddParties($contractId, $partiesArray);
				
				/* Check if all parties have been added to the database */
				if($result == count($partiesArray)) { /* Success */
				
					/* Remove any party that is no longer needed from the db */
					foreach($previousParties as $pp) {
						$ppFound = false;
						foreach($partiesArray as $party) {
							if($pp['email'] == $party['email']) {
								$ppFound = true;
								break;
							}
						}
					
						if(!$ppFound) {
							deleteParty($contractId, $pp['email']);
						}
					}
					
					$creatorData = array (
						'first_name' => $contract['my_first_name'],
						'last_name' => $contract['my_last_name'],
						'identity_number' => $contract['my_identity_number'],
						'phone' => $contract['my_phone'],
						'address' => $contract['my_address'],
						'can_edit' => 1,
						'is_creator' => 1
					);
					
					/* Update the contract creator's info and give him edit permissions */
					$result = updateParty($contractId, $contract['my_email'], $creatorData);

					if($result == true) {
						
						/* Prepare a list of emails of all recipients */
						foreach($partiesArray as $party) {
							$partiesEmails[] = $party['email'];
						}
						
						/* Send the contract to all parties while identified as the logged-in user */
						$mailSent = sendContractToParties($user, $contract, $partiesEmails);
						
						/* Go to 'review the contract' page */
						header('Location: my_contracts.php');
						
					} else { /* Couldn't set a contract creator */
					
						$error[] = 'You could not add yourself as the contract initiator. We apologize for any inconvenience.';
					
					}

				} else { /* Creation add all parties */
				
					$error[] = 'You could not add contract parties (' . $result . ' <> ' . count($partiesArray) . ') due to a system error. We apologize for any inconvenience.';
				
				}

			} else { /* Contract creation failed */
				
				/* Error while trying to add a new contract */
				$error[] = 'You could not add a new contract (' . $contractId . ') due to a system error. We apologize for any inconvenience.';
			}
		
		}
		
		/* Revert transaction if any error occured */
		if((!empty($error)) && ($contractId > 0) && (!isset($rid))) {
			deleteContract($contractId);
		}	
	
	}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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