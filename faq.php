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
<title>iAgree.co.il | שאלות ותשובות</title>

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
    
    		<img src="img/iAgree_articles_faq.jpg" alt="שאלות ותשובות">
            
			<h1>שאלות ותשובות</h1>
            
            <div class="q" id="q1">
            	
				<h3 onClick="$('#q1 p').slideToggle()"><img src="img/iAgree_Q&A.png">האם לחתימה באינטרנט תוקף חוקי?</h3>
                <p>כן! חתימה על חוזה שכירות באינטרנט הינה חוקית בישראל וכן ונהוגה במספר מדינות נוספות בעולם. בישראל, ניתן לחתום על חוזה שכירות של עד 5 שנים סה"כ באמצעים אלקטרוניים.  תוקפה של חתימה זאת זהה לחתימה כתובה על נייר בהיבט משפטי. ההליך האינטרנטי המובנה באתר חזק ותקף יותר מאמצעים רבים הנהוגים כיום בשוק כגון – פקס.<br>בנוסף, האתר עומד בתקנים מחמירים עולמיים שעוסקים בחתימה אלקטרונית –ESIGN  האמריקאי ו- UETA האירופאי.
</p>
            </div><!--q1-->
            
            <div class="q" id="q2">
				<h3 onClick="$('#q2 p').slideToggle()"><img src="img/iAgree_Q&A.png">כמה עולה השירות באתר?</h3>
                <p>השירות ניתן בחינם גם למשכיר וגם לשוכר וללא אותיות קטנות.</p>
            </div><!--q2-->
            
            <div class="q" id="q3">
				<h3 onClick="$('#q3 p').slideToggle()"><img src="img/iAgree_Q&A.png">כיצד אקבל את החוזה אחרי שאחתום?</h3>
                <p>לאחר החתימה יישלח לדואר האלקטרוני של כל הצדדים בחוזה עותק חתום בפורמט PDF . העותק כולל מידע על המחשב ממנו נחתם החוזה (IP, תאריך וזמן החתימה) וכן תעודות זהות של החותמים.</p>
            </div><!--q3-->
            
            <div class="q" id="q4">
				<h3 onClick="$('#q4 p').slideToggle()"><img src="img/iAgree_Q&A.png">כיצד מתבצעת החתימה?</h3>
                <p>ישנם 2 דרכים בהם ניתן לבצע את החתימה:<br>
1.	חתימה על גבי המסך (באמצעות העכבר) – זוהי האופציה המומלצת על-ידנו.<br>2.	העלאת קובץ המכיל סריקה של חתימה.</p>
            </div><!--q4-->
            
			<div class="q" id="q5">
				<h3 onClick="$('#q5 p').slideToggle()"><img src="img/iAgree_Q&A.png">אנחנו 3 שותפים, האם עדין ניתן לחתום על החוזה?</h3>
                <p>כן! המערכת מאפשרת חתימה של עד 3 שותפים על חוזה שכירות אחד. כל שנדרש הוא להזין את כתובת הדואר האלקטרוני של כל השותפים בעת הכנסת פרטי החוזה.<br>
במידה ויוצר החוזה הינו אחד מהשוכרים – המערכת תאפשר סבב התייחסויות לחוזה בין השוכרים לפני השליחה למשכיר.</p>
            </div><!--q5-->
            
            <div class="q" id="q6">
				<h3 onClick="$('#q6 p').slideToggle()"><img src="img/iAgree_Q&A.png">מי יכול ליצור חוזה – בעל הדירה או השוכר?</h3>
                <p>כל אחד מהצדדים יכול ליצור חוזה ולשלוח אותו לכל שאר הצדדים בחוזה.<br>אין חובה שהדבר ייעשה על-ידי בעל הדירה.<br>כל הצדדים יוכלו לראות את החוזה ולהעיר הערות לפני חתימה, כלל ההערות יועברו ליוצר החוזה. שינויים בפרטי החוזה יבוצעו רק ע"י היוצר והחוזה ה"מתוקן" יופץ שוב להתייחסות חוזרת לכלל הצדדים.</p>
            </div><!--q6-->
            
            <div class="q" id="q7">
				<h3 onClick="$('#q7 p').slideToggle()"><img src="img/iAgree_Q&A.png">עשיתי טעות במילוי החוזה – כיצד ניתן לתקן?</h3>
                <p>כל עוד לא הופץ החוזה לחתימה, יוצר החוזה יכול לבצע שינויים בחוזה.<br>במידה ויבוצעו שינויים לאחר הפצה להתייחסות – המערכת תפיץ את החוזה לסבב התייחסויות נוסף. לאחר חתימת כל הצדדים לא ניתן לבצע שינויים.</p>
            </div><!--q7-->
            
            <div class="q" id="q8">
				<h3 onClick="$('#q8 p').slideToggle()"><img src="img/iAgree_Q&A.png">אני רוצה לעבור על החוזה לפני החתימה , כיצד ניתן?</h3>
                <p>מיד לאחר הכנסת כל הפרטים, תוכל לעבור על החוזה לפני שליחתו למשתתפים האחרים.<br>כל אחד מהשותפים לחוזה – יוכל גם כן לעבור עליו לפני החתימה ולאשר/ להגיב על החוזה.<br>כל ההערות שיאספו מהשוכרים – ירוכזו אצל יוצר החוזה והוא יוכל לבצע את השינויים באופן מרוכז.</p>
            </div><!--q8-->
            
            <div class="q" id="q9">
				<h3 onClick="$('#q9 p').slideToggle()"><img src="img/iAgree_Q&A.png">בעל הדירה שלי לא מסכים לחתום על החוזה – מה ניתן לעשות?</h3>
                <p>אכן בעיה מעניינת. חשוב להדגיש בפניו 3 אלמנטים בולטים שעלולים לשנות את דעתו:<br>
א. החוזה נכתב באוריינטציה שוויונית במטרה להגן על המשכיר ולא רק על השוכר.<br>
ב. החוזה נכתב ע"י משרד עו"ד פישר-בכר-חן-וול-אוריון ושות' בניגוד לחוזים רגילים שלפעמים נכתבים ע"י בעל הבית ולא מתוקפים משפטית.<br>
ג. לבקש מבעל הדירה להיכנס לאתר, להתחיל את התהליך (תמיד אפשר להתחרט). סביר להניח שבשלב האישור הוא יימצא יתרונות נוספים בחוזה מול החוזה הישן שלו.</p>
            </div><!--q9-->
            
            <div class="q" id="q10">
				<h3 onClick="$('#q10 p').slideToggle()"><img src="img/iAgree_Q&A.png">מהו שטר החוב המצורף לחוזה?</h3>
                <p>במידה ובחרתם באפשרות של חתימה על שטר חוב כחלק מהערבויות , יצורף לחוזה עותק של שטר חוב. את השטר תוכלו להדפיס ולהחתים את הערבים ולהעביר אותו לבעל הדירה ביחד עם שאר הצ'קים. למידע נוסף על ביטחונות בקרו ב"מידע שימושי" באתר.</p>
            </div><!--q10-->
            
            
            <div class="q" id="q11">
				<h3 onClick="$('#q11 p').slideToggle()"><img src="img/iAgree_Q&A.png">נרשמתי לאתר דרך GOOGLE+ וגם דרך המייל ואני לא רואה את החוזים שלי?</h3>
                <p>אתר iAgree מזהה את המשתמשים באתר ע"פ כתובת הדוא"לת במידה וחשבון הGOOGLE+ שלך שונה מכתובת הדוא"ל שהזנת המערכת מזהה אותך כשני משתמשים. כל שעליך לעשות הוא להתחבר לחשבון המקורי איתו נרשמת והחוזים יופיעו בחשבונך.</p>
            </div><!--q11-->            
    
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
