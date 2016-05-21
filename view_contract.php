<?php

    session_start();
	
	include_once("services.php");
	include_once("global_defs.php");
	include_once("contracts/services.php");
	
    if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
    }
	
	/* Fetch the contract object according to its ID */
	if(isset($_GET['rid'])) {
		$rid = basicParse($_GET['rid']);
		$contractId = getContractIdByRandomId($rid);
		
		if(empty($contractId)) {
			/* If 'rid' is invalid, redirect to homepage */
			header('Location: index.php');
		}
		
		$contract = getContractById($contractId);
		
		$contractCreator = getContractCreator($contractId);
		$contractCreator['name'] = $contractCreator['first_name'] . " " . $contractCreator['last_name'];
	} else {
		/* If 'rid' is not given, redirect to homepage */
		header('Location: index.php');
	}
    
	if(isset($user) && isset($contract)) {
		$myParty = getPartyByEmailAndContractId($user['email'], $contract['id']);
		$partiesArray = getPartiesByContractId($contract['id']);
		
		/* Check if all parties have agreed on the contract */
		$allPartiesAgreed = true;
		foreach($partiesArray as $party) {
			$allPartiesAgreed = ($allPartiesAgreed & $party['agreed']);
		}
		
		if(isset($partiesArray)) {

			foreach($partiesArray as $party) {
				$contract[$party['role']][] = $party;
			}

		}
	}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1">
<title>iAgree.co.il | חוזה iAgree - הופכים את חווית שכירת הדירות לפשוטה ונעימה.</title>
<link href="style2.css" rel="stylesheet" type="text/css">
<!-- Tablet -->
<link href="mobile2.css" rel="stylesheet" type="text/css" media="only screen and (min-width:0px) and (max-width:768px)">
<!-- Desktop -->
<link href="style2.css" rel="stylesheet" type="text/css" media="only screen and (min-width:769px)">

</head>

<body>

<section id="section1">

	<?php include 'nav.php';?>

</section>

<section id="section2">

	<div class="wrapper" id="contractWrapper">
    
    	<?php include 'contract_body.php';?>	
        
        <!---------------------------------------------------------------
							Approve/Edit
---------------------------------------------------------------->
            
        <div class="approve" id="approve">

            <p class="contractButton" id="remarks"><a href="my_contracts.php">חזור לעמוד החוזים שלי</a></p>
			
        </div><!--approve-->
        
    </div><!--wrapper-->

</section><!--section2-->

<section id="section3">

	<?php include 'footer.php';?>
    
</section>


<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>

<script>

/*****************************************************************
*    					General variables    					 *
*****************************************************************/

	var h = $(window).height();
	var frm = document.getElementById("frm");
	var mql = window.matchMedia("screen and (min-width:769px)");
	

/*****************************************************************
*    					Font size function    					 *
*****************************************************************/
	
function fontSize(){
	
	var w = $(window).width();
	var a = w/160;
	var b = h/77;
	if (w<1200){
	//	$('.container').css('max-width','100%');
		}
	if (w/h > 2){$('body').css('font-size',a+'px');}
	else		{$('body').css('font-size',b+'px');}
}
	

/*****************************************************************
*    							user	    					 *
*****************************************************************/


function user(){
//	alert();
	if ("<?=isset($user)?>"){
//	if (0){
		$('#userLogin').hide();
		$('#userLogout').show();
		$('#userLogout').css('display','table-cell');
		
		if("<?=isset($user['gplus_url']) ?>"){
			$('.gplus').show();
			}
		
		} else {
			$('#userLogin').show();
			$('#userLogin').css('display','table-cell');
			$('#userLogout').hide();
			loginUser();
			}
}


/*****************************************************************
*    					Ready functions	    					 *
*****************************************************************/
	
$(document).ready(function() {
//	alert("<?=$contract['insurance_option']?>");

	fontSize();
	user();
	

})


  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65350205-1', 'auto');
  ga('send', 'pageview');
  


</script>


</body>
</html>