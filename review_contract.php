<?php

    session_start();
	
	include_once("services.php");
	include_once("contracts/services.php");

	/* Get 'rid', if exists, for forwarding it to save_contract.php */
	if(isset($_GET['rid'])) {
		$rid = basicParse($_GET['rid']);
//		$contractId = getContractIdByRandomId($rid);
//		$contract = getContractById($contractId);
	} 
	
/*	else {	*/
	
		/* Get from the session the saved contract we want to review */
		if(isset($_SESSION['saved_contract'])) {
			$contract = $_SESSION['saved_contract'];
		} else {
			header('Location: create_contract.php');
		}
/*	}	*/
    
    
	/* update landlord details in case he is a registered user */
	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		
		if ($sontract['landlord'][0]['email'] == $user['email']){
			
			$sontract['landlord'][0]['first_name'] = $user['first_name'];
			$sontract['landlord'][0]['last_name'] = $user['last_name'];
			$sontract['landlord'][0]['identity_number'] = $user['identity_number'];
			$_SESSION['temp_id_img'] = $user['scanned_id'];
			
		} 
		
/*		
		$tempParty = getPartyByEmailAndContractId($user['email'], $contractId);
		
		if (($tempParty['email'] == $user['email']) && ($tempParty['role']  == 'landlord')){};
*/
    }
	
/*	if(isset($user) && isset($contract)) {	*/
	if(isset($user) && isset($contract['id'])) {
	
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
	
	/******************** maoz functions **********************/
	
	//include_once("contract_functions.php");

	/******************** /maoz functions **********************/

?>
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1">
<title>iAgree.co.il | חוזה iAgree</title>
<link href="style2.css" rel="stylesheet" type="text/css">
<!-- Tablet -->
<link href="mobile2.css" rel="stylesheet" type="text/css" media="only screen and (min-width:0px) and (max-width:768px)">
<!-- Desktop -->
<link href="style2.css" rel="stylesheet" type="text/css" media="only screen and (min-width:769px)">

</head>

<body>

<div class="popupContainer">

	<div class="popupBlock">
    
    	<div class="popupBox" id="popupBoxReview1">
        
        	<img class="xbox" src="img/iAgree_x.png">
            <img src="img/IAgreeLogoSmall.png">
            <h1>החוזה נשלח בהצלחה!</h1>
            <h2>בדקות הקרובות יישלח מייל, עם קישור לחוזה, אל כל הצדדים בחוזה.</h2>
            <h3>הפרטים האישיים של המשתתפים בחוזה יושלמו באופן אוטומטי לאחר הרשמתם לאתר.</h3>
            <h3>לאחר קריאת החוזה יתבקשו כל הצדדים לאשר את החוזה.</h3>
            <h3>לאחר שכל הצדדים אישרו את החוזה, יישלח החוזה לחתימה דיגיטלית.</h3>
            <a href="save_contract.php<?=(isset($rid) ? "?rid=$rid" : "")?>">אשר</a>
        
        </div><!--popupBox-->
        
        
        
        <div class="popupBox" id="popupBoxReview2">
        
        	<img class="xbox" src="img/iAgree_x.png">
            <img src="img/IAgreeLogoSmall.png">
            
            <h2>ע"מ להמשיך עליך להירשם לאתר.</h2>
            <h3>מיד עם סיום ההרשמה, תחזור לעמוד זה באופן אוטומטי.</h3>
            <a href="login.php?location=review_contract.php#approve">אשר</a>
        
        </div><!--popupBox-->

    
    	<div class="popupBox" id="popupBoxReview3">
        
        	<img class="xbox" src="img/iAgree_x.png">
            <img src="img/IAgreeLogoSmall.png">
            <h1>החוזה נוצר בהצלחה!</h1>
            <h3>בעמוד "החוזים שלי" תתבקש להכניס את כתובת הדואר האלקטרוני של השוכרים העתידיים לטובת בניית פרופיל ובהמשך במידה ותבחר, תוכל להפיץ אליהם את החוזה הנ"ל.</h3>
            <h3>בלחיצת אישור, תועבר לעמוד "החוזים שלי" להמשך התהליך.</h3>
            <a href="save_contract.php<?=(isset($rid) ? "?rid=$rid" : "")?>">אשר</a>
        
        </div><!--popupBox-->
        
	</div><!--popupBlock-->
        

</div><!--popupContainer-->

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

            <p class="contractButton" id="remarks"><a href="property_description.php<?=(isset($rid) ? "?rid=$rid" : "")?>">ערוך</a></p>
            <p class="contractButton" id="notLogedIn"><a onClick="login()">אשר את החוזה</a></p>
            <p class="contractButton" id="notLogedIn3"><a onClick="login()">אשר את החוזה</a></p>
            <p class="contractButton" id="logedIn"><a onClick="sendContract()">הפץ את החוזה לאישור</a></p>
            <p class="contractButton" id="logedIn3"><a onClick="sendContractLandload()">אשר את החוזה</a></p>
            
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
	var frm = document.getElementById("form2");
	var owner = "<?=isset($_SESSION['role']) ? ($_SESSION['role'] == 'landLord' ? 'landLord' : 'tenant') : ''?>";
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
//		$('#notLogedIn').hide();
//		$('#logedIn').css('display','inline-block');
		
		if("<?=isset($user['gplus_url']) ?>"){
			$('.gplus').show();
			}
		
		} else {
			$('#userLogin').show();
			$('#userLogin').css('display','table-cell');
			$('#userLogout').hide();
//			$('#logedIn').hide();
//			$('#notLogedIn').css('display','inline-block');
			}
}


/*****************************************************************
*    					Ready functions	    					 *
*****************************************************************/
	
$(document).ready(function() {
	fontSize();
	user();
	
//	alert('<?=$contract['landlord'][0]['scanned_id']?>');
//	alert('<?=$contract['scanned_id']?>');
	
	buttons();
})


/*****************************************************************
*  						Cobtract Completion			  			 *
*****************************************************************/

function buttons(){

	if ("<?=isset($user)?>"){
//	if (0){
		
		if ("<?=$contract['insurance_option']?>" == 3){
			
			$('.contractButton').hide();
			$('#remarks').show();
			$('#logedIn3').show();
			
		}else{
			
			$('.contractButton').hide();
			$('#remarks').show();
			$('#logedIn').show();
			
		}
		
	}
		
	if (!"<?=isset($user)?>"){
//	if (1){ 
	
		if ("<?=$contract['insurance_option']?>" == 3){
			
			$('.contractButton').hide();
			$('#remarks').show();
			$('#notLogedIn3').show();
			
		}else{
			
			$('.contractButton').hide();
			$('#remarks').show();
			$('#notLogedIn').show();
		}	
		
	}
	
}


$('.xbox').click(function(){$('.popupContainer').hide();});


function sendContract(){
	$('.popupContainer').css('display','table');
	$('.popupBox').hide();
	$('#popupBoxReview1').fadeIn();
}


function sendContractLandload(){
	$('.popupContainer').css('display','table');
	$('.popupBox').hide();
	$('#popupBoxReview3').fadeIn();
}

	
function login(){
	$('.popupContainer').css('display','table');
	$('.popupBox').hide();
	$('#popupBoxReview2').fadeIn();
}

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-65350205-1', 'auto');
ga('send', 'pageview');
  


</script>


</body>
</html>