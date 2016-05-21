<?php

	session_start();
	
	include_once("services.php");
	
	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
    } 

	/* Decide if to use a contract from the database or from the temporary session */
	if(isset($_GET['rid'])) {
		
		$rid = basicParse($_GET['rid']);
		$contractId = getContractIdByRandomId($rid);
		
		//$contract = getContractById($contractId);	//fetch from db
		
	}
	
	if(isset($_SESSION['saved_contract'])) {
		
		$contract = $_SESSION['saved_contract'];	//fetch from temporary session
		
	}
	
	
//	$_SESSION['isImgUploaded'] = isset($_POST['my_id_img']) ?  1 : 0;
	
	if($_FILES['my_id_img']){
		$imgLoadOk = 1;
		
		$imgRand = rand();
		
		$info = pathinfo($_FILES['my_id_img']['name']);
		$ext = $info['extension']; // get the extension of the file
		$newname = "temp.".$imgRand.".".$ext; 
		
		$_SESSION['temp_id_img'] = $newname;
		
		$target = 'tempImg/'.$newname;
		move_uploaded_file( $_FILES['my_id_img']['tmp_name'], $target);
		
	}
	
	

?>
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1">
<title>iAgree.co.il | פרטים אישיים</title>
<link href="style2.css" rel="stylesheet" type="text/css">
<!-- Tablet -->
<link href="mobile2.css" rel="stylesheet" type="text/css" media="only screen and (min-width:0px) and (max-width:768px)">
<!-- Desktop -->
<link href="style2.css" rel="stylesheet" type="text/css" media="only screen and (min-width:769px)">

</head>

<body oncontextmenu="return false;">

<section id="section1">

	<?php include 'nav.php';?>

</section>

<section id="section2">

	<div class="wrapper">
    
    	<div class="right">
        
        	<div class="dots">
            
            	<div class="dot" id="dotFull"><p></p></div>
            
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dotFull"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dotFull"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dotFull"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dotFull"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dotFull"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dotFull"><p></p></div>
            
            </div><!--dots-->
            
            <div class="contract">
            
            	<h1>פרטים אישיים</h1>
                
                <form id="form2" action="contract_creation_checkpoint.php?location=<?=urlencode('review_contract.php')?><?=(isset($rid) ? "&rid=$rid" : "")?>" method="post" enctype="multipart/form-data"> 
                
<!--                	<div class="contractInput" id="load_id" >
                            
                        <div class="load_id" onClick="idImgClick()">
                        
                            <p>העלה תעודת זהות</p>
                            <input class="newInput newInputM" type="file" id="file" name="my_id_img" multiple accept='image/*' value="" />
                        
                        </div>
                        
                    </div><!--load_id-->
                    
                    <div class="rightLineBlock">
                    
                    	<div class="contractInput" id="my_first_name">
                        
                            <h3>שם פרטי:</h3>
                            <input id="my_first_nameInput" name="my_first_name" class="newInput newInputM" onChange="done(this)" type="text" value=""/>
                            <img src="img/iAgree_alert.png">
                        </div><!--my_first_name-->
                        
                        <div class="contractInput" id="my_last_name">
                            <h3>שם משפחה:</h3>
                            <input id="my_last_nameInput" name="my_last_name" class="newInput newInputM" onChange="done(this)" type="text" value=""/>
                            <img src="img/iAgree_alert.png">
                        </div><!--my_last_name-->
                        
                        <div class="contractInput" id="my_identity_number">
                            <h3>ת"ז:</h3>
                            <input id="my_identity_numberInput" name="my_identity_number" class="newInput newInputM" onChange="doneID(this)" placeholder="9 ספרות" type="text" value=""/>
                            <img src="img/iAgree_alert.png">
                        </div><!--my_identity_number-->
                                            
                    </div><!--rightLineBlock#1-->
                    
                    
                    <div class="rightLineBlock">
                    
                    	<div class="contractInput input48" id="my_phone">
                            <h3>טלפון:</h3>
                            <input id="my_phoneInput" name="my_phone" class="newInput newInputMobile" onChange="done(this)" placeholder="לדוגמה: 0549328745" type="text" value=""/>
                            <img src="img/iAgree_alert.png">
                        </div><!--my_phone-->
                        
                        <div class="contractInput input48" id="my_address">
                            <h3>כתובת:</h3>
                            <input id="my_addressInput" name="my_address" class="newInput newInputP" onChange="done(this)" type="text" value=""/>
                            <img src="img/iAgree_alert.png">
                        </div><!--my_address-->
                                            
                    </div><!--rightLineBlock#2-->
                    
                    
                    <div class="rightLineBlock">
                    
                    	<div class="contractInput input48" id="my_email">
                            <h3>דוא"ל:</h3>
                            <input id="my_emailInput" name="my_email" class="newInput newInputP" onChange="done(this);emailAC()"  placeholder="לדוגמה: dan@iAgree.co.il" type="text" value=""/>
                            <img src="img/iAgree_alert.png">
                            
                            <script>
							
								if (<?=isset($user['email'])?>){ frm.my_email.value="<?=$user['email']?>"}
							
							</script>
                            
                        </div><!--email-->
                        
                        
                        <div id="miniImg">
                        
                        	<?php	
								
								$imgSource = isset($user['scanned_id']) ? $user['scanned_id'] : isset($_SESSION['temp_id_img']) ? $_SESSION['temp_id_img'] : null;
								if ($imgSource){
									
							?>
                            
                            			<input id="scanned_id" name="scanned_id" type="hidden" value="<?=$imgSource?>"/>
                                        <img src="tempImg/<?=$imgSource?>">
                                        
                            <?php
									}
							?>
                        
                        </div><!--miniImg-->
                                            
                    </div><!--rightLineBlock#3-->
                    
                    
                    <div class="rightLineBlock platinumNoshow">
            
                        <div class="contractInput input48" id="landlord_email">
                            <h3>דוא"ל משכיר:</h3>
                            <input id="landlord_emailInput" name="landlord_email" class="newInput newInputP" onChange="done(this)" placeholder="לדוגמה: israel@iAgree.co.il" type="text" value=""/>
                            <img src="img/iAgree_alert.png">
                        </div><!--landlord_email-->
                                        
                    </div><!--rightLineBlock#4-->
                    
                    <div class="rightLineBlock platinumNoshow" id="tenant_email">
                    
                        <div class="contractInput input48" id="tenant1_email">
                            <h3>דוא"ל שוכר:</h3>
                            <input id="tenant1_emailInput" name="tenant1_email" class="newInput newInputP" onChange="done(this)" placeholder="לדוגמה: israel@iAgree.co.il" type="text" value=""/>
                            <img src="img/iAgree_alert.png">
                        </div><!--tenant1_email-->
                        
                        <div class="contractInput input48" id="tenant2_email">
                            <input id="tenant2_emailInput" name="tenant2_email" class="newInput newInputP" onChange="done(this)" placeholder="לדוגמה: israel@iAgree.co.il" type="text" value=""/>
                            <img class="xxx" src="img/iAgree_x.png" onClick="closeP('tenant2_email')">
                            <img src="img/iAgree_alert.png">
                        </div><!--tenant2_email-->
                        
                        <div class="contractInput input48" id="tenant3_email">
                            <input id="tenant3_emailInput" name="tenant3_email" class="newInput newInputP" onChange="done(this)" placeholder="לדוגמה: israel@iAgree.co.il" type="text" value=""/>
                            <img class="xxx" src="img/iAgree_x.png" onClick="closeP('tenant3_email')">
                            <img src="img/iAgree_alert.png">
                        </div><!--tenant3_email-->
                        
                        <p onClick="openP()"><img id="plus" src="img/iAgree_plus.png"> הוסף שוכר</p>
                                        
                    </div><!--rightLineBlock#5-->
                
            	</form>
            
            </div><!--contract-->
            
            <div class="buttons">
            
            	<div class="prev"><a href="securities_selection.php<?=(isset($rid) ? "?rid=$rid" : "")?>">הקודם</a></div>
                <div class="next" id="nextFinish"><a onClick="review()">סיים, ועבור על החוזה!</a></div>
            
            </div><!--buttons-->
        
        </div><!--right--
        
        --><div class="left">
        
        	<div class="notes">
            
            	<p>אתה נדרש להכניס את הפרטים האישיים שלך ואת כתובת המייל של שאר הצדדים. הפרטים המזהים של שאר הצדדים יוכנסו על-ידם בהמשך.</p>
                <p><span>בלחיצה על "הבא" תוכל לראות את החוזה הדיגיטלי שהוכן עבורך.</span></p>
                <p><span>תידרש לאשר את החוזה 
לפני שליחתו לשאר הצדדים.</span></p>
            
            </div><!--notes-->
            
            <div class="helpText">
            
            	<p>אנא השלם את הפרטים החסרים.</p>
            
            </div><!--helpText-->
        
        </div><!--left-->
    
    </div><!--wrapper-->

</section><!--section2-->

<section id="section3">

	<?php include 'footer.php';?>
    
</section>


<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>

<script>


function IDValidator(id)
{
 id += ""; //cast as string
 if (id.length != 9 || isNaN(id)) {
 return false;
 }
 var counter = 0, incNum;
 for (i in id) {
 incNum = Number(id[i]) * ((i % 2) + 1);//multiply digit by 1 or 2
 counter += (incNum > 9) ? incNum - 9 : incNum;//sum the digits up and add to counter
 }
 return (counter % 10 == 0);
}

/*****************************************************************
*    					General variables    					 *
*****************************************************************/

	var h = $(window).height();
	var frm = document.getElementById("form2");

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
			}
}


/*****************************************************************
*    					Ready functions	    					 *
*****************************************************************/
	
$(document).ready(function() {
	fontSize();
	user();

//	alert("<?=$user['first_name']?>");
	

	imgShow();
	
	if ("<?=$contract['insurance_option']?>" == 3){
//	if (1){
		$('.platinumNoshow').hide();}
		
	if ("<?=isset($_SESSION['temp_id_img'])?>"){
		$('#load_id').hide();}
	
	
	frm.my_first_name.value 	= "<?=str_replace('"',  '\"', $contract['my_first_name'])?>";
	frm.my_last_name.value 		= "<?=str_replace('"',  '\"', $contract['my_last_name'])?>";
	frm.my_identity_number.value 	= "<?=$contract['my_identity_number']?>";
	frm.my_phone.value 			= "<?=$contract['my_phone']?>";
	frm.my_address.value 		= "<?=str_replace('"',  '\"', $contract['my_address'])?>";
	frm.my_email.value 			= "<?=$contract['my_email']?>";
	frm.landlord_email.value 	= "<?=$contract['landlord'][0]['email']?>";
	frm.tenant1_email.value 	= "<?=$contract['tenant'][0]['email']?>";
	frm.tenant2_email.value 	= "<?=$contract['tenant'][1]['email']?>";
	frm.tenant3_email.value 	= "<?=$contract['tenant'][2]['email']?>";
	
	if(frm.tenant2_email.value == "")
		$('#tenant2_email').hide();
	
	if(frm.tenant3_email.value == "")
		$('#tenant3_email').hide();
	
	start();
})		

/*****************************************************************
*    						HomeApp()	    					 *
*****************************************************************/

function emailAC(){
	
	if("<?=$contract['role']?>" == 'tenant'){
		frm.tenant1_email.value = frm.my_email.value;
		done(frm.tenant1_email);}
	else{
		if("<?=$contract['role']?>" == 'landlord'){
			frm.landlord_email.value = frm.my_email.value;
			done(frm.landlord_email);}
	}
}



function review(){
	
	var a=0;
	$('.contractInput img').css('display','none');
	imgShow();
	
	$('.helpText').css('opacity','0');
	
	
	if ("<?=$contract['insurance_option']?>" != 3){
	
		if($('#tenant3_email').is(":visible")){
			
			if (!ValidateEmail(frm.tenant3_email.value)) {
				frm.tenant3_email.focus();
				$(frm.tenant3_email).removeClass('selected');
				frm.tenant3_email.value = ""
				$('#tenant3_email img').fadeIn();
				a=1;}
		}
				
			var ten2 = $('#tenant2_email').is(":visible");
		if (!ValidateEmail(frm.tenant2_email.value) && ten2) {
			frm.tenant2_email.focus();
			$(frm.tenant2_email).removeClass('selected');
			frm.tenant2_email.value = ""
			$('#tenant2_email img').fadeIn();
			a=1;}
		
		
		if (!ValidateEmail(frm.tenant1_email.value)) {
			frm.tenant1_email.focus();
			$(frm.tenant1_email).removeClass('selected');
			frm.tenant1_email.value = ""
			$('#tenant1_email img').fadeIn();
			a=1;}
		
		if (!ValidateEmail(frm.landlord_email.value)) {
			frm.landlord_email.focus();
			$(frm.landlord_email).removeClass('selected');
			frm.landlord_email.value = ""
			$('#landlord_email img').fadeIn();
			a=1;}
			
	}

	
	if (!ValidateEmail(frm.my_email.value)) {
		frm.my_email.focus();
		$(frm.my_email).removeClass('selected');
		frm.my_email.value = ""
		$('#my_email img').fadeIn();
		a=1;}

	
	if (frm.my_address.value.length == 0) {
		frm.my_address.focus();
		$('#my_address img').fadeIn();
		a=1;}
	
	if (frm.my_phone.value.length == 0) {
		frm.my_phone.focus();
		$('#my_phone img').fadeIn();
		a=1;}
		
	if (!IDValidator(frm.my_identity_number.value)) {
		frm.my_identity_number.focus();
		$('#my_identity_number img').fadeIn();
		a=1;}
		
	if (frm.my_last_name.value.length == 0) {
		frm.my_last_name.focus();
		$('#my_last_name img').fadeIn();
		a=1;}
		
	if (frm.my_first_name.value.length == 0) {
		frm.my_first_name.focus();
		$('#my_first_name img').fadeIn();
		a=1;}
		
	if (a==1) {
		$('.helpText').css('opacity','1')
		return(0);}
	
	frm.submit(); }
	
	
function start(){
	done(document.getElementById('my_first_nameInput'));
	done(document.getElementById('my_last_nameInput'));
	doneID(document.getElementById('my_identity_numberInput'));
	done(document.getElementById('my_phoneInput'));
	done(document.getElementById('my_addressInput'));
	done(document.getElementById('my_emailInput'));
	done(document.getElementById('landlord_emailInput'));
	done(document.getElementById('tenant1_emailInput'));
	done(document.getElementById('tenant2_emailInput'));
	done(document.getElementById('tenant3_emailInput'));
}
	

function done(z){
	if (z.value != ""){
		$(z).addClass('selected');
		$(z).closest('.contractInput').children('img').hide();
		$('.xxx').show();}
	else{
		$(z).removeClass('selected')}	
}

function doneID(z){
	if (z.value.length == 9){
		$(z).addClass('selected');
		$(z).closest('.contractInput').children('img').hide();}
		
	else{
		$(z).removeClass('selected');
		z.value = ""
//		$(z).closest('.cRinline').children('img').show();
	}
}

function openP(){
	var x2 = $('#tenant2_email').is(":visible");
	if (!x2){$(tenant2_email).fadeIn();}
	else{
		$(tenant3_email).fadeIn(function(){
			$('#tenant1_email p').fadeOut()});
		}	
}

function closeP(x){	
	$("#"+x).fadeOut();
	var z = document.getElementById(x+"Input");
	z.value="";
	$('#tenant1_email p').fadeIn()
}


function idImgClick(){
//	alert();
	document.getElementById('file').click();
	//alert(frm.my_id_img.value);
//	if(frm.my_id_img.value != ""){
//		$('#idImgAlert').hide();
//		$('#idImgSuccess').fadeIn();}	 
		
	//alert(frm.my_id_img.value);
		
	$("input:file").change(function (){	
		
		$('#form2').attr('action',"personal_details.php");
		
		frm.submit();
		
		
	});
}

function imgShow(){
	$('#plus').show();
	$('.xxx').show();
	$('#IDimage').show();
	$('#miniImg img').show();
}

function ValidateEmail(x) {
	var a=0;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if (x.length==0) {
		a=1;}
		else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			 a=1;}
	if (a==1) {return false;}

return 1; }


  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65350205-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>