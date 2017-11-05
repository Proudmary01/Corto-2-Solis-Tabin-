<?php 

	// Allow the config
	define('__CONFIG__', true);

	// Require the config
	require_once "../inc/config.php"; 

	if($_SERVER['REQUEST_METHOD'] == 'POST' or 1==1) {
		// Always return JSON format
		// header('Content-Type: application/json');

		$return = [];

		

		$email = $_POST['email'] ;
		$password = $_POST['password'] ;
		$findUser = $con->prepare("SELECT user_id FROM users WHERE email='$email' and password='$password' LIMIT 1");
		

		/*$email = Filter::String( $_POST['email'] );
		$password = Filter::String( $_POST['password'] );
		$findUser = $con->prepare("SELECT user_id FROM users WHERE email = :email and password = '$password' LIMIT 1");
		$findUser->bindParam(':email', $email, PDO::PARAM_STR);*/
		

		$findUser->execute();
		if($findUser->rowCount() == 1) { //Lo encontro.

				$return['redirect'] = 'dashboard.php?message=welcome';
				$return['is_logged_in'] = true;
			// User exists 
			// We can also check to see if they are able to log in. 
			//$return['error'] = "You already have an account";
			//$return['is_logged_in'] = false;
		} else {
			//No lo encontro.
			$return['error'] = "Account doesn't exists";
			$return['is_logged_in'] = false;
		}

		echo json_encode($return, JSON_PRETTY_PRINT); exit;
	} else {
		// Die. Kill the script. Redirect the user. Do something regardless.
		exit('Invalid URL');
	}
?>
