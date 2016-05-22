<?php	
	/* Fetch the contract object according to its ID */
	if(isset($_GET['hellosign_guid'])) {
		$guid = strval($_GET['hellosign_guid']);
		if($guid) {

			$filename = "contract-" . $guid . ".pdf";
			$filepath = dirname(__FILE__). "/pdfs/" . $filename;

			/* HelloSign */
			include_once("../contracts/esignature_defs.php");
			require_once '../contracts/hellosign/autoload.php';
				
			$client = new HelloSign\Client(HELLOSIGN_CLIENT_ID);
			$client->getFiles($guid, $filepath, HelloSign\SignatureRequest::FILE_TYPE_PDF);	
			
			header('Content-type: application/pdf');
			header('Content-Disposition: inline; filename="' . $filename . '"');
			header('Content-Transfer-Encoding: binary');
			header('Accept-Ranges: bytes');
			@readfile($filepath);
			
		}
	}
	
?>

