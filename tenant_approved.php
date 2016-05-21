<?php

	session_start();
	
	include_once("services.php");
	include_once("global_defs.php");
	include_once("contracts/services.php");
	
	$tenantEmail = basicParse($_GET['tenantEmail']);
	$contractId = basicParse($_GET['contractId']);
	$approved = basicParse($_GET['approved']);
//	$tenantUser = getUserByEmail($tenantEmail);
//	$contract = getContractById($contractId);
	
	$party = getPartyByEmailAndContractId($tenantEmail, $contractId);
	
	if ($approved==1){
		
			$creatorData = array (
				'screening_approved' => 1
			);
			
//			sendContractToTenant($tenantUser, $contract);
			
		}else{
			
			$creatorData = array (
				'screening_approved' => '-1'
			);
			
		}
		
		$result = 0;
		$result = updateParty($contractId, $tenantEmail, $creatorData);
		
		if ($result){header("Location: my_contracts.php"); }

?>