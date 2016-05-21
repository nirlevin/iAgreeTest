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
<title>iAgree.co.il | אודותינו</title>

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
	    
			<h1>אודותינו</h1>
			<p>iAgree הינה פלטפורמה שמאפשרת התקשרות פשוטה, יעילה ובטוחה בין משכיר לשוכר.</p>
			<p>שוכר ממוצע ישכיר מספר חד ספרתי של דירות בחייו ואילו משכיר ממוצע משכיר דירה אחת בממוצע בכל רגע נתון. התוצאה הינה התקשרות חסרת ניסיון וידע מצד שני הצדדים.</p>
			<p>הבעיה שעומדת לנגד עינינו בשוק השכירות, ניתנת להגדרה באופן פשוט "התקשרויות/עסקאות בין אנשים ללא היכרות מוקדמת, בסכומי כסף גדולים תוך העדר ידע מקדים ובסביבה נטולת חוקים ברורים". העדר תהליך סדור, מובנה ושיוויוני מוליד כמעט מתבקש סוג של "מערב פרוע" בו קיימת פגיעה בצד החלש, תחושת אי אמון לא בריאה ולעיתים אף רמיה. הסיפורים לכך רבים ומקוממים.</p>
			<p>ההתקדמות האחרונה של גורמים שונים בכנסת במטרה לחוקק חקיקה שתוביל לקידום ההוגנות והפיקוח בשוק השכירות הינה מבורכת. אך לצערנו לא הבשילה לידי מימוש ואינה מייצרת פתרון מלא לבעיה.</p>
			<p>האידיאולוגיה שלנו הינה שכדי לייצר התקשרות נכונה בין הצדדים נדרש לייצר פתרון WIN-WIN שמחזק את מעמדו של השוכר ובמקביל שומר ומגן על המשכיר. ועל כן חברנו למשרד עו"ד מהגדולים בארץ ובעבודה משותפת ומחקר מעמיק בנושא יצרנו חוזה ברור ומפורש, בפורמט אינטרנטי נגיש ונוח שיהווה מגדלור לשוק השכירות בישראל. כיום ישנם פתרונות רבים לחלק הראשון בהתקשרות בין משכיר לשוכר סביב פרסום וחיפוש הדירה אך לא קיימת פלטפורמה שמתעסקת בשאר נפח ההתקשרות, מרגע ההחלטה על שכירת הדירה ועד סיום החוזה. ועל כן שמנו לנו למטרה לתת מענה פשוט יעיל ואיכותי תחת "קורת גג" אחת לשאר הסוגיות כגון: חתימת חוזה, תשלומי שכירות, ביטחונות ועוד.</p>
			<h3>אופן השימוש הינו "פתוח", בחרנו לאפשר לכ-ו-ל-ם לחתום על החוזה בצורה נוחה ופשוטה באינטרנט בחינם!</h3>
			
			<p>בימינו, כבר לא נדרש שבעל הדירה מהצפון והשוכר מהדרום ייסעו במיוחד לדירה במרכז על מנת לחתום על חוזה שכירות אלמוני וזר.</p>
    	
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
