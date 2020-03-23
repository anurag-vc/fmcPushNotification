<?php
ini_set('display_errors','on');

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

	define('API_ACCESS_KEY','YOUR-API-KEY-HERE');


if($getDeviceID = $db->getDeviceID()){

	$count = count($getDeviceID);

	foreach ($getDeviceID as $key => $value) {
		
		$registrationIds	=	$value['device_id'];

     $msg = array
          (
			'body' 	=> 'YOUR-CONTENT-WANT-TO-TRIGGER-TO-Users',
			'title'	=> 'YOUR-TITLE',
           	'isSilent' => FALSE
          );
    
	$fields = array
			(
				'to'		=> $registrationIds, 
				'data' => $msg
			);
	
	$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);

	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, true );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		echo $result;
	}
}