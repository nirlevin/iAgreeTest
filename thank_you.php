<?php

    session_start();
	
    if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
    } 

$field_name = $_POST['name'];
$field_email = $_POST['email'];
$field_message = $_POST['comments'];
	
$mail_to = $field_email;
$subject = 'iAgree | פנייתך התקבלה';

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
		
			<h1>הי '.$field_name.',</h1>
			<h2>תודה שפנית אלינו ל- iAgree !</h2>
			<p>'.$field_message.'.</p>
			<h2>המייל התקבל בהצלחה והועבר לטיפול, אנחנו נחזור אליך במהלך 48 השעות הקרובות.</h2>
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
$headers .= "Reply-To: contact@iagree.co.il\r\n";
$headers .= "Bcc: contact@iagree.co.il, maoz@iagree.co.il, offer@iagree.co.il, tom@iagree.co.il\r\n";

$mail_status = mail($mail_to, $subject, $body_message, $headers);
?>
<!doctype html>
<html>
<head>
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1">
<title>iAgree.co.il | פנייתך התקבלה</title>

<meta name="viewport" content="width=device-width">
<link href="style2.css" rel="stylesheet" type="text/css">
<!-- Tablet -->
<link href="mobile2.css" rel="stylesheet" type="text/css" media="only screen and (min-width:0px) and (max-width:768px)">
<!-- Desktop -->
<link href="style2.css" rel="stylesheet" type="text/css" media="only screen and (min-width:769px)">

</head>


<body oncontextmenu="return false;">

<section id="section1">
	
		<?php include 'nav.php';?>

</section><!--section1-->

<section id="section2">

	<div class="wrapper" id="contentPage">
	    
			<div class="gap10">
		</div>
    
    	<div class="thankYou">
		
			<h1>הי <?php echo $_POST['name'] ?>,</h1>
			<p>תודה שפנית אלינו ל- iAgree !</p>
			<p>המייל התקבל בהצלחה והועבר לטיפול, אנחנו נחזור אליך במהלך 48 השעות הקרובות.</p>
			<h3>לשירותך תמיד,</h3>
			
			<a href="index.html"><img src="img/IAgreeLogo.png"></a>
			
			<h3>צוות iAgree</h3>

		
        </div><!--thankYou-->
    	
    </div><!--wrapper-->

</section><!--section2-->

<section id="section3">

	<?php include 'footer.php';?>

</section><!--section3-->
	

<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>

<script>

/*****************************************************************
*    					General variables    					 *
*****************************************************************/

	var h = $(window).height();
	var j = 0;
	var i = 0;
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
	user();
})	


  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65350205-1', 'auto');
  ga('send', 'pageview');	
	
</script>

</body>
</html>
