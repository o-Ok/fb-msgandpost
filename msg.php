<?php


include 'config.php';
$hub_verify_token = null;
if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}
if ($hub_verify_token === $verify_token) {
    echo $challenge;
}
$input = json_decode(file_get_contents('php://input'), true);
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];
$message_to_reply = '';
/**
 * Some Basic rules to validate incoming messages
 */
/*if(preg_match('[help|pomos|pomosh|помош]', strtolower($message))) {
    
    
    if($response != '') {
        $message_to_reply = $response;
    } else {
        $message_to_reply = "Sorry, I don't know.";
    }
} else {
    $message_to_reply = 'Sorry, I don\'t understand you. I can only tell what time it is now.';
}*/

switch ($message) {
  	case (preg_match('[hi|hello|hey]', strtolower($message)) ? true : false):
		$response = "Hello. How can we be of assistence...";
		$message_to_reply = $response;
		break;
	case (preg_match('[спасе]', strtolower($message)) ? true : false):
		$response = "Спасе ќе изгуби пак после...";
		$message_to_reply = $response;
		break;
	default:
		$response = "Уште работи";	
		$message_to_reply = $response;
		break;
	
	/*$re = '/\b\w*(барам|нудам|имам)|(\d.*места|\d.*место|\d.слободни|\d.слободно)|((од.|до.)битола|(од.|до.)скопје|(од.|до.)прилеп|(од.|do.)охрид)|(во.*\d|после.*\d|пред.*\d)\w*\b/umx';
$str = 'имам 5 места од битола до скопје во 5 часот после ручек';

preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

// Print the entire match result
var_dump($matches);
*/
}
//API Url
$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
//Initiate cURL.
$ch = curl_init($url);
//The JSON data.
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
    "message":{
        "text":"'.$message_to_reply.'"
    }
}';
//Encode the array into JSON.
$jsonDataEncoded = $jsonData;
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
//Execute the request
if(!empty($input['entry'][0]['messaging'][0]['message'])){
    $result = curl_exec($ch);
}

?>