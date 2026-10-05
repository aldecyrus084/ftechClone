<?php 
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';  
 
$array = explode(",", $_SESSION['access']); 
$role = $_SESSION['role'];

$systemManagementKeys = [
    'system_info',
    'settings',
    'remote',
    'telegram',
    'license',
    'cronjobs',
    'cli',
    'backup_restore'
];
 
$showSystemManagement = $role == 'admin' || count(array_intersect($systemManagementKeys, $array)) > 0;
 
?>
<style>

a[data-bs-toggle="collapse"]::after {
    display: none !important;
}

.toggle-icon {
    transition: transform 0.3s ease;
}

.toggle-icon.rotate {
    transform: rotate(180deg);
}

</style>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header" style='display: flex; align-items: center; justify-content: center;'>
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="javascript:void(0);">
            <img src="../assets/img/ftech.png" class="navbar-brand-img h-100" alt="main_logo"> 
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
		
			<li class="nav-item mt-3">
			  <h6 class="ps-1 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Main Menu</h6>
			</li>
			
            <li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'dashboard' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'dashboard' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=dashboard">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Dashboard</span>
                </a>
            </li>
			
			<?php if (in_array('manage_pc', $array) || $role == 'admin') { ?> 
            <li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'manage_pc' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'manage_pc' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=manage_pc">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">computer</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Manage PC</span>
                </a>
            </li>
			<?php }?>
			
			<?php if (in_array('members', $array) || $role == 'admin') { ?> 
            <li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'members' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'members' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=members">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">group</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Members</span>
                </a>
            </li> 
			<?php }?>
			
			<?php if (in_array('rates', $array) || $role == 'admin') { ?> 
            <li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'rates' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'rates' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=rates">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">paid</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Timer Rates</span>
                </a>
            </li> 
			<?php }?>
			
			<?php if (in_array('redeem_rates', $array) || $role == 'admin') { ?> 
            <li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'redeem_rates' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'redeem_rates' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=redeem_rates">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">star</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Redeem Rates</span>
                </a>
            </li> 
			<?php }?>
			
			<?php if (in_array('redeem_history', $array) || $role == 'admin') { ?> 
            <li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'redeem_history' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'redeem_history' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=redeem_history">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">history</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Redeem History</span>
                </a>
            </li> 
			<?php }?>
			
			<?php if (in_array('sales_history', $array) || $role == 'admin') { ?> 
            <li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'sales_history' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'sales_history' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=sales_history">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">point_of_sale</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Reports</span>
                </a>
            </li>
			<?php }?>
			 

            <?php if (in_array('subvendo', $array) || $role == 'admin') { ?> 
                <li class="nav-item">
                    <a class="nav-link p-2 text-white <?php echo $page === 'subvendo' ? 'active' : ''; ?>" 
                    style="<?php echo $page === 'subvendo' ? 'background: #FF4057' : ''; ?>" 
                    href="../pages/index.php?page=subvendo">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10 text-sm">casino</i>
                        </div>
                        <span class="nav-link-text ms-1 text-sm">Sub-Coinslot</span>
                    </a>
                </li>
			<?php }?>
			 
			<?php if ($showSystemManagement) { ?> 
                <li class="nav-item mt-3">
                <h6 class="ps-1 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">System Management</h6>
                </li>
            <?php }?>
			
			
			<?php if (in_array('system_info', $array) || $role == 'admin') { ?> 
            <li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'system_info' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'system_info' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=system_info">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">info</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">System Info</span>
                </a>
            </li> 
			<?php }?>
			 
			
			<?php if (in_array('settings', $array) || $role == 'admin') { ?> 
            <li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'settings' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'settings' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=settings">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">settings</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Settings</span>
                </a>
            </li>
			<?php }?>
			
			<?php if (in_array('remote', $array) || $role == 'admin') { ?> 
			<li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'remote' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'remote' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=remote">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">hub</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Remote</span>
                </a>
            </li>
			<?php }?>
			
			<?php if (in_array('telegram', $array) || $role == 'admin') { ?> 
			<li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'telegram' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'telegram' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=telegram">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">telegram</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Telegram Bot</span>
                </a>
            </li>
			<?php }?>
			
			<?php if (in_array('license', $array) || $role == 'admin') { ?> 
			<li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'license' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'license' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=license">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">confirmation_number</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">License</span>
                </a>
            </li>
			<?php }?>
			
			<?php if (in_array('cronjobs', $array) || $role == 'admin') { ?> 
			<li class="nav-item" disabled>
                <a class="nav-link p-2 text-white <?php echo $page === 'cronjobs' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'cronjobs' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=cronjobs" disabled>
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">format_list_bulleted</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Cron Jobs</span>
                </a>
            </li>
			<?php }?>
			
			
			<?php if (in_array('cli', $array) || $role == 'admin') { ?> 
			<li class="nav-item" disabled>
                <a class="nav-link p-2 text-white <?php echo $page === 'cli' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'cli' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=cli" disabled>
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">CLi</span>
                </a>
            </li>
			<?php }?>
			
			
			<?php if (in_array('backup_restore', $array) || $role == 'admin') { ?> 
			<li class="nav-item" disabled>
                <a class="nav-link p-2 text-white <?php echo $page === 'backup_restore' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'backup_restore' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=backup_restore" disabled>
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">backup</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Backup & Restore</span>
                </a>
            </li>
			<?php }?>
			

			<?php if (in_array('voucher', $array) || $role == 'admin') { ?> 
                <li class="nav-item mt-3">
                    <h6 class="ps-1 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Voucher Menu</h6>
                </li>
            <?php }?> 

			<?php if (in_array('voucher', $array) || $role == 'admin') { ?> 
			<li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'voucher' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'voucher' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=voucher">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">local_activity</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Pisonet Voucher</span>
                </a>
            </li>
			<?php }?> 
			
			<!-- <!?php if (in_array('wifi_voucher', $array) || $role == 'admin') { ?> 
			<li class="nav-item">
                <a class="nav-link p-2 text-white <!?php echo $page === 'wifi_voucher' ? 'active' : ''; ?>" 
                   style="<!?php echo $page === 'wifi_voucher' ? 'background: #FF4057' : ''; ?>" 
                   href="javascript:void(0)">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">wifi_password</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Wifi Voucher <span class = "text-xsm text-dark">(soon)</span></span>
                </a>
            </li>
			<!?php }?>  -->
			<?php if (in_array('users', $array) || in_array('profile', $array) || $role == 'admin') { ?> 
                <li class="nav-item mt-3">
                <h6 class="ps-1 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account Menu</h6>
                </li>
            <?php }?>
			<?php if (in_array('profile', $array) || $role == 'admin') { ?> 
			<li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'profile' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'profile' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=profile">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">person</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Profile</span>
                </a>
            </li>
			<?php }?>
			<?php if (in_array('users', $array) || $role == 'admin') { ?> 
			<li class="nav-item">
                <a class="nav-link p-2 text-white <?php echo $page === 'users' ? 'active' : ''; ?>" 
                   style="<?php echo $page === 'users' ? 'background: #FF4057' : ''; ?>" 
                   href="../pages/index.php?page=users">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 text-sm">group</i>
                    </div>
                    <span class="nav-link-text ms-1 text-sm">Sub-users</span>
                </a>
            </li>
			<?php }?>
        </ul>
    </div> 
</aside>
