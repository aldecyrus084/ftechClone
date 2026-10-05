<?php
 	
date_default_timezone_set('Asia/Manila');
session_start();
require_once("../init.php"); 
require_once('../controller/controller.php');
require_once('../controller/reports.php');

$db = new CONTROLLER();
$rp = new REPORTS();
$request = isset($_POST['request']) ?  $_POST['request'] : $_GET['request'];

error_reporting(E_ALL);
ini_set('display_errors', 1);

if($request == 'login')
{
    $username = $_POST['uname'];
    $pwd = $_POST['pwd'];
    $result = $db->login($username, $pwd);
     
    if(!empty($result))
    { 
        $_SESSION['username'] = $result[0]['username'] ;
        $_SESSION['password'] = $result[0]['password'] ;
        $_SESSION['role'] = $result[0]['role'] ;
        $_SESSION['full_name'] = $result[0]['full_name'] ; 
        $_SESSION['login_id'] = $result[0]['rowid'] ;  
        $_SESSION['access'] = $result[0]['access'] ; 
        $_SESSION['_islogin'] = true;
        echo 'success';
    }
    else
    {
        echo '';
    }
}
else if($request == 'get_today_sale')
{ 
    $df = $_POST['df'];
    $dt = $_POST['dt'];  
    $result = $db->get_today_sale($df, $dt); 
    if($result != "")
    {
        echo $result;
    }
    else
    {
        echo 0;
    } 
} 
 
else if($request == 'get_today_salex')
{  
    $result = $db->get_today_salex(); 
    if($result != "")
    {
        echo $result;
    }
    else
    {
        echo 0;
    } 
}

else if($request == 'get_online_offline')
{
    $result = $db->get_online_offline();
    echo $result;
}

else if($request == 'get_overview')
{
    $result = $db->overview();
    echo $result;
}

else if($request == 'over_view_filter')
{
    $result = $db->over_view_filter();
    echo $result;
}

else if($request  == 'get_table_pc')
{
    $result = $db->get_table_pc();
    echo $result;
}
else if($request  == 'get_rates')
{
    $result = $db->get_rates();
    echo $result;
}
else if($request  == 'redeem_get_rates')
{
    $result = $db->redeem_get_rates();
    echo $result;
}
else if($request  == 'get_vip_rates')
{
    $result = $db->get_vip_rates();
    echo $result;
}
else if($request  == 'get_vvip_rates')
{
    $result = $db->get_vvip_rates();
    echo $result;
}
else if($request  == 'get_member')
{
    $result = $db->get_member();
    echo $result;
}

else if($request == 'get_daily_sales') 
{
    $result = $db->get_daily_sales();
    echo $result;
}

else if($request == 'get_monthly_sales') 
{
    $result = $db->get_monthly_sales();
    echo $result;
}

else if($request == 'logout')
{
    session_destroy(); 
    echo 1;
}

else if($request == 'get_online')
{
    $result = $db->get_online();
    echo $result;
}
 
else if($request == 'apply_autoshutdown')
{
    $stat = $_POST['stat'];
    $result = $db->apply_autoshutdown($stat);
    echo $result;
}

else if($request == 'disable_autoshutdown')
{
    $rowid = $_POST['rowid'];
    $stat = $_POST['stat'];
    $result = $db->disable_autoshutdown($rowid,$stat);
    echo $result;
}

else if($request == 'addTime')
{
    $ip         = $_POST['ip'];
    $pcname     = $_POST['pcname'];
    $mac_add    = $_POST['mac_add'];
    $tot_time   = $_POST['tot_time'];
    $result     = $db->addTime($ip ,$pcname,$mac_add , $tot_time );
    echo $result;
}
 

else if($request == 'resetMaxattempt')
{
    $ip         = $_POST['ip']; 
    $result     = $db->resetMaxattempt($ip);
    echo $result;
}

else if($request == 'manageShutdown_timer')
{
    $ip             = $_POST['ip']; 
    $insert_timer   = $_POST['insert_timer'];
    $shutdown_timer = $_POST['shutdown_timer'];
    $result         = $db->manageShutdown_timer($ip, $insert_timer,$shutdown_timer);
    echo $result;
}

else if($request == 'weekly_sales')
{ 
    $result         = $db->weekly_sales();
    echo $result;
}
else if($request == 'monthly_sale')
{ 
    $result         = $db->monthly_sale();
    echo $result;
}

else if($request == 'yearly_sale')
{ 
    $result         = $db->yearly_sale();
    echo $result;
}

else if($request == 'getallsales')
{ 
    $df     = $_POST['df'];
    $dt     = $_POST['dt']; 
    $result = $db->getallsales($df, $dt);
    echo $result;
}
else if($request == 'redeem_history')
{ 
    $df     = $_POST['df'];
    $dt     = $_POST['dt']; 
    $result = $db->redeem_history($df, $dt);
    echo $result;
} 
else if($request == 'delete_all_member')
{  
    $result = $db->delete_all_member();
    echo $result;
} 
else if($request == 'resetTime')
{ 
    $ip     = $_POST['ip']; 
    $result = $db->resetTime($ip);
    echo $result;
}
 
else if($request == 'update_per_pc')
{  
    $result = $db->update_per_pc();
    echo json_encode($result);
}

else if($request == 'deduct_time')
{
    $table = $_POST['table'];
    $rowid = $_POST['rowid'];
    $time = $_POST['time'];
    $result = $db->deduct_time($table,$rowid,$time);
    echo $result;
}

else if($request == 'add_time')
{
    $table = $_POST['table'];
    $rowid = $_POST['rowid'];
    $time = $_POST['time'];
    $result = $db->add_time($table,$rowid,$time);
    echo $result;
}

else if($request == 'manage_time_guest')
{
    $table = $_POST['table'];
    $rowid = $_POST['rowid'];
    $time = $_POST['time'];
    $result = $db->manage_time_guest($table,$rowid,$time);
    echo $result;
}
else if($request == 'reset_time')
{
    $table = $_POST['table'];
    $rowid = $_POST['rowid']; 
    $result = $db->reset_time($table,$rowid);
    echo $result;
}
else if($request == 'remove_pc')
{ 
    $rowid = $_POST['rowid']; 
    $result = $db->remove_pc($rowid);
    echo $result;
}
else if($request == 'enableApp')
{
	$rowid = $_POST['rowid']; 
	$state = $_POST['state']; 
    $result = $db->enableApp($rowid,$state);
    echo $result;
}
else if($request == 'update_rem_time')
{ 	
	$rem_time = $_POST['rem_time'];
	$action = $_POST['action'];
	$result   = $db->update_rem_time($rem_time,$action);
    echo $result;
}

else if($request == 'update_user_time')
{ 	
	$rem_time  = $_POST['rem_time']; 
	$rowid     = $_POST['rowid']; 
	$fields    = $_POST['fields']; 
	$result    = $db->update_user_time($rem_time,$rowid,$fields);
    echo $result;
}

else if($request == 'update_user_timex')
{ 	
	$rem_time  = $_POST['rem_time'];  
	$fields    = $_POST['fields']; 
	$ids       = json_decode($_POST['ids'], true);
	$result    = $db->update_user_timex($rem_time,$fields,$ids);
    echo $result;
}


else if($request == 'deduct_user_time')
{ 	
	$rem_time  = $_POST['rem_time']; 
	$rowid     = $_POST['rowid']; 
	$fields    = $_POST['fields']; 
	$result    = $db->deduct_user_time($rem_time,$rowid,$fields);
    echo $result;
}
else if($request == 'deduct_user_timex')
{ 	
	$rem_time  = $_POST['rem_time'];  
	$fields    = $_POST['fields']; 
	$ids       = json_decode($_POST['ids'], true);
	$result    = $db->deduct_user_timex($rem_time,$fields,$ids);
    echo $result;
}
else if($request == 'user_time_reset')
{ 	 
	$rowid = $_POST['rowid'];
	$fields = $_POST['fields'];
	$result   = $db->user_time_reset($rowid, $fields);
    echo $result;
}


else if($request == 'change_background')
{   
    $filename  = $_FILES['file']['name']; 
    $rowid     = $_POST['file_id'];     
    $location = "../assets/img/"; 
	if(isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $timestamp = time();
        $newFileName = $timestamp . '_' . $_FILES["file"]["name"];
         
        $uploadFile = $location.$newFileName;
        move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile);
    }   
    $result = $db->change_background("/admin/assets/img/".$newFileName,$rowid);
    echo $result; 
   
}

else if($request == 'change_logo') {   
    $filename  = $_FILES['file']['name'];      
    $location = "../assets/logo/"; 
    
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) { 
        $existingFilePath = $location . $filename;
 
        if (file_exists($existingFilePath)) {
            unlink($existingFilePath);
        }  
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $existingFilePath)) { 
			$result = $db->change_logo("/admin/assets/logo/" . $filename);
			echo $result; 
        } else {
            echo "Failed";
        }
    }
	else
	{
		echo "Failed";
	}
}
 
else if($request == 'change_bg') {   
    $filename  = $_FILES['file']['name'];      
    $location = "../assets/globalwallpaper/"; 
    
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) { 
        $existingFilePath = $location . $filename;
 
        if (file_exists($existingFilePath)) {
            unlink($existingFilePath);
        }  
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $existingFilePath)) { 
			$result = $db->change_bg("/admin/assets/globalwallpaper/" . $filename);
			echo $result; 
        } else {
            echo "Failed";
        }
    } 
	else
	{
		echo "Failed";
	}
}
else if($request == 'deleteglobalwallpaper')
{ 
    $path = "/var/www/html/admin/assets/globalwallpaper/";

    if (!isset($_POST['file'])) {
        echo "NO_FILE";
        exit;
    }

    $filename = basename($_POST['file']); 
    $fullpath = $path . $filename;

    if (file_exists($fullpath)) {
        if (unlink($fullpath)) {
            echo "OK";
        } else {
            echo "ERROR_DELETE";
        }
    } else {
        echo "NOT_FOUND";
    } 
}
else if($request == 'deletelogo')
{ 
    $path = "/var/www/html/admin/assets/logo/";

    if (!isset($_POST['file'])) {
        echo "NO_FILE";
        exit;
    }

    $filename = basename($_POST['file']); 
    $fullpath = $path . $filename;

    if (file_exists($fullpath)) {
        if (unlink($fullpath)) {
            echo "OK";
        } else {
            echo "ERROR_DELETE";
        }
    } else {
        echo "NOT_FOUND";
    } 
}
else if($request == "update_globalWallpaper")
{
	$filename = $_POST['file'];
    $result = $db->change_bg("/admin/assets/globalwallpaper/" . $filename);
    echo $result; 
}
else if($request == "update_logo")
{
	$filename = $_POST['file'];
    $result = $db->change_logo("/admin/assets/logo/" . $filename);
    echo $result; 
}
else if($request == "salesx")
{
	$type = $_POST['type'];
    $result = $db->salesx($type);
    echo json_encode($result); 
}

else if($request == "system_info")
{
	$result = $db->system_info();
    if(!empty($result))
    {  
        echo $result;
    }
    else
    {
        echo json_encode(['error' => 'No data']);
    }
}

else if($request == "change_ip")
{
    $ip = $_POST['ip'];
    $gw = $_POST['gw'];
    $network_type = $_POST['network_type'];
    $result = $db->change_ip($ip,$gw, $network_type); 
    echo $result;
}

else if($request == "shutdown_reboot")
{
    $cmd = $_POST['cmd'];
    $result = $db->shutdown_reboot($cmd); 
    echo $result;
}

else if($request == "get_timer_settings")
{ 
    $result = $db->get_timer_settings(); 
    echo $result;
}
else if($request == "get_loginRules")
{ 
    $result = $db->get_loginRules(); 
    echo $result;
}
else if($request == "save_timer")
{ 
    $result = $db->save_timer(); 
    echo $result;
}

else if($request == "save_loginrules")
{ 
    $result = $db->save_loginrules(); 
    echo $result;
}

else if($request == "get_announcement")
{ 
    $result = $db->get_announcement(); 
    echo json_encode($result);
}
else if($request == "server_ip")
{ 
    $result = $db->server_ip(); 
    echo $result;
}
else if($request == "update_announcement")
{ 
    $lock_msg   = $_POST['lock_msg'];
    $before_msg = $_POST['before_msg'];
    $result = $db->update_announcement($lock_msg, $before_msg); 
    echo $result;
}

else if($request == "update_open_closed")
{ 
    $time_open   = $_POST['time_open'];
    $time_close = $_POST['time_close'];
    $early_warning = $_POST['early_warning'];
    $result = $db->update_open_closed($time_open, $time_close, $early_warning); 
    echo $result;
}
else if($request == "update_enable_schedule")
{ 
    $state   = $_POST['state']; 
    $result = $db->update_enable_schedule($state); 
    echo $result;
}
else if($request == "enable_tele")
{ 
    $state   = $_POST['state']; 
    $result = $db->enable_tele($state); 
    echo $result;
}
else if($request == "enable_logo")
{ 
    $state   = $_POST['state']; 
    $result = $db->enable_logo($state); 
    echo $result;
}
else if($request == "ena_bill")
{ 
    $state   = $_POST['state']; 
    $result = $db->ena_bill($state); 
    echo $result;
}
else if($request == "overwrite_bg")
{ 
    $state   = $_POST['state']; 
    $result = $db->overwrite_bg($state); 
    echo $result;
}
else if($request == "delete_rates")
{ 
    $rowid   = $_POST['rowid']; 
    $result = $db->delete_rates($rowid); 
    echo $result;
}

else if($request == "redeem_delete_rates")
{ 
    $rowid   = $_POST['rowid']; 
    $result = $db->redeem_delete_rates($rowid); 
    echo $result;
}

else if($request == "vipdelete_rates")
{ 
    $rowid   = $_POST['rowid']; 
    $result = $db->vipdelete_rates($rowid); 
    echo $result;
}
else if($request == "vvipdelete_rates")
{ 
    $rowid   = $_POST['rowid']; 
    $result = $db->vvipdelete_rates($rowid); 
    echo $result;
}
else if($request == "delete_member")
{ 
    $rowid   = $_POST['rowid']; 
    $result = $db->delete_member($rowid); 
    echo $result;
}
else if($request == "delete_users")
{ 
    $rowid   = $_POST['rowid']; 
    $result = $db->delete_users($rowid); 
    echo $result;
}
else if($request == "save_rates_update")
{ 
    $rowid    = $_POST['rowid']; 
    $credit   = $_POST['credit']; 
    $time_sec = $_POST['time_sec']; 
    $points   = $_POST['points']; 
    $result = $db->save_rates_update($rowid, $credit,$time_sec, $points); 
    echo $result;
}
else if($request == "redeem_save_rates_update")
{ 
    $rowid    = $_POST['rowid']; 
    $credit   = $_POST['credit']; 
    $time_sec = $_POST['time_sec'];  
    $result   = $db->redeem_save_rates_update($rowid, $credit,$time_sec); 
    echo $result;
}

else if($request == "vipsave_rates_update")
{ 
    $rowid    = $_POST['rowid']; 
    $credit   = $_POST['credit']; 
    $time_sec = $_POST['time_sec']; 
    $points   = $_POST['points']; 
    $result = $db->vipsave_rates_update($rowid, $credit,$time_sec, $points); 
    echo $result;
}
else if($request == "vvipsave_rates_update")
{ 
    $rowid    = $_POST['rowid']; 
    $credit   = $_POST['credit']; 
    $time_sec = $_POST['time_sec']; 
    $points   = $_POST['points']; 
    $result = $db->vvipsave_rates_update($rowid, $credit,$time_sec, $points); 
    echo $result;
}
else if($request == "save_member")
{ 
    $rowid    = $_POST['rowid']; 
    $name     = $_POST['name']; 
    $username = $_POST['username']; 
    $password = $_POST['password']; 
    $result   = $db->save_member($rowid, $name,$username, $password); 
    echo $result;
}
else if($request == 'set_as_vip')
{
    $rowid = $_POST['rowid']; 
    $value = $_POST['value']; 
    $result   = $db->set_as_vip($rowid, $value); 
    echo $result;
}
else if($request == 'update_pass')
{
    $full_name = $_POST['full_name'];  
    $username = $_POST['username'];  
    $password = $_POST['password'];  
    $result   = $db->update_pass($full_name,$username,$password); 
    echo $result;
}
else if($request == 'app_update_pass')
{
    $pass = $_POST['pass'];   
    $result   = $db->app_update_pass($pass); 
    echo $result;
}

else if($request == 'reset_data')
{
	$table   = $_POST['table']; 
	$result   = $db->reset_data($table); 
    echo $result;
}
else if($request == 'backup')
{
	$result   = $db->backup(); 
    echo $result;
}
else if($request == 'backup_multiple')
{
	$param   = urldecode($_GET['param']); 
	$result   = $db->backup_multiple($param); 
    echo $result;
}
else if($request == 'save_autobakuop')
{
	$param   = $_POST['param']; 
	$result  = $db->save_autobakuop($param); 
    echo $result;
}
else if($request == 'getdefaultbackup')
{ 
	$result  = $db->getdefaultbackup(); 
    echo $result;
}

else if ($request == 'restore') { 
    $backupFile = $_FILES["file"]["tmp_name"]; 

    // Ensure the file was uploaded correctly
    if (!file_exists($backupFile)) {
        echo json_encode(["success" => false, "message" => "Backup file does not exist."]);
        exit;
    }

    // Construct the MySQL command
    $command = "mysql -h localhost -u ftech -p'ftech' ftech < $backupFile 2>&1"; // Capture error output
    exec($command, $output, $returnVar); 

    // Check for success
    if ($returnVar === 0) { 
        echo json_encode(["success" => true, "message" => "Data restored successfully."]);
    } else { 
        echo json_encode(["success" => false, "message" => "Error restoring database: " . implode("\n", $output)]);
    } 
}

else if($request == 'zerotier_info')
{
	$result   = $db->zerotier_info(); 
    echo $result;
}

else if($request == 'join')
{
	$network_id = $_POST['network_id'];
	$result   = $db->join_network($network_id); 
    echo $result;
}

else if($request == 'forget_network')
{
	$network_id = $_POST['network_id'];
	$result   = $db->forget_network($network_id); 
    echo $result;
}

else if($request == 'get_coin_pins')
{ 
	$result   = $db->get_coin_pins(); 
    echo $result;
}

else if($request == 'get_bill_pins')
{ 
	$result   = $db->get_bill_pins(); 
    echo $result;
}
else if($request == 'get_set_pins')
{ 
	$result   = $db->get_set_pins(); 
    echo $result;
}
else if($request == 'get_relay_state')
{ 
	$result   = $db->get_relay_state(); 
    echo $result;
}
else if($request == "update_coin_settings")
{ 
    $coin_pin   = $_POST['coin_pin'];
    $set_pins = $_POST['set_pins'];
    $relay_state = $_POST['relay_state'];
    $result = $db->update_coin_settings($coin_pin, $set_pins,$relay_state); 
    echo $result;
}

else if($request == "update_bill_settings")
{ 
    $bill_pin   = $_POST['bill_pin'];
    $credit_per_pulse = $_POST['credit_per_pulse']; 
    $result = $db->update_bill_settings($bill_pin, $credit_per_pulse); 
    echo $result;
}
else if($request == "get_transfer_pc")
{ 
    $rowid   = $_POST['rowid']; 
    $result = $db->get_transfer_pc($rowid); 
    echo $result;
}
else if($request == "transfer_now")
{ 
    $from_rowid   = $_POST['from_rowid']; 
    $to_rowid   = $_POST['to_rowid']; 
    $result = $db->transfer_now($from_rowid, $to_rowid); 
    echo $result;
}
else if ($request == "get_filter_list")
{
    $result = $db->get_filter_list(); 
    echo $result;
}
else if ($request == "getCoinslot")
{
    $result = $db->getCoinslot(); 
    echo $result;
}
else if($request == 'genrep')
{ 
    $df = $_POST['df'];
    $dt = $_POST['dt']; 
	$filter_by = $_POST['filter_by'];
	$report_type = $_POST['report_type'];
	$coinslot = $_POST['coinslot'];
    $result = $rp->genrep($df, $dt, $filter_by, $report_type, $coinslot); 
    echo $result;
}

else if($request == 'shutdown_reboot_pc')
{ 
    $rowid  = $_POST['rowid'];
    $fields = $_POST['fields'];  
    $result = $db->shutdown_reboot_pc($rowid, $fields); 
    echo $result;
}

else if($request == 'wake_on_lan')
{ 
    $mac  = $_POST['mac'];   
    $result = $db->wake_on_lan($mac); 
    echo $result;
}
else if($request == 'wake_all')
{  
    $result = $db->wake_all(); 
    echo json_encode($result);
}
else if($request == 'top_up')
{
	$top_up_rowid = $_POST['top_up_rowid']; 
	$top_up_table = $_POST['top_up_table'];
	$credit = $_POST['credit'];
    $result = $db->top_up($top_up_rowid,$credit,$top_up_table); 
    echo $result; 
}
else if($request == 'deduct_top_up_guest')
{
	$top_up_rowid = $_POST['top_up_rowid']; 
	$top_up_table = $_POST['top_up_table'];
	$credit = $_POST['credit'];
    $result = $db->deduct_top_up_guest($top_up_rowid,$credit,$top_up_table); 
    echo $result; 
}
else if($request == 'member_idle')
{
	$member_idle = $_POST['member_idle'] ;
    $result = $db->member_idle($member_idle); 
    echo $result; 
}
else if($request == 'get_idle_cnt')
{ 
    $result = $db->get_idle_cnt(); 
    echo $result; 
}
else if($request == 'get_machine_info')
{ 
    $result = $db->get_machine_info(); 
    echo $result; 
}
else if ($request == "getSerial")
{
	$result = $db->getSerial(); 
    echo $result; 
}
else if($request == "verify_license")
{
	$license_key = $_POST['license_key'] ; 
	$result = $db->verify_license2($license_key); 
    echo $result; 
} 
else if($request == "verify")
{ 
	$result = $db->verify(); 
    echo $result; 
}
else if($request  == 'get_sub_users')
{
    $result = $db->get_sub_users();
    echo $result;
}

else if($request  == 'save_users')
{
	$name = $_POST['name'] ;
	$username = $_POST['username'] ;
	$password = $_POST['password'] ;
	$access = $_POST['access'] ;
	$action = $_POST['action'] ;
	$rowid = $_POST['rowid'] ;
    $result = $db->save_users($action,$name,$username,$password,$access, $rowid);
    echo $result;
}
else if($request == 'get_session')
{ 
    $result = $db->get_session();
     echo $result[0]['access']  ;  
    if(!empty($result))
    {  
        $_SESSION['access'] = $result[0]['access'] ;   
    } 
}
else if($request == 'get_voucher')
{ 
    $result = $db->get_voucher();
	echo $result;
}
else if($request == 'wifi_get_voucher')
{ 
    $result = $db->wifi_get_voucher();
	echo $result;
}

else if ($request == 'saveVoucherCodes')
{
	$prefix       = $_POST['prefix'] ;
	$voucherCodes = $_POST['voucherCodes'] ;
	$price        = $_POST['price'] ;
	$time_sec     = $_POST['time_sec'] ;
	$expiration   = $_POST['expiration'] ; 
	$voucher_type   = $_POST['voucher_type'] ; 
	$result = $db->saveVoucherCodes($prefix, $voucherCodes, $price, $time_sec, $expiration, $voucher_type); 
	echo $result;
}
else if ($request == 'wifi_saveVoucherCodes')
{
	$prefix       = $_POST['prefix'] ;
	$voucherCodes = $_POST['voucherCodes'] ;
	$price        = $_POST['price'] ;
	$time_sec     = $_POST['time_sec'] ;
	$expiration   = $_POST['expiration'] ; 
	$result = $db->wifi_saveVoucherCodes($prefix, $voucherCodes, $price, $time_sec, $expiration); 
	echo $result;
}

else if ($request == 'delete_voucher')
{
	$rowid       = $_POST['rowid'] ; 
	$result = $db->delete_voucher($rowid); 
	echo $result;
}
else if ($request == 'wifi_delete_voucher')
{
	$rowid       = $_POST['rowid'] ; 
	$result = $db->wifi_delete_voucher($rowid); 
	echo $result;
}
else if ($request == 'delete_voucher_where')
{
	$filter       = $_POST['filter'] ; 
	$result = $db->delete_voucher_where($filter); 
	echo $result;
}
else if ($request == 'wifi_delete_voucher_where')
{
	$filter       = $_POST['filter'] ; 
	$result = $db->wifi_delete_voucher_where($filter); 
	echo $result;
}
else if ($request == 'delete_single_sales')
{
	$rowid       = $_POST['rowid'] ; 
	$table       = $_POST['table'] ; 
	$result      = $db->delete_single_sales($rowid, $table); 
	echo $result;
}
else if ($request == 'get_whitelisted')
{ 
	$result      = $db->get_whitelisted(); 
	echo $result;
}
else if ($request == 'get_chat')
{ 
	$result      = $db->get_chat(); 
	echo $result;
}

else if ($request == 'delete_app')
{ 
	$rowid       = $_POST['rowid'] ; 
	$result      = $db->delete_app($rowid); 
	echo $result;
}
else if ($request == 'delete_chat')
{ 
	$rowid       = $_POST['rowid'] ; 
	$result      = $db->delete_chat($rowid); 
	echo $result;
}

else if ($request == 'add_app')
{ 
	$app_name       = $_POST['app_name'] ; 
	$result      = $db->add_app($app_name); 
	echo $result;
}
else if ($request == 'add_chat')
{ 
	$title       = $_POST['title'] ; 
	$msg         = $_POST['msg'] ; 
	$result      = $db->add_chat($title,$msg); 
	echo $result;
}
else if ($request == 'remove_all')
{  
	$result      = $db->remove_all(); 
	echo $result;
}
else if ($request == 'delete_all_members')
{  
	$ids         = json_decode($_POST['ids'], true);
	$result      = $db->delete_all_members($ids); 
	echo $result;
} 
else if ($request == 'addCron')
{  
	$cron       = $_POST['cron'] ; 
	$result     = $db->addCron($cron); 
	echo $result;
}
else if ($request == 'removeCron')
{  
	$cron       = $_POST['cron'] ; 
	$result     = $db->removeCron($cron); 
	echo $result;
}
else if ($request == 'getAllCrons')
{    
	$result     = $db->getAllCrons(); 
	echo $result;
}
else if ($request == 'tele_config')
{    
	$token      = $_POST['token'] ;
	$chat_id    = $_POST['chat_id'] ;
	$result     = $db->tele_config($token,$chat_id); 
	echo $result;
}
else if ($request == 'getTeleConfig')
{     
	$result     = $db->getTeleConfig(); 
	echo json_encode($result);
}

else if ($request == 'cli_cmd')
{     
	$command    = $_POST['command'] ;
	$result     = $db->cli_cmd($command); 
	echo $result;
} 
else if ($request == 'addPoints')
{     
	$rowid    = $_POST['rowid'] ;
	$points   = $_POST['points'] ;
	$result   = $db->addPoints($rowid,$points); 
	echo $result;
} 
else if ($request == 'addPointsx')
{      
	$points   = $_POST['points'] ;
	$ids      = json_decode($_POST['ids'], true);
	$result   = $db->addPointsx($points,$ids); 
	echo $result;
} 
else if ($request == 'deductPoints')
{     
	$rowid    = $_POST['rowid'] ;
	$points   = $_POST['points'] ;
	$result   = $db->deductPoints($rowid,$points); 
	echo $result;
} 
else if ($request == 'deductPointsx')
{      
	$points   = $_POST['points'] ;
	$ids      = json_decode($_POST['ids'], true);
	$result   = $db->deductPointsx($points,$ids); 
	echo $result;
} 
else if ($request == 'startcam')
{       
	$result   = $db->startcam(); 
	echo $result;
}  
else if ($request == 'get_recording')
{       
	$sessionid   = $_POST['sessionid'] ;
	$result   = $db->get_recording($sessionid); 
	echo $result;
}  
else if ($request == 'getRetainDays')
{        
	$result   = $db->getRetainDays(); 
	echo $result;
} 
else if ($request == 'save_retention')
{       
	$retentionday   = $_POST['retentionday'] ;
	$result   = $db->save_retention($retentionday); 
	echo $result;
}   
else if ($request == 'getRecordingLogs')
{       
	$filter_by   = $_POST['filter_by'] ;
	$result   = $db->getRecordingLogs($filter_by); 
	echo $result;
} 
else if($request == "getcamSettings") 
{
	$result   = $db->getcamSettings(); 
	echo $result;
}
else if($request == "updateffmpeg") 
{
	$type   = $_POST['type'] ;
	$rowid  = $_POST['rowid'] ;
	$result = $db->updateffmpeg($type,$rowid); 
	echo $result;
}
else
{
    echo "not found";
}




?>