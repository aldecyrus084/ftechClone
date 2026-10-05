<?php
 	
date_default_timezone_set('Asia/Manila');
session_start();
ini_set('display_errors', 1);
require_once("../init.php"); 
require_once('../controller/main_controller.php'); 

$db = new MAIN_CONTROLLER();
$request = isset($_POST['request']) ?  $_POST['request'] : $_GET['request'];

error_reporting(E_ALL);
ini_set('display_errors', 1);

if($request == 'get_pc_performance')
{ 
    $result = $db->get_pc_performance();
    echo $result;
} 
else if($request == 'ajax_get_pc_performance_json')
{ 
    $result = $db->ajax_get_pc_performance_json();
    echo $result;
} 
else if($request == 'get_pc_list')
{  
    $result = $db->get_pc_list();
    echo $result;
}
else if($request == 'getTemplate')
{  
    $result = $db->getTemplate();
    echo $result;
}
else if($request == 'getSubvendo')
{  
    $result = $db->getSubvendoModel();
    echo $result;
}
else if($request == 'getVendoList')
{  
    $result = $db->getVendoListModel();
    echo $result;
}
else if($request == 'DeleteSubVendo')
{  
    $rowid  = $_POST['rowid'];
    $result = $db->DeleteSubVendoModel($rowid);
    echo $result;
}
else if($request == 'updateSubVendo')
{  
    $rowid        = $_POST['rowid'];
    $coinslotname = $_POST['coinslotname'];
    $description  = $_POST['description'];
    $status       = $_POST['status'];
    $result       = $db->updateSubVendo($rowid,$coinslotname,$description,$status);
    echo $result;
}
else if($request == 'sendMessage')
{
    $msg    = $_POST['msg'];
    $target = $_POST['target'];
    $result = $db->sendMessage($msg, $target);
    echo $result;
}
else
{
    echo "not found";
}




?>