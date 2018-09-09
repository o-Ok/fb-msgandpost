<?php
if (isset($_POST['message'])){
	$message = $_POST['message'];
}
if (isset($_POST['image'])){
	$image = $_POST['image'];
}
if (isset($_POST['user_id'])){
	$user = $_POST['user_id'];
}
if (isset($_POST['accept_tearms'])){
	$page_access_token = 'YOUR_PAGE_ACCESS_TOKEN';
	$page_id = 'YOUR_PAGE_ID';


	$data['url'] = $image;
	$data['message'] = $message;
	
	
	$data['tags'] = '[{tag_uid:'.$user.',x:20,y:30}]';
	var_dump($tags);

	$data['access_token'] = $page_access_token;
	$post_url = 'https://graph.facebook.com/v2.12/'.$page_id.'/photos';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $post_url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$return = curl_exec($ch);
	curl_close($ch);
	echo $return;
}




?>