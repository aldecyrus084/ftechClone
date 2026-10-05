<?php
 	
date_default_timezone_set('Asia/Manila');
session_start();
require_once("../init.php"); 
require_once('../controller/api.php'); 

$api = new API(); 
$request = isset($_POST['request']) ?  $_POST['request'] : $_GET['request'];

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($request == 'getsales')
{     
	$result = $api->getsales(); 
	echo $result;
}
else if ($request == 'forgotPassword')
{     
	$result = $api->forgotPassword(); 
	echo $result;
}
else if($request == 'autobackup')
{
	$param = "";
	$result = $api->autobackup($param);
	echo $result;
} 
else if($request == 'clear_guest_time')
{ 
	$result = $api->clear_guest_time();
	echo $result;
} 
else if($request == 'activate_licensed')
{
	$licenseKey = $_POST['licenseKey'];
	$machineID  = $_POST['machineID'];

	$url = "https://ftech-centralized.com/index.php/api/activateLicense";

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	// Set headers
	$headers = array(
		"Content-Type: application/x-www-form-urlencoded"
	);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

	// Correctly formatted POST data
	$data = http_build_query([
		'licenseKey' => $licenseKey,
		'machineID'  => $machineID,
		'pc_based'   => true
	]);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

	// Debug only: disable SSL verification (use with caution)
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	// Execute request
	$resp = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	// Output
	if ($err) {
		echo json_encode([
			'status'  => 'error',
			'msg' => 'cURL Error: ' . $err
		]);
	} else {
		echo $resp;
	}
}
else if($request == 'bindVendo')
{
	$coinslot_name        = $_POST['name'];
	$coinslot_description = $_POST['desc'];
	$ip      = $_POST['ip'];
	$mac     = $_POST['mac'];
	$subnet  = $_POST['subnet'];
	$gateway = $_POST['gateway'];
	$dns     = $_POST['dns'];
	$link    = $_POST['link'];
	$duplex  = $_POST['duplex'];  

	$result = $api->bindVendo($coinslot_name,$coinslot_description,$ip,$mac,$subnet,$gateway,$dns,$link,$duplex);
	echo $result;
}

?>