<!doctype html>
<html>
<head>

</head>


<body>
	
<div class="navBar">
        
	<div class="navCell" id="logo">
            
        <a href="../index.php"><img src="../img/IAgreeLogoSmall.png" alt="iAgree.co.il | הופכים את חוויית שכירת הדירות בישראל לפשוטה ונעימה."></a>
        
    </div><!--navCell-->
    
    
    <div class="navCell" id="blank">
    
    </div><!--navCell-->
    
    <div class="navCell" id="userLogin">
    
    	<a href="../create_contract.php" id="newContract">צור חוזה<span class="noMobile"> חדש</span></a>	

<!--		<a style="direction:ltr" href="#" id="newContract">...Coming Soon</a>	-->

		<a href="../login.php?location=<?=$_SERVER['PHP_SELF']?>">כניסה<span class="noMobile"> למשתמש רשום</span></a>
                
    </div><!--navCell-->
    

    
    <div class="navCell" id="userLogout">
    
<!--    	<a href="create_contract.php" id="newContract">צור חוזה<span class="noMobile"> חדש</span></a>	-->

		<a style="direction:ltr" href="#" id="newContract">...Coming Soon</a>
        
        <a onClick="togglePersonalArea()">
			<?php if(isset($user['profile_image_url'])) { ?><img class="gplus" src="<?=$user['profile_image_url']?>"><?php } ?>
			<?=$user['name']?>
		</a>
        
    </div><!--navCell-->
    
    

</div><!--navBar-->

	<div class="personalArea">
    
        <a href="../my_contracts.php">החוזים שלי</a>
        <a href="change_password.php">שינוי סיסמה</a>
        <a href="../logout.php">התנתק</a>
    
    </div><!--personalArea-->

<script>

function togglePersonalArea(){
	$('.personalArea').slideToggle();
}	

</script>

</body>
</html>
