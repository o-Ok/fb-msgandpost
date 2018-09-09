<?php 
if(!session_id()) {
    session_start();
}
$message = $_POST['message'];
$title    = $_POST['title'];

echo $message . " " . $title;
		if (isset($_SESSION['facebook_access_token'])) {
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
		} else {
			// getting short-lived access token
			$_SESSION['facebook_access_token'] = (string) $accessToken;
		  	// OAuth 2.0 client handler
			$oAuth2Client = $fb->getOAuth2Client();
			// Exchanges a short-lived access token for a long-lived one
			$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
			$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
			// setting default access token to be used in script
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
		}
		// redirect the user back to the same page if it has "code" GET variable
		if (isset($_GET['code'])) {
			header('Location: ./');
		}
		// getting basic info about user
		try {
			$profile_request = $fb->get('/me');
			$profile = $profile_request->getGraphNode()->asArray();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			session_destroy();
			// redirecting user back to app login page
			header("Location: ./");
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
		// post on behalf of page
		$pages = $fb->get('/me/accounts');
		$pages = $pages->getGraphEdge()->asArray();
		foreach ($pages as $key) {
			if ($key['id'] == 'YOUR_PAGE_ID') {
				$post = $fb->post('/' . $key['id'] . '/feed', array(
					'message' => $message,
	            'link' => $title), $key['access_token']);
				$post = $post->getGraphNode()->asArray();
				print_r($post);
			}
		}
	  	// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
			 ?>