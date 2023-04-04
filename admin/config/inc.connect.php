<?php

require_once 'config.php';

require_once 'User.class.php';


if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var(GOOGLE_REDIRECT_URL, FILTER_SANITIZE_URL));
}


if(isset($_SESSION['token'])){
	$gClient->setAccessToken($_SESSION['token']);
}



if($gClient->getAccessToken()){

	
	// Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();
	
	// Initialize User class
	$user = new UserG();
	
	
	// Getting user profile info
	$gpUserData = array();
	$gpUserData['oauth_uid']  = !empty($gpUserProfile['id'])?$gpUserProfile['id']:'';
	$gpUserData['first_name'] = !empty($gpUserProfile['given_name'])?$gpUserProfile['given_name']:'';
	$gpUserData['last_name']  = !empty($gpUserProfile['family_name'])?$gpUserProfile['family_name']:'';
	$gpUserData['email'] 	  = !empty($gpUserProfile['email'])?$gpUserProfile['email']:'';
	$gpUserData['picture'] 	  = !empty($gpUserProfile['picture'])?$gpUserProfile['picture']:'';
	
	// Insert or update user data to the database
    $gpUserData['oauth_provider'] = 'google';
    $userData = $user->checkUser($gpUserData);
	
	// Storing user data in the session
	$_SESSION['userData'] = $userData;
	
	
	// Render user profile data
    if(!empty($userData)){
    	
    	//require_once 'logdb.php';
		require_once 'config_general.php';

		if(stristr($userData['email'], '@etu.') ==TRUE) {
			header("Location: login.php");
		} 
		
		else {
			$exe_etu = $bdd -> query ("SELECT * FROM membres WHERE email='".$userData['email']."' ");
		}
	
	
		$nb_etu = $exe_etu -> rowcount ();
		$rep_etu = $exe_etu -> fetch ();
		extract($rep_etu);
		
		$sql = "SELECT `id`,`member_admin` FROM `membres` WHERE email='".$userData['email']."' ";

		if ($stm = $bdd->query($sql)) {
			// A nice and secure way to query the database 
			if ($nb_etu>0) {
				$result=$stm->fetch();
				$user_id=$result[0];
				$acreditation=$result[1];
				if($acreditation=="")
					header("Location: login.php");
				$_SESSION['member_id'] = $user_id;
				$_SESSION['acreditation'] = $acreditation;
				$_SESSION['an'] = $an;
				$_SESSION['member_logged_in'] = true;
				$_SESSION['first_name'] = $gpUserData['first_name'];
				$_SESSION['last_name'] = $gpUserData['last_name'];
				$_SESSION['username']=$gpUserData['email'];
				$_SESSION['member_username'] = $gpUserData['email'];
				// Reset login attempts 
				$_SESSION['attempts'] = 0;
				$_SESSION['admin']=true;
				
				$_COOKIE['username']=$gpUserData['email'];
				$redir="index.php";
			}
		}
		
		//$_COOKIE['username']=$username;
		//$_COOKIE['username']='secretariat@ensp-arles.fr';
		//$redir="index.php";
	  
		
    }
    
    else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }

	}else{
	header("Location: login.php");
}


?>
