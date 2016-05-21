<?php

	/**
	 * These are the email address and time-zone that will appear coming from (the sender).
	 */
	define('SENDER_EMAIL_ADDRESS', 'contact@iagree.co.il');
	
	define('WEBSITE_TIMEZONE', 'Asia/Tel_Aviv');
	
	/**
	 * The URL of our website. Shall end with a forward slash ('/').
	 */
	define('WEBSITE_URL', 'http://delta.iagree.co.il/');
	
	define('DEFAULT_LOGIN_REDIRECTION_PAGE', 'http://delta.iagree.co.il/');
		
	/**
	 * Minimum length of a user's password.
	 */
	define('USER_PASSWORD_MIN_LENGTH', 6);
	
	define('SCANNED_ID_IMAGE_MAX_SIZE_BYTES', 5000000); //5MB
	
	define('VIEW_CONTRACT_TEMPLATE_FILE', 'view_contract_mail_template.html');
	
	define('TENANT_SIGN_MAIL_TEMPLATE', 'tenant_sign_mail_template.html');
	
	define('SCREENING_REQUEST_TEMPLATE_FILE', 'screening_request_mail_template.html');
	
	define('MAX_ALLOWED_CONTRACTS_PER_USER', 20); //as party of any kind
	
?>