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
	
	/* Format end_date before calculating the extension_date */
	$contract['end_date'] = convertDateToMySqlFormat($contract['end_date']);
	
	/* Calculate and format extention_date for display */
	$extention_date = date('d/m/Y', strtotime('+1 year', strtotime($contract['end_date'])));
	
	/* Format end_date for display */
	$contract['end_date'] = convertDateToDisplayFormat($contract['end_date']);
	
	/* Format start_date for display */
	$contract['start_date'] = convertDateToDisplayFormat($contract['start_date']);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1">
<title>iAgree.co.il | אופן התשלום</title>
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
                
                <div class="dot" id="dot4"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot4"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot4"><p></p></div>
            
            </div><!--dots-->
            
            <div class="contract">
            
            	<h1>אופן התשלום</h1>
                
                <form id="form2" action="contract_creation_checkpoint.php?location=<?=urlencode('insurance_options.php')?><?=(isset($rid) ? "&rid=$rid" : "")?>" method="post"> 
                
                	<div class="rightLineBlock">
                    
                    	<div class="contractInput input48" id="fee">
                            <h3>שכירות חודשית:</h3>
                            <input id="feeInput" name="fee" class="newInput" onChange="done(this)" placeholder="לדוגמה: 1-50000" type="text" value="" onClick="helpText(1)"/>
                            <img src="img/iAgree_alert.png">
                        </div><!--fee-->
                        
                        <div class="contractInput input48" id="start_date">
                            <h3>תחילת שכירות:</h3>
                            <input id="dateStart" name="start_date" class="newInput newInputS" onChange="plusYear(this.value);done(this); done(frm.end_date);" type="text" value="" maxlength="10" onClick="helpText(2)"/>
                            <img src="img/iAgree_alert.png">
                        </div><!--cRinline-->
                                            
                    </div><!--rightLineBlock#1-->
                    
                    
                    <div class="rightLineBlock">
                    
                    	<div class="contractInput input48" id="end_date">
                            <h3>סיום שכירות:</h3>
                            <input id="dateEnd" name="end_date" class="newInput newInputS" onChange="endDate(this.value);done(this);"  type="text" value="" maxlength="10"/>
                            <img src="img/iAgree_alert.png">
                        </div><!--cRinline-->
                        
                        <div class="contractInput" id="optional_extension">
                            <h3>תקופת אופציה לשנה:</h3>
                            <select id="extensionInput" name="optional_extension" class="newInput newInputS optionGrey" onChange="$(this).css('color','rgb(255,255,255)'); ext(this);" value=""  onClick="helpText(3)">
                                
                                <option value="0"  selected="noSelect" id="noSelect">לא</option>
                                <option value="1">כן</option>
                            </select>
                            <input id="date3Input" name="extension_date" type="hidden" value="">
                            <span>עד תאריך <a id="fill"></a></span>
                            <img src="img/iAgree_alert.png">
                        </div><!--extension-->
                                            
                    </div><!--rightLineBlock#2-->
                    
                    
                    <div class="rightLineBlock" id="leumiCard">
            
                        <h3><strong>אופן התשלום:</strong></h3>
                        <!--<p>אנא הזן פרטי כרטיס אשראי</p>-->
						
                            <div class="contractInput input48" id="credit_card">
                                <h3>מספר כרטיס</h3>
                                <input id="dateStart" name="card_number" class="newInput newInputS" onChange=";done(this);" type="text" value="" maxlength="16"  onClick="helpText(4)"/>
                                <img src="img/iAgree_alert.png">
                            </div><!--cRinline-->
                            
                            <div class="contractInput cardDate" id="roomz">
                                <h3>שנה:</h3>
                                <select name="card_year" class="newInput newInputS optionGrey" id="card_year" placeholder="שנה" onChange="$('#card_year').css('color','rgb(255,255,255)'); done(this)" value="">
                                    
                                    <option value="" selected="noSelect" id="noSelect">שנה</option>
                                    
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
            
                                </select>
                                <img src="img/iAgree_alert.png">
                            </div><!--roomz-->
                
                
                            <div class="contractInput" id="roomz">
                                <h3>חודש:</h3>
                                <select name="card_month" class="newInput newInputS optionGrey" id="card_month" placeholder="חודש" onChange="$('#card_month').css('color','rgb(255,255,255)'); done(this)" value="">
                                    
                                    <option value="" selected="noSelect" id="noSelect">חודש</option>
                                    
                                    <option value="1">01</option>
                                    <option value="2">02</option>
                                    <option value="3">03</option>
                                    <option value="4">04</option>
                                    <option value="5">05</option>
                                    <option value="6">06</option>
                                    <option value="7">07</option>
                                    <option value="8">08</option>
                                    <option value="9">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
            
                                </select>
                                <img src="img/iAgree_alert.png">
                            </div><!--roomz-->
                            
                        </div><!--rightLineBlock#4-->
                        
                        
                        <div class="rightLineBlock">
						
                            <div class="contractInput" id="card_digits">
                                <h3>3 ספרות בגב הכרטיס (CVV)</h3>
                                <input id="dateStart" name="card_3digits" class="newInput newInputS" onChange=";done(this);" type="text" value="" maxlength="3"/>
                                <img src="img/iAgree_alert.png">
                            </div><!--cRinline-->
                            
                            
                            <div class="contractInput" id="leumiCardLogo">
                            <h3>powered by</h3>
                               
                            </div><!--cRinline-->
                            
                        </div><!--rightLineBlock#5-->
                    
            	</form>
            
            </div><!--contract-->
            
            
            <div class="buttons">
            
            	<div class="prev"><a href="property_remarks.php<?=(isset($rid) ? "?rid=$rid" : "")?>">הקודם</a></div>
                <div class="next"><a onClick="page5()">הבא</a></div>

            
            </div><!--buttons-->
        
        </div><!--right--
        
        --><div class="left">
        
        	<div class="notes" id="notes1">
            
            	<p>גובה השכירות החודשית המשולמת בכל חודש בעבור כל הדירה, בשקלים.</p>
            
            </div><!--notes-->
            
            
            <div class="notes" id="notes2">
            
            	<p>יום תחילת השכירות בנכס. יום זה יקבע כיום ביצוע התשלום בכל חודש. (במידה ונבחר יום בחודש הגדול מ-28 – יקובע יום התשלום כ-28 לחודש).</p>
            
            </div><!--notes-->
            
            
            
            <div class="notes" id="notes3">
            
            	<p>במידה והינך מעוניין לאפשר הארכת החוזה בשנה נוספתת סמן בשדה זה "כן".</p>
            
            </div><!--notes-->
            
            
            
            <div class="notes" id="notes4">
            
            	<p>פרטי אשראי לקבלת שכר הדירה</p>
            
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
<link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui.structure.min.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">

<script>

/*
$(document).ready(function (){
	$("input").click(function (){
//			var thisId = $(this).get(id);
		alert($(this).attr('id'));
		$('html, body').animate({
			scrollTop: ($(this).attr('id')).offset().top
		}, 1000);
	});
});*/


function helpText(x){
	$('.notes').hide();
	$('#notes'+x).show( "scale", {percent: 50, origin: "center"}, 500 );

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
	$('.cRightLine img').css('display','none');
	$('#dateStart').datepicker({dateFormat: "dd/mm/yy"});
	$('#dateEnd').datepicker({dateFormat: "dd/mm/yy"});
//	$('.secText').hide();
	
	fontSize();
	start();
	user();
	
	$('.notes').hide();
})		

	
/*****************************************************************
*    						page5()	    					 *
*****************************************************************/

function page5(){
	
	var a=0;
	$('.contractInput img').css('display','none');
	
	$('.helpText').css('opacity','0');
	
	if (frm.optional_extension.value.length == 0) {
		frm.optional_extension.focus();
		$('#optional_extension img').fadeIn();
		a=1;}
	
	if (frm.end_date.value.length == 0) {
		frm.end_date.focus();
		$('#end_date img').fadeIn();
		a=1;}
		
	if (frm.start_date.value.length == 0) {
		frm.start_date.focus();
		$('#start_date img').fadeIn();
		a=1;}
		
/*	if (frm.billing_day.value.length == 0) {
		frm.billing_day.focus();
		$('#payment img').fadeIn();
		a=1;}	*/
		
	if (frm.fee.value.length == 0) {
		frm.fee.focus();
		$('#fee img').fadeIn();
		a=1;}
		
/*	if (frm.collaterals.value.length == 0) {
		frm.collaterals.focus();
		$('#collaterals img').fadeIn();
		a=1;}	*/
		
	if (a==1) {
		$('.helpText').css('opacity','1')
		reutrn(0);}

	frm.submit(); }
	

	
function start(){

	frm.fee.value = "<?=$contract['fee']?>";
//	frm.billing_day.value = "<?=$contract['billing_day']?>";
	frm.start_date.value = "<?=$contract['start_date']?>";
	frm.end_date.value = "<?=$contract['end_date']?>";
//	frm.extension_date.value = "<?=$contract['extension_date']?>";
	frm.optional_extension.value = "<?=$contract['optional_extension']?>";
//	frm.collaterals.value = "<?=isset($contract['collaterals']) ? $contract['collaterals'] : -1?>";
	
//	alert (frm.end_date.value);
	
	if (frm.end_date.value != ""){
		endDate("<?=$contract['end_date']?>");}
	
//	selectCollaterals(frm.collaterals.value);

	done(document.getElementById('feeInput'));
//	done(document.getElementById('paymentInput'));
	done(document.getElementById('dateStart'));
	done(document.getElementById('dateEnd'));
	ext(document.getElementById('extensionInput'));
}



function done(z){
	if (z.value != ""){
		$(z).addClass('selected');
		$(z).closest('.contractInput').children('img').hide();}
	else{
		$(z).removeClass('selected')}
		
}

function ext(z){

	if (z.value == 1){
		$(z).addClass('selected');
		done(z);
		$('#optional_extension span').fadeIn();
	
	}else{
		$('#optional_extension span').hide();
		done(z);}
			
}

function selectCollaterals(x){
	if(x <= 0) {
		return;
	}
	
	$('.sec').removeClass('selected');
	$('#sec'+x).addClass('selected');
	
	frm.collaterals.value = x;

	$('.secText').fadeIn();
	$('.secText p').hide();
	$('#secText'+x).show();
}

function plusYear(x){
	
	var dd = x.charAt(0)+x.charAt(1);
	var mm = x.charAt(3)+x.charAt(4);
	var yyyy = x.charAt(6)+x.charAt(7)+x.charAt(8)+x.charAt(9);

	var endDate = new Date(mm+'/'+dd+'/'+yyyy);
	var extDate = new Date(mm+'/'+dd+'/'+yyyy);
	
//	alert(temp);
	endDate.setFullYear(endDate.getFullYear()+1)
	extDate.setFullYear(extDate.getFullYear()+2);
	endDate.setDate(endDate.getDate()-1);
	extDate.setDate(extDate.getDate()-1);
	
	frm.end_date.value = $.datepicker.formatDate('dd/mm/yy', endDate);
	frm.extension_date.value = $.datepicker.formatDate('dd/mm/yy', extDate);
	document.getElementById('fill').innerHTML =  frm.extension_date.value;
	
}

function endDate(x){
	
	var dd = x.charAt(0)+x.charAt(1);
	var mm = x.charAt(3)+x.charAt(4);
	var yyyy = x.charAt(6)+x.charAt(7)+x.charAt(8)+x.charAt(9);


	var extDate = new Date(mm+'/'+dd+'/'+yyyy);
	
//	alert(myDate);
	
//	frm.end_date.value = $.datepicker.formatDate('dd/mm/yy', myDate);
	
	extDate.setFullYear(extDate.getFullYear()+1);
	extDate.setDate(extDate.getDate());

	
	frm.extension_date.value = $.datepicker.formatDate('dd/mm/yy', extDate);
	document.getElementById('fill').innerHTML =  frm.extension_date.value;	

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