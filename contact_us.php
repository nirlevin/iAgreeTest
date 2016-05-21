<?php
    session_start();
	
    if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
    } 
?><!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1">
<title>iAgree.co.il | צור קשר</title>
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

	<div class="wrapper" id="contactUs">
    
    	<div class="right">
            
            <div class="contract">
            
            	<h1>צור קשר</h1>
                
                <form id="form2" action="thank_you.php" method="post"> 
                
                	<div class="rightLineBlock">
                    
                    	<div class="contractInput input48" id="name">
                            <h3>שם:</h3>
                            <input name="name" class="newInput newInputM" onChange="done(this)" type="text" value=""/>
                            <img src="img/iAgree_alert.png">
                            
                        </div><!--name-->
                                            
                    </div><!--rightLineBlock#1-->
                    
                    
                    <div class="rightLineBlock">
                    
                    	<div class="contractInput input48" id="email">
                            <h3>דוא"ל:</h3>
                            <input name="email" class="newInput newInputM" onChange="done(this)"  placeholder="לדוגמה: israel@iAgree.co.il" type="text" value=""/>
                            <img src="img/iAgree_alert.png">
                            
                        </div><!--email-->
                                            
                    </div><!--rightLineBlock#2-->
                    
                    
                    <div class="rightLineBlock">
                    
                    	<div class="contractInput textInput" id="comments">
                        
                            <h3>הודעה:</h3>
                            <textarea name="comments" class="newInput newInputL" onChange="done(this)" rows="5" maxlength="306"></textarea>
                            <img src="img/iAgree_alert.png">
                            
                        </div><!--comments-->
                                            
                    </div><!--rightLineBlock#3-->
                    
                    
                    <div class="rightLineBlock">
                                        
                            <div class="contactSubimt">
                                <p onClick="thankYou()">שלח</p>
                            </div><!--contactSubimt-->
                                                                    
                    </div><!--rightLineBlock#4-->
                
            	</form>
            
            </div><!--contract-->
        
        </div><!--right--
        
        --><div class="left">
        
        	<div class="notes" id="mediaContact">
            
            	<p>עומדים לרשותך גם ב..</p>
                <p><a href="https://www.facebook.com/IAGREE.CO.IL"><img src="img/iAgree_face.png">Facebook</a></p>
                <p><a href="https://plus.google.com/109760024080614172945/about"><img src="img/iAgree_goog.png">+Google</a></p>
                <p><a href="#"><img src="img/iAgree_twit.png">Twitter</a></p>
            
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
	user();
});

	
/*****************************************************************
*    						page5()	    					 *
*****************************************************************/

function thankYou(){
	
	var a=0;
	$('.contractInput img').css('display','none');
	
	$('.helpText').css('opacity','0');
		
	if (frm.comments.value.length == 0) {
		frm.comments.focus();
		$('#comments img').fadeIn();
		a=1;}
		
	if (!ValidateEmail(frm.email.value)) {
		frm.email.focus();
		$(frm.email).removeClass('selected');
		frm.email.value = ""
		$('#email img').fadeIn();
		a=1;}
		
	if (frm.name.value.length == 0) {
		frm.name.focus();
		$('#name img').fadeIn();
		a=1;}
			
	if (a==1) {
		$('.helpText').css('opacity','1')
		reutrn(0);}

	frm.submit(); }


function done(z){
	if (z.value != ""){
		$(z).addClass('selected');
		$(z).closest('.contractInput').children('img').hide();}
	else{
		$(z).removeClass('selected')}
		
}

function selected(x){
	$('.sec').removeClass('selected');
	$('#'+x).addClass('selected');
	frm.securities.value = x.charAt(3);
	var y = x.charAt(3);
	$('.secText').fadeIn();
	$('.secText p').hide();
	$('#secText'+y).show();
	
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

function closeLogin(){
	$('.loginBlock').fadeOut();
}

function showLogin(){
	$('.loginBlock').fadeIn();
	$('.loginBlock').css('display','table');
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