<?php

	session_start();
		
	include_once("services.php");
	include_once("global_defs.php");
	include_once("contracts/services.php");

	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
	}else{
		$notLoggedIn = 1;
	}

	/* MY1 Fetch the contract object according to its ID */
	if(isset($_GET['rid'])) {
		$rid = basicParse($_GET['rid']);
		$contractId = getContractIdByRandomId($rid);
		
		if(empty($contractId)) {
			/* MY1 If 'rid' is invalid, redirect to homepage */
			header('Location: index.php');
		}

		$contract = getContractById($contractId);
			
			$contractAddress = $contract['street'] . ' ' . $contract['building'] . " דירה " . $contract['apartment'] . ", " . $contract['city'];
			
			$contractCreator = getContractCreator($contractId);
			$contractCreator['name'] = $contractCreator['first_name'] . " " . $contractCreator['last_name'];
	} else {
		/* If 'rid' is not given, redirect to homepage */
		$notAuthorized =1;
	}


	if(isset($user) && isset($contract)) {
		$myParty = getPartyByEmailAndContractId($user['email'], $contract['id']);
		
		if ($myParty != null){
		
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
			
		} else{
			$notAuthorized =1;
		}
		
	}
	
	/* Update party Phone and Address in Prties DB */
	if (($_POST['allDetailsDone'] ==1) && ($myParty['phone'] == NULL)){
				
		$detailsComplete = 1;
		
		$partyData = array (
				'phone' => $_POST['my_phone'], 
				'address' => $_POST['my_address']
			);
		
		 $result = updateParty($contractId, $user['email'], $partyData);
		 
		 header('Location: sign_contract.php?rid='.$rid);
	}
	
	/* Upload signature and Snapshot photos */
	if(isset($_POST['my_signature']) && (!$user['signature'])){
		
		$refresh = 0;

		$signature = uploadImage($_POST['my_signature'], "signatures/", $user['email'], $contractId);
		
		$snapshot = uploadImage($_POST['my_snapshot'], "snapshots/", $user['email'], $contractId);
		
		$tenantData = array (
			'signature' => $signature,
			'snapshot' => $snapshot,
			'my_ip' => get_client_ip(),
			'my_device_name' => $_POST['my_device_name'],
			'signature_timestamp' => $_POST['signature_date']
			);
		
		$result = 0;			
		$result = updateParty($contractId, $user['email'], $tenantData);
		
	
		if($result){header('Location:sign_contract.php?rid='.$rid.'&refresh=1');}
								
	}

	/* Refresh page one more time after uploading the snapshot and signature photos */
	if ($_GET['refresh']){
		
		$tenantData = array (
			'contract_signed' => 1
			);
			
		$result = 0;			
		$result = updateParty($contractId, $user['email'], $tenantData);
		
		header('Location:sign_contract.php?rid='.$rid);
	}

	/* Get IP */
	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
	
	/* Send comments to contract creator */
	if(isset($_POST['comments'])){

		$owner_name = basicParse($_POST['owner_name']);
		$owner_email = basicParse($_POST['owner_email']);
		$who_sent = basicParse($_POST['who_sent']);
		$who_sent_email = basicParse($_POST['who_sent_email']);
		$field_message = basicParse($_POST['comments']);
			
		$mail_to = $owner_email;
		$subject = 'iAgree | התקבלו הערות על החוזה מאת '.$who_sent;

		$body_message = '
		<html>
		<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1">

		<meta name="viewport" content="width=device-width">

		<style>
		BODY{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 10px;
			color:rgb(102,102,102);
			text-align:center;
			background-image:url(http://iagree.co.il/img/thankYouBG.jpg);
			direction:rtl;}
			
		body,html {
		  height: 100%;
		  width:100%;
		  margin:0;
		  padding:0;}

		#div2ThankYou{
			height:89%;
			display:block;}

			.gap10{
				height:10%;
				display:table;}

		.thankYou{
			width:80%;
			height:80%;
			margin:0 auto;
			border:20px solid rgba(0,176,240,1);
			border-left:2em solid rgba(146,208,80,1);
			border-bottom:2em solid rgba(146,208,80,1);
			text-align:center;}
			
			.thankYou img{
				width:50%;
				max-width:30em;}
				
			.thankYou h2{
				width:60%;
				margin: auto 20%;
				font-size:2em;}
				
			.thankYou h3{
				width:100%;
				font-size:2em;}

			.thankYou p{
				font-size:2em;}
		</style>

		</head>
		<body id="noShow">
			<div class="content">    
			
			<div class="div2" id="div2ThankYou">
			
				<div class="gap10">
				</div>
			
				<div class="thankYou">
				
					<h1>הי '.$owner_name.',</h1>
					<h2>'.$who_sent.', שלח אליך הערות על החוזה.</h2>
					<p>'.$field_message.'.</p>
					<h2>אנא סכמו בינכם את ההערות וערוך את החוזה בהתאם.<br>לאחר סיום העריכה, הפץ שוב את החוזה לסבב התייחסויות</h2>
					<h3>לשירותך תמיד,</h3>
					
					<a href="http://iagree.co.il/index.html"><img src="http://iagree.co.il/img/IAgreeLogoSmall2.png"></a>
					
					<h3>צוות iAgree</h3>

				
				</div><!--thankYou-->
					
			</div><!--div2-->
			
			</div><!--content-->
			
		</body>

		</html>
		';

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: contact@iagree.co.il\r\n";
		$headers .= "Reply-To: ".$who_sent_email."\r\n";
		$headers .= "Bcc: contact@iagree.co.il, maoz@iagree.co.il, offer@iagree.co.il, tom@iagree.co.il\r\n";

		$mail_status = mail($mail_to, $subject, $body_message, $headers);
		
		$comments_sent = 1;
		
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

<!-- Not sure this is still in use... -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<!---->

<link rel="stylesheet" href="css/signature-pad.css">

<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type='text/javascript' src="//wurfl.io/wurfl.js"></script>

<!-- Not sure this is still in use...	-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!---->

</head>

<body>

<!---------------- Signature pad dark background ----------------->
<div id="signature" class="popupContainer"></div><!--signature-->


<!------------------------ PopUps section ------------------------>
<div class="popupContainer" id='popupContainer'>

	<div class="popupBlock">

		<!------- Page not authorized popup ------->
		<div class="popupBox" id="notAuthorized">
        
            <img src="img/IAgreeLogoSmall.png">
            <h1>אינך מורשה לצפות בעמוד זה!</h1>
            
            <h2>ייתכן מאחר שאינך משתמש רשום באתר</h2>
            <h3>הינך מועבר לעמוד הבית</h3>            
            
            <a href="login.php">אישור</a>
        
        </div><!--popupBox-->
		

		<!------- Send comments popup ------->
		<div class="popupBox" id="popupBoxComments">
        
        	<img class="xbox" src="img/iAgree_x.png">
            <img src="img/IAgreeLogoSmall.png">
            <h1>שלח הערות ליוצר החוזה</h1>
            <h2>אנא מלא הערותיך בתיבת הטקסט.</h2>
            <h3>בלחיצת "שלח" הערותיך יישלחו ליוצר החוזה.</h3>
            
            <form id="commentsFrom" method="post">
            <input name="owner_email" type="hidden" value="<?=$contractCreator['email']?>" />
            <input name="who_sent" type="hidden" value="<?=$user['name']?>" />
            <input name="who_sent_email" type="hidden" value="<?=$user['email']?>" />
            <input name="owner_name" type="hidden" value="<?=$contractCreator['name']?>" />
            
            	<div class="rightLineBlock">
                    
                    <div class="contractInput textInput" id="comments">
                    
                        <h3>הודעה:</h3>
                        <textarea name="comments" class="newInput newInputL" onChange="done(this)" rows="7" maxlength="306"></textarea>
                        <img src="img/iAgree_alert.png">
                        
                    </div><!--comments-->
                                        
                </div><!--rightLineBlock-->
            
            </form>
            
            <a onClick="sendCommentsToOwner(document.getElementById('commentsFrom'))">שלח</a>
        
        </div><!--popupBox-->
		
		
		<!------- Comments sent popup ------->
		<div class="popupBox" id="commentsSent">
        
        	<img class="xbox" src="img/iAgree_x.png">
            <img src="img/IAgreeLogoSmall.png">
            <h1>הי <?=$who_sent?>,</h1>
			<h2>הערותיך  נשלחו בהצלחה ליוצר החוזה.</h2>
			<p>אנא סכמו בינכם את ההערות. לאחר מכן יערוך יוצר החוזה את החוזה בהתאם.<br>עם סיום העריכה, יופץ שוב החוזה לסבב התייחסויות</p>
			<h3>לשירותך תמיד,</h3>			
			<h3>צוות iAgree</h3>
			
        </div><!--popupBox-->


		<!------- User not logged in popup ------->
		<div class="popupBox" id="NotLoggedIn">
        
            <img src="img/IAgreeLogoSmall.png">
            <h1>ברוך הבא לאתר iAgree</h1>
            
            <h2>ע"מ לצפות בחוזה עליך להתחבר לאתר</h2>
            <h3>לאחר לחיצת אשר, תועבר לעמוד login.</h3>
            <h3>מיד לאחר הכניסה לאתר, תחזור באופן אוטומטי לעמוד זה.</h3>            
            
            <a href="login.php?location=sign_contract.php?rid=<?=$rid?>">התחבר</a>
        
        </div><!--popupBox-->
		
		
		<!------- Fill in missing details popup ------->
		<div class="popupBox" id="fillInMissingDetails">
        
        	<img class="xbox" src="img/iAgree_x.png">
            <img src="img/IAgreeLogoSmall.png">
            
            <h2>אנא השלם את הפרטים הבאים על מנת לחתום על החוזה.</h2>
            <h3>מיד לאחר האישור פרטיך יושלמו בחוזה באופן אוטומטי</h3>
            
            <form id="frm" method="post" enctype="multipart/form-data">
				<input type="hidden" name="contract_agreed">
                
                
                <div class="rightLineBlock">
                
                    <div class="contractInput input48" id="my_phone">
                        <h3>טלפון:</h3>
                        <input id="my_phoneInput" name="my_phone" class="newInput newInputMobile" onChange="done(this)" placeholder="לדוגמה: 0549328745" type="text" value="<?=isset($_POST['contract_agreed'])?$_POST['my_phone']:$myParty["phone"]?>"/>
                        <img src="img/iAgree_alert.png">
                    </div><!--my_phone-->
                    
                    <div class="contractInput input48" id="my_address">
                        <h3>כתובת:</h3>
                        <input id="my_addressInput" name="my_address" class="newInput newInputP" onChange="done(this)" type="text" value="<?=isset($_POST['contract_agreed'])?$_POST['my_address']:$myParty["address"]?>"/>
                        <img src="img/iAgree_alert.png">
                    </div><!--my_address-->
                                        
                </div><!--rightLineBlock#2-->
                               
               	<input type="hidden" name="allDetailsDone" value="1">
            
            </form>
            
            <a onClick="review()">אשר</a>
        
        </div><!--popupBox-->
		
		
		<!------- Signature process complete successfully popup ------->
		<div class="popupBox" id="signSuccess">
        
            <img src="img/IAgreeLogoSmall.png">
            <h1>תודה שחתמת דרכינו!</h1>
            <h2>מיד עם חתימת כל הצדדים על החוזה<br>יישלח אליך עותק החוזה החתום במייל</h2>
            
            <h1><img src="img/IAgreeLogoSmall2.png"> ככה שוכרים היום דירה!</h1>
            
            
            <a href="index.php">אשר</a>
        
        </div><!--popupBox-->
		
	</div><!--popupBlock-->

</div><!--popupContainer-->



<!------------------------ page content starts ------------------------>

<section id="section1">

	<?php include 'nav.php';?>

</section>

<section id="section2">

	<div class="wrapper" id="contractWrapper">
    
    	<!-------- Contract body -------->
		<?php include 'contract_body.php';?>
		
		
<?
	if(!$myParty['contract_signed']) {
?>
    
    	<!---------- Snapshot and Signature pad ---------->
        <div class="m-signature-pad" id="snapshot">
		
			<!--------- Snapshot pad-------->
			<div class="camcontent">
			
				<h1>רגע לפני שחותמים! אנחנו רוצים לוודא שזה באמת אתה...</h1>
					
				<video id="video" autoplay width="320" height="240"></video>
				
				<canvas id="canvas" width="320" height="240"></canvas>
				
			</div><!--camcontent-->
			
		   
			<div class="cambuttons">
			
				<div class="button" id="snap"><p>שמור תמונה</p></div> 
				<div class="button" id="reset"><p>תמונה חדשה</p></div>     
				<div class="button" id="upload" onClick="$('#snapshot').hide(); $('#signature-pad').show()"><p>אשר</p></div> 
			
			</div><!--cambuttons-->
         
		</div><!--snapshot-->

		
		
		<!--------- Signature pad-------->
		<div class="m-signature-pad" id="signature-pad">
			<h1>חתימה</h1>
			<div class="m-signature-pad--body">
			  
			  <canvas id="myCanvas"></canvas>
			
			</div>
			
			<div class="m-signature-pad--footer">
			  
				<p id="snap" onClick="getCanvas()">אשר</p>
			  
			</div>   

		</div><!--signature-pad-->
		
		<script src="js/signaturePad/signature_pad.js"></script>
		<script src="js/signaturePad/app.js"></script>
		
<?
	}
?>
		
		
		<!------------------------ Action buttons ----------------------->
		<div class="approve" id="approve">
		
			<!------ If contract was signed go back to my contracts	------>
			<?
				if($myParty['contract_signed']) {
			?>
			
					<p class="contractButton" id="remarks"><a href="my_contracts.php">חתמת על החוזה בהצלחה<br>חזור לעמוד החוזים שלי</a></p>
					
			<?
				}else{
			?>

					<p class="contractButton" id="remarks"><a onClick="sendComments()">שלח הערות ליוצר החוזה</a></p>
				   
					<p class="contractButton" id="logedIn"><a onClick="completeDetails()">השלם פרטים</a></p>
					
					<p class="contractButton" id="sign"><a onClick="showSigPad()">חתום!</a></p>
			<?
				}
			?>
			
        </div><!--approve-->
  	
		
		<!--------- Hidden DIV to hold the canvas of the snapshot -------->
		<div class="hidden">
			
			<canvas class="resutls" id="snapResult" width="320" height="240"></canvas>
        
			<div class="resutls" id="imgResult"></div>
			
		</div><!--hidden-->
  	
    	
		<!-------- Appendix A - Snapshot and ID images ------->
		<?php include 'appendixA.php';?>
		
		
		<!----- Form to post Snapshot Signature and ather signing data ----->
		<form id="frmSnapshot" method="post" enctype="multipart/form-data">
		
			<input type="hidden" name="my_snapshot" id="my_snapshot"/>
			<input type="hidden" name="my_signature" id="my_signature"/>
			<input type="hidden" name="my_device_name"/>
			<input type="hidden" name="signature_date"/>
            
		</form>
 
        
    </div><!--wrapper-->

</section><!--section2-->

        
<section id="section3">

	<?php include 'footer.php';?>
    
</section>




<script>

/* Activates the webcam */
/*	I want to try to activate camera only when necessary */
function getPhoto(){

	// Put event listeners into place
//	window.addEventListener("DOMContentLoaded", function() {
		// Grab elements, create settings, etc.
		var canvas = document.getElementById("canvas"),
			context = canvas.getContext("2d"),
			video = document.getElementById("video"),
			videoObj = { "video": true },
			image_format= "jpeg",
			jpeg_quality= 85,
			errBack = function(error) {
				console.log("Video capture error: ", error.code);};
				
		var snapResult = document.getElementById("snapResult"),
			context2 = snapResult.getContext("2d"),
			video2 = document.getElementById("video"),
			videoObj2 = { "video": true },
			image_format2= "jpeg",
			jpeg_quality2= 85;
			
		// Put video listeners into place
		if(navigator.getUserMedia) { // Standard
			navigator.getUserMedia(videoObj, function(stream) {
				video.src = stream;
				video.play();
				$("#snap").show();
			}, errBack);
		} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
			navigator.webkitGetUserMedia(videoObj, function(stream){
				video.src = window.webkitURL.createObjectURL(stream);
				video.play();
				$("#snap").show();
			}, errBack);
		} else if(navigator.mozGetUserMedia) { // moz-prefixed
			navigator.mozGetUserMedia(videoObj, function(stream){
				video.src = window.URL.createObjectURL(stream);
				video.play();
				$("#snap").show();
			}, errBack);
		}
		
		// Get-Save Snapshot - image 
		document.getElementById("snap").addEventListener("click", function() {
			context.drawImage(video,0,0,320,240);
			context2.drawImage(video,0,0,320,240);
			
			$('.resutls').hide();
			
			// the fade only works on firefox?
			$("#video").fadeOut("fast", function(){
				$("#canvas").fadeIn("fast");
				});
			
			$("#snap").hide();
			$("#reset").css('display','inline-table');
			$("#upload").css('display','inline-table');
		});

		// reset - clear - to Capture New Photo
		document.getElementById("reset").addEventListener("click", function() {
			$("#canvas").hide("fast", function(){
				$("#video").show();
				});
			$("#snap").show();
			$("#reset").hide();
			$("#upload").hide();
		});

//	}, false);

}



/* Get Sanpshot and Signature canvases and post it to server */
function getCanvas(){
	
	$('#signature').hide();
	$('#signature-pad').hide();
	$('.approve').hide();
	
	var my_canvas = document.getElementById('myCanvas');
	var snap_result = document.getElementById('snapResult');
	
	
	var myImg = new Image();
	myImg.id = "pic";

	myImg.src = my_canvas.toDataURL();
	document.getElementById('imgResult').appendChild(myImg);
	
	fSnapshot = document.getElementById('frmSnapshot');
	var sigDate = new Date;
	
	fSnapshot.my_device_name.value = WURFL.complete_device_name;
	fSnapshot.signature_date.value = sigDate;
	
	var dataURL_signature = my_canvas.toDataURL("image/png");
	fSnapshot.my_signature.value = dataURL_signature;
	
	var dataURL_snapshot = snap_result.toDataURL("image/png");
	fSnapshot.my_snapshot.value = dataURL_snapshot;

//	alert(55);
	fSnapshot.submit();
	
}


/* Get signature time */
function signTime(){	
	document.getElementById("signTime").innerHTML = new Date();
}


/*************** Popup functions ************/

/* Close popup with "X" symbol */
$('.xbox').click(function(){
	$('.popupContainer').hide();	
})

/* Page not authorized */
function notAuthorized(){
	$('.popupContainer').css('display','table');
	$('.popupBox').hide();
	$('#notAuthorized').fadeIn();}
	
/* User not logged in */
function loginUser(){
	$('.popupContainer').css('display','table');
	$('.popupBox').hide();
	$('#NotLoggedIn').fadeIn();}

/* Send Comments */
function sendComments(){
	$('.popupContainer').css('display','table');
	$('.popupBox').hide();
	$('#popupBoxComments').fadeIn();}
	
/* Comments sent */
function commentsSent(){
	$('.popupContainer').css('display','table');
	$('.popupBox').hide();
	$('#commentsSent').fadeIn();}
	
	
/* Fill in missing details */
function completeDetails(){
	$('.popupContainer').css('display','table');
	$('.popupBox').hide();
	$('#fillInMissingDetails').fadeIn();}
	
/*Successful Signing*/
function signSuccess(){

	$('.popupContainer').css('display','table');
	$('.popupBox').hide();
	$('#signSuccess').fadeIn();

}


/* Select which button to display */
function whichButton(){
	
	$('.contractButton').hide();
	
	if ('<?=$myParty['phone']?>' != ""){
		
		$('#sign').show();
	}else {
		$('#logedIn').show();
		$('#remarks').show();
	}
}
	

/* Show signature pad */
function showSigPad(){

	$('#signature').fadeIn();
	$('#signature-pad').css('opacity','1');
	$('#snapshot').fadeIn();
	getPhoto();
	
}


/* General variables */

	var h = $(window).height();
	var frm = document.getElementById("frm");
	var mql = window.matchMedia("screen and (min-width:769px)");
	

/* Font size function */
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


/* Checks if user logged in */
function user(){
	if ("<?=isset($user)?>"){

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
//			loginUser();
			}
}


/* Ready functions */
	
$(document).ready(function() {

	if ('<?=$notAuthorized?>'==1){notAuthorized()};
	if ('<?=$notLoggedIn?>'==1){loginUser()};
	
	/* Hide objects on load */
	$('.m-signature-pad').hide();
	$('.resutls').hide();
	$('#signature').hide();
//	$('#popupContainer').hide();
	

/* Probabaly can be deleted */
//	$('#idImg').show();
//	$('#miniImg img').show();

	
	/* Required functions */
	fontSize();
	user();
	
		
	if ('<?=!$myParty['contract_signed']?>'){whichButton()};
	
	if ('<?=$comments_sent?>'){commentsSent()};

//	alert('<?=$notLoggedIn?>');

})


/* Review form for inputs validation */
function review(){
		
	var a=0;
	$('.contractInput img').css('display','none');

	if (frm.my_address.value.length == 0) {
		frm.my_address.focus();
		$('#my_address img').fadeIn();
		a=1;}
	
	if (frm.my_phone.value.length == 0) {
		frm.my_phone.focus();
		$('#my_phone img').fadeIn();
		a=1;}
		
	if (a==1) {reutrn(0);}
	
	frm.submit(); }
	
/* Send comment to owner form function */	
function sendCommentsToOwner(frm){
	var a=0;
	$('.contractInput img').css('display','none');
		
	if (frm.comments.value.length == 0) {
		frm.comments.focus();
		$('#comments img').fadeIn();
		a=1;}
		
	if (a==1) {reutrn(0);}
	
	frm.submit();}


/* Google Analytics code */
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65350205-1', 'auto');
  ga('send', 'pageview');        

</script>

</body>
</html>