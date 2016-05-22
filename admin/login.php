<html>
<head>
	<meta charset="visual">
	<meta http-equiv="Content-Language" content="he">
	<meta http-equiv="Content-Script-Type" content="text/vbscript">
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-8">
	
	<title>iAgree Admin Login</title>
	<script>
	<!--
	function open_window(myurl,sizable,wl,wh)
		{
			myWindow = window.open(myurl, 'myWindow', 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable='+sizable+',width='+wl+',height='+wh);
			if (! ((navigator.appName == 'Microsoft Internet Explorer') && (parseInt(navigator.appVersion.substring(0, 1), 10) < 4)) )
			myWindow.focus();
		}
	 // End -->	
	</script>
	
	<style>
		.login-table {
			border: 1px solid DarkGray;
			background-color: Whitesmoke;
			font-family: Calibri, Consolas, Tahoma;
			color: Gray;
			margin: 2em;
			padding: 1em;
		}
		
		.login-table td {
			padding: 0.5em;
			text-align: center;
		}
		
		input[type='text'], input[type='password'], input[type='submit'] {
			padding: 0.2em;
			font-family: Calibri, Consolas, Tahoma;
			font-size: 1.05em;
		}
	</style>
	
</head>

<body>

	<center>
	
		<form action="index.php" method="post">
			<table class="login-table" cellspacing="0" cellpadding="6" border="0">
				<tr>
					<td><input type="text" name="username" placeholder="Username" size="40"></td>
				</tr>
				<tr>
					<td><input type="password" name="password" placeholder="Password" size="40"></td>
				</tr>
				<tr>
					<td><input type="Submit" value="Login"></td>
				</tr>
			</table>
		</form>
		
	</center>

</body>
</html>
