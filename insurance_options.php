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
<title>iAgree.co.il | בחר מסלול</title>
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
                
                <div class="dot" id="dot4"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot4"><p></p></div>
            
            </div><!--dots-->
            
            <div class="contract">
            
            	<h1>בחר מסלול</h1>
                
                <form id="form2" action="contract_creation_checkpoint.php?location=<?=urlencode('securities_selection.php')?><?=(isset($rid) ? "&rid=$rid" : "")?>" method="post"> 
                
                	<div class="rightLineBlock" id="insuranceOption">
                    
                    	<div class="contractInput insuranceOption">
                        
                        	<div class="ioContainer"  id="io1" onClick="selectOption(1);">                            
                            
                            <div class="ioTitle">
                            
                            	<h3>SILVER</h3>                       
                            	<p class="pBold">__ ₪ / לחודש</p>
                            
                            </div><!--ioTitle-->
                            
                            <div class="ioBox">
                            
                            	<p>1 חוזים לשנה<br><br></p>
                            	<p>חתימת חוזה שכירות אינטרנטי מאושר ע"י עו"ד</p>
                                <p>תשלום שכר-דירה באמצעות כרטיס אשראי</p>
                                
                                                            
                            </div><!--ioTitle-->
                            
                            </div><!--ioContainer-->
                            
                        </div><!--io0-->
                        

                    
                    	<div class="contractInput insuranceOption">
                            
                            <div class="ioContainer"  id="io2" onClick="selectOption(2);">                           
                            
                            <div class="ioTitle">
                            	<h3>GOLD</h3>
                            	<p class="pBold">__ ₪ / לחודש</p>
                                
                            </div><!--ioTitle-->
                            
                            <div class="ioBox">
                            
                            	<p>ללא הגבלת כמות חוזים לשנה</p>
                                <p>חתימת חוזה שכירות אינטרנטי מאושר ע"י עו"ד
</p>
                                <p>תשלום שכר-דירה באמצעות כרטיס אשראי</p>
                                <p>אבטחת תשלומי שכר-דירה</p>
                                
                                

                            
                            </div><!--ioTitle-->
                            
                            </div><!--ioContainer-->
                            
                        </div><!--io1-->
                        
                    
                    	<div class="contractInput insuranceOption">
                        
                        	<div class="ioContainer"  id="io3" onClick="selectOption(3);">                            
                            
                            <div class="ioTitle">
                            	<h3>PLATINUM</h3>
                            	<p class="pBold">__ ₪ / לחודש</p>
                            
                            </div><!--ioTitle-->
                            
                            <div class="ioBox">
                            
                            	<p>ללא הגבלת כמות חוזים לשנה</p>
                                <p>חתימת חוזה שכירות אינטרנטי מאושר ע"י עו"ד
</p>
                                <p>תשלום שכר-דירה באמצעות כרטיס אשראי</p>
                                <p>אבטחת תשלומי שכר-דירה</p>
                                <p>בניית פרופיל סיכון ורקע על השוכרים
</p>
                                
                            
                            </div><!--ioTitle-->
                            
                            </div><!--ioContainer-->
                            
                        </div><!--insuranceOption-->
                                            
                    </div><!--rightLineBlock#1-->
                    
                    <input name="insurance_option" type="hidden" value=""/>
                    
                        
            	</form>
            
            </div><!--contract-->
            
            
            <div class="buttons">
            
            	<div class="prev"><a href="property_remarks.php<?=(isset($rid) ? "?rid=$rid" : "")?>">הקודם</a></div>
                <div class="next"><a onClick="checkForm()">הבא</a></div>

            
            </div><!--buttons-->
        
        </div><!--right--
        
        --><div class="left">
        
        	<div class="notes">
            

            	<pלפניך 3 מסלולים שונים.</p>
                <p>אנא בחר את המסלול הרצוי.</p>
                <p>פירוט על ההבדלים בין המסלולים מצוין על גבי כל מסלול.</p>
            
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
	fontSize();
	user();
	
//	alert();
	
	$('.ioBox img').show();
	
	if ('<?=isset($contract['insurance_option'])?>'){
		
		selectOption('<?=$contract['insurance_option']?>');
	}
})		

	
/*****************************************************************
*						Insurance Option	    				 *
*****************************************************************/

function selectOption(x){

	$('.ioContainer').css('opacity','0.2');
	$('#io'+x).css('opacity','1');

	frm.insurance_option.value=x;
	
	

}

function checkForm(){
	if (frm.insurance_option.value != ''){
		frm.submit()
	}
	else{
		$('.insuranceOption').css('border','1px solid red');
	}
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