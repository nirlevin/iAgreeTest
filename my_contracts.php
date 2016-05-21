<?php
    session_start();
	
    if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
    } else {
		header('Location: login.php?location=' . urlencode($_SERVER['REQUEST_URI']));
	}
	
	include("services.php");
	
//MY logics of progress bar and action button.
	
	
		
	$rid = isset($_GET['rid']) ? basicParse($_GET['rid']) : null;
	$submitContract = isset($_GET['submitContract'])? basicParse($_GET['submitContract']) : 0;
	$contractId = isset($rid) ? getContractIdByRandomId($rid) : null;
	$contract = getContractById($contractId);
		
	
	if(isset($_POST['newTenant'])){
		
		$partiesArray[] = array ('email' => $_POST['newTenant'], 'role' => 'tenant');
		$partiesEmails[] = $_POST['newTenant'];
		
		addParties($contractId, $partiesArray);
		
		$screeningRequestSent = sendTenantsScreeningRequest($user, $contract, $partiesEmails);
		
		if($screeningRequestSent){
			
			$tenantData = array (
				'screen_request_sent' => 1
			);
			
			$result = 0;			
			$result = updateParty($contractId, $_POST['newTenant'], $tenantData);
			
		}
			
		if($result){Header('location:my_contracts.php');}
	}
	
	
	if ($submitContract){
		
		$tenantEmail = isset($_GET['tenantEmail'])? basicParse($_GET['tenantEmail']) : null; 
		$tenantUserTemp = getUserByEmail($tenantEmail);
		$tenant = getPartyByEmailAndContractId($tenantEmail, $contractId);
		
		$contractSent = 0;
		$contractSent = sendContractToTenant($tenantUserTemp, $contract);
		
		if ($contractSent){
			
			$tenantData = array (
				'contract_submitted' => 1
			);
			
			$result = 0;
			
			$result = updateParty($contractId, $tenantEmail, $tenantData);
		
			if ($result){header("Location: my_contracts.php");}
			
		}
		
	}
	
	
	if(isset($_GET['agreed'])){
	
		$email = basicParse($_GET['tenantEmail']);
//		$contractId = basicParse($_GET['contractId']);
		
		 
		
		
		if (!$tenant['contract_submitted']){
		
			$creatorData = array (
				'contract_approved' => 1, 
				'contract_submitted' => 1
			);
			
			sendContractToTenant($tenant, $contract);
			
		}
		
		$result = 0;
		$result = updateParty($contractId, $email, $creatorData);
		
		if ($result){header("Location: my_contracts.php");}
	
	}
	
	
	/* Send the contract to all parties */
	if(isset($_POST['remind'], $_POST['rid'])) {

		$rid = basicParse($_POST['rid']);
		$contractId = getContractIdByRandomId($rid);
		$contract = getContractById($contractId);

		if(isset($user) && isset($contract)) {
			$partiesArray = getPartiesByContractId($contract['id']);
			
			/* Prepare a list of emails of all recipients */
			foreach($partiesArray as $party) {
				$partiesEmails[] = $party['email'];
			}
			
			/* Send the contract to all parties while identified as the logged-in user */
			$reminderMailSent = sendContractToParties($user, $contract, $partiesEmails);
		}
		
	}
	
?><!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1">
<title>iAgree.co.il | החוזים שלי</title>
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

<section class="myContracts" id="section2">

	<div class="wrapper" id="myContracts">
    
		<h1><span>החוזים שלי</span></h1>
        
        <?php
		
//			$j=1;
			
			/* Retrieve all contracts related to the logged-in user */
			if($partiesArray = getPartiesByEmail($user['email'])) {
				foreach ($partiesArray as $party) {
					$contract = getContractById($party['contract_id']);
					$thisContractPartiesArray = getPartiesByContractId($party['contract_id']);
					
					if($thisContractPartiesArray != null && $contract != null) {

						/* Check if all parties have agreed on the contract */
						$allPartiesAgreed = true;
						foreach($thisContractPartiesArray as $p) {
							$allPartiesAgreed = ($allPartiesAgreed & $p['contract_agreed']);
						}
						
						/* Check if all tenants have signed on the contract */
						$i = 0;
						$allTenantsSigned = true;
						foreach($thisContractPartiesArray as $p) {
							if ($p['role'] == 'tenant'){
																
								$allTenantsSigned = ($allTenantsSigned & $p['contract_signed']);
								$i++;
								
							}
						}
	
						foreach($thisContractPartiesArray as $p) {
							$contract[$p['role']][] = $p;
						}

						$contractSentToHelloSign = (!empty($contract['hellosign_guid']));
						
						
		?>
        
        
        <div class="contractBox">
        
        	<div class="firstRow">
            
            	<div class="firstRowCell" id="propertyAddress">
                
                	<h3><img src="img/iAgree_homeGreen.png"><?=($contract['street'] . ' ' . $contract['building'] . " דירה " . $contract['apartment'] . ", " . $contract['city'])?><span> (<?= $contract['id']?>)</span></h3>
                
                </div><!--firstRowCell-->
                
                <div class="firstRowCell" id="contractImg">
                
                	<img src="img/iAgree_star<?=$contract['insurance_option']?>.png">
                
                </div><!--firstRowCell-->
                
                <div class="firstRowCell" id="propertyLinks">
				
				<?
				
				if (($allTenantsSigned) && ($i>0)){
				
				?>
				
					<a id='signContract' href="sign_contract.php?rid=<?=$contract['rid']?>">חתום על החוזה</a>	

				<? 
				
				}else{
					
				?>
                
                	<a href="view_contract.php?rid=<?=$contract['rid']?>"><img src="img/iAgree_view.png">צפה בחוזה</a>
                
				<?
				
				}
	
				if($party['can_edit'] == true){
				
				?>
					<a href="edit_contract.php?rid=<?=$contract['rid']?>"><img src="img/iAgree_edit.png">ערוך</a>
						
						<?php if($allPartiesAgreed == false) { ?>
						
							<a id="sendMemo" onClick="sendMemo(<?=$contract['id']?>)"><img src="img/iAgree_alarm.png">שלח תזכורת</a>
							<img id="memoImg" src="img/iAgree_ok.png">
							<form id="memoForm<?=$contract['id']?>" method="post">
								<input type="hidden" name="remind">
								<input type="hidden" name="rid" value="<?=$contract['rid']?>">
							</form>
							
						<?php } 
						
						}
				?>
               
                
                </div><!--firstRowCell-->
            
            </div><!--firstRow-->
            
            
            <p><img  src="img/iAgree_tenants.png">שוכרים</p>
            
            
           
            <?php // Start of tenant auto fill
			
				if(!empty($contract['tenant'])){	
								
					$i = 1;
					foreach($contract['tenant'] as $tenant){
						
			?>
            
                     <div class="secondRow">
                    
                        <div class="secondRowCell tenantName" id="ten<?=$i?>Email">
                                
			<?php
						
							$tenantUser = getUserByEmail($tenant['email']);
							
							if($tenantUser != NULL){
						
			?>
					
								<p><?=$tenantUser['first_name'] . " " . $tenantUser['last_name']?></p>
						
			<?php
						
							}else{
					
			?>
                
                				<p><?=$tenant['email']?></p>
                            
            <?php	
							
							}
										
			?>
                
                	</div><!--secondRowCell-->
                    
                    
                    <div class="secondRowCell" id="nextAction">
                    
                    	<p class="pTitle">פעולה הבאה:</p>
                        
			<?php
			
					if ($tenant['contract_signed']){
						
			?>            
                      <p class="pAction pActionGrey">החוזה נחתם<br>בהצלחה</p>
                                
            <?        }elseif ($tenant['contract_submitted']){
						
			?>            
                        <p class="pAction pActionGrey">ממתין לחתימת<br>השוכר</p>
                                
			<?			}elseif ($tenant['screening_approved'] == 1){
							
			?>
                        	<p class="pAction"><a href="my_contracts.php?tenantEmail=<?=$tenantUser['email']?>&rid=<?=$contract['rid']?>&submitContract=1">הפץ חוזה<br>לחתימה</a></p>
            
			<?				}elseif ($tenant['screening_complete']){
							
			?>
								<p class="pAction"><a href="tenant_profiling.php?tenantEmail=<?=$tenantUser['email']?>&rid=<?=$contract['rid']?>">צפה בפרופיל<br>שוכר</a></p>
                                
			<?					}else{
							
			?>          
									<p class="pAction pActionGrey">ממתין לאישור<br>השוכר</p>
                                
			<?					}
									
			?>  
                    
                    </div><!--secondRowCell-->
                    
                    
                    <div class="secondRowCell process" id="">
                
                    <div class="progressNumbers">
                    
                        <div class="spaceCell spaceCellEdge"></div>
                        
					
                            <div class="numberCell ncGreen" id="numberCell1"><h3>1</h3></div>
                            <div class="spaceCell scGreen" id="spaceCell1"><hr></div>
                            
                     
						<?php
						
                             if ($tenant['screen_request_approved']){ ?>
                             
                             	<div class="numberCell ncGreen" id="numberCell2"><h3>2</h3></div>
                        		<div class="spaceCell scGreen" id="spaceCell2"><hr></div>
                             
                        <?php } else { ?> 
                        
                        
                        	<div class="numberCell" id="numberCell2"><h3>2</h3></div>
                        	<div class="spaceCell" id="spaceCell2"><hr></div>
                        
                        
                        <?php } 
						
							if($tenant['screening_approved'] == (-1)){ ?> 
                            
                            
                                <div class="numberCell ncRed" id="numberCell3"><h3>3</h3></div>
                                <div class="spaceCell" id="spaceCell3"><hr></div>
						
						<?php } elseif ($tenant['screening_complete']){ ?>
                             
                             	<div class="numberCell ncGreen" id="numberCell3"><h3><a href="tenant_profiling.php?tenantEmail=<?=$tenantUser['email']?>&contractID=<?=$contract['id']?>">3</a></h3></div>
                        		<div class="spaceCell scGreen" id="spaceCell3"><hr></div>                        
						
						<?php }else { ?> 
                            
                                <div class="numberCell" id="numberCell3"><h3>3</h3></div>
                                <div class="spaceCell" id="spaceCell3"><hr></div>
								
						<? }
											
							if ($tenant['contract_submitted']){	?>
							
								<div class="numberCell ncGreen" id="numberCell4"><h3>4</h3></div>
                        		<div class="spaceCell scGreen" id="spaceCell4"><hr></div>	
								
						<?php }else { ?>
						
								<div class="numberCell" id="numberCell4"><h3>4</h3></div>
                        		<div class="spaceCell" id="spaceCell4"><hr></div>
						
						<?php }
						
							if ($tenant['contract_signed']){	?>
							
								<div class="numberCell ncGreen" id="numberCell5"><h3>5</h3></div>	
								
						<?php }else { ?>
						
								<div class="numberCell" id="numberCell5"><h3>5</h3></div>
						
						<?php } ?>
                        
                        		<div class="spaceCell spaceCellEdge"></div>
                    
                    </div><!--progressNumbers-->
                    
                    
                    <div class="progressText">
                    
                        <div class="progressTextCell" id="progressTextCell1">
                        
									<p>בקשה נשלחה</p>								
                            
                        </div><!--progressTextCell-->
                        
                        
                        <div class="progressTextCell" id="progressTextCell2">
                        
                            <?php
								
								if ($tenant['screen_request_approved']){ ?>
                                
                                	<p>שוכר אישר</p>
                                    
                            <?php } else {?>
									<p>ממתין לאישור<br>שוכר</p>
								
							<?php } ?>
                            
                        </div><!--progressTextCell-->
                        
                        
                        <div class="progressTextCell" id="progressTextCell3">
                        
                            <?php
								
								if ($tenant['screening_approved']==(-1)) { ?>    
								
									<p><a href="tenant_profiling.php?tenantEmail=<?=$tenantUser['email']?>&contractId=<?=$contract['id']?>">שוכר אינו<br>מאושר</a></p>
								
							<? } elseif ($tenant['screening_complete']){ ?>
                                
                                	<p><a href="tenant_profiling.php?tenantEmail=<?=$tenantUser['email']?>&contractId=<?=$contract['id']?>">פרופיל מוכן</a></p>
                                    
                            <?php } else {							
							
								 if ($tenant['screen_request_sent']){ ?>
									<p>ממתין לבניית<br> פרופיל</p>
								
							<?php } else { ?>    
								
									<p>פרופיל שוכר</p>
								
							<?php } 
							
							}?>
                            
                        </div><!--progressTextCell-->
                        
                        
                        <div class="progressTextCell" id="progressTextCell4">
                        
                        	<?php 
						
							if ($tenant['contract_submitted']){	?>
                            
                            	<p>חוזה נשלח</p>
                                
                            <?php } else { ?>
										
										<p>הפצת חוזה</p>
										
							<?php 
									
							} ?>
                            
                        </div><!--progressTextCell-->
                        
                        
                        <div class="progressTextCell" id="progressTextCell5">
                        
                           <?php 
						
							if ($tenant['contract_signed']){	?> 
							
                            	<p>חוזה נחתם</p>
							
							<?php } else { if ($tenant['contract_submitted']){	?>
                                
                                    <p style="font-size:1.2em;">ממתין לחתימת<br>השוכר</p>
                                    
                                <?php } else {	?>
                                
                                    <p>חתימת חוזה</p>
                                    
                                <?php } 
								
							}?>
                                
                        </div><!--progressTextCell-->
    
                    
                    </div><!--progressText-->            
                    
            
            	</div><!--secondRow-->
            
            <?php
			
				}
				
			}	
			?>
            
           
            
            
            <div class="secondRow" id="newTenantRow">

	           	<form id="newTenantForm" action="my_contracts.php?rid=<?=$contract['rid']?>" method="post" enctype="multipart/form-data">
            
            		<div class="secondRowCell tenantName newTenant">
           
						<input id='newTenant' name="newTenant" type="text" placeholder='כתובת דוא"ל' onClick="$(this).removeClass('redInput');">
                        <p>כתובת הדוא"ל אינה תקינה</p>
				
                	</div><!--secondRowCell-->
                
                
                	<div class="secondRowCell" id="nextAction">
                
                    	<p class="pTitle">פעולה הבאה:</p>
                    
					   	<p onClick="sendScreeningRequest('newTenantForm')" class="pAction">שלח בקשה<br>ליצירת פרופיל</p>
                        
                    </div><!--secondRowCell-->
                
                
                
                
                <div class="secondRowCell process" id="">
                
                    <div class="progressNumbers">
                    
                        <div class="spaceCell spaceCellEdge"></div>    
                            
                        <div class="numberCell" id="numberCell1"><h3>1</h3></div>
                        <div class="spaceCell" id="spaceCell1"><hr></div>                        
                    
                        <div class="numberCell" id="numberCell2"><h3>2</h3></div>
                        <div class="spaceCell" id="spaceCell2"><hr></div>
                        
                        <div class="numberCell" id="numberCell3"><h3>3</h3></div>
                        <div class="spaceCell" id="spaceCell3"><hr></div>
                    
                        <div class="numberCell" id="numberCell4"><h3>4</h3></div>
                        <div class="spaceCell" id="spaceCell4"><hr></div>
                        
                        <div class="numberCell" id="numberCell5"><h3>5</h3></div>  
                                              
                        <div class="spaceCell spaceCellEdge"></div>
                    
                    </div><!--progressNumbers-->
                    
                    
                    <div class="progressText">
                    
                        <div class="progressTextCell" id="progressTextCell1">  
								
							<p>שליחת בקשה</p>
                            
                        </div><!--progressTextCell-->
                        
                        
                        <div class="progressTextCell" id="progressTextCell2">
                        
                            <p>אישור שוכר</p>
                            
                        </div><!--progressTextCell-->
                        
                        
                        <div class="progressTextCell" id="progressTextCell3">
                        
                            <p>פרופיל שוכר</p>
                            
                        </div><!--progressTextCell-->
                        
                        
                        <div class="progressTextCell" id="progressTextCell4">
                        
                        	<p>הפצת חוזה</p>
                            
                        </div><!--progressTextCell-->
                        
                        
                        <div class="progressTextCell" id="progressTextCell5">
                        
                           <p>חתימת חוזה</p>
                                
                        </div><!--progressTextCell-->
    
                    
                    </div><!--progressText-->
                    
                </div><!--secondRowCell-->                
                
                
                </form>
            
            </div><!--secondRow-->
            
            
            <h2 id="addTenant" onClick="addRemoveTenant();"><img src="img/iAgree_plus.png">הוסף שוכר</h2>            
            <h2 id="removeTenant" onClick="addRemoveTenant();"><img src="img/iAgree_x.png">ביטול</h2>
        
        </div><!--contractBox-->
        
        
<?php
						}
						
					}
	
				}
		
		
		$j = $j+1;
		
	?>     
            
    
		</div><!--wrapper-->

</section><!--section2-->

<section id="section3">

	<?php include 'footer.php';?>

</section><!--section3-->
	

<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>

<script>



/*****************************************************************
*    					my_contract new logic    					 *
*****************************************************************/
function addRemoveTenant(){
            
	$('#newTenantRow').fadeToggle();
	$('#addTenant').toggle();
	$('#removeTenant').toggle();
	
}
				
function sendScreeningRequest(x){
	
	var frm = document.getElementById(x);
	$('.newTenant p').hide();
	
	if(!ValidateEmail(frm.newTenant.value)){
		
		$('#newTenant').addClass('redInput');
		$('.newTenant p').fadeIn();
	
	}else{
			
		$('#newTenant').removeClass('redInput');
		frm.submit();
	}
}
			
function profiling(x,y,z){
	
	formP = document.getElementById('profilingForm');
	formP.profilingName.value = y;
	formP.profilingID.value = z;
	
	formP.submit();
		
}			





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
	
//	alert('<?=$contractSent?>');
	
	fontSize();
	user();
	
//	$('#newTenantRow').hide();
	
	$('.noShow').hide();
	$('#removeTenant').hide();
	$('.newTenant p').hide();
	
	setTimeout(refresh, 600000);
	
	
//	$('.myContractsBlue').hide();
	

});


function refresh(){
	window.location.reload(true);
}

function sendMemo(contract_id){
	$('#memoForm' + contract_id).submit();
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


	
function sendToHelloSign(contract_id){
	$('#signForm' + contract_id).submit();
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
