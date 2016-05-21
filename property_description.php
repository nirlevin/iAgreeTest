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
	
	/* Format number of rooms to be 1 or 1.5 and not 1.00 */
	$contract['rooms'] = str_replace(".0", "", (string) number_format($contract['rooms'], 1, ".", ""));
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1">
<title>iAgree.co.il | תיאור הנכס</title>
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
                
                <div class="dot" id="dot2"><p></p></div>
			
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot3"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot4"><p></p></div>
				
				<div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot4"><p></p></div>
                
                <div class="dot" id="h_line"><p></p></div>
                
                <div class="dot" id="dot4"><p></p></div>
            
            </div><!--dots-->
            
            <div class="contract">
            
            	<h1>ספר לנו על הדירה</h1>
                
                <form id="form2" action="contract_creation_checkpoint.php?location=<?=urlencode('property_remarks.php')?><?=(isset($rid) ? "&rid=$rid" : "")?>" method="post"> 
                
                	<div class="rightLineBlock">
                                	
                        <div class="contractInput input48" id="city">
                            <h3>עיר:</h3>
                            <input name="city" id="cityInput" class="newInput" onChange="done(this);autocomplete2(this.value);" type="text" value=""/>
                            <img src="img/iAgree_alert.png">
                        </div><!--city-->
                        
                        <div class="contractInput input48" id="street">
                            <h3>רחוב:</h3>
                            <input id="streetInput" name="street" class="newInput" onChange="done(this)" type="text" value=""/>
                            <img src="img/iAgree_alert.png">
                        </div><!--street-->
                                            
                    </div><!--rightLineBlock#1-->
                    
                    
                    <div class="rightLineBlock">
                    
                    	<div class="contractInput" id="building">
                    <h3>מספר בית:</h3>
                    <input id="buildingInput" name="building" class="newInput newInputS" onChange="done(this)" type="text" value=""/>
                    <img src="img/iAgree_alert.png">
                </div><!--building-->
                
                <div class="contractInput" id="apartment">
                    <h3>מספר דירה:</h3>
                    <input id="apartmentInput" name="apartment" class="newInput newInputS" title="לבית פרטי הכנס 0" onChange="done(this)" type="text" value=""/>
                    <img src="img/iAgree_alert.png">
                </div><!--apartment-->
                
                <div class="contractInput" id="roomz">
                	<h3>מספר חדרים:</h3>
                    <select name="rooms" class="newInput newInputS optionGrey" id="rooms" placeholder="מספר החדרים בנכס" onChange="$('#rooms').css('color','rgb(255,255,255)'); done(this)" value="">
                        
                        <option value="" selected="noSelect" id="noSelect">בחר</option>
						
                        <option value="1">1</option>
                        <option value="1.5">1.5</option>
                        <option value="2">2</option>
                        <option value="2.5">2.5</option>
                        <option value="3">3</option>
                        <option value="3.5">3.5</option>
                        <option value="4">4</option>
                        <option value="4.5">4.5</option>
                        <option value="5">5</option>
                        <option value="5.5">5.5</option>
                        <option value="6">6</option>
                        <option value="6.5">6.5</option>
                        <option value="7">7</option>
                        <option value="7.5">7.5</option>
                        <option value="8">8</option>
                    </select>
                    <img src="img/iAgree_alert.png">
                </div><!--roomz-->
                                            
                    </div><!--rightLineBlock#2-->
                    
                    
                    <div class="rightLineBlock">
                    
                    	<h3>ריהוט קיים בדירה:</h3>
                
                        <div class="appliances">
                        
                            <img src="img/iAgree_ac.png" id="air_conditioner_toggle" onClick="homeApp('air_conditioner')">
                            <img src="img/iAgree_freezer.png" id="fridge_toggle" onClick="homeApp('fridge')">
                            <img src="img/iAgree_micro.png" id="microwave_toggle" onClick="homeApp('microwave')">
                            <img src="img/iAgree_oven.png" id="oven_toggle" onClick="homeApp('oven')">
                            <img src="img/iAgree_washer.png" id="washing_machine_toggle" onClick="homeApp('washing_machine')">
                            <img src="img/iAgree_tv.png" id="television_toggle" onClick="homeApp('television')">
                        
                        </div>
                        
                        <div class="homeApp" id="air_conditioner">
                            <p>מזגן:</p>
                            <input id="air_conditioner_exists" name="air_conditioner_exists" type="hidden" value=0>
                            
                            <input name="air_conditioner" placeholder="לדוגמא: מזגן בסלון / מיזוג מרכזי">
                        </div><!--homeApp-->
                        
                        <div class="homeApp" id="fridge">
                            <p>מקרר:</p>
                            <input id="fridge_exists" name="fridge_exists" type="hidden" value=0>
                            <input name="fridge" placeholder="לדוגמא: מקרר אמנה 200L">
                        </div><!--homeApp-->
                        
                        <div class="homeApp" id="microwave">
                            <p>מיקרוגל:</p>
                            <input id="microwave_exists" name="microwave_exists" type="hidden" value=0>
                            <input name="microwave" placeholder="לדוגמא: מיקרוגל סמסונג חדש">
                        </div><!--homeApp-->
                        
                        <div class="homeApp" id="oven">
                            <p>תנור:</p>
                            <input id="oven_exists" name="oven_exists" type="hidden" value=0>
                            <input name="oven" placeholder="לדוגמא: תנור משולב כיריים">
                        </div><!--homeApp-->
                        
                        <div class="homeApp" id="washing_machine">
                            <p>מכונת כביסה:</p>
                            <input id="washing_machine_exists" name="washing_machine_exists" type="hidden" value=0>
                            <input name="washing_machine" placeholder="לדוגמא: מכונת כביסה 7KG">
                        </div><!--homeApp-->
                        
                        <div class="homeApp" id="television">
                            <p>טלוויזיה:</p>
                            <input id="television_exists" name="television_exists" type="hidden" value=0>
                            <input name="television" placeholder='לדוגמא: טלוויזיה LG "32'>
                        </div><!--homeApp-->
                                            
                    </div><!--rightLineBlock#3-->
                    
                    
                    <div class="rightLineBlock" id="furniture">
            			
                        <div class="contractInput textInput">
                            <h3>ריהוט נוסף:</h3>
                            <textarea id="homeExtra" name="contents" class="newInput" onChange="done(this)" rows="5" maxlength="306"></textarea>
                        </div><!--furniture-->
                                        
                    </div><!--rightLineBlock#4-->
                
            	</form>
            
            </div><!--contract-->
            
            
            <div class="buttons">
            
            	<div class="prev"><a href="create_contract.php<?=(isset($rid) ? "?rid=$rid" : "")?>">הקודם</a></div>
                <div class="next"><a onClick="page3()">הבא</a></div>

            
            </div><!--buttons-->
        
        </div><!--right--
        
        --><div class="left">
        
        	<div class="notes">
            
            	<p>אתה נדרש למלא את כלל הפרטים שמופיעים בצידו הימני של המסך בתאים המתאימים.</p>
                <p>במידה וקיים ריהוט בדירה - ניתן ללחוץ על הסמל המתאים ו/או למלא תחת סעיף "ריהוט נוסף".</p>
            
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
<!--
<script>
	$(document).ready(function (){
		$("input").click(function (){
//			var thisId = $(this).get(id);
			alert($(this).attr('id'));
			$('html, body').animate({
				scrollTop: ($(this).attr('id')).offset().top
			}, 1000);
		});
	});
</script>

-->

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
	$('.homeApp').hide();
	fontSize();	
	autocomplete1();
	start();
	user();
})		

/*****************************************************************
*    						HomeApp()	    					 *
*****************************************************************/
	
function homeApp(x){
	if($('#'+x).is(':visible')){
		document.getElementById(x+'_exists').value = 0;
		$('#'+x).fadeOut();
		$('#'+x+'_toggle').css('-webkit-filter','grayscale(100%)');
		$('#'+x+'_toggle').css('filter','grayscale(100%)');}
		
	else{
		document.getElementById(x+'_exists').value = 1;
		$('#'+x).fadeIn();
		$('#'+x+'_toggle').css('-webkit-filter','none');
		$('#'+x+'_toggle').css('filter','none');
	}
}




function page3(){
	
	var a=0;
	$('.contractInput img').css('display','none');
	$('.appliances img').show();
	
	$('.helpText').css('opacity','0');
	
	if (frm.rooms.value.length == 0) {
		frm.rooms.focus();
		$('#roomz img').fadeIn();
		a=1;}
	
	if (frm.apartment.value.length == 0) {
		frm.apartment.focus();
		$('#apartment img').fadeIn();
		a=1;}
		
	if (frm.building.value.length == 0) {
		frm.building.focus();
		$('#building img').fadeIn();
		a=1;}
		
	if (frm.street.value.length == 0) {
		frm.street.focus();
		$('#street img').fadeIn();
		a=1;}
		
	if (frm.city.value.length == 0) {
		frm.city.focus();
		$('#city img').fadeIn();
		a=1;}
		
	if (a==1) {
		$('.helpText').css('opacity','1')
		reutrn(0);}
	
	frm.submit(); 
}

	

function done(z){
	if (z.value != ""){
		$(z).addClass('selected');
		$(z).closest('.contractInput').children('img').hide();}
	else{
		$(z).removeClass('selected')}	
}

function start(){
	
	frm.city.value = "<?=str_replace('"',  '\"', $contract['city'])?>";
	
	frm.street.value = "<?=str_replace('"',  '\"', $contract['street'])?>";
	
	frm.building.value = "<?=str_replace('"',  '\"', $contract['building'])?>";
	
	frm.apartment.value = "<?=str_replace('"',  '\"', $contract['apartment'])?>";
	
	frm.rooms.value = "<?=$contract['rooms']?>";
	
	frm.contents.value = "<?=str_replace('"',  '\"', $contract['contents'])?>";
	
	frm.air_conditioner_exists.value = "<?=$contract['air_conditioner_exists']?>";
	frm.air_conditioner.value = "<?=str_replace('"',  '\"', $contract['air_conditioner'])?>";
	
	frm.fridge_exists.value = "<?=$contract['fridge_exists']?>";
	frm.fridge.value = "<?=str_replace('"',  '\"', $contract['fridge'])?>";
	
	frm.microwave_exists.value = "<?=$contract['microwave_exists']?>";
	frm.microwave.value = "<?=str_replace('"',  '\"', $contract['microwave'])?>";
	
	frm.oven_exists.value = "<?=$contract['oven_exists']?>";
	frm.oven.value = "<?=str_replace('"',  '\"', $contract['oven'])?>";
	
	frm.washing_machine_exists.value = "<?=$contract['washing_machine_exists']?>";
	frm.washing_machine.value = "<?=str_replace('"',  '\"', $contract['washing_machine'])?>";
	
	frm.television_exists.value = "<?=$contract['television_exists']?>";
	frm.television.value = "<?=str_replace('"',  '\"', $contract['television'])?>";


	done(document.getElementById('cityInput'));
	done(document.getElementById('streetInput'));
	done(document.getElementById('buildingInput'));
	done(document.getElementById('apartmentInput'));
	done(document.getElementById('rooms'));
	done(document.getElementById('homeExtra'));
	checkHomeApp('air_conditioner');
	checkHomeApp('fridge');
	checkHomeApp('oven');
	checkHomeApp('microwave');
	checkHomeApp('washing_machine');
	checkHomeApp('television');
}

function checkHomeApp(x){
	
	if(document.getElementById(x+'_exists').value == 1){
		$('#'+x).fadeIn();
		$('#'+x+'_toggle').css('-webkit-filter','none');
		$('#'+x+'_toggle').css('filter','none');}	
}


function autocomplete1(){
	var myArr = [];
	$.ajax({
		type: "GET",
		url: "cities.xml", // change to full path of file on server
		dataType: "xml",
		success: parseXml,
		complete: setupAC,
		failure: function() {alert("XML File could not be found");}
	});
 
	function parseXml(xml){
     		//find every query value
			$(xml).find("row").each(function(){
			myArr.push($(this).find("city").text());
			});
	}
 
	function setupAC() {
		$("input#cityInput").autocomplete({
		source: myArr,
		minLength: 2,
		select: function(event, ui) {
		$("input#cityInput").val(ui.item.value);}
  		});	
	}
}

function autocomplete2(x){
	var myArr2 = [];
	
	$.ajax({
		type: "GET",
		url: "streets.xml", // change to full path of file on server
		dataType: "xml",
		success: parseXml2,
		complete: setupAC2,
		failure: function() {alert("XML File could not be found");}
	});
 
	function parseXml2(xml){
		 $(xml).find("ROW").each(function(){
			 var y = this;
			if (x==$(this).find("city").text()){
				myArr2.push($(y).find("street").text());}
		}); 
	}
	
	function setupAC2() {
		$("input#streetInput").autocomplete({
		source: myArr2,
		minLength: 2,
		select: function(event, ui) {
		$("input#streetInput").val(ui.item.value);}
	  });
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