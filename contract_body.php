<?php

	include("services.php");
	
	if($user){
	
		$contract['landlord'][0]['first_name'] = $user['first_name'];
		$contract['landlord'][0]['last_name'] = $user['last_name'];
		$contract['landlord'][0]['identity_number'] = $user['identity_number'];
		$contract['landlord'][0]['email'] = $user['email'];
	}
	
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?php

	/* Format end_date before calculating the extension_date */
	$end_date = convertDateToMySqlFormat($contract['end_date']);
	
	/* Calculate and format extention_date for display */
	$extention_date = date('d/m/Y', strtotime('+1 year', strtotime($end_date)));

	/* Format end_date for display */
	$end_date = convertDateToDisplayFormat($contract['end_date']);

	/* Format start_date for display */
	$start_date = convertDateToDisplayFormat($contract['start_date']);
	
	/* Format number of rooms to be 1 or 1.5 and not 1.00 */
	$contract['rooms'] = str_replace(".0", "", (string) number_format($contract['rooms'], 1, ".", ""));
	
?>

<div class="contractPage" id="page1">
            
            <h1>הסכם שכירות</h1>
            <p>בין</p>
            
            <div class="ll">
                <p class="llRight">מר / גב'</p> 
                <p class="llLeft"> <span><?=($contract['landlord'][0]['first_name'] . " " . $contract['landlord'][0]['last_name'])?></span> </p>
            </div><!--ll-->
                
             <div class="ll">
                <p class="llRight">ת.ז</p> 
                <p class="llLeft"> <span><?=$contract['landlord'][0]['identity_number']?></span> </p>
             </div><!--ll-->
            
             <div class="ll">
                <p class="llRight">מרחוב</p> 
                <p class="llLeft"> <span><?=$contract['landlord'][0]['address']?></span> </p>
             </div><!--ll-->
             
             <div class="ll">
                <p class="llRight">טלפון</p> 
                <p class="llLeft"> <span><?=$contract['landlord'][0]['phone']?></span> </p>
             </div><!--ll-->
                
            <p>(להלן:"<strong>המשכיר</strong>");</p>
            
            <p>ובין</p>
            
            
            <div class="tenants">
            
				<?php
					$i = 1;
					foreach($contract['tenant'] as $tenant) {
						
						$tenantUser = getUserByEmail($tenant['email']);
						
				?>
                <div class="tenant" id="tenant<?=$i?>">
                    
                    <div class="ll">
                        <p class="llRight">מר / גב'</p> 
                        <p class="llLeft"> <span><?=($tenantUser['first_name'] . " " . $tenantUser['last_name'])?></span> </p>
                    </div><!--ll-->
                        
                     <div class="ll">
                        <p class="llRight">ת.ז</p> 
                        <p class="llLeft"> <span><?=$tenantUser['identity_number']?></span> </p>
                     </div><!--ll-->
                    
                     <div class="ll">
                        <p class="llRight">מרחוב</p> 
                        <p class="llLeft"> <span><?=$tenant['address']?></span> </p>
                     </div><!--ll-->
                     
                     <div class="ll">
                        <p class="llRight">טלפון</p> 
                        <p class="llLeft"> <span><?=$tenant['phone']?></span> </p>
                     </div><!--ll-->
                    
                </div><!--tenant<?=$i?>-->
				<?php
						$i++;
					}
				?>
            
            </div><!--tenants-->
            
            <p>(להלן:<strong>"השוכר"</strong>).</p>
            
            <div class="contarctLine">
                <p class="rightLine"><strong>הואיל</strong></p>
                <p class="lrftLine">והמשכיר הינו בעל הזכויות הרשום והבלעדי של דירה בת <span><?=$contract['rooms']?></span> חדרים, ברחוב <span><?=$contract['street']?></span>,
        מספר <span><?=$contract['building']?></span>, דירה <span><?=$contract['apartment']?></span>, בעיר <span><?=$contract['city']?></span> (להלן "הדירה");
        </p>
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine"><strong>והואיל</strong></p>
                <p class="lrftLine">והצדדים מעוניינים להתקשר בהסכם זה, לפיו ישכור השוכר את הדירה מאת המשכיר.</p>
            </div><!--ContarctLine-->
            
            <h2>לפיכך, הוצהר, הותנה והוסכם בין הצדדים, כדלקמן:</h2>
            
            <h3>1. תקופת השכירות וסיומה</h3>
            
            <div class="contarctLine">
                <p class="rightLine">1.1.</p>
                <p class="lrftLine">המשכיר משכיר בזה לשוכר, והשוכר שוכר בזה מהמשכיר את הדירה, החל מתאריך <span><?=$start_date?></span> ועד לתאריך <span><?=$end_date?></span> (להלן: "תקופת השכירות").</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">1.2.</p>
                <p class="lrftLine">השוכר רשאי לסיים את תקופת השכירות בכל עת, בהודעה של שישים (60) ימים מראש, וזאת בתנאי שהציע למשכיר שוכר חלופי שקיבל על עצמו בכתב את כל התחייבויות השוכר לפי הסכם זה לתקופת השכירות הנותרת. המשכיר לא יסרב לאשר את השוכר החלופי, אלא מטעמים סבירים.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">1.3.</p>
                <p class="lrftLine">המשכיר יהיה רשאי לסיים את תקופת השכירות באופן מידי במקרה של הפרה יסודית של הסכם זה על ידי השוכר, אשר לא תוקנה תוך ארבעה עשר (14) ימים ממועד מסירת דרישה בכתב לשוכר לתיקון ההפרה.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">1.4.</p>
                <p class="lrftLine">במהלך תקופה של תשעים (90) ימים לפני תום תקופת השכירות, יהיה רשאי המשכיר להראות את הדירה לשוכרים פוטנציאליים, בתיאום מראש עם השוכר.</p>    
            </div><!--ContarctLine-->
            
            
            <h3>2. דמי השכירות</h3>    
            
            <div class="contarctLine">
                <p class="rightLine">2.1.</p>
                <p class="lrftLine">תמורת מילוי התחייבויות המשכיר לפי הסכם זה, ישלם השוכר למשכיר, במהלך תקופת השכירות, דמי שכירות חודשיים בסך <span><?=$contract['fee']?></span> ש"ח (להלן: "דמי השכירות"). דמי השכירות ישולמו על ידי השוכר למשכיר מידי חודש בחודשו במהלך תקופת השכירות, ביום ה-<span><?=$contract['billing_day']?></span> של החודש. לא יאוחר מ-14 יום לאחר חתימת הסכם זה או מועד תחילת השכירות – המוקדם מבניהם,  יפקיד השוכר בידי המשכיר כל ההמחאות בגין תקופת השכירות. במקרה שהמחאות אלו יחזרו או יבוטלו, יחויב השוכר בעמלת הביטול.
        מוסכם, כי אי תשלום דמי השכירות במלואם ובמועדם ייחשב להפרה יסודית של השוכר.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">2.2.</p>
                <p class="lrftLine">הצדדים מאשרים כי דמי השכירות נקבעו לאחר שניתן לשוכר מידע בדבר דמי השכירות ששולמו בגין השכרת הדירה בשנים עשר (12) החודשים שקדמו למועד החתימה על הסכם זה, ככל שהשוכר ביקש לקבל מידע זה. </p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">2.3.</p>
                <p class="lrftLine">בכל מקרה של אי תשלום בפועל של דמי השכירות, במלואם ובמועדם,השוכר מתחייב להסדיר באופן מידי את התשלום במלואו. מבלי לגרוע מיתר הוראות הסכם זה, במקרה שדמי השכירות לא שולמו תוך שבעה (7) ימים מהמועד שנקבע לתשלומם, יתווסף לכל חלק מדמי השכירות שטרם שולם פיצוי מוסכם בסך 150 ש"ח עבור כל יום נוסף בו לא הוסדר התשלום.</p>    
            </div><!--ContarctLine-->
            
        </div><!--contractPage-->

            
        <div class="contractPage">    
        
            <h3>3.	תקופת האופציה</h3>
            
            <div id="contractSection3">
            
			<?php
				if($contract['optional_extension'] == 1) {
			?>
			
					<div class="contarctLine">
						<p class="rightLine">3.1.</p>
						<p class="lrftLine">השוכר רשאי להאריך את תוקף הסכם זה בשנים עשר (12) חודשים, מתאריך <span><?=$end_date?></span> ועד לתאריך <span><?=$extention_date?></span> (להלן: "האופציה" ו"תקופת האופציה"), באמצעות הודעה בכתב למשכיר לפחות תשעים (90) ימים טרם תום תקופת השכירות, והכל בכפוף לכך שהשוכר עמד במלוא התחייבויותיו על פי הסכם זה ושהמשכיר יהיה רשאי להעלות את דמי השכירות בתקופת האופציה בלא יותר משלושה אחוזים (3%) מדמי השכירות בתקופת השכירות.</p>    
					</div><!--ContarctLine-->
					
					<div class="contarctLine">
						<p class="rightLine">3.2.</p>
						<p class="lrftLine">במקרה של מימוש האופציה על ידי השוכר, יפקיד השוכר בידי המשכיר, לפחות ארבעים וחמישה (45) ימים טרם תחילת תקופת האופציה, המחאות עבור דמי השכירות החודשיים בתקופת האופציה.</p>    
					</div><!--ContarctLine-->
					
					<div class="contarctLine">
						<p class="rightLine">3.3.</p>
						<p class="lrftLine">בתקופת האופציה יחולו על הצדדים כל הוראות הסכם זה, בשינויים המחויבים, לרבות כל הוראות ההסכם הנוגעות לתשלום דמי השכירות ותשלומים נוספים.</p>    
					</div><!--ContarctLine-->
				
			<?php } else { ?>
			
					<div class="contarctLine">
						<p class="rightLine">3.1.</p>
						<p class="lrftLine">ללא.</p>    
					</div><!--ContarctLine-->
				
			<?php } ?>
            
        </div><!--contractSection3-->    
            
            <h3>4.	מיסים ותשלומים אחרים</h3>
            
            <div class="contarctLine">
                <p class="rightLine">4.1.</p>
                <p class="lrftLine">במהלך תקופת השכירות יישא השוכר בכל מס, חיוב, היטל או תשלום אחר בקשר עם החזקת הדירה והשימוש השוטף בה, לרבות(א) ארנונה; (ב) תשלומי וועד בית ודמי ניהול; ו- (ג) תשלומים בגין צריכה, לרבות תשלומי מים, חשמל, גז וחימום (להלן ביחד: "התשלומים השוטפים"), ובכל מקרה, למעט תשלומים החלים לפי כל דין על בעל הדירה ואשר לא נקבע במפורש בהסכם זה כי ישולמו על ידי המשכיר. מוסכם, כי אי תשלום התשלומים השוטפים במלואם ייחשב להפרה יסודית של השוכר.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">4.2.</p>
                <p class="lrftLine">השוכר מתחייב להעביר על שמו, מיד עם תחילת תקופת השכירות, את כל החשבונות בכל הגופים והרשויות המתאימים, לרבות העירייה או הרשות המקומית, חברת החשמל, חברת הגז וחברת המים, וחשבונות אלו יישארו רשומים על שם השוכר עד תום תקופת השכירות.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">4.3.</p>
                <p class="lrftLine">השוכר לא יישא בכל מס, חיוב, היטל או תשלום המיועד או קשור לרכישה או לשדרוג של מערכות או מתקנים קבועים המשרתים את הדירה, או את הבית המשותף, למעט התאמות מיוחדות או שיפורים שבוצעו לפי דרישת השוכר, ובכפוף להסכמת המשכיר.</p>    
            </div><!--ContarctLine-->
            
            <h3>5. מצב הדירה</h3>
            
            <div class="contarctLine">
                <p class="rightLine">5.1.</p>
                <p class="lrftLine">המשכיר מצהיר בזאת כי הדירה ראויה למגורים, ועומדת, בין היתר, בתנאים הבאים: (א) בניית הדירה הושלמה; (ב) לשוכר יש ותהיה גישה חופשית לדירה לאורך כל תקופת השכירות; (ג) הדירה כוללת מטבח וחדר שירותים ורחצה; (ד) הדירה כוללת מערכות תקינות לאספקת מי שתייה ומי רחצה (כולל מים חמים), ניקוז, חשמל ותאורה; (ה) בדירה יש פתחי אוורור ומכלולים לסגירת פתחים אלו, לרבות דלת כניסה ראשית בעלת אמצעי נעילה; ו- (ו) אין בדירה גורם סיכון בלתי סביר לבריאות או לביטחון השוכר. הוראה זו הינה הוראה יסודית והפרתה תיחשב להפרה יסודית של המשכיר.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">5.2.</p>
                <p class="lrftLine">השוכר מצהיר כי טרם החתימה על הסכם זה הוא ראה ובדק את הדירה, הבניין ותנאי סביבתם, ועל אף הליקויים והפגמים המפורטים בהמשך,מצא אותם ראויים ומתאימים למטרותיו. השוכר מצהיר כי למעט כמפורט בסעיף 5 זה, הוא שוכר את הדירה כפי שהיא (As Is), והוא מוותר על כל טענה לאי-התאמה או פגם, למעט פגמים נסתרים שיש בהם משום הפרעה ממשית לשימוש בדירה ולמעט פגמים שהמשכיר התחייב לתקן בהסכם זה.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine" id="defGeneral">
                <p class="rightLine">5.3.</p>
				
				<?php
					$contents = generateApartmentContentsLine($contract['id']);
				?>
				
                <p class="lrftLine">
                    <p id="def1">ידוע למשכיר ולשוכר כי במועד החתימה על הסכם זה קיימים בדירה הליקויים והפגמים המפורטים להלן,ומוסכם על הצדדים כי הם יתוקנו על ידי המשכיר במהלך תקופה של ארבעה עשר (14) יום מיום תחילת השכירות: <span><?=$contract['repairs']?></span></p>
                    <p id="def2">ידוע למשכיר ולשוכר כי במועד החתימה על הסכם זה קיימים בדירה הליקויים והפגמים המפורטים להלן,ומוסכם על הצדדים כי המשכיר לא מתחייב לתקנם: <span><?=$contract['defects']?></span></p>
                    <p id="def3">הצדדים מאשרים כי עם מסירת החזקה בדירה לשוכר, תכולת הדירה תכלול את הפריטים ואת הציוד שלהלן ("הציוד"), והשוכר מתחייב לא להוציאם מהדירה או למסור אותם לאחרים:
                    <span><?=$contents?></span></p>
                </p>
            </div><!--ContarctLine-->
            
        </div><!--contractPage-->
        
        
        <div class="contractPage">    
            
            <h3>6. השימוש בדירה</h3>
            
            <div class="contarctLine">
                <p class="rightLine">6.1.</p>
                <p class="lrftLine">השוכר מתחייב להשתמש בדירה לצרכי מגורים בלבד ולא לכל צורך אחר. עוד מתחייב השוכר לא למסור, לשעבד או להעביר בכל דרך אחרת את זכויותיו לפי הסכם זה, או להרשות לאחרים להשתמש בדירה או בכל חלק ממנה, בתמורה או שלא בתמורה, ללא הסכמת המשכיר מראש ובכתב. הוראה זו הינה הוראה יסודית והפרתה תיחשב להפרה יסודית של השוכר.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">6.2.</p>
                <p class="lrftLine">על אף האמור בסעיף 6.1 השוכר יוכל להשכיר את הדירה בשכירות משנה ("סאבלט") לאחר קבלת הסכמה מפושרת בכתב מהמשכיר. </p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">6.3.</p>
                <p class="lrftLine">השוכר מתחייב להשתמש בדירה, על מערכותיה ותכולתה, באופן זהיר וסביר, ולשמור על ניקיונה ועל ניקיון הבניין.השוכר לא יעשה בדירה,או בכל חלק ממנה,כל שימוש אשר יכול לגרום נזק, הטרדה או רעש בלתי סבירים, וכן יציית וימלא בדייקנות את כל הוראות החוק, הוראות כל רשות מוסמכת והוראות ועד הבית.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine" id="yesPets">
                <p class="rightLine">6.4.</p>
				<?php if($contract['animals'] != 0) { ?>
					<p class="lrftLine">מוסכם כי השוכר יהיה רשאי להחזיק בדירה חיית מחמד, בכפוף לכך שהשוכר מאשר כי האמור בסעיף 6.3 לעיל יחול ויחייב אותו גם בכל הקשור להחזקת חיית המחמד.</p>
				<?php } else { ?>
					<p class="lrftLine">השוכר מתחייב שלא להכניס בעלי חיים לדירה.</p>
				<?php } ?>
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">6.5.</p>
                <p class="lrftLine">השוכר יאפשר למשכיר ולמי מטעמו להיכנס לדירה בזמנים סבירים, בתיאום מראש עם המשכיר.</p>    
            </div><!--ContarctLine-->
            
            
            <h3>7. נזקים וליקויים לדירה; שינויים בדירה</h3>
            
            <div class="contarctLine">
                <p class="rightLine">7.1.</p>
                <p class="lrftLine">המשכיר יתקן, על חשבונו, כל נזק וקלקול שסיבתם בלאי סביר, תוך זמן סביר ולא יאוחר מארבע עשר (14) ימים מדרישת השוכר בכתב, ובמקרה של תקלה שאינה מאפשרת מגורים סבירים בדירה - באופן מידי, ולא יאוחר משלושה (3) ימים מדרישת השוכר בכתב, ובלבד שניתן לבצע את התיקון במסגרת לוחות הזמנים האמורים והשוכר הודיע למשכיר על הנזק או הקלקול בסמוך לאחר גילויו. על אף האמור לעיל, המשכיר לא יהיה חייב בתיקון נזק או קלקול קלי ערך, שתיקונם אינו מצריך בדרך כלל עבודת בעל מקצוע, וכן נזק או קלקול שייגרמו לדירה ולכל חלק ממנה (לרבות הציוד), בגין שימוש לא סביר. במקרה שמי מהצדדים לא יקיים את התחייבותו לתיקון התיקונים החלים עליו, יהיה רשאי הצד השני (אך לא חייב) לבצע בעצמו את תיקונים אלו, על חשבון הצד השני.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">7.2.</p>
                <p class="lrftLine">השוכר מתחייב שלא לבצע שינויים או תוספות כלשהן במבנה הדירה ולא להוסיף לדירה כל מבנה, תוספת או שיכלול, או להסיר כל חלק מהדירה, ללא הסכמת המשכיר בכתב ומראש. מבלי לגרוע מזכות המשכיר לסעד אחר, במקרה שביצע השוכר שינויים בניגוד לאמור, יהיה רשאי המשכיר להורות לשוכר להחזיר את מצב הדירה לקדמותו על חשבון השוכר, או להורות לשוכר להותיר את השינויים, אשר יהפכו לקניין המשכיר מבלי שיהיה עליו לשלם בגינם. במקרה שהשוכר לא החזיר את מצב הדירה לקדמותו, בניגוד להוראות סעיף זה, יהיה רשאי המשכיר (אך לא חייב) לעשות כן, על חשבון השוכר. </p>    
            </div><!--ContarctLine-->
            
            
            <h3>8. מסירת הדירה ופינויה</h3>
            
            <div class="contarctLine">
                <p class="rightLine">8.1.</p>
                <p class="lrftLine">המשכיר מתחייב למסור את הדירה לשוכר, בתחילת תקופת השכירות, כשהיא פנויה וחופשייה מכל אדם וחפץ (למעט אלו המוזכרים בהסכם), במצב טוב ותקין, נקייה ומסודרת.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">8.2.</p>
                <p class="lrftLine">במועד תום תקופת השכירות או בכל מועד בו תבוא השכירות לסיומה על פי הוראות הסכם זה, יפנה השוכר את הדירה וימסור אותה בחזרה למשכיר או למי שיורה המשכיר, כשהיא פנויה וחופשייה מכל אדם וחפץ השייך לשוכר, במצב טוב ותקין, נקייה ומסודרת כפי שנמסרה לו. מוסכם, כי במקרה שהדירה נצבעה לפני תחילת תקופת השכירות, השוכר ידאג לצבוע, על חשבונו, את הדירה. במעמד פינוי הדירה, הצדדים יערכו פרוטוקול מסירת דירה אשר יהווה אסמכתא לכך שהשוכר קיים את התחייבויותיו וכי למשכיר אין טענות כלפיו.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">8.3.</p>
                <p class="lrftLine">לא פינה השוכר את הדירה בתום תקופת השכירות או עם ביטול הסכם זה, יהיה רשאי המשכיר, מבלי לגרוע מכל זכות הנתונה לו, לגבות פיצוי מוסכם בסך 300 ש"ח עבור כל יום של איחור בפינוי. במקרה של אי פנוי במועד, יהיה רשאי המשכיר או מי מטעמו להיכנס לדירה ולפנותה, בכפוף להוראות הדין. </p>    
            </div><!--ContarctLine-->
            
        </div><!--contractPage-->
        
        <div class="contractPage">      
            
            <h3>9. בטחונות</h3>
            
            <div class="contarctLine">
            
                <p class="rightLine">9.1.</p>
                <p class="lrftLine">
					<?php
						if ($contract['insurance_option']!=1){
									
									$collateralsDb = 'collaterals_p';}
									
								else{
									
									$collateralsDb = 'collaterals';
								}
								
						$collaterals = getCollaterals($contract['collaterals'],$collateralsDb); 
						echo $collaterals['description'];
					?>
				</p>    
            </div><!--ContarctLine-->            
            
            <h3>10. אחריות</h3>
            
            <div class="contarctLine">
                <p class="rightLine">10.1.</p>
                <p class="lrftLine">בכפוף להוראות כל דין, השוכר אחראי כלפי המשכיר וכלפי כל צד שלישי שהוא לכל נזק, דרישה או עילת תביעה מכל מין וסוג שהוא, לרבות נזק לגוף או לרכוש, שיגרם בקשר עם השימוש בדירה על ידי השוכר. השוכר יפצה את המשכיר וישפה אותו בגין כל נזק או הוצאה, לרבות הוצאות משפט, שייגרמו למשכיר בשל תביעה שתוגש נגד המשכיר, ככל שהתביעה נובעת מאי מילוי או הפרה של התחייבויות השוכר לפי הסכם זה או הוראות כל דין. </p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">10.2.</p>
                <p class="lrftLine">מובהר, כי אף צד אינו מתחייב לערוך ביטוחים בקשר עם נזקים לדירה, לתכולתה או לצדדים שלישיים, וכי אף צד לא יהא אחראי לנזקיו של הצד השני עקב אי קיומם של ביטוחים כאמור.</p>    
            </div><!--ContarctLine-->
        
        </div><!--contractPage-->
        
        <div class="contractPage" id="page1"> 
            
            <h3>11. שונות</h3>
            
            <div class="contarctLine">
                <p class="rightLine">11.1.</p>
                <p class="lrftLine">המבוא להסכם זה מהווה חלק בלתי נפרד ממנו.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">11.2.</p>
                <p class="lrftLine">על הסכם זה ועל הדירה לא יחולו הוראות חוק הגנת הדייר (נוסח משולב) תשל"ב – 1972 (להלן: "חוק הגנת הדייר"), התקנות מתוקפו או כל חוק או תקנה שיבואו במקומם, והשוכר מוותר בזאת על כל טענה, דרישה או עילת תביעה מכוחם. הצדדים מאשרים כי השוכר לא שילם כל תשלום כדמי מפתח עבור הדירה, לא השתתף ולא ישתתף בחלק כלשהו בהוצאות הבניה של הדירה, וכי הסכם זה אינו יוצר ולא ייצור יחסים המקנים זכות כלשהי לקבלת דמי מפתח לפי חוק הגנת הדייר או כל חוק אחר שיבוא במקומו. </p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">11.3.</p>
                <p class="lrftLine">המשכיר רשאי להעביר לאחר את זכויותיו בדירה, כולן או חלקן, ללא צורך בהסכמת השוכר, ובלבד שיודיע על כך לשוכר מראש ושלא יפגעו זכויות השוכר על פי הסכם זה עקב העברת הזכויות.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">11.4.</p>
                <p class="lrftLine">אם יקבע כי הוראה מהוראות ההסכם הינה בלתי אכיפה או בטלה מסיבה כלשהי לא יהיה בכך כדי לפגוע ביתר הוראותיו של ההסכם, והצדדים יפעלו על מנת ליישם את ההסכם כרוחו וכלשונו, לרבות החלפת ההוראה הבלתי אכיפה או בטלה כאמור בהוראה חלופית שתוצאתה ופעולתה זהות בעיקרן.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">11.5.</p>
                <p class="lrftLine">הסכם זה קובע באופן בלעדי את תנאי ההתקשרות בין הצדדים ולא יחולו עליהם הסכמים או הסדרים אחרים, מכל סוג, בין בכתב ובין בעל פה. כל שינוי, ויתור או מתן ארכה לא יהיה להם תוקף אלא אם נערכו בכתב ונחתמו על-ידי הצדדים. ויתר צד להסכם על קיום הוראה מהוראות הסכם זה, יהא ויתור זה חד פעמי ולא יהווה תקדים לוויתור על קיום כל הוראה שהיא.</p>    
            </div><!--ContarctLine-->
                
            <div class="contarctLine">
                <p class="rightLine">11.6.</p>
                <p class="lrftLine">כתובות הצדדים לצרכי הסכם זה הם כמפורט במבוא או כל כתובת אחרת עליה יודיעו הצדדים. כל הודעה ששלח צד להסכם תיחשב כאילו הגיעה לצד השני תוך שלושה (3) ימי עסקים - אם שוגרה בדואר רשום; בעת מסירתה ובלבד שנתקבל אישור מסירה - אם נמסרה ביד; או ביום העסקים הראשון שלאחר מועד שליחתה ובלבד שנתקבל אישור על קבלתה - באם נמסרה בפקסימיליה.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">11.7.</p>
                <p class="lrftLine">במקרה שלפי הסכם זה הדירה מושכרת למספר שוכרים, יחולו על כל אחד מהם כל הוראות הסכם זה, וכולם יחדיו ייחשבו כ"שוכר". התחייבויות כספיות יחולקו בין המשכירים לפי המוסכם ביניהם, ובלבד שכל התשלומים לפי הסכם זה ישולמו במלואם ובמועדם.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">11.8.</p>
                <p class="lrftLine">הצדדים מאשרים כי הסכם זה ייחתם בחתימה אלקטרונית, באמצעות אתר iagree.co.il וכי עותקים חתומים שלו יוחזקו על ידי כל אחד מהצדדים.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">11.9.</p>
                <p class="lrftLine">על הסכם זה יחולו דיני מדינת ישראל. סמכות השיפוט הייחודית והבלעדית בכל מחלוקת שתתעורר בין הצדדים תהא נתונה לבית המשפט המוסמך במחוז השיפוט שבה ממוקמת הדירה. </p>    
            </div><!--ContarctLine-->
        
            
            <h2>ולראייה באו הצדדים על החתום:</h2>
            
            <p><strong>המשכיר</strong></p>
            
            <div class="landlordContainer">
            
                <div class="landlordBox">
                
                    <div class="ll">
                        <p class="llRight">מר / גב'</p> 
                        <p class="llLeft"> <span><?=($contract['landlord'][0]['first_name'] . " " . $contract['landlord'][0]['last_name'])?></span> </p>
                    </div><!--ll-->
                        
                     <div class="ll">
                        <p class="llRight">ת.ז</p> 
                        <p class="llLeft"> <span><?=$contract['landlord'][0]['identity_number']?></span> </p>
                     </div><!--ll-->
                    
                     <div class="ll">
                        <p class="llRight">מרחוב</p> 
                        <p class="llLeft"> <span><?=$contract['landlord'][0]['address']?></span> </p>
                     </div><!--ll-->
                     
                     <div class="ll">
                        <p class="llRight">טלפון</p> 
                        <p class="llLeft"> <span><?=$contract['landlord'][0]['phone']?></span> </p>
                     </div><!--ll-->
                  
                 <?    
                     if($contract['landlord'][0]['signature']){ 
				?>
                     
                     <div class="mySignature">
                     
                     	<img src="<?=$contract['landlord'][0]['signature']?>">
                     
                     </div><!--mySignature-->
                     
                 <?
					 }
					 
				?>
                     
                 </div><!--landlordBox-->
                 
             </div><!--landlordContainer-->
                
            
            <p><strong>השוכר/ים</strong></p>

            
            <div class="tenants">
            
				<?php
					$i = 1;
					foreach($contract['tenant'] as $tenant) {
						$tenantUser = getUserByEmail($tenant['email']);
				?>
                <div class="tenant" id="tenant<?=$i?>2">
                    
                    <div class="ll">
                        <p class="llRight">מר / גב'</p> 
                        <p class="llLeft"> <span><?=($tenantUser['first_name'] . " " . $tenantUser['last_name'])?></span> </p>
                    </div><!--ll-->
                        
                     <div class="ll">
                        <p class="llRight">ת.ז</p> 
                        <p class="llLeft"> <span><?=$tenantUser['identity_number']?></span> </p>
                     </div><!--ll-->
                    
                     <div class="ll">
                        <p class="llRight">מרחוב</p> 
                        <p class="llLeft"> <span><?=$tenant['address']?></span> </p>
                     </div><!--ll-->
                     
                     <div class="ll">
                        <p class="llRight">טלפון</p> 
                        <p class="llLeft"> <span><?=$tenant['phone']?></span> </p>
                     </div><!--ll-->
                 
				 <?    
                     if($tenant['signature']){ 
				?>    
                     
                     <div class="mySignature">
                     
                     	<img src="<?=$tenant['signature']?>">
                     
                     </div><!--mySignature-->
                     
                <?
					 }
					 
				?>
                    
                </div><!--tenant<?=$i?>-->
				<?php
						$i++;
					}
				?>
            
            </div><!--tenants-->
            
        </div><!--contractPage-->       
 
        
<!---------------------------------------------------------------
							Guarantee Bill
---------------------------------------------------------------->
        
        
        <div class="contractPage" id="guaranteeBill">
        
            <h1>נספח א' – שטר חוב וערבים</h1>
            <p>(יש להדפיס , להחתים ולמסור במועד מתן ההמחאות)</p>
            
            <h2>שנערך  ונחתם בעיר <span id="city2"></span>בתאריך <span id="date4"></span></h2>
            
            <div class="contarctLine">
                <p class="rightLine">א.</p>
                <p class="lrftLine">אני הח"מ ת.ז.  מתחייב לשלם לפקודת  ת.ז. סך של ______________ ₪ (במילים: ___________________ ₪ ) ("סכום השטר"), צמוד למדד המחירים לצרכן המתפרסם על ידי הלשכה המרכזית לסטטיסטיקה הידוע ביום החתימה על שטר חוב זה, קרי המדד לחודש ______ שנת_____ (להלן: "המדד הבסיסי"), ומוסכם עלי כי אם ירד המדד הידוע לפני התשלום בפועל לעומת המדד הבסיסי, סכום השטר וכל תשלום לפיו יהיו נקובים לפי המדד הבסיסי.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">ב.</p>
                <p class="lrftLine">שטר זה ניתן להסבה ו/או להעברה.</p>    
            </div><!--ContarctLine-->
            
            <div class="contarctLine">
                <p class="rightLine">ג.</p>
                <p class="lrftLine">המחזיק בשטר זה פטור מכל חובות המוטלות על מחזיק בשטר, לרבות הצגת השטר לפירעון, פרוטסט וממשלוח הודעת אי-כיבוד, והח"מ מוותרים על כל טענה או תביעה בקשר עם האמור.</p>    
            </div><!--ContarctLine-->
            
            <div class="horizontalSig">
                <p></p>
                <p></p>
                <p></p>
                <p></p>  
            </div><!--ContarctLine-->
            
            <div class="horizontalSig" id="HSlower">
                <p>שם השוכר – עושה השטר</p>
                <p>ת.ז</p>
                <p>כתובת</p>
                <p>חתימת השוכר – עושה השטר</p>  
            </div><!--ContarctLine-->
            
            <div class="horizontalSig">
                <p></p>
                <p></p>
                <p></p>
                <p></p>  
            </div><!--ContarctLine-->
            
            <div class="horizontalSig" id="HSlower">
                <p>שם השוכר – עושה השטר</p>
                <p>ת.ז</p>
                <p>כתובת</p>
                <p>חתימת השוכר – עושה השטר</p>  
            </div><!--ContarctLine-->
            
            <div class="horizontalSig">
                <p></p>
                <p></p>
                <p></p>
                <p></p>  
            </div><!--ContarctLine-->
            
            <div class="horizontalSig" id="HSlower">
                <p>שם השוכר – עושה השטר</p>
                <p>ת.ז</p>
                <p>כתובת</p>
                <p>חתימת השוכר – עושה השטר</p>  
            </div><!--ContarctLine-->   
        
        
            <h1>ערבות אוואל</h1>
                
            <div class="contarctLine">
        <!--    	<p class="rightLine"></p>-->
                <p class="lrftLine">אנו הח"מ ערבים בזה, ביחד ולחוד, בערבות אוואל מוחלטת, בלתי חוזרת ואשר מוגבלת בסך של ______________ ש"ח (במילים: ___________________ ש"ח), כלפי __________________, ת.ז. _______________ ("המשכיר"), למילוי כל התחייבויות החתום/מים מעלה כלפי המשכיר ולפירעון שטר חוב זה. ידוע לי/לנו כי מתן ערבותי/נו זו הינה מוחלטת ובלתי חוזרת ואינה ניתנת לביטול, לשינוי או להעברה, אלא אם תתקבל הודעה בכתב מהמשכיר בדבר שחרור מהערבות. אנו מוותרים על כל דרישה תחילה מהחתומים מעלה או מהשוכר, ומסכימים כי סעיפים 15(א) והסייג שבסעיף 8 לחוק הערבות, תשכ"ז-1967 לא יחולו עלינו.</p>    
            </div><!--ContarctLine-->
            
            
            <div class="horizontalSig">
                <p></p>
                <p></p>
                <p></p>
                <p></p>  
            </div><!--ContarctLine-->
            
            <div class="horizontalSig" id="HSlower">
                <p>שם הערב</p>
                <p>ת.ז</p>
                <p>כתובת</p>
                <p>חתימת הערב</p>  
            </div><!--ContarctLine-->
            
            <div class="horizontalSig">
                <p></p>
                <p></p>
                <p></p>
                <p></p>  
            </div><!--ContarctLine-->
            
            <div class="horizontalSig" id="HSlower">
                <p>שם הערב</p>
                <p>ת.ז</p>
                <p>כתובת</p>
                <p>חתימת הערב</p>  
            </div><!--ContarctLine-->   
       
        </div><!--contractPage-->
        
 
</body>
</html>