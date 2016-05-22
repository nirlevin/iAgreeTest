<?php
	include_once("../services.php");
	include_once("../global_defs.php");
	include_once("../contracts/services.php");
	
	date_default_timezone_set(WEBSITE_TIMEZONE);

	/* Fetch the contract object according to its ID */
	if(isset($_GET['id'])) {
		$contractId = intval($_GET['id']);
		if(isset($contractId) && ($contractId > 0)) {
			$contract = getContractById($contractId);
			if(isset($contract)) {
				$partiesArray = getPartiesByContractId($contract['id']);
			}	
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" href="style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
			iAgree
		</title>
	</head>
	<body>

	<h2>Contract <?=$contract['id']?></h2>

	<?php
	
			if(isset($contract)) {
				
				/* Dump contract details */
				echo "<pre>";
				print_r($contract);
				echo "</pre>";

			}
			
			if(isset($partiesArray)) {

				foreach($partiesArray as $party) {
					echo "<pre>";
					print_r($party);
					echo "</pre>";
				}

			}
		
	?>
	
	</body>
</html>