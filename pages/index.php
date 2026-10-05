
<?php session_start(); 

if(!isset($_SESSION['_islogin']))
{ 
  header("Location: /admin/index.php");
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/logo.png">
  <title>
    F-TECH
  </title> 

  <link href="../assets/css/fontawesome.css" rel="stylesheet" />
  <link href="../assets/css/brands.css" rel="stylesheet" />
  <link href="../assets/css/solid.css" rel="stylesheet" />
  <link href="../assets/css/ftech.css" rel="stylesheet" />

  <link rel="stylesheet" href="../assets/css/material_icons.css">
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />   
  <script src="../assets/js/jquery.js"></script>
</head>

<body class="g-sidenav-show bg-gray-400" style="height: 100vh; background: linear-gradient(to right, #e1e8ed, #CCD4D9);
">

  <?php 
  include("sidebar.php"); 
  ?> 

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php   echo ucwords(str_replace('_',' ', isset($_GET['page']) ? $_GET['page'] : '404'));?></li> 
        </ol>
        <h6 class="font-weight-bolder mb-0"><?php  echo ucwords(str_replace('_',' ', isset($_GET['page']) ? $_GET['page'] : '404'));?></h6>
      </nav>
      <?php 
      include('topbar.php'); 
      ?> 
    </div>
  </nav>

<?php
$page = isset($_GET['page']) ? $_GET['page'] : null;
if($page=='dashboard')
{
    include('dashboard.php');
}
else if($page=='manage_pc')
{
    include('available_pc.php');
}
else if($page=='sales_history')
{
    include('sales.php');
}
else if($page=='system_info')
{
    include('device_info.php');
}
else if($page=='settings')
{
    include('settings.php');
}
else if($page=='rates')
{
    include('rates.php');
}
else if($page=='members')
{
    include('members.php');
}
else if($page=='redeem_rates')
{
    include('redeem_rates.php');
}
else if($page=='redeem_history')
{
    include('redeem_history.php');
}
else if($page=='change_pass')
{
    include('change_pass.php');
}
else if($page=='remote')
{
    include('remote.php');
}
else if($page=='license')
{
    include('license.php');
}
else if($page=='users')
{
    include('users.php');
}
else if($page=='profile')
{
    include('profile.php');
}
else if($page=='voucher')
{
    include('voucher.php');
}
else if($page=='wifi_voucher')
{
    include('wifi_voucher.php');
}
else if($page=='cronjobs')
{
    include('cronjobs.php');
}
else if($page=='telegram')
{
    include('telegram.php');
}
else if($page=='cli')
{
    include('cli.php');
}
else if($page=='backup_restore')
{
    include('backup_restore.php');
}
else if($page=='camera')
{
    include('camera.php');
}
else if($page=='camera_settings')
{
    include('camera_settings.php');
}
else if($page=='camera_logs')
{
    include('camera_logs.php');
}
else if($page=='subvendo')
{
    include('subvendo.php');
}
else
{  
  include('404.php'); 
}
?>
</main>
<?php require_once('footer.php'); ?>