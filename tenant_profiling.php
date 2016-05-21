<?php

	session_start();
	
	include("services.php");
	
	$rid = basicParse($_GET['rid']);
	$tenantEmail = basicParse($_GET['tenantEmail']);
	$contractId = getContractIdByRandomId($rid);
	
	$tenant = getUserByEmail($tenantEmail);
	$party = getPartyByEmailAndContractId($tenantEmail, $contractId); 
	

	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1">
<title>iAgree.co.il | פורפיל שוכרים</title>
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
    
    	--><div class="right" id="dashboardPanel">
		
		<? if($party['screening_approved']==1){
		?>
		
			<a id="approveButton" href="my_contracts.php">אישרת את השוכר</a>
			
		<?}elseif($party['screening_approved']==(-1)){
		?>
        
			<a id="rejectButton" href="my_contracts.php">שוכר לא אושר על ידך</a>
            
		<?}else{
		?>
			
        	<a id="approveButton" href="tenant_approved.php?contractId=<?=$contractId?>&tenantEmail=<?=$tenantEmail?>&approved=1">אשר את השוכר</a>
            <a id="rejectButton" href="tenant_approved.php?contractId=<?=$contractId?>&tenantEmail=<?=$tenantEmail?>&approved='-1'">סמן שוכר כלא מאושר</a>
        
		<?}
		?>
			
			
        	<h1>יצירת פרופיל שוכר</h1>
            
            <div class="dashboardTenant">	 
            
            	<h2>שם השוכר: <span><?=$tenant['first_name']." ".$tenant['last_name']?> | ת"ז: <?=$tenant['identity_number']?></span></h2>                
                
                
                <div class="dashboard firstRow">
                
                    <div class="dashboardCell" id="dashboardCell1">
                        
                        <div class="upperCell"><div class="upperCellTable">
                            
                            <img class="imgLoading loadingUpper" src="imgLeumiCard/loading4.gif">
                            
                            <div class="mutualFriend" id="stars">
							
								<p>(4 חוות דעת)</p>
                            
                                <img src="imgLeumiCard/blue_star.png">
                                <img src="imgLeumiCard/blue_star.png">
                                <img src="imgLeumiCard/blue_star.png">
                                <img src="imgLeumiCard/blue_star.png">
                                <img class="shade" src="imgLeumiCard/grey_star.png">
                            
                            </div>
                            
                        </div><!--upperCellTable--></div><!--upperCell-->
                        
                        <div class="lowerCell">
                        
                            <h3>דירוג משכירים קודמים</h3>
                            
                        </div><!--upperCell-->   		
                    
                    </div><!--dashboardCell-->
                    
                    
                    <div class="dashboardCell" id="dashboardCell2">
                        
                        <div class="upperCell"><div class="upperCellTable">
                            
                            <img class="imgLoading loadingUpper" src="imgLeumiCard/loading4.gif">
                            
                            <div class="mutualFriend" id="stars">
                            
                                <img src="imgLeumiCard/blue_star.png">
								<img src="imgLeumiCard/blue_star.png">
								<img src="imgLeumiCard/blue_star.png">
								<img src="imgLeumiCard/blue_star.png">
								<img src="imgLeumiCard/blue_star.png">
                            
                            </div>
                            
                        </div><!--upperCellTable--></div><!--upperCell-->
                        
                        <div class="lowerCell">
                        
                            <h3>היסטוריית תשלומים</h3>
                            
                        </div><!--upperCell-->   		
                    
                    </div><!--dashboardCell-->
                    
                    
                    <div class="dashboardCell" id="dashboardCell3">
                        
                        <div class="upperCell"><div class="upperCellTable">
                        
                            <img class="imgLoading loadingUpper" src="imgLeumiCard/loading4.gif">
                            
                             <div class="mutualFriends" id="mutualFriends1">
                            
                            <div class="mutualFriends mfOver" onMouseOut="$('#mutualFriends1').fadeOut();"></div>
                            
                               <h2>3 חברים משותפים</h2>
                                
                                <div class="mutualFriend">
                                
                                    <img src="imgLeumiCard/linkedin.png">
                                    <img class="socialMediaImg" src="imgLeumiCard/in_prorile.jpg">
                                    <p>Amit Erez</p>
                                
                                </div><!--mutualFriend-->
                                
                                <div class="mutualFriend">
                                
                                    <img src="imgLeumiCard/fb.png">
                                    <img class="socialMediaImg" src="imgLeumiCard/fb_profile1.jpg">
                                    <p>Noa Shalev</p>
                                
                                </div><!--mutualFriend-->
                                
                                <div class="mutualFriend">
                                
                                    <img src="imgLeumiCard/fb.png">
                                    <img class="socialMediaImg" src="imgLeumiCard/fb_profile2.jpg">
                                    <p>Noam Weiss</p>
                                
                                </div><!--mutualFriend-->
                            
                            </div><!--mutualFriends-->
                        
                            <p onMouseOver="$('#mutualFriends1').fadeIn();">3</p>
                            
                         <!--   <p>3</p>	-->
                            
                        </div><!--upperCellTable--></div><!--upperCell-->
                        
                        <div class="lowerCell">
                        
                            <h3>רשתות חברתיות</h3>
                            
                        </div><!--upperCell-->   		
                    
                    </div><!--dashboardCell-->
                    
                
                </div><!--dashboard-->
				
				
				
				<div class="dashboard secondRow">
                
                    <div class="dashboardCell" id="dashboardCell4">
                        
                        <div class="upperCell"><div class="upperCellTable">
                            
                            <img class="imgLoading" src="imgLeumiCard/loading4.gif">
                            
                            <img class="imgGrey" src="imgLeumiCard/tom_id_grey.png">
                            <img class="imgBlue" src="imgLeumiCard/tom_id_blue.png">
                            
                            
                        </div><!--upperCellTable--></div><!--upperCell-->
                        
                        <div class="lowerCell">
                        
                            <h3>אימות ת"ז</h3>
                            
                        </div><!--upperCell-->   		
                    
                    </div><!--dashboardCell-->
                    
                    
                    <div class="dashboardCell" id="dashboardCell5">
                        
                        <div class="upperCell"><div class="upperCellTable">
                            <img class="imgLoading" src="imgLeumiCard/loading4.gif">
                            
                            <img class="imgGrey" src="imgLeumiCard/tom_bank_grey.png">
                            <img class="imgBlue" src="imgLeumiCard/tom_bank_blue.png">
                            
                            
                        </div><!--upperCellTable--></div><!--upperCell-->
                        
                        <div class="lowerCell">
                        
                            <h3>חשבונות מוגבלים</h3>
                            
                        </div><!--upperCell-->   		
                    
                    </div><!--dashboardCell-->
                    
                    
                    <div class="dashboardCell" id="dashboardCell6">
                        
                        <div class="upperCell"><div class="upperCellTable">
                            
                           <img class="imgLoading" src="imgLeumiCard/loading4.gif">
                            
                            <img class="imgGrey" src="imgLeumiCard/tom_credit_grey.png">
                            <img class="imgBlue" src="imgLeumiCard/tom_credit_blue.png">
                            
                        </div><!--upperCellTable--></div><!--upperCell-->
                        
                        <div class="lowerCell">
                        
                            <h3>היסטוריית אשראי</h3>
                            
                        </div><!--upperCell-->   		
                    
                    </div><!--dashboardCell-->
                    
                    
                    <div class="dashboardCell" id="dashboardCell7">
                        
                        <div class="upperCell"><div class="upperCellTable">
                            
                            <img class="imgLoading" src="imgLeumiCard/loading4.gif">
                            
                            <img class="imgGrey" src="imgLeumiCard/tom_court_grey.png">
                            <img class="imgBlue" src="imgLeumiCard/tom_court_blue.png">
                            
                        </div><!--upperCellTable--></div><!--upperCell-->
                        
                        <div class="lowerCell">
                        
                            <h3>בתי משפט</h3>
                            
                        </div><!--upperCell-->   		
                    
                    </div><!--dashboardCell-->
                    
                    
                    <div class="dashboardCell" id="dashboardCell8">
                        
                        <div class="upperCell"><div class="upperCellTable">
                           
                            <a href="#"><img src="imgLeumiCard/coins16.png">תלוש שכר</a><br>
                            
                            <a href="#"><img src="imgLeumiCard/graduate16.png">השכלה אקדמאית</a>
                           
<!--                            
                            <a href="#"><img src="imgLeumiCard/money_gey.png"></a><br>
                            
                            <a href="#"><img src="imgLeumiCard/edu_grey.png""></a>
-->                            
                            
                        </div><!--upperCellTable--></div><!--upperCell-->
                        
                        <div class="lowerCell">
                        
                            <h3></h3>
                            
                        </div><!--upperCell-->   		
                    
                    </div><!--dashboardCell-->
                    
                
                </div><!--dashboard-->
				
                
            </div><!--tenantDashboard-->
            
        
        </div><!--right--
        
        --><div class="left">
        
        	<div class="notes">
            
            	<h2>פרופיל השוכר והרקע המוצג בעמוד זה נקבעים עפ"י 3 קריטריונים:</h2>
                
                <h3>1. היסטוריית נתוני אשראי</h3>
                <p>בנק ישראל</p>
                <p>כונס הנכסים</p>
                <p>הוצאה לפועל</p>
                <p>חשבון בנק</p>
                
                <h3>2. דירוג ע"י משכירים </h3>
                <p>חוות דעת של משכירים מאומתים קודמים</p>
                
                <h3>3. בניית פרופיל עצמי</h3>
                <p>סקירה של פרופיל ברשתות החברתיות ובדיקת חברים           משותפים.</p>
                <p>אופציה להעלאת מסמכים כגון: תלוש משכורת, תעודות אקדמאיות וכו'.</p>
            
            </div><!--notes-->
        
        </div><!--left-->
    
    </div><!--wrapper-->

</section><!--section2-->

<section id="section3">

	<?php include 'footer.php';?>
    
</section>


<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>

<script>

function dashboard(a,b){
	
	//canvas initialization
	var canvas = document.getElementById("canvas"+a);

	var ctx = canvas.getContext("2d");	
	
	
	//dimensions
	var W = 300;
	var H = 150;

	//Variables
	var degrees = 0;
	var new_degrees = 0;
	var difference = 0;
	var color = "rgba(0,175,240,0.7)"; //green looks better to me
	var bgcolor = "rgba(180,180,180,0.5)";
	var text;
	var animation_loop, redraw_loop;


	function init(){
		
		//Clear the canvas everytime a chart is drawn
		ctx.clearRect(0, 0, W, H);
		
		
		//Background 360 degree arc
		ctx.beginPath();
		
		ctx.strokeStyle = bgcolor;
		
		ctx.lineWidth = 10;
		
		ctx.arc(W/2, H/2, 70, 0, Math.PI*2, false); //you can see the arc now
		
		ctx.stroke();
		
		
		//gauge will be a simple arc
		//Angle in radians = angle in degrees * PI / 180
		var radians = degrees * Math.PI / 180;
		ctx.beginPath();
		
		ctx.strokeStyle = color;
		
		ctx.lineWidth = 10;
		
		//The arc starts from the rightmost end. If we deduct 90 degrees from the angles
		//the arc will start from the topmost end
		ctx.arc(W/2, H/2, 70, 0 - 270*Math.PI/180, radians - 270*Math.PI/180, false);
		 
		//you can see the arc now
		ctx.stroke();
		
		//Lets add the text
		ctx.fillStyle = color;
		
		ctx.font = "4em bebas";
		
		text = Math.floor(degrees/360*100) + "%";
		
		//Lets center the text
		//deducting half of text width from position x
		text_width = ctx.measureText(text).width;
		
		//adding manual value to position y since the height of the text cannot
		//be measured easily. There are hacks but we will keep it manual for now.
		ctx.fillText(text, W/2+40, H/2 + 15);
	}

	function draw()
	{
		//Cancel any movement animation if a new chart is requested
		if(typeof animation_loop != undefined) clearInterval(animation_loop);
		
		//random degree from 0 to 360
//		new_degrees = Math.round(Math.random()*360);

		new_degrees = Math.round(b);

		difference = new_degrees - degrees;
		//This will animate the gauge to new positions
		//The animation will take 1 second
		//time for each frame is 1sec / difference in degrees
		animation_loop = setInterval(animate_to, 1000/difference);
	}
	
	//function to make the chart move to new degrees
	function animate_to()
	{
		//clear animation loop if degrees reaches to new_degrees
		if(degrees == new_degrees) 
			clearInterval(animation_loop);
		
		if(degrees < new_degrees)
			degrees++;
		else
			degrees--;
			
		init();
	}
	
	//Lets add some animation for fun
	draw();
//	redraw_loop = setInterval(draw, 2000); //Draw a new chart every 2 seconds

}





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
//	
//	$('#dashboardCell1 #stars').show();
//	$('#dashboardCell1 #stars p').show();
	
	fontSize();
//	autoComplete(owner);
	user();

//	alert();
	
//	dashboard(1,307);
//	dashboard(2,91);
//	dashboard(3,181);
//	dashboard(4,1);
//	dashboard(5,1);
//	dashboard(6,1);
	
//	$('.checkedMark').hide();
	
	tenant1();
	
});



function tenant1(){

//	alert();
	
	setTimeout(function(){checkMark(1)},1600);
	setTimeout(function(){checkMark(4)},1800);
	setTimeout(function(){checkMark(2)},2000);
	setTimeout(function(){checkMark(8)},2200);
	setTimeout(function(){checkMark(7)},2400);
	setTimeout(function(){checkMark(3)},2600);
	setTimeout(function(){checkMark(5)},2800);
	setTimeout(function(){checkMark(6)},1500);
	
	setTimeout(function(){
		$('#dashboardCell8 a').show();
		$('#dashboardCell8 .upperCellTable').css('text-align','right')},1800);
	setTimeout(function(){$('#dashboardCell1 #stars').show()},1600);
	setTimeout(function(){$('#dashboardCell1 #stars p').show()},1600);
	setTimeout(function(){$('#dashboardCell2 #stars').show()},2000);
	setTimeout(function(){$('#dashboardCell3 p').show()},2600);

	
	
	setTimeout(function(){checkMark(9)},1600);
	setTimeout(function(){checkMark(15)},1800);
	setTimeout(function(){checkMark(11)},2000);
	setTimeout(function(){checkMark(10)},2200);
	setTimeout(function(){checkMark(16)},2400);
	setTimeout(function(){checkMark(13)},2600);
	setTimeout(function(){checkMark(12)},2800);
	setTimeout(function(){checkMark(14)},1500);
	
	setTimeout(function(){
		$('#dashboardCell8 a').show();
		$('#dashboardCell8 .upperCellTable').css('text-align','right')},1800);
	setTimeout(function(){$('#dashboardCell9 #stars').show()},1600);
	setTimeout(function(){$('#dashboardCell9 #stars p').show()},1600);
	setTimeout(function(){$('#dashboardCell10 #stars').show()},2000);
	setTimeout(function(){$('#dashboardCell11 p').show()},2600);	

	setTimeout(function(){$('.imgLoading').hide()},3000);

}

function checkMark(x){

	$('#dashboardCell' + x +' .imgLoading').hide();
	$('#dashboardCell' + x +' .imgGrey').hide();
	$('#dashboardCell' + x +' .imgBlue').show();
	
	
}

	
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