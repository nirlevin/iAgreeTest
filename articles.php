<?php
    session_start();
	
    if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
    } 
?><!doctype html>
<html>
<head>
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1">
<title>iAgree.co.il | מידע שימושי!</title>

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
    
			<h1>מידע שימושי!</h1>
            
            <div class="article">
            	
                <img src="img/iAgree_articles_secuities.jpg" alt="כל מה שרצית לדעת על ביטחונות שכירות">
                <h2><a href="securities.php">כל מה שרצית לדעת על ביטחונות שכירות</a></h2>
                
                <h3>השוכר נדרש במעמד חתימת החוזה לספק ביטחונות לבעל הדירה כנגד הדירה אותה קיבל לשימוש. הביטחונות נדרשים על-מנת להגן על בעל הדירה במקרים בהם החוזה מופר על-ידי השוכר – לא מתבצע תשלום או נזק כלשהו בנכס...</h3>
                
  				<a class="linkToArticle" href="securities.php">לכתבה המלאה...</a>              
                
            </div><!--article-->
            
            
            <div class="article">
            	
                <img src="img/iAgree_articles_10_tips.jpg" alt="10 טיפים לשוכר הדירה">
                <h2><a href="10_tips_for_apartment_rental.php">10 טיפים לשוכר הדירה</a></h2>
                
                <h3>השוכר נדרש במעמד חתימת החוזה לספק ביטחונות לבעל הדירה כנגד הדירה אותה קיבל לשימוש. הביטחונות נדרשים על-מנת להגן על בעל הדירה במקרים בהם החוזה מופר על-ידי השוכר – לא מתבצע תשלום או נזק כלשהו בנכס...</h3>
                
  				<a class="linkToArticle" href="10_tips_for_apartment_rental.php">לכתבה המלאה...</a>              
                
            </div><!--article-->


			<div class="article">
            	
                <img src="img/iAgree_articles_faq.jpg" alt="שאלות ותשובות">
                <h2><a href="faq.php">שאלות ותשובות</a></h2>
                
                <h3>האם לחתימה באינטרנט תוקף חוקי?<br>כמה עולה השירות באתר?<br>כיצד אקבל את החוזה אחרי שאחתום?<br>כיצד מתבצעת החתימה?<br>אנחנו 3 שותפים, האם עדין ניתן לחתום על החוזה?</h3>
                
  				<a class="linkToArticle" href="faq.php">לכתבה המלאה...</a>              
                
            </div><!--article-->
    
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
});

	
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65350205-1', 'auto');
  ga('send', 'pageview');	
	
</script>

</body>
</html>
