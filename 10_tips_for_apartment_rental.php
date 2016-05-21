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
<title>iAgree.co.il | 10 טיפים לשוכר הדירה</title>

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

	<div class="wrapper article articleContent" id="contentPage">
    
    		<img src="img/iAgree_articles_10_tips.jpg" alt="10 טיפים לשוכר הדירה">
        
			<h1>10 טיפים לשוכר הדירה</h1>
			<h3>רוצים לדעת איך לעשות את זה נכון?</h3>
            <h3>איזה דברים חייבים לבדוק לפני שחותמים על החוזה?</h3>
            <p>1. חשוב לבקש מבעל הדירה הוכחות שהדירה בבעלותו – "נסח טאבו" הינו המסמך המועדף לצורך זה. במידה ובעל הדירה הוא מתחזה – הכסף ששילמתם יירד לטמיון.</p>
            <p>2. בידקו את זרם המים במקלחת, רצוי לבדוק במקביל לפתיחת ברז אחר בדירה.</p>
            <p>3. אל תתביישו להפעיל את המזגן על מנת לבדוק את תקינותו.</p>
            <p>4. בידקו את מצב התריסים בדירה ובחדר השינה בפרט – לא נעים להתעורר כל בוקר עם זריחת החמה.</p>
            <p>5. בקרו בדירה בשעות היום והלילה – לפעמים הדברים נראים שונה והרעשים שונים.</p>
            <p>6. בידקו אם יש תחבורה ציבורית קרובה – תחנת רכבת או אוטובוס קרובים מדי עשויים להוות מפגע.</p>
            <p>7. תאמו מראש אופציה להארכת החוזה לשנה נוספת וכך תבטיחו מחיר הוגן גם לשנה הבאה.</p>
            <p>8. בצעו קריאת שעונים ביום הכניסה (חשמל, מים וגז) ואל תשכחו לבצע אותו דבר ביום העזיבה.  את הנ"ל נכון לבצע בכתב מול המשכיר.</p>
            <p>9. אם אין חניה בבנין - בדקו את מצב החניה ברחוב, בייחוד בשעות הערב.</p>
            <p>10. חתמו על חוזה דירה ברור והוגן לשני הצדדים – כמו זה שנמצא באתר שלנו!</p>

    
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
