<?php

	include_once('../SystemClasses/Admin.php');
	$Connection = Connection::get_DefaultConnection();

	$user = 'demo';
	$pass = 'demo';
	
	
	$resp = array('accessGranted' => false, 'errors' => ''); // For ajax response
	
	if($user == 'demo')
	{
		$given_username = 'wilson';
		$given_password = '123';
		echo $given_username;
		if ($Admin = Admin::GetObjectByUserName($Connection,$given_username)){
			var_dump($Admin);
			if ($Admin->ComparePassword($given_password)){
				session_start();
				$_SESSION['CurrentUserId'] = $Admin->get_Id();
		        $resp['accessGranted'] = true;
				setcookie('failed-attempts', 0);
			}
			else
			{
				// Failed Attempts
				$fa = isset($_COOKIE['failed-attempts']) ? $_COOKIE['failed-attempts'] : 0;
				$fa++;
				
				setcookie('failed-attempts', $fa);
				
				// Error message
				$resp['errors'] = '<strong>Invalid login!</strong><br />Please enter valid username and password.<br />Failed attempts: ' . $fa;
			}
		}
		else
		{
			// Failed Attempts
				$fa = isset($_COOKIE['failed-attempts']) ? $_COOKIE['failed-attempts'] : 0;
				$fa++;
				
				setcookie('failed-attempts', $fa);
				
				// Error message
				$resp['errors'] = '<strong>Invalid login!</strong><br />Please enter valid username and password.<br />Failed attempts: ' . $fa;
		}

	}
	
	echo json_encode($resp);

?>