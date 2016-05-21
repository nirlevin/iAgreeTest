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
<title>iAgree.co.il | תנאי שימוש</title>
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

	<div class="wrapper" id="contractWrapper">
    
    	<div class="contractPage" id="userAgreement">
            
            <h1>תנאי שימוש</h1>
            
            <p class="freeP" style="display:none;">ברוכים הבאים לאתר IAGREE, המעניק מגוון שירותים למשכירי ושוכרי דירות ("האתר"). האתר מנוהל ומופעל על-ידי חברת XXXXXX בע"מ, מXXXXX ("החברה").</p>
            <p class="freeP">הגישה לאתר והשימוש בו, ובכלל זה בשירותים השונים המוצעים בו, כפופים לתנאי השימוש המפורטים להלן ("תנאי השימוש"), המסדירים את היחסים בין החברה לבין המשתמש באתר (להלן: "משתמש" או "אתה"). הרישום לאתר או עצם השימוש בו מעידים על הסכמתך לתנאי השימוש, ולכן הינך מתבקש לקרוא אותם בקפידה.</p>
                        
            <h3>1. אודות האתר והשירותים</h3>
            
            <div class="contarctLine">
                <p class="rightLine">1.1.</p>
                <p class="lrftLine">האתר מאפשר התקשרות אינטראקטיבית בין משכירי ושוכרי דירות (להלן בהתאמה: "משכירים" ו"שוכרים"), ומסייע להם להפוך את התקשורת ביניהם ליעילה, נוחה ונעימה ("השירותים"). בין יתר השירותים שהחברה מציעה, מאפשר האתר למשכירים ולשוכרים המעוניינים להסדיר את היחסים החוזיים ביניהם, ליצור ולחתום על הסכם שכירות באמצעות מערכת מקוונת.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">1.2.</p>
                <p class="lrftLine">האתר מספק פלטפורמה המאפשרת ביצוע עסקאות בין משכירים ובין שוכרים, וכן מספקת שירותים אדמיניסטרטיביים וטכנולוגיים הדרושים להשלמת העסקה ביניהם ("עסקה"). מובהר, כי החברה אינה צד לכל עסקה שהיא ולכל התקשרות בין משכיר לשוכר, לרבות במקרה בו העסקה יצאה אל הפועל בעקבות מידע שפורסם או נמסר באמצעות האתר ולרבות במקרה שהעסקה בוצעה באמצעות שירותי האתר השונים (כמו למשל, על ידי חתימה על החוזה המקוון בנוסח המוצע באתר). החברה לא תישא בשום מקרה באחריות לכל נזק, הפסד או אובדן מכל מין וסוג, ולכל טענה, דרישה או עילת תביעה של צד לעסקה, בין אם בקשר לעסקה עצמה, בין אם בקשר לדירה נשוא העסקה ובין אם בכל נושא אחר, וכל מחלוקת בקשר לעסקה ולדירה תהא אך ורק בין המשכיר לשוכר.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">1.3.</p>
                <p class="lrftLine">החברה אינה מתחייבת לוודא או לבדוק את זהות המשתמשים בשירותים, יכולתם הפיננסית, או את מהימנות המידע אשר שוכרים ומשכירים מספקים על עצמם או על הדירות. המשתמש באתר אחראי באופן בלעדי לאימות המידע כאמור, לפי העניין, בהתאם לשיקול דעתו הבלעדי.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">1.4.</p>
                <p class="lrftLine">הנך מצהיר ומתחייב כי השימוש באתר והתקשרויות עם משתמשים אחרים בעסקאות ייעשו בהתאם להוראות כל דין, והאתר לא יהיה אחראי בכל דרך שהיא לאי עמידתך בהוראות הדין.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">1.5.</p>
                <p class="lrftLine">למען הסר ספק, מובהר כי החברה אינה מתווכת במקרקעין ואינה מספקת באמצעות האתר שירותי תיווך במקרקעין.</p>    
            </div><!--ContarctLine-->
            
            
            <h3>2. החוזה המקוון</h3>    
            
            <div class="contarctLine">
                <p class="rightLine">2.1.</p>
                <p class="lrftLine">כחלק מהשירותים, מציעה החברה למשתמשים להיעזר במערכת מקוונת המאפשרת להסדיר את תנאי הסכם השכירות, וזאת על בסיס נתונים אשר מוזנים למערכת על ידי הצדדים; הכול כפי שמפורט בתנאי שימוש אלו ובאתר (להלן: "החוזה המקוון"). </p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">2.2.</p>
                <p class="lrftLine">החוזה המקוון אינו מהווה תחליף להתייעצות עם אנשי מקצוע בתחומים הרלוונטיים. החברה ו/או מי מטעמה אינם מתחייבים כי תנאי החוזה המקוון יתאימו לצרכי המשתמש או למטרותיו, ואין לראות בתנאים המופיעים בחוזה המקוון כייעוץ משפטי או ייעוץ מקצועי אחר מכל סוג שהוא. הצדדים לעסקה חופשיים להתקשר בחוזה שונה מזה שהוצע באתר, לפי שיקול דעתם.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">2.3.</p>
                <p class="lrftLine">למען הסר ספק, החברה אינה אחראית לוודא ולבדוק את מהימנות המידע המוזן על ידי המשתמשים לחוזה המקוון, והיא אינה צד לחוזה המקוון. אין בתנאי החוזה המקוון כדי לחייב את החברה ו/או להטיל עליה אחריות מכל מין וסוג, והיא או מי מטעמה לא יישאו בכל אחריות לנזק, אובדן, חסרון כיס, עוגמת נפש וכל נזק אחר מכל מין וסוג שהוא שייגרם למשתמש כתוצאה מהשימוש בחוזה המקוון או מהסתמכות על תנאיו.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">2.4.</p>
                <p class="lrftLine">מובהר, כי במקרים של שימוש במערכת המקוונת והחוזה המקוון המוצע באתר, יישמר עותק מההסכם הסופי בין המשכיר והשוכר במערכות החברה, והחברה תהא רשאית לפרסם באתר מידע אודות מיקום הנכס ודמי השכירות, ובלבד שפרסום כאמור אינו מזהה אישית את השוכר או את המשכיר.</p>    
            </div><!--ContarctLine-->
            
            
        </div><!--contractPage-->

            
        <div class="contractPage">    
        
            <h3>3. רישום לאתר</h3>
                        
            <div class="contarctLine">
                <p class="rightLine">3.1.</p>
                <p class="lrftLine">השימוש באתר מותנה ברישום. לצורך השלמת הרישום לאתר, יש לבחור שם משתמש וסיסמא וכן למסור פרטים כגון שם, כתובת, מספר תעודת זהות וצילום תעודת זהות, כתובת דוא"ל, מספר טלפון, פרטים בקשר עם הדירה שהנך מעוניין להשכיר או לשכור ופרטים מזהים נוספים, כפי שיידרשו מעת לעת. בנוסף, ייתכן כי נתונים מסוימים נוספים יידרשו לצורך עריכת החוזה המקוון וביצוע פעולות אחרות באמצעות האתר. </p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">3.2.</p>
                <p class="lrftLine">3.2.	הנך מתחייב כי (א) הפרטים שיימסרו על ידך יהיו נכונים ומדויקים ולא ייעשה כל שימוש באתר תוך שימוש בזהות בדויה או התחזות לאחר; (ב) במקרה של שינוי פרטים או אם ישנו חשש שנעשה שימוש בלתי מורשה בנתוניך, תדווח על כך לאלתר לחברה באמצעות פנייה בדואר אלקטרוני לכתובת <a href="contact_us.php">contact@iagree.co.il</a>.</p>    
            </div><!--ContarctLine-->
            
 
            <h3>4. הוראות כלליות בדבר השימוש באתר</h3>
            
            <div class="contarctLine">
                <p class="rightLine">4.1.</p>
                <p class="lrftLine">המשתמש מצהיר כי הינו בגיר, בעל כשרות משפטית, ובעל סמכות על-פי דין לביצוע כל הפעולות שיעשו על ידו באמצעות האתר, לרבות הסמכות להתקשר בחוזה המקוון (ככל שייחתם). ככל שהמשתמש עושה שימוש באתר מטעמו של אחר, הוא מצהיר כי יש בידו את כל האישורים הנדרשים לשם כך.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">4.2.</p>
                <p class="lrftLine">כל הזכויות, לרבות זכויות קניין רוחני, באתר ובשירותים, בתכנים, בעיצובים, ביישומים, בכלים וברכיבים אחרים באתר, הינן של החברה ו/או של צדדים שלישיים שהרשו לחברה להשתמש בהם.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine"></p>
                <p class="lrftLine">המונחים "תוכן" או "תכנים" פירושם כל מידע מכל מין וסוג, לרבות (אך לא רק): כל מסמך, רשומה, תמונה, צילום, איור, הנפשה, תרשים, דמות, סרטון, קובץ קולי, תוכנה, קובץ, קוד מחשב, יישום, פורמט, פרוטוקול, מאגר נתונים, ממשקי משתמש, וכן כל תו, סימן, סמל וצלמית; והכל, בכל מדיה שהיא.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">4.3</p>
                <p class="lrftLine">החברה מעניקה בזאת למשתמש רישיון שימוש מוגבל, שאינו בלעדי ואינו ניתן להעברה או להמחאה, לעשות שימוש אישי באתר, בשירותים ובתכני החברה, אך ורק לצרכים המתוארים באתר ובתנאי השימוש; והכל בכפוף ליתר הוראות תנאי השימוש. מעבר לאמור לעיל, החברה לא מעניקה כל זכות או רישיון, מפורש או משתמע, בקשר עם האתר, השירותים ותכני החברה. </p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">4.4</p>
                <p class="lrftLine">ככל שהמשתמש ישלח לחברה המלצות או השגות בקשר לאתר או לשירותים, החברה תהא רשאית לעשות בהם שימוש בהתאם לשיקול דעתה הבלעדי מבלי שתהיה חייבת לפצות את המשתמש בכל דרך שהיא בגין המלצה או השגה כאמור.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">4.5</p>
                <p class="lrftLine">החברה אינה מתחייבת כי (א) האתר יהלום את ציפיות או דרישות המשתמש; (ב) השירותים המוצעים באתר יינתנו בלא הפסקות וללא טעויות; או (ג) האתר יהיה חסין מפני גישה בלתי מורשית למחשבי החברה או מפני קלקולים, תקלות או כשלים בחומרה, בתוכנה ובכל מערכת תקשורת אחרת של החברה ו/או של מי מטעמה.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">4.6</p>
                <p class="lrftLine">מבלי לגרוע מהזכויות והסעדים הנתונים לחברה לפי כל דין, החברה תהא רשאית לחסום את השימוש של המשתמש באתר, בשירותים, או בכל חלק מהם, לרבות במקרה בו, על פי שיקול דעתה, המשתמש או מי מטעמו ביצע איזה מהמעשים הבאים: (א) מעשה בלתי חוקי; (ב) הפרת תנאי מתנאי השימוש; (ג) מסירת פרטי זיהוי שגויים בעת ההרשמה או לאחר מכן; או (ד) מעשה או מחדל שיש בו כדי לפגוע בחברה או במשתמשים אחרים או בפעילות התקינה של האתר.</p>    
            </div><!--ContarctLine-->
            
            
            <h3>5. מודעות ותכני המשתמש</h3>
            
            <div class="contarctLine">
                <p class="rightLine">5.1.</p>
                <p class="lrftLine">המשתמש מצהיר ומתחייב כי (א) הוא בעל הזכויות הבלעדי בתכנים שהועלו או שיועלו על ידו לאתר, לרבות מודעות, הודעות, פרסומות וכיוצא באלה או שקיבל את כל האישורים וההרשאות הנדרשים לשם כך; ו- (ב) כי הוא אחראי באופן בלעדי לתכנים ולמודעות המועלים על ידו לאתר. החברה לא תישא בכל אחריות לכל נזק מכל מין וסוג שהוא כתוצאה מפרסום לא מורשה של תכנים או מודעות על ידי המשתמש באתר, לרבות בגין הפרת זכויות קנייניות, הזכות לפרטיות או זכויות אחרות של צדדים שלישיים.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">5.2.</p>
                <p class="lrftLine">מבלי לגרוע מיתר הוראות הסכם זה, החברה שומרת לעצמה את הזכות, מבלי שהדבר יתפרש כנטילת אחריות כלשהי על מידע או תכנים שהועלו לאתר על ידי המשתמש, להסיר מהאתר, ללא הודעה מראש, תכנים, לרבות מודעות, שפורסמו על ידי משכירים ושוכרים, אשר לפי שיקול דעתה הבלעדי הינם שקריים או מטעים, מפרים זכויות של צדדים שלישיים ו/או אינם עומדים בהוראות תנאי השימוש.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine" id="defGeneral">
                <p class="rightLine">5.3.</p>
                <p class="lrftLine">5.3.	מבלי לגרוע מיתר הוראות הסכם זה, מובהר, כי פרסום מודעות של משכירים לא יהווה המלצה מצד האתר ביחס לדירות המפורסמות להשכרה, וכי לא ניתן כל מצג על ידי החברה ביחס לדירות כאמור. החברה אינה נושאת באחריות כלשהי למודעות אלו, לרבות לחוקיות, נכונות, עדכניות או תקפות כל מידע הכלול בהן.</p>
            </div><!--ContarctLine-->
            
        </div><!--contractPage-->
        
        
        <div class="contractPage">    
            
            <h3>6. שימוש אסור באתר</h3>
            
            <div class="contarctLine">
                <p class="rightLine">6.1.</p>
                <p class="lrftLine">הנך מתחייב כי בעת השימוש באתר ובשירותים, לא תעשה ולא תאפשר לאחרים לעשות איזו מהפעולות הבאות: (א) שימוש באתר באופן המשנה את עיצוב האתר או מחסיר תכנים כלשהם, לרבות פרסומות ותכנים מסחריים; (ב) שימוש בשמות ובסימנים המסחריים (בין אם רשומים ובין אם לאו) המוצגים באתר, מבלי לקבל את הסכמת החברה ו/או את הסכמת בעלי הזכויות בהם מראש ובכתב, לפי העניין; (ג) הפעלת כל יישום מחשב או כל אמצעי אחר, לשם חיפוש, סריקה, העתקה או אחזור אוטומטי של תכנים; (ד) שימוש באתר לצרכים מסחריים החורגים מהתקשרות בעסקה בין משכיר ושוכר; (ה) שליחה, שידור, הצגה או הטענה של כל תוכן (1) שקרי או מטעה; (2) בלתי חוקי או בלתי מוסרי, לרבות חומרי הסתה, חומרים הכוללים אלימות, גזענות, פורנוגרפיה, דברי-נאצה, איומים, וביטויים של גסות רוח; (3) המעודד לביצוע עבירה פלילית; (4) המהווה פגיעה בזכויות של צדדים שלישיים, לרבות זכויות קניין רוחני; ו/או (5) המהווה לשון הרע על אדם או פגיעה בפרטיותו של אדם; (ו) הכולל או נועד להפיץ וירוסים, תוכנות-עוינות ו/או כל אמצעי אחר אשר עלול לפגוע, להרוס, להפריע, או להגביל את השימוש במערכות מחשב, שרתים, חומרה או תוכנה של החברה או של כל צד שלישי; ו/או (ז) הפצת "דואר זבל" או כל שימוש שנועד להתחקות או להטריד אדם אחר בכל דרך שהיא.</p>    
            </div><!--ContarctLine-->
            
            
            <h3>7. קישורים ופרסומים</h3>
            
            <div class="contarctLine">
                <p class="rightLine">7.1.</p>
                <p class="lrftLine">האתר עשוי לכלול קישורים לעמודים, לאפליקציות ולאתרים שונים ברשת האינטרנט אשר אינם מנוהלים ו/או מופעלים על ידי החברה ו/או על ידי מי מטעמה. החברה אינה שולטת ו/או מפקחת על עמודים, אפליקציות ואתרים כאמור, והעובדה שהחברה מקשרת לתכנים אלה אינה מעידה על הסכמתה לתוכנם ואינה מהווה ערובה לאמינותם, לעדכניותם או לחוקיותם. החברה לא תהא אחראית לתכנים אלו, ולא תישא בכל אחריות לכל נזק שייגרם לך או לכל צד שלישי אחר כתוצאה מהשימוש בעמודים, אפליקציות ואתרים כאמור. השימוש בעמודים, אפליקציות ואתרים אלו כפוף לתנאי השימוש ותנאי הפרטיות המופיעים בהם, ולא לתנאי השימוש ותנאי הפרטיות של החברה.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">7.2.</p>
                <p class="lrftLine">אין ליצור קישורים לאתר, מכל אתר אינטרנט המכיל תכנים לא חוקיים או המעודדים פעילות בלתי חוקית, לרבות תכנים המעודדים גזענות, הפליה, אלימות או תכנים פורנוגראפיים או פוגעניים אחרים, או כאלו המהווים פגיעה בפרטיות או בשם הטוב של צדדים שלישיים.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">7.3.</p>
                <p class="lrftLine">האתר עשוי לכלול מידע מסחרי הנמסר לפרסום מטעמם של מפרסמים שונים. פרסום מידע מסחרי כאמור באתר אינו מהווה המלצה או עידוד לרכוש את השירותים, הנכסים או המוצרים המוצעים. החברה ו/או מי מטעמה לא ישאו בכל אחריות לתוכן המידע המסחרי או הפרסומות באתר, והאחריות היחידה לתוכן הפרסומות והמידע המסחרי חלה על המפרסמים. כל עסקה שתיעשה בעקבות מודעה או מידע המתפרסמים באתר תבוצע ישירות בינך לבין המפרסם הנוגע בדבר, והחברה לא תהא צד לכל עסקה כזאת.</p>    
            </div><!--ContarctLine-->
            
            
            <h3 id="privacyPolicy">8. מדיניות פרטיות</h3>
            
            <p class="freeP">החברה מתייחסת בכבוד לפרטיות המשתמשים באתר, ותפעל בהתאם למדינית הפרטיות המפורטת להלן ועל פי הוראות כל דין.</p>
            
            <div class="contarctLine">
                <p class="rightLine">8.1.</p>
                <p class="lrftLine">במסגרת ההרשמה לאתר והשימוש בשירותים המוצעים בו, הנך עשוי להתבקש למסור לחברה פרטים אודותיך, לרבות שם, כתובת, מספר תעודת זהות וצילום תעודת זהות, כתובת דוא"ל, מספר טלפון, פרטים בקשר עם הדירה שהנך מעוניין להשכיר או לשכור וכיוצא באלה. פרטים אלו ישמרו במאגריה של החברה וכן יכול שישמרו על ידי החברה פרטים נוספים על אופן שימושך באתר, כתובת ה-IP  שלך, מיקומך, מודעות ודירות שעניינו אותך, תכנים או עמודים שקראת, ועוד. הנך מצהיר כי ידוע לך שלא חלה עליך חובה על-פי חוק למסור מידע זה לחברה, וכי המידע נמסר מרצונך ובהסכמתך.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">8.2.</p>
                <p class="lrftLine">השימוש במידע כאמור ייעשה רק על פי מדיניות פרטיות זו, וזאת למטרות המפורטות להלן: (א) על מנת לתפעל ולנהל את השירותים ופעילות האתר; (ב) על מנת להעניק לך שירות ולשמור איתך על קשר; (ג) על מנת לשפר ולהעשיר את השירותים וליצור שירותים ותכנים חדשים המתאימים לדרישות ולציפיות המשתמשים וכן לשנות או לבטל שירותים קיימים; (ד) לצורך שליחתם של דברי דואר ודפוס, לרבות הצעות מסחריות מטעם החברה, בכפוף להסכמתך ובכפוף לכך שתוכל לבקש בכל עת שלא לקבל דברי דואר כאמור; (ה) כדי להתאים את המודעות שיוצגו לעיניך בעת השימוש באתר לתחומי ההתעניינות שלך; ו- (ו) לכל מטרה אחרת, המפורטת בתנאי שימוש אלו.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">8.3.</p>
                <p class="lrftLine">הפרטים והמידע אודותיך לא יימסרו לידי צדדים שלישיים ללא הסכמתך מראש, אלא ככל שהדבר הותר במסגרת מדיניות פרטיות זו, כפי שתעודכן מפעם לפעם. על אף האמור לעיל, החברה רשאית להעביר לצדדים שלישיים את פרטיך האישיים והמידע שנאסף אודותיך במקרים המפורטים להלן: (א) לנותני שירותים של החברה, על מנת שהחברה תוכל להעניק לך את השירותים, בהתאם למטרות המפורטות בסעיף ‏8.2 לעיל; (ג) לחברות בנות של החברה, בכפוף לכך שהשימוש שלהם במידע יהיה בהתאם למדיניות פרטיות זו; (ד) לשותפיה העסקיים ולצדדים שלישיים אחרים לצורך שליחתם של חומרים שווקים, פרסומיים ואחרים אשר עשויים לעניין אותך, ובלבד שהתקבלה הסכמתך המפורשת בנפרד למסירת מידע כאמור בכפוף להוראות כל דין; (ה) במקרה שתפר את תנאי השימוש באתר או תבצע באמצעות האתר, או בקשר איתה, פעולות בניגוד לדין או ניסיון לבצע פעולות כאלה; (ו) אם יתקבל בידי החברה צו שיפוטי המורה לה למסור את פרטיך או המידע אודותיך לצד שלישי; (ז) במקרה שהחברה תסבור, כי מסירת המידע נחוצה כדי למנוע נזק חמור לגופך או לרכושך או לגופו או לרכושו של אחר; (ח) אם מדובר במידע סטטיסטי אודות השימוש באתר, אשר אינו מזהה אותך באופן אישי; ו- (ט) במקרה של מכירת מניות החברה או עיקר נכסיה, ככל שהעברת המידע דרושה לצורך ביצוע עסקה כאמור.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">8.4.</p>
                <p class="lrftLine">יצוין, כי החברה עושה שימוש במערכות אבטחת מידע כדי למנוע גישה בלתי מורשית למידע שבידיה. עם זאת, אין באפשרות החברה להבטיח שהאתר והשירותים יהיו חסינים באופן מוחלט מפני גישה בלתי מורשית למידע המאוחסן על ידה, והיא לא תהיה אחראית לכל נזק שייגרם עקב חדירה למידע המוחזק בידיה.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">8.5.</p>
                <p class="lrftLine">החברה רשאית לשנות מעת לעת את הוראות מדיניות הפרטיות המפורטות לעיל.</p>    
            </div><!--ContarctLine-->
            
        </div><!--contractPage-->
        
        <div class="contractPage">      
            
            <h3>9. אחריות ושיפוי</h3>
            
            <div class="contarctLine">
                <p class="rightLine">9.1.</p>
                <p class="lrftLine">השימוש באתר הוא על אחריותך הבלעדית והמלאה. האתר, השירותים והתכנים באתר מוצעים כמות שהם (As Is), ללא אחריות מכל סוג שהוא. החברה או מי מטעמה לא יישאו באחריות כלשהי, ישירה או עקיפה, כספית או אחרת, לכל תוצאה שתנבע מהשימוש באתר, בשירותים או במערכת החוזה המקוון, לרבות כתוצאה מעסקה שבוצעה באמצעות השימוש באתר או כתוצאה מהסתמכות על המידע המפורסם באתר. לא תהיה לך כל טענה, דרישה ו/או עילת תביעה כלפי החברה או מי מטעמה בקשר לאתר, לרבות זמינות התכנים בה, תקלות, תוצאות השימוש בה וכיוצא באלה, וככל שיש או שעשויה להיות לך כל טענה כאמור, בין אם ידועה לך ובין אם תיוודע לך בעתיד, אתה מוותר עליה באופן בלתי חוזר.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">9.2.</p>
                <p class="lrftLine">המשתמש מתחייב בזאת לפצות ולשפות את החברה, מיד עם דרישתה הראשונה, בגין כל נזק אשר יגרם לה כתוצאה מהשימוש באתר או בשירותים על ידי המשתמש, לרבות בגין כל מעשה או מחדל מצד המשתמש בניגוד להוראות תנאי שימוש אלו, ולרבות בגין כל טענה, דרישה או עילת תביעה של צד שלישי (לרבות משכיר או שוכר, לפי העניין) הנובעים מכל מעשה או מחדל של המשתמש.</p>    
            </div><!--ContarctLine-->
            
            
            <h3>10. הודעה והסרה</h3>
            
            <div class="contarctLine">
                <p class="rightLine">10.1.</p>
                <p class="lrftLine">החברה שומרת לעצמה את הזכות להסיר מהאתר תכנים אשר צדדים שלישיים טוענים כי הם מפרים את זכויות הקניין הרוחני שלהם או זכויות אחרות. אם הנך סבור כי תוכן מסוים המופיע באתר מפר את זכויות הקניין הרוחני שלך, או של צד שלישי, או מפר הוראה אחרת מתנאי שימוש אלה, הנך מתבקש לפנות בדואר אלקטרוני לכתובת contact@iagree.co.il ולציין את הפרטים הבאים: (א) פרטיך המלאים ופרטי ההתקשרות עמך (שם מלא, כתובת, טלפון, דואר אלקטרוני); (ב) זיהוי מדויק של התוכן שלטענתך מפר זכויות והסבר מפורט כיצד הוא מפר זכויות; ו- (ג) הצהרה חתומה שלך, כי למיטב ידיעתך המידע שנמסר על ידך מלא ונכון.</p>    
            </div><!--ContarctLine-->
            
        </div><!--contractPage-->
        
        <div class="contractPage" id="page1"> 
            
            <h3>11. כללי</h3>
            
            <div class="contarctLine">
                <p class="rightLine">11.1.</p>
                <p class="lrftLine">החברה עשויה לשנות מעת לעת את מבנה האתר, מראהו ועיצובו, את היקפם וזמינותם של השירותים, ותהיה רשאית לגבות תשלום בעד שירותים כאלה או אחרים לפי שיקול דעתה הבלעדי או לשנות כל דבר ו/או היבט אחר הכרוך באתר, והכל - מבלי להודיע על כך מראש. מעצם טיבם, שינויים כאמור עלולים להיות כרוכים בתקלות ובאי-נוחות. לא תהיה לך כל תביעה ו/או טענה ו/או דרישה כלפי החברה ו/או מי מטעמה בגין שינויים כאמור ו/או תקלות שיתרחשו עקב או אגב ביצועם.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">11.2.</p>
                <p class="lrftLine">על השימוש באתר, לרבות כל סכסוך, מחלוקת או הליך משפטי הקשור לתנאי שימוש אלה, יחולו אך ורק דיני מדינת ישראל. מקום השיפוט הבלעדי בכל הליך משפטי הנוגע לשימוש באתר או לתנאי שימוש אלה, בין במישרין ובין בעקיפין, יהיה בבתי המשפט המוסמכים במחוז תל-אביב-יפו. </p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">11.3.</p>
                <p class="lrftLine">תנאי השימוש מהווים את ההסכם המשפטי המלא בינך ובין החברה בקשר לשימוש שלך באתר.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">11.4.</p>
                <p class="lrftLine">במידה וייקבע שחלק כלשהו מתנאי השימוש אינו תקף, או שאינו ניתן לאכיפה, אזי התנאים שתוקפם נשלל או שאינם ניתנים לאכיפה ייחשבו כאילו הוחלפו בתנאים תקפים הניתנים לאכיפה שתוכנם תואם את כוונת התנאים המקוריים, ואילו יתר תנאי השימוש יישארו בתוקפם ככתבם וכלשונם.</p>    
            </div><!--ContarctLine-->
            
        
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