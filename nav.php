<?php

	session_start();
	
	if(isset($_POST['super_user'])) {
		$_SESSION['super_user'] = $_POST['super_user'];}
		
	if (!($_SESSION['super_user'] == '7193931' || $_SESSION['super_user'] == '6855661' || $_SESSION['super_user'] == '7701434')){
	
		$super_user_ok = 1;
		
	}else {
		
		$super_user_ok = 0;
		
	}
		

?>
<!doctype html>
<html>
<head>

</head>


<body>

<?php

	if ($super_user_ok){?>
		<div class="popupContainerSU">

		<div class="popupBlock">
        
        	<div class="popupBox" id="popupBoxComments">
				
				<form id="superUser" method="post">
				
					<div class="rightLineBlock">
						
					<div class="contractInput textInput" id="comments">
						
							<input name="super_user" class="newInput newInputM" value=""></input>
							
						</div><!--comments-->
                                        
					</div><!--rightLineBlock#3-->
					
					<a onClick="document.getElementById('superUser').submit()">אשר</a>	
				
				</form>
				
				
			
			</div><!--popupBox-->
		
		</div><!--popupBlock-->		

	</div><!--popupContainerSU-->
    
<?php 
	}
?>
	
<div class="navBar">
        
	<div class="navCell" id="logo">
            
        <a href="index.php"><img src="img/IAgreeLogoSmall.png" alt="iAgree.co.il | הופכים את חוויית שכירת הדירות בישראל לפשוטה ונעימה."></a>
        
    </div><!--navCell-->
    
    
    <div class="navCell" id="blank">
    
    </div><!--navCell-->
    
    <div class="navCell" id="userLogin">
    
    	<a href="create_contract.php" id="newContract">צור חוזה<span class="noMobile"> חדש</span></a>	

<!--		<a href="#" id="newContract">...Coming Soon</a>	-->

		<a href="login.php?location=<?=$_SERVER['PHP_SELF']?>">כניסה<span class="noMobile"> למשתמש רשום</span></a>
                
    </div><!--navCell-->
    

    
    <div class="navCell" id="userLogout">
    
    	<a href="create_contract.php" id="newContract">צור חוזה<span class="noMobile"> חדש</span></a>	

<!--		<a href="#" id="newContract">...Coming Soon</a>	-->
        
        <a onClick="togglePersonalArea()">
			<?php if(isset($user['profile_image_url'])) { ?><img class="gplus" src="<?=$user['profile_image_url']?>"><?php } ?>
			<?=$user['name']?>
		</a>
        
    </div><!--navCell-->
    
    

</div><!--navBar-->

	<div class="personalArea">
    
        <a href="my_contracts.php">החוזים שלי</a>
        <a href="site-login/change_password.php">שינוי סיסמה</a>
        <a href="logout.php">התנתק</a>
    
    </div><!--personalArea-->

<script>

function togglePersonalArea(){
	$('.personalArea').slideToggle();
}	

</script>

</body>
</html>
