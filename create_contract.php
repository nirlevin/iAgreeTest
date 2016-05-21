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
<title>iAgree.co.il | צור חוזה</title>
<link href="style2.css" rel="stylesheet" type="text/css">
<!-- Tablet -->
<link href="mobile2.css" rel="stylesheet" type="text/css" media="only screen and (min-width:0px) and (max-width:768px)">
<!-- Desktop -->
<link href="style2.css" rel="stylesheet" type="text/css" media="only screen and (min-width:769px)">

</head>

<body oncontextmenu="return false;">

<section id="section1">

	<?php include 'nav.php';?>

</section><!--

--><section id="section2"><!--

	--><div class="wrapper"><!--
    
    	--><div class="right">
        
        	<div class="dots">
            
            	<div class="dot" id="dotFull"><p></p></div>
            
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot1"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot2"><p></p></div>
			
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
            
            	<h1>ליצור חוזה בדרך פשוטה, נעימה והוגנת</h1>
                
                <form id="form2" action="contract_creation_checkpoint.php?location=<?=urlencode('property_description.php')?><?=(isset($rid) ? "&rid=$rid" : "")?>" method="post"> 
                
                	<div class="rightLineBlock" id="startPage">
                                	
                        <a class="unSelected" id='landlord' onClick="page2('landlord')">משכיר<br><span>(בעל הדירה)</span></a>
            		<a class="unSelected" id="tenant" onClick="page2('tenant')">שוכר<br><span>(הדייר)</span></a>
                    
                    <input name="role" type="hidden" value="">
                                            
                    </div><!--rightLineBlock#1-->
                    
            	</form>
            
            </div><!--contract-->
            
            
            <div class="buttons">
            

            
            </div><!--buttons-->
        
        </div><!--right--
        
        --><div class="left">
        
        	<div class="notes">
            
            	<p>זהו השלב הראשון ביצירת החוזה.
משלב זה אתה תוגדר כיוצר החוזה.</p>
                <p>חשוב לזכור! כל הצדדים בחוזה יכולים
להעיר הערות על החוזה,<br>אך רק אתה (יוצר החוזה) יכול לשנותו.</p>
            
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
	var owner = "<?=isset($contract['role']) ? ($contract['role'] == 'landlord' ? 'landlord' : 'tenant') : ''?>";
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
	autoComplete(owner);
	user();
})		

	
/*****************************************************************
*    					  Step1 Function   						 *
*****************************************************************/

function autoComplete(x){
	
//	alert(x);

	$('.unSelected').removeClass('selected');
	
	if (x=='landlord'){
		$('#landlord').addClass('selected');
		$('.helpText').css('opacity','0');
		owner = 'landlord'};
	if (x=='tenant'){$('#tenant').addClass('selected');
		$('.helpText').css('opacity','0');
		owner = 'tenant'};
		
 	frm.role.value = owner;
//	alert(frm.role.value);
		
		
}

	
/*****************************************************************
*    					  Step1 Function   						 *
*****************************************************************/

function page2(x){
	autoComplete(x);
	
//	alert(frm.role.value);
	frm.submit();
}



</script>

<script>


  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65350205-1', 'auto');
  ga('send', 'pageview');
  


</script>


</body>
</html>