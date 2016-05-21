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

?>
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1">
<title>iAgree.co.il | תיאור הנכס</title>
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
                
                <div class="dot" id="dot3"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot4"><p></p></div>
				
				<div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot4"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot4"><p></p></div>
            
            </div><!--dots-->
            
            <div class="contract">
            
            	<h1>ספר לנו על הדירה</h1>
                
                <form id="form2" action="contract_creation_checkpoint.php?location=<?=urlencode('payment_and_securities.php')?><?=(isset($rid) ? "&rid=$rid" : "")?>" method="post"> 
                
                	<div class="rightLineBlock">
                    
                    	<div class="contractInput" id="animals">
                            <h3>בעלי חיים:</h3>
                            <input name="animals" type="hidden" value="0"/>
                            <img class="animals" id='yesPet' src="img/iAgree_pet.png" onClick="animalsToggle()">
							<img class="animals" id='noPet' src="img/iAgree_noPet.png" onClick="animalsToggle()">
                        </div><!--animals-->
                                            
                    </div><!--rightLineBlock#1-->
                    
                    
                    <div class="rightLineBlock">
                    
                    	<div class="contractInput textInput" id="faults1">
                            <h3>ליקויים בדירה שיתוקנו תוך 14 יום מתחילת החוזה:</h3>
                <textarea id="repairsTxt" name="repairs" class="newInput" onChange="doneText(this)" rows="5" maxlength="306"></textarea>
                        </div><!--faults1-->
                        
                   	</div><!--rightLineBlock#2-->
                    
                    
                    <div class="rightLineBlock">
                    
                    	<div class="contractInput textInput" id="faults2">
                            <h3>ליקויים קיימים בדירה:</h3>
                            <textarea id="defectsTxt" name="defects" class="newInput" placeholder="ליקויים שלא יתוקנו" onChange="doneText(this)" rows="5" maxlength="306"></textarea>
                                            
                    	</div><!--faults2-->
                    
                    </div><!--rightLineBlock#3-->
                                    
            	</form>
            
            </div><!--contract-->
            
            
            <div class="buttons">
            
            	<div class="prev"><a href="property_description.php<?=(isset($rid) ? "?rid=$rid" : "")?>">הקודם</a></div>
                <div class="next"><a onClick="page4()">הבא</a></div>

            
            </div><!--buttons-->
        
        </div><!--right--
        
        --><div class="left">
        
        	<div class="notes">
            
            	<p>בע"ח - בחר במידה ומוסכם<span> כי ניתן להכניס 
חיות מחמד לדירה</span>.</p>
                <p>ליקויים הינם תקלות/ מפגעים הקיימים בדירה
אותם נכון לציין בחוזה לאחר הסיור בדירה.<br>יש להפריד בין ליקויים אותם הסכמתם לתקן לבין ליקויים שמוסכם כי יישארו בדירה.</p>
            
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
	start();
	user();
})
	

function page4(){
	
	var a=0;
		
	if (a==1) {
		$('.helpText').css('opacity','1')
		reutrn(0);}
	
	frm.submit(); 
}

function updateAnimalsButton() {
	if(frm.animals.value == 1) {
		$('#yesPet').addClass('animalsColor');
		$('#noPet').removeClass('animalsColor');
	} else {
		$('#yesPet').removeClass('animalsColor');
		$('#noPet').addClass('animalsColor');
	}
}
	
function start(){
	frm.animals.value = <?=(isset($contract['animals']) ? $contract['animals'] : 1)?>;
	frm.repairs.value = "<?=str_replace('"',  '\"', $contract['repairs'])?>";
	frm.defects.value  = "<?=str_replace('"',  '\"', $contract['defects'])?>";

	updateAnimalsButton();
	
	done(document.getElementById('repairsTxt'));
	done(document.getElementById('defectsTxt'));
}

function animalsToggle() {
	var x = frm.animals.value;
	x++;
	x = x % 2;
	frm.animals.value = x;
	updateAnimalsButton();
}


	

function done(z){
	
	if (z.value != ""){
		$(z).addClass('selected');
		$(z).closest('.contractInput').children('img').hide();}
	else{
		$(z).removeClass('selected')}
		
	
}

function doneText(z){
	
	if (z.value != ""){
		$(z).addClass('selected');
		$(z).closest('.contractInput').children('img').hide();}
	else{
		$(z).removeClass('selected')
		z.value = "ללא"}
		
	
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