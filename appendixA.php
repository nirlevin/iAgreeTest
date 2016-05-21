<!doctype html>
<html>
<head>
</head>


<body>
  
		<div class="contractPage" id="appendixA">
		
			<h1>נספח א' – צילומי תעודות זהות ותמונת חתימה</h1>
            
            <h2>השוכרים</h2>
			
	<?
		$i = 1;
		foreach($contract['tenant'] as $tenant) {
			$tenantUser = getUserByEmail($tenant['email']);
	?>
			<div class="appendixRow">
			
					<h3 class="llLeft"> <span><?=($tenantUser['first_name'] . " " . $tenantUser['last_name'])?></span> </h3>
					
					<div class="AppendixImages">
					
	<? 	
					
		if($tenantUser['scanned_id']){
			
	?>
					
						<div class="AppendixImage">
						
							<img src="tempImg/<?=$tenantUser['scanned_id']?>">
						
						</div><!--AppendixImage-->
						
	<?
		}
		
		if($tenant['snapshot']){ 
	?>
					
						<div class="AppendixImage">
						
							<img src="<?=$tenant['snapshot']?>">
							
						</div><!--AppendixImage-->
						
	<?
		}
	?>
					
					</div><!--AppendixImages-->
			
			</div><!--appendixRow-->
			
	<?
		$i++;
		}
	?>
		

		<h2>המשכיר</h2>
		
		<div class="appendixRow">
		
	<?
		$landlordUser = getUserByEmail($contract['landlord'][0]['email']);
	?>
			
					<h3 class="llLeft"> <span><?=($landlordUser['first_name'] . " " . $landlordUser['last_name'])?></span> </h3>
					
					<div class="AppendixImages">
					
	<? 				
		if($landlordUser['scanned_id']){
			
	?>
					
						<div class="AppendixImage">
						
							<img src="tempImg/<?=$landlordUser['scanned_id']?>">
						
						</div><!--AppendixImage-->
						
	<?
		}
		
		if(landlordUser){ 
	?>
					
						<div class="AppendixImage">
						
							<img src="<?=$contract['landlord'][0]['snapshot']?>">
							
						</div><!--AppendixImage-->
						
	<?
		}
	?>
					
					</div><!--AppendixImages-->
			
			</div><!--appendixRow-->
		
		</div><!--appendixA-->
</body>
</html>