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
<title>iAgree.co.il | בטחונות וערבויות</title>
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
                
                <div class="dot" id="dotFull"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dotFull"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot4"><p></p></div>
            
            </div><!--dots-->
            
            <div class="contract">
            
            	<h1>בטחונות וערבויות</h1>
                
                <form id="form2" action="contract_creation_checkpoint.php?location=<?=urlencode('personal_details.php')?><?=(isset($rid) ? "&rid=$rid" : "")?>" method="post">
                    
                    
                    <div class="rightLineBlock" id="collaterals">
						
                        <div class="secContainer" id="secContainer">
                        
                            <?php
							
								if ($contract['insurance_option']!=1){
									
									$collateralsDb = 'collaterals_p';}
									
								else{
									
									$collateralsDb = 'collaterals';
								}
								
								$collateralsOptions = getCollateralsOptions($collateralsDb);
                                foreach($collateralsOptions as $collaterals) {
                            ?>
                
                                    <div class="sec" id="sec<?=$collaterals['id']?>" onClick="selectCollaterals(<?=$collaterals['id']?>)">
                                        <p><?=$collaterals['title']?></p>
                                        
                                        <p class="secText" id="secText<?=$collaterals['id']?>"><?=$collaterals['description']?></p>
                                    </div>
                            
                            <?php
                                }
                            ?>
                    
                        </div><!--secContainer-->
                    
                    <input id="securitiesInput" name="collaterals" type="hidden" value="">
                                        
                    </div><!--rightLineBlock#4-->
                
            	</form>
            
            </div><!--contract-->
            
            
            <div class="buttons">
            
            	<div class="prev"><a href="insurance_options.php<?=(isset($rid) ? "?rid=$rid" : "")?>">הקודם</a></div>
                <div class="next"><a onClick="page5()">הבא</a></div>

            
            </div><!--buttons-->
        
        </div><!--right--
        
        --><div class="left">
        
        	<div class="notes">
            
            	<p>בהמשך לאבטחת תשלום שכר הדירה אתה נדרש לבחור בטחונות עבור מקרים נוספים כגון: נזק לדירה או חובות לרשויות מקומיות. יש לבחור את תמהיל הבטחונות המתאים.</p>
                <p>למידע נוסף<span> בנושא ביטחונות</span> <a target="_blank" href="securities.php">לחץ כאן</a></p>
            
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
//	$('#dateStart').datepicker({dateFormat: "dd/mm/yy"});
//	$('#dateEnd').datepicker({dateFormat: "dd/mm/yy"});
//	$('.secText').hide();
		
	
	
	fontSize();
	start();
	user();
	
//	alert('<?=$contract['collaterals']?>');
	
	
	if('<?=isset($contract['collaterals'])?>'){
		
		selectCollaterals("<?=$contract['collaterals']?>");
	
	}else{
		
		selectCollaterals(3);
	}
})		

	
/*****************************************************************
*    						page5()	    					 *
*****************************************************************/

function page5(){
	
	var a=0;
	$('.sec').css('border-color','rgba(0,175,240,0.5)');
	
	$('.helpText').css('opacity','0');
			
	if (frm.collaterals.value.length == 0) {
		frm.collaterals.focus();
		$('.sec').css('border-color','red');
		a=1;}
		
	if (a==1) {
		$('.helpText').css('opacity','1')
		reutrn(0);}

	frm.submit(); }
	

	
function start(){

//	frm.fee.value = "<?=$contract['fee']?>";
//	frm.billing_day.value = "<?=$contract['billing_day']?>";
//	frm.start_date.value = "<?=$contract['start_date']?>";
//	frm.end_date.value = "<?=$contract['end_date']?>";
//	frm.extension_date.value = "<?=$contract['extension_date']?>";
//	frm.optional_extension.value = "<?=$contract['optional_extension']?>";
//	frm.collaterals.value = "<?=isset($contract['collaterals']) ? $contract['collaterals'] : -1?>";
	
//	alert (frm.end_date.value);
	
//	if (frm.end_date.value != ""){
//		endDate("<?=$contract['end_date']?>");}
	
//	selectCollaterals(frm.collaterals.value);

//	done(document.getElementById('feeInput'));
//	done(document.getElementById('paymentInput'));
//	done(document.getElementById('dateStart'));
//	done(document.getElementById('dateEnd'));
//	ext(document.getElementById('extensionInput'));
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