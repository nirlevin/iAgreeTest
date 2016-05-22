<?php
    include "security.php";

	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Content-Type: text/html; charset=utf-8');
	
	/* List of contracts */
	include "../services.php";
	
	$contracts = getAllContracts();	
?>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>iAgree Administrator Panel</title>
</head>
<body>

	<h1>iAgree Administrator Panel</h1>
	
	<table width='100%' border='1' cellspacing='0' cellpadding='10'>
		<tr>
			<th>ID</th>
			<th>Address</th>
			<th>Parties</th>
			<th>HelloSign GUID</th>
		</tr>
		
		<?php
			foreach($contracts as $contract) {
				$partiesAgreed = 0;
				foreach($contract['parties'] as $party) {
					if($party['agreed']) 
						$partiesAgreed++;
				}
				
				echo "<tr>";
				echo "<td>" . $contract['id'] . "</td>";
				echo "<td><a href='view_contract.php?id=" . $contract['id'] . "'>" . $contract['street'] . " " . $contract['building'] . ", " . $contract['city'] . "</a></td>";
				echo "<td>" . count($contract['parties']) . " (" . $partiesAgreed .  " agreed)</td>";
				echo "<td><a href='view_pdf.php?hellosign_guid=" . $contract['hellosign_guid'] . "'>" . $contract['hellosign_guid'] . "</a></td>";
				echo "</tr>";
			}	
		?>
	
	</table>

</body>
</html>