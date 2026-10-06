<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("../model/model.php");

class CONTROLLER extends MODEL
{ 
    function login($username,$pwd)
    {
        //return $this->loginx($username,$pwd);
		$result = $this->sqlquery("Select rowid,full_name,username, `password`,`role`, access from `users` where username = ? and password = ?", array($username,$pwd)); 
		return $result;
    }

    function get_today_sale($df, $dt)
    { 
        $dates = "'".$df ." 00:00:00 '"." AND '". $dt . " 23:59:59'"; 
        $result = $this->sqlquery("SELECT SUM(credit) as credit from `insert_logs` where date_inserted between $dates"); 
       return $result[0]['credit'];
    }

    function get_today_salex()
    {  
        $result = $this->sqlquery("SELECT SUM(credit) as credit from `insert_logs` where date(date_inserted) = date(NOW())"); 
       return $result[0]['credit'];
    }

    function get_online_offline()
    {
        $result = $this->sqlquery("Select  
            (Select COUNT(*) from `clientpc` where online_stat = 'ONLINE') AS online_cnt,
            (Select COUNT(*) from `clientpc` where online_stat = 'OFFLINE')  AS offline_cnt
        ");
        return json_encode($result);
    }

	function over_view_filter()
	{
		$sql = "SELECT concat(pc_name,' ','(', ip_address, ')' ) as pcnamex, ip_address   from  `clientpc` order by pc_name asc";
		$result = $this->sqlquery($sql);
		
		$html = '';
		if(!empty($result))
        {
			foreach($result as $field => $value) 
            {
				$html .= '<option value = "'.str_replace(".", "", $value['ip_address']).'">'.$value['pcnamex'].'</option>';
			}
		}
		return $html ;
		
	}
	
	
    function overview()
    { 
        $now = date("Y-m-d H:i:s");
        $result = $this->sqlquery("SELECT 
			'INSERT LOGS' AS log_type,
			CONCAT(b.pc_name,' ','(', a.ip_address, ')' ) AS pcnamex, 
			CONCAT('Credit:','₱',credit,' ' ,'Time:', TIME_FORMAT(SEC_TO_TIME(`credit_time`),'%H:%i:%s')) AS time_credit, 
			IF(username <> '',username,'GUEST') AS username,
			date_inserted ,
			a.ip_address,
			a.voucher,
			'' AS user_stat,
			'' AS top_up,
			'' AS top_up_by,
			'' transaction_type,
			'' AS rem_time,
			'' AS pc_type,
			session_id, 
			coinslot_name
		FROM `insert_logs`  AS a
		LEFT JOIN (
			SELECT pc_name,ip_address FROM clientpc
		)AS b ON a.ip_address = b.ip_address 
		WHERE DATE(date_inserted) = DATE(NOW()) 

		UNION ALL

		SELECT 
			'LOGIN' AS log_type, 
			CONCAT(pcname,' ','(', pc_ip, ')' ) AS pcnamex, 
			'' AS time_credit,
			userid AS username,
			date_inserted,
			pc_ip AS ip_address,
			'' voucher,
			user_stat,
			'' AS top_up,
			'' AS top_up_by,
			'' transaction_type,
			TIME_FORMAT(SEC_TO_TIME(IFNULL(rem_time, 0)),'%H:%i:%s') AS rem_time,
			pc_type,
			'' AS session_id, 
			'' AS coinslot_name
		FROM `userLog`  
		WHERE DATE(date_inserted) = DATE(NOW()) 

		UNION ALL

		SELECT 
			'TOPUP' AS log_type, 
			CONCAT(pc_name,' ','(', ip_address, ')' ) AS pcnamex, 
			'' AS time_credit,
			username,
			date_inserted,
			ip_address,
			'' voucher,
			'' user_stat,
			credit AS top_up,
			top_up_by, 
			transaction_type,
			'' AS rem_time,
			'' AS pc_type,
			'' AS session_id, 
			'' AS coinslot_name
		FROM `top_up_logs`
		WHERE DATE(date_inserted) = DATE(NOW()) 
		 
		UNION ALL 

		SELECT 
			'ADDTIME' AS log_type, 
			CONCAT(b.pc_name,' ','(', b.ip_address, ')' ) AS pcnamex, 
			TIME_FORMAT(SEC_TO_TIME(`add_time`),'%H:%i:%s') AS time_credit,
			`user` AS username,
			date_inserted,
			IFNULL(ip_address, '0.0.0.0') AS ip_address,
			'' voucher,
			'' user_stat,
			'' top_up,
			'' top_up_by, 
			'' transaction_type,  
			'' AS rem_time,
			'' AS pc_type,
			'' AS session_id, 
			'' AS coinslot_name
		FROM `add_time_logs` AS  a
		LEFT JOIN (
			SELECT rowid,pc_name,ip_address FROM clientpc
		)AS b ON a.client_id = b.rowid 
		WHERE DATE(date_inserted) = DATE(NOW())  

		UNION ALL

		SELECT 
			'SHARE_TIME' AS log_type, 
			`to` AS pcnamex, 
			TIME_FORMAT(SEC_TO_TIME(`share_time`),'%H:%i:%s')  AS time_credit,
			`from` AS username,
			date_inserted,
			'' ip_address,
			'' voucher,
			'' user_stat,
			'' AS top_up,
			'' top_up_by, 
			'' transaction_type,
			'' AS rem_time,
			'' AS pc_type,
			'' AS session_id, 
			'' AS coinslot_name
		FROM  `transferTime`

		WHERE DATE(date_inserted) = DATE(NOW()) 
		ORDER BY date_inserted DESC");
        $html = '';

		$is_ena_cam = $this->sqlquery("Select ena_cam from settings");

        if(!empty($result))
        {
            foreach($result as $field => $value) 
            {  
				if($value['log_type'] == "INSERT LOGS")
				{
					$html .= '<div class="timeline-block mb-3 '.str_replace(".", "", $value['ip_address']).'">
						<span class="timeline-step">
							<i class="material-icons text-success text-gradient">payments</i>
						</span>
						<div class="timeline-content">
							<h6 class="text-dark text-sm font-weight-bold mb-0">'.$value['pcnamex'].'</h6>
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Coinslot: '.$value['coinslot_name'].'</p>
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0"> '.$value['time_credit'].'</p>
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Date & Time: '.$value['date_inserted'].'</p>
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">User: '.$value['username'].'</p> 
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Voucher: '.$value['voucher'].'</p>
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">';

						if (!empty($value['session_id'])) {
							$html .= '<button class="btn btn-sm btn-info '.($is_ena_cam[0]['ena_cam'] == 'N' ? 'd-none' : '' ).'" onclick="watchVideo(\''.$value['session_id'].'\')">
										<i class="fas fa-play"></i> Watch Video
									  </button>';
						} else {
							$html .= '<span class="text-danger font-weight-bold '.($is_ena_cam[0]['ena_cam'] == 'N' ? 'd-none' : '' ).'">NO AVAILABLE VIDEO</span>';
						}

					$html .= '</p>
						</div>
					</div>';



				}
				else if($value['log_type'] == "LOGIN")
				{ 
					$pc_type = "NonVip"; 
					if($value['pc_type'] == "YES")
					{
						$pc_type = "VIP";
					}
					else if($value['pc_type'] == "YYES")
					{
						$pc_type = "V-VIP";
					}
					else
					{
						$pc_type = "Non-Vip"; 
					}
					
					$html .= '<div class="timeline-block mb-3 LOGIN ' .strtoupper($value['user_stat']).' ' .str_replace(".", "", $value['ip_address']).'">
						<span class="timeline-step">
							<i class="material-icons '
								.(strtoupper($value['user_stat']) == 'LOGIN' ? 'text-info' : 'text-danger')
								.' text-gradient">person</i>
						</span>
						<div class="timeline-content">
							<h6 class="text-dark text-sm font-weight-bold mb-0">'.strtoupper($value['user_stat']).' | '.$value['pcnamex'].'</h6> 
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">User: '.$value['username'].'</p>  
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Remaining Time: '.$value['rem_time'].'</p>  
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">PC Type: '.$pc_type.'</p>
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">'.$value['date_inserted'].'</p>
						</div>
					</div>';

				}
				else if($value['log_type'] == "TOPUP")
				{
					if($value['transaction_type'] == "member_top_up")
					{
						$html .= '<div class="timeline-block mb-3 TOPUP ">
							<span class="timeline-step">
							<i class="material-icons text-warning text-gradient">account_balance_wallet</i>
							</span>
							<div class="timeline-content">
							<h6 class="text-dark text-sm font-weight-bold mb-0">MEMBERS TOP-UP</h6> 
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Top-Up: ₱'.$value['top_up'].'</p>
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Top-Up to: '.$value['username'].'</p>  
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Top-Up By: '.$value['top_up_by'].'</p>  
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">'.$value['date_inserted'].'</p>
							</div>
						</div> ';
					}
					else
					{
						$html .= '<div class="timeline-block mb-3 TOPUP ">
							<span class="timeline-step">
							<i class="material-icons text-warning text-gradient">account_balance_wallet</i>
							</span>
							<div class="timeline-content">
							<h6 class="text-dark text-sm font-weight-bold mb-0">GUEST TOP-UP</h6> 
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Top-Up: ₱'.$value['top_up'].'</p>
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Top-Up to: '.$value['pcnamex'].'</p>  
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Top-Up By: '.$value['top_up_by'].'</p>  
							<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">'.$value['date_inserted'].'</p>
							</div>
						</div> ';
					}
					
				}
				else if($value['log_type'] == "ADDTIME")
				{ 
					$html .= '<div class="timeline-block mb-3 '.str_replace(".", "", $value['ip_address']).'">
						<span class="timeline-step">
						<i class="material-icons text-info text-gradient">more_time</i>
						</span>
						<div class="timeline-content">
						<h6 class="text-dark text-sm font-weight-bold mb-0">GUEST ADD TIME</h6> 
						<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Add Time:'.$value['time_credit'].'</p>
						<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Added To: '.$value['pcnamex'].'</p>  
						<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Added By: '.$value['username'].'</p>  
						<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">'.$value['date_inserted'].'</p>
						</div>
					  </div> ';
				}
				else if($value['log_type'] == "SHARE_TIME")
				{ 
					$html .= '<div class="timeline-block mb-3 '.str_replace(".", "", $value['ip_address']).'">
						<span class="timeline-step">
						<i class="material-icons text-danger text-gradient">share</i>
						</span>
						<div class="timeline-content">
						<h6 class="text-dark text-sm font-weight-bold mb-0">TRANSFER TIME</h6> 
						<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">From: '.$value['username'].'</p>  
						<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">To: '.$value['pcnamex'].'</p>  
						<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Shared Time: '.$value['time_credit'].'</p>
						<p class="text-secondary font-weight-bold text-xs mt-1 mb-0">'.$value['date_inserted'].'</p>
						</div>
					  </div> ';
				}
            }
        }
        else
        {
            $html .= '<div class="timeline-block mb-3">
            <span class="timeline-step">
            <i class="material-icons text-success text-gradient">notifications</i>
            </span>
            <div class="timeline-content">
            <h6 class="text-dark text-sm font-weight-bold mb-0">NO DATA FOR TODAY</h6>
            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"></p>
            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"></p>
            </div>
          </div> ';
        }
       
        return $html; 
    }

    function get_table_pc()
    { 
        $result = $this->sqlquery("SELECT pc_name, a.ip_address, SEC_TO_TIME(IF(log_in_user <> '',(SELECT remaining_time FROM `user`  WHERE username = a.log_in_user GROUP BY username), remaining_time)) AS rem_time,if(log_in_user <> '' , log_in_user, 'GUEST')log_in_user,is_vip, online_stat, IFNULL(b.today_sale,0) AS to_sales FROM `clientpc`  AS a
		LEFT JOIN
		(
			SELECT SUM(credit) AS today_sale, mac_address,ip_address FROM `insert_logs` WHERE DATE(date_inserted) = DATE(NOW()) GROUP BY mac_address
		)AS b ON a.ip_address = b.ip_address");
        $html = '';
        if(!empty($result ))
        {
            foreach($result as $field => $value) 
            { 
                if($value['online_stat'] == 'ONLINE')
                { 
                    $pc_stat = '<span class="badge badge-sm bg-gradient-success">Online</span>';
                    $stat = 'text-success';
                } 
                else
                {
                    $pc_stat = '<span class="badge badge-sm bg-gradient-danger">Offline</span>';
                    $stat = 'text-danger';
                }
                $badge = 'badge bg-secondary';
                if($value['is_vip'] == "YES")
                {
                    $badge = 'badge bg-warning';
                }
    
                $html .= '
                <tr>
                    <td class="align-middle text-sm"> 
                    <div class="d-flex px-2 py-1">
                        <div>
                            <i class="fas fa-desktop '.$stat.' me-3" aria-hidden="true"> </i>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-white fs-6 text-sm"> '.$value['pc_name'].'</h6>
                        </div>
                    </div>
                    </td>
                    <td class="align-middle text-center text-sm" >'.$value['ip_address'].'</td>  
                    <td class="align-middle text-center text-sm">'.$value['rem_time'].'</td>
                    <td class="align-middle text-center text-sm">'.$value['log_in_user'].'</td>
                    <td class="align-middle text-center text-sm">'.$value['to_sales'].'</td>
                    <td class="align-middle text-center text-sm"><span class = "'.$badge.'">'.$value['is_vip'].'</span></td>
                    <td class="align-middle text-center text-sm">'.$pc_stat.'</td> 
                </tr>';
            }
        } 
        return $html; 
    }

    function get_rates()
    { 
        $result = $this->sqlquery("SELECT rowid, credit, sec_to_time(sec_per_credit) as sec_per_creditx, sec_per_credit, points FROM rates WHERE is_vip = 'NO' order by credit asc");
        $html = '';
        if(!empty($result))
        {
            foreach($result as $field => $value) 
            {   
                $html .= '
                    <tr> 
                        <td class="align-middle text-center text-sm">&#8369; '.$value['credit'].'</td>
                        <td class="align-middle text-center text-sm">'.$value['sec_per_creditx'].'</td>
                        <td class="align-middle text-center text-sm">'.$value['points'].'</td> 
                        <td class="align-middle text-center text-sm">
                            <a href="#" class = "text-white px-3 py-1 bg-info rounded-2" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" >Actions</a>  
                            <ul class="dropdown-menu bg-gray-150 p-0" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#" onclick = "edit_rates(`'.$value['rowid'].'`,`'.$value['credit'].'`,`'.$value['sec_per_credit'].'`,`'.$value['points'].'`)">Edit</a></li> 
                                <li><a class="dropdown-item" href="#" onclick = "delete_rates(`'.$value['rowid'].'`)">Delete</a></li>  
                            </ul>  
                        </td>  
                    </tr>';
            }
        }
        
        return $html; 
    }

    function redeem_get_rates()
    { 
        $result = $this->sqlquery("Select rowid,points, sec_to_time(reward_time) as reward_timex, reward_time  from `points_rates` order by points asc");
        $html = '';
        if(!empty($result))
        {
            foreach($result as $field => $value) 
            {   
                $html .= '
                    <tr> 
                        <td class="align-middle text-center text-sm">'.$value['points'].' .pts</td>
                        <td class="align-middle text-center text-sm">'.$value['reward_timex'].'</td> 
                        <td class="align-middle text-center text-sm">
                            <a href="#" class = "text-white px-3 py-1 bg-info rounded-2" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" >Actions</a>  
                            <ul class="dropdown-menu bg-gray-150 p-0" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#" onclick = "edit_rates(`'.$value['rowid'].'`,`'.$value['points'].'`,`'.$value['reward_time'].'`)">Edit</a></li> 
                                <li><a class="dropdown-item" href="#" onclick = "delete_rates(`'.$value['rowid'].'`)">Delete</a></li>  
                            </ul>  
                        </td>  
                    </tr>';
            }
        }
        
        return $html; 
    }
    function get_vip_rates()
    { 
        $result = $this->sqlquery("SELECT rowid, credit, sec_to_time(sec_per_credit) as sec_per_creditx, sec_per_credit, points FROM rates WHERE is_vip = 'YES'  order by credit asc");
        $html = '';
        if(!empty($result))
        {
            foreach($result as $field => $value) 
            {   
                $html .= '
                    <tr> 
                        <td class="align-middle text-center text-sm">&#8369; '.$value['credit'].'</td>
                        <td class="align-middle text-center text-sm">'.$value['sec_per_creditx'].'</td>
                        <td class="align-middle text-center text-sm">'.$value['points'].'</td> 
                        <td class="align-middle text-center text-sm">
                            <a href="#" class = "text-white px-3 py-1 bg-info rounded-2" role="button" id="dropdownMenuLinkx" data-bs-toggle="dropdown" aria-expanded="false" >Actions</a>  
                            <ul class="dropdown-menu bg-gray-150 p-0" aria-labelledby="dropdownMenuLinkx">
                                <li><a class="dropdown-item" href="#" onclick = "vipedit_rates(`'.$value['rowid'].'`,`'.$value['credit'].'`,`'.$value['sec_per_credit'].'`,`'.$value['points'].'`)">Edit</a></li> 
                                <li><a class="dropdown-item" href="#" onclick = "vipdelete_rates(`'.$value['rowid'].'`)">Delete</a></li>  
                            </ul>  
                        </td>  
                    </tr>';
            }
        }
        
        return $html; 
    }
	
	function get_vvip_rates()
    { 
        $result = $this->sqlquery("SELECT rowid, credit, sec_to_time(sec_per_credit) as sec_per_creditx, sec_per_credit, points FROM rates WHERE is_vip = 'YYES'  order by credit asc");
        $html = '';
        if(!empty($result))
        {
            foreach($result as $field => $value) 
            {   
                $html .= '
                    <tr> 
                        <td class="align-middle text-center text-sm">&#8369; '.$value['credit'].'</td>
                        <td class="align-middle text-center text-sm">'.$value['sec_per_creditx'].'</td>
                        <td class="align-middle text-center text-sm">'.$value['points'].'</td> 
                        <td class="align-middle text-center text-sm">
                            <a href="#" class = "text-white px-3 py-1 bg-info rounded-2" role="button" id="dropdownMenuLinkx" data-bs-toggle="dropdown" aria-expanded="false" >Actions</a>  
                            <ul class="dropdown-menu bg-gray-150 p-0" aria-labelledby="dropdownMenuLinkx">
                                <li><a class="dropdown-item" href="#" onclick = "vvipedit_rates(`'.$value['rowid'].'`,`'.$value['credit'].'`,`'.$value['sec_per_credit'].'`,`'.$value['points'].'`)">Edit</a></li> 
                                <li><a class="dropdown-item" href="#" onclick = "vvipdelete_rates(`'.$value['rowid'].'`)">Delete</a></li>  
                            </ul>  
                        </td>  
                    </tr>';
            }
        }
        
        return $html; 
    }

    function get_member()
    { 
        $result = $this->sqlquery("Select rowid, `name`, username,password, 
		SEC_TO_TIME(remaining_time) remaining_time, 
		SEC_TO_TIME(vip_rem_time) vip_rem_time, 
		SEC_TO_TIME(vvip_rem_time) vvip_rem_time, 
		
		LPAD(FLOOR(remaining_time / 3600), LENGTH(FLOOR(remaining_time / 3600)), '0') m_hours, 
        LPAD(FLOOR((remaining_time % 3600) / 60), 2, '0')m_mins,  
        LPAD(remaining_time % 60, 2, '0') m_seconds,
		
		LPAD(FLOOR(vip_rem_time / 3600), LENGTH(FLOOR(vip_rem_time / 3600)), '0') v_m_hours, 
        LPAD(FLOOR((vip_rem_time % 3600) / 60), 2, '0')v_m_mins,  
        LPAD(vip_rem_time % 60, 2, '0') v_m_seconds,
		
		LPAD(FLOOR(vvip_rem_time / 3600), LENGTH(FLOOR(vvip_rem_time / 3600)), '0') vv_m_hours, 
        LPAD(FLOOR((vvip_rem_time % 3600) / 60), 2, '0')vv_m_mins,  
        LPAD(vvip_rem_time % 60, 2, '0') vv_m_seconds,
		
		credit,login_status,points, update_flag,
		CONCAT(
			TIMESTAMPDIFF(DAY, update_flag, now()), 'D ',
			LPAD(TIMESTAMPDIFF(HOUR, update_flag,now()) % 24, 2, '0'), 'H ',
			LPAD(TIMESTAMPDIFF(MINUTE, update_flag, now()) % 60, 2, '0'), 'M'
		) AS idle_time
		from `user` order by username asc");
        $html = '';
        if(!empty($result))
        {
            foreach($result as $field => $value) 
            {     
                $badge = 'p-2 badge bg-secondary';
                if($value['login_status'] == 'login')
                {
                    $badge = 'p-2 badge bg-success';
                }
                $html .= '
    <tr>
        <td class="align-middle text-center text-sm">
            <input type="checkbox" class="member-check" id="check'.$value['rowid'].'" value="'.$value['rowid'].'">
        </td>
        <td class="align-middle text-center text-sm">'.$value['name'].'</td>
        <td class="align-middle text-center text-sm">'.$value['username'].'</td>
        <td class="align-middle text-center text-sm">
            <div class="input-group d-flex justify-content-center align-items-center">
                <input type="password" id="passwordField'.$value['rowid'].'" class="text-center form-control text-white" value="'.$value['password'].'" readonly style="pointer-events: none;">
                <i class="fa-solid fa-eye text-white text-sm fs-6" id="eyeIcon'.$value['rowid'].'" onclick="togglePassword('.$value['rowid'].')"></i>
            </div>
        </td>
        <td class="align-middle text-center text-sm">'.$value['vip_rem_time'].'</td>
        <td class="align-middle text-center text-sm">'.$value['vvip_rem_time'].'</td>
        <td class="align-middle text-center text-sm">'.$value['remaining_time'].'</td>
        <td class="align-middle text-center text-sm">&#8369; '.$value['credit'].'</td>
        <td class="align-middle text-center text-sm">'.$value['points'].'</td>
        <td class="align-middle text-center text-sm">'.$value['idle_time'].'</td>
        <td class="align-middle text-center text-sm">'.$value['update_flag'].'</td>
        <td class="align-middle text-center text-sm"><span class="'.$badge.'">'.$value['login_status'].'</span></td>
        <td class="align-middle text-center text-sm">
            <a class="mb-0" href="#" onclick="delete_member(`'.$value['rowid'].'`)" data-bs-toggle="tooltip" title="Delete Member">
                <i class="fa-solid fa-trash-can text-white fs-6"></i>
            </a>
            <a class="mb-0 ms-1" href="#" onclick="change_pass(`'.$value['rowid'].'`,`'.$value['username'].'`,`'.$value['name'].'`)" data-bs-toggle="tooltip" title="Edit Member">
                <i class="fa-sharp text-white fa-solid fa-pen-to-square fs-6"></i>
            </a>
            <a class="mb-0 ms-1" href="#" onclick="top_up(`'.$value['rowid'].'`,`user`,`Top Up - '.$value['username'].'`)" data-bs-toggle="tooltip" title="Top Up">
                <i class="fa-solid text-white fa-money-bill-1-wave fs-6"></i>
            </a>
            <a class="mb-0 ms-1" href="#" onclick='."'".'add_time('.json_encode($value, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP).')'."'".' data-bs-toggle="tooltip" title="Add Time">
                <i class="fa-solid text-white fa-user-clock fs-6"></i>
            </a>
            <a class="mb-0 ms-1" href="#" onclick="resetx(`'.$value['rowid'].'`)" data-bs-toggle="tooltip" title="Reset Time">
                <i class="fa-solid text-white fa-arrow-rotate-left"></i>
            </a>
        </td>
    </tr>';


            }
        }
        
        return $html; 
    }



    function get_daily_sales()
    {
        $result = $this->sqlquery("SELECT
            SUM(CASE WHEN DAYOFWEEK(date_inserted) = 1 THEN credit ELSE 0 END) AS sunday,
            SUM(CASE WHEN DAYOFWEEK(date_inserted) = 2 THEN credit ELSE 0 END) AS monday,
            SUM(CASE WHEN DAYOFWEEK(date_inserted) = 3 THEN credit ELSE 0 END) AS tuesday,
            SUM(CASE WHEN DAYOFWEEK(date_inserted) = 4 THEN credit ELSE 0 END) AS wednesday,
            SUM(CASE WHEN DAYOFWEEK(date_inserted) = 5 THEN credit ELSE 0 END) AS thursday,
            SUM(CASE WHEN DAYOFWEEK(date_inserted) = 6 THEN credit ELSE 0 END) AS friday,
            SUM(CASE WHEN DAYOFWEEK(date_inserted) = 7 THEN credit ELSE 0 END) AS saturday
        FROM
            insert_logs
        WHERE
            DATE(date_inserted) >= CURDATE() - INTERVAL (DAYOFWEEK(CURDATE()) - 1) DAY
        AND DATE(date_inserted) < CURDATE() - INTERVAL (DAYOFWEEK(CURDATE()) - 1 - 7) DAY; 
        ");

      return json_encode($result);
    }


    function get_monthly_sales()
    {
        $result = $this->sqlquery('SELECT
        SUM(CASE WHEN MONTH(date_inserted) = 1 THEN credit ELSE 0 END) AS jan,
        SUM(CASE WHEN MONTH(date_inserted) = 2 THEN credit ELSE 0 END) AS feb,
        SUM(CASE WHEN MONTH(date_inserted) = 3 THEN credit ELSE 0 END) AS mar,
        SUM(CASE WHEN MONTH(date_inserted) = 4 THEN credit ELSE 0 END) AS apr,
        SUM(CASE WHEN MONTH(date_inserted) = 5 THEN credit ELSE 0 END) AS may,
        SUM(CASE WHEN MONTH(date_inserted) = 6 THEN credit ELSE 0 END) AS jun,
        SUM(CASE WHEN MONTH(date_inserted) = 7 THEN credit ELSE 0 END) AS jul,
        SUM(CASE WHEN MONTH(date_inserted) = 8 THEN credit ELSE 0 END) AS aug,
        SUM(CASE WHEN MONTH(date_inserted) = 9 THEN credit ELSE 0 END) AS sep,
        SUM(CASE WHEN MONTH(date_inserted) = 10 THEN credit ELSE 0 END) AS `oct`,
        SUM(CASE WHEN MONTH(date_inserted) = 11 THEN credit ELSE 0 END) AS nov,
        SUM(CASE WHEN MONTH(date_inserted) = 12 THEN credit ELSE 0 END) AS `dec`
        FROM `insert_logs` WHERE YEAR(date_inserted) = YEAR(NOW())');

        return json_encode($result);
    }


    function get_online()
    { 
        $result = $this->sqlquery("SELECT a.rowid, pcname, a.ip,mac_address, TIME_FORMAT(SEC_TO_TIME(`time_sec`),'%H:%i:%s') as time_secx, CONCAT('₱',' ',SUM(b.credit)) total_sales, attemp_cnt,max_attemp, CONCAT(insert_count_down, ' Seconds') as insert_count_down, CONCAT(shutdown_timer_sec, ' Seconds') as shutdown_timer_sec,insert_count_down as insert_timer,shutdown_timer_sec as shutdown_timer, `status` from clientpc as a
        left join 
        (
        Select credit, ip from insert_logs  where Date(date_inserted) = date(NOW())
        )as b on a.ip = b.ip
         group by a.ip order by pcname");
        $html = '';
        $i = 0;
        foreach($result as $field => $value) 
        {
            // $html .= $value['pcnamex'] ;
            $i++;
            $pc = 'text-danger';
            $pc_stat = '';
            $ena = '';
            $ena_auto = '';

            if($value['status'] == 'ONLINE')
            {
                $pc = 'text-success';
                $pc_stat = '<span class="badge badge-sm bg-gradient-success">Online</span>';
            } 
            else
            {
                $pc_stat = '<span class="badge badge-sm bg-gradient-secondary">Offline</span>';
            }
 
            $html .= '
                        <tr>
                            <td>'.$i.'</td> 
                            <td class="align-middle text-center text-sm">   
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="javascript:void(0)" onclick = "ResetTime('."'".$value['ip']."'".')">Reset Time</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" onclick = "openModal('."'addTime'".', '."'".$value['pcname']."'".', '."'".$value['ip']."'".', '."'".$value['mac_address']."'".')">Add Time</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" onclick = "ResetMaxAttemp('."'".$value['ip']."'".')">Reset Max Attempt</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0)" onclick = "openModal('."'shutdownTimer'".', '."'".$value['pcname']."'".', '."'".$value['ip']."'".', '."'".$value['mac_address']."'".','."'".$value['insert_timer']."'".','."'".$value['shutdown_timer']."'".')">Manange Shutdown Timer</a></li>
                                    </ul>
                                </div> 
                            </td>
                            <td> 
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <i class="fas fa-desktop '. $pc .' me-3" aria-hidden="true"> </i>
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm"> '.$value['pcname'].'</h6>
                                </div>
                            </div>
                            </td>
                            <td  >'.$value['ip'].'</td>
                            <td class="align-middle text-center text-sm">'.$value['mac_address'].'</td>
                            <td class="align-middle text-center text-sm">'.$value['time_secx'].'</td>
                            <td class="align-middle text-center text-sm">'.$value['total_sales'].'</td>
                            <td class="align-middle text-center text-sm">'.$value['attemp_cnt'].'</td>
                            <td class="align-middle text-center text-sm">'.$value['max_attemp'].'</td>
                            <td class="align-middle text-center text-sm">'.$value['insert_count_down'].'</td>
                            <td class="align-middle text-center text-sm">'.$value['shutdown_timer_sec'].'</td>
                            <td class="align-middle text-center text-sm">'.$pc_stat.'</td> 
                        </tr>';
        }
        return $html; 
    } 

    function apply_autoshutdown($stat)
    {
        $result = $this->sqlnonquery("UPDATE clientpc set `enable` = ? ", array($stat));
        return $result;
    }

    function disable_autoshutdown($rowid,$stat)
    { 
        $result = $this->sqlnonquery("UPDATE clientpc set `enable` = ? where rowid = ? ", array($stat, $rowid));
        return $result;
    }

    function addTime($ip ,$pcname,$mac_add , $tot_time )
    {
        // $data = array(
        //     'ip'            => $ip,
        //     'pcname'        => $pcname,
        //     'addtime'       => $tot_time,
        //     'mac_add'       => $mac_add,
        //     'date_inserted' => date('Y-m-d H:i:s')
        // );
        $res = $this->sqlquery("SELECT time_sec from clientpc where ip = '$ip'"); 

        $time  =  (int)$tot_time + (int)$res[0]['time_sec'];
        $result = $this->sqlnonquery("UPDATE clientpc set `time_sec` = ? where ip = ? ", array($time, $ip)); 

        if($result)
        { 
            $result2 = $this->sqlnonquery("INSERT into add_time_logs (ip,pcname,`addtime`,mac_address,date_inserted) values (?,?,?,?,?)", array($ip ,$pcname,$tot_time,$mac_add , date('Y-m-d H:i:s'))); 
            return $result2;
        }
        else
        {
            return $result2;
        }
    }

    function resetMaxattempt($ip)
    {
        $result = $this->sqlnonquery("UPDATE clientpc set `attemp_cnt` = ? where ip = ? ", array('0', $ip)); 
        return $result;
    }

    function resetTime($ip)
    {
        $result = $this->sqlnonquery("UPDATE clientpc set `time_sec` = ? where ip = ? ", array('0', $ip)); 
        return $result;
    }

    function manageShutdown_timer($ip,$insert_timer,$shutdown_timer)
    {
        $result = $this->sqlnonquery("UPDATE clientpc set  insert_count_down = ?, shutdown_timer_sec = ? where ip = ? ", array($insert_timer,$shutdown_timer, $ip)); 
        return $result;
    }

    function weekly_sales()
    {
        $sql = "SELECT WEEK(date_inserted) AS week_number, YEAR(date_inserted) AS year, SUM(credit) AS weekly_sales
        FROM insert_logs
        GROUP BY week_number, year
        ORDER BY year, week_number limit 1;
        ";

        $result = $this->sqlquery($sql);
        return json_encode($result);
    }

    function monthly_sale()
    {
        $sql = "SELECT MONTH(date_inserted) AS month, YEAR(date_inserted) AS year, SUM(credit) AS monthly_sale
        FROM insert_logs
        GROUP BY year, month
        ORDER BY year, month limit 1;
        ";

        $result = $this->sqlquery($sql);
        return json_encode($result);
    }

    function yearly_sale()
    {
        $sql = "SELECT YEAR(date_inserted) AS year, SUM(credit) AS yearly_sale
        FROM insert_logs
        GROUP BY year
        ORDER BY year limit 1; 
        ";

        $result = $this->sqlquery($sql);
        return json_encode($result);
    }

    function getallsales($df, $dt)
    {
        $dates = "'".$df ." 00:00:00 '"." AND '". $dt . " 23:59:59'"; 
        $sql = "SELECT a.rowid,
            DATE(a.date_inserted) AS `date`,  
            b.pc_name,
            a.ip_address AS ip, 
            a.mac_address, 
            a.credit AS credit, 
            TIME_FORMAT(SEC_TO_TIME(a.`credit_time`),'%H:%i:%s') AS `time`, 
            a.date_inserted 
        FROM insert_logs  AS a
        LEFT JOIN clientpc AS b ON a.mac_address = b.mac_address
        WHERE a.date_inserted BETWEEN  $dates"; 
        $result = $this->sqlquery($sql);

        $html = '';  

        if(is_array($result ))
        {	
			$i = 0;
            foreach($result as $field => $value) 
            { 
				$i += 1;
                $html .= '
                    <tr>
						<td class = "text-center">'.$i.'</td>  
                        <td class = "text-center">'.$value['date'].'</td>  
                        <td class = "text-center">'.$value['pc_name'].'</td>  
                        <td class = "text-center">'.$value['ip'].'</td> 
                        <td class = "text-center">'.$value['mac_address'].'</td> 
                        <td class = "text-center">&#8369;'.$value['credit'].'</td> 
                        <td class = "text-center">'.$value['time'].'</td> 
                        <td class = "text-center">'.$value['date_inserted'].'</td> 
                    </tr>
                ';
            }
        }
       
        return $html;
    }

    function redeem_history($df, $dt)
    {
        $dates = "'".$df ." 00:00:00 '"." AND '". $dt . " 23:59:59'"; 
        $sql = "SELECT rowid, points,sec_to_time(reward_time) reward_time,`user`, date_redeem, remaining_points from `redeem_history` where date_redeem BETWEEN  $dates"; 
        $result = $this->sqlquery($sql); 
        $html = '';  

        if(is_array($result ))
        {
			$i = 0;
            foreach($result as $field => $value) 
            { 
				$i += 1;
                $html .= '
                    <tr>
						<td class = "text-center">'.$i.'</td> 
                        <td class = "text-center">'.$value['points'].' pts</td>  
                        <td class = "text-center">'.$value['reward_time'].'</td>  
                        <td class = "text-center">'.$value['user'].'</td> 
                        <td class = "text-center">'.$value['remaining_points'].' pts</td>  
                        <td class = "text-center">'.$value['date_redeem'].'</td>  
                    </tr>
                ';
            }
        }
       
        return $html;
    }


    function update_per_pc()
    {
        $sql = "SELECT 
            a.rowid,
            case when c.login_status = 'login' then
			case when a.is_vip = 'YES' then sec_to_time(c.vip_rem_time) when  a.is_vip = 'YYES' then sec_to_time(c.vvip_rem_time) else  sec_to_time(c.remaining_time) end
			else SEC_TO_TIME(a.remaining_time) end as rem_time,#
            ifnull(b.tot_cred,0) tot_cred,#
            c.username, #
            b.last_inserted,
			a.online_stat
        from `clientpc` as a
        left join (
            Select SUM(credit)as tot_cred,ip_address, max(date_inserted) as last_inserted from `insert_logs` 
            WHERE DATE(date_inserted) = DATE(NOW()) GROUP BY ip_address
        )as b on a.ip_address = b.ip_address 
        left join `user` as c on a.log_in_user = c.username and c.login_status = 'login'
        order by a.pc_name 
        ";
        $result = $this->sqlquery($sql);
        return $result;
    } 

    function add_time($table,$rowid,$time)
    {
        $result = $this->sqlnonquery("Update clientpc set remaining_time = remaining_time + ? where rowid = ?", array($time,$rowid));
        $sql   = "Insert into add_time_logs (client_id, add_time, date_inserted,`table`, user) values (?,?,NOW(),?,?)";
        $reslt = $this->sqlnonquery($sql,array($rowid,$time,$table,$_SESSION['username']));
        return $reslt;
    }
	
	function deduct_time($table,$rowid,$time)
    {
        $result = $this->sqlnonquery("Update clientpc set remaining_time = case WHEN remaining_time - ? < 0 THEN 0 ELSE remaining_time - ? end where rowid = ?", array($time,$time,$rowid)); 
        return $result;
    }
	
	function manage_time_guest($table,$rowid,$time)
    {
        $result = $this->sqlnonquery("Update $table set remaining_time = ? where rowid = ?", array($time,$rowid));  
        return $result;
    }
    function reset_time($table,$rowid)
    {
        $result = $this->sqlnonquery("Update $table set remaining_time = 0 where rowid = ?", array($rowid));
        return $result;
    }

    function remove_pc($rowid)
    {
        $result = $this->sqlnonquery("DELETE FROM `clientpc` WHERE rowid = ?", array($rowid));
        return $result;
    }
	
	function enableApp($rowid,$state)
	{
		$result = $this->sqlnonquery("Update clientpc set enable_autoshutdown = ? where rowid = ?", array($state,$rowid));
        return $result;
	}
	
	function update_rem_time($rem_time,$action)
	{ 
		$sql = "update `clientpc` set remaining_time = remaining_time + ?";
		if($action == "Reset all guest Time")
		{
			$sql = "update `clientpc` set remaining_time = ?"; 
		} 
		$result = $this->sqlnonquery($sql, array($rem_time));
        return $result;
	}
	
	function update_user_time($rem_time,$rowid, $fields)
	{ 
		$result = $this->sqlnonquery("update `user` set $fields = $fields + ? where rowid = ?", array($rem_time, $rowid));
        return $result;
	}
	
	function update_user_timex($rem_time,$fields,$ids)
	{   
		if (!empty($ids)) {
			$idList = implode(",", array_map('intval', $ids)); 
			$query = "UPDATE `user` set $fields = $fields + ? WHERE rowid IN ($idList)";
			return $this->sqlnonquery($query, array($rem_time)); 
		}else{
			return false;
		} 
	}
	
	function deduct_user_time($rem_time,$rowid, $fields)
	{ 
		$result = $this->sqlnonquery("update `user` set $fields = case when $fields - ? < 0 then  0 else $fields - ? end  where rowid = ?", array($rem_time,$rem_time, $rowid));
        return $result;
	}
	
	function deduct_user_timex($rem_time,$fields,$ids)
	{   
		if (!empty($ids)) {
			$idList = implode(",", array_map('intval', $ids));  
			$result = $this->sqlnonquery("UPDATE `user` set $fields = case when $fields - ? < 0 then  0 else $fields - ? end WHERE rowid IN ($idList)", array($rem_time,$rem_time));
       		return $result;
		}else{
			return false;
		} 
	}
	
	function addPoints($rowid,$points)
	{ 
		$result = $this->sqlnonquery("update `user` set points = points + ? where rowid = ?", array($points, $rowid));
        return $result;
	}
	function addPointsx($points,$ids)
	{   
		if (!empty($ids)) {
			$idList = implode(",", array_map('intval', $ids));   
			$result = $this->sqlnonquery("UPDATE `user` set points = points + ? WHERE rowid IN ($idList)", array($points));
       		return $result;
		}else{
			return false;
		}  
	}
	
	function deductPoints($rowid,$points)
	{ 
		$result = $this->sqlnonquery("update `user` set points = case when points - ? < 0 then 0 else points - ?  end where rowid = ?", array($points,$points, $rowid));
        return $result;
	}
	
	function deductPointsx($points,$ids)
	{  
		if (!empty($ids)) {
			$idList = implode(",", array_map('intval', $ids));    
			$result = $this->sqlnonquery("UPDATE `user` set points = case when points - ? < 0 then 0 else points - ?  end WHERE rowid IN ($idList)", array($points,$points));
       		return $result;
		}else{
			return false;
		}  
	}
	
	function change_background($newFileName, $rowid)
    {  
        $result = $this->sqlnonquery("update `clientpc` set background_img = ? where rowid = ?", array($newFileName, $rowid)); 
        return $result;
    }
	
	function change_logo($newFileName)
    {  
        $result = $this->sqlnonquery("update `settings` set logo_path = ?", array($newFileName)); 
        return $result;
    }
	
	function change_bg($newFileName)
    {  
        $result = $this->sqlnonquery("update `settings` set bg_path = ?", array($newFileName)); 
        return $result;
    }

    function salesx($type)
    { 
		$option = "";
		$option2 = "";
		if($type != "ALL")
		{
			$option = " AND coinslot_name = '$type'";
			$option2 = " WHERE coinslot_name = '$type'";
		}

        $data = array();
        $today_sales = $this->sqlquery("SELECT ifnull(SUM(credit),0) as today_sales from `insert_logs` where date(date_inserted) = date(now()) $option "); 
        $weekly_sales = $this->sqlquery("SELECT WEEK(date_inserted) AS week_number, YEAR(date_inserted) AS year, ifnull(SUM(credit),0) AS weekly_sales
        FROM insert_logs
		$option2
        GROUP BY week_number, year
        ORDER BY year desc, week_number desc limit 1"); 
        $monthly_sale = $this->sqlquery("SELECT MONTH(date_inserted) AS month, YEAR(date_inserted) AS year, ifnull(SUM(credit),0) AS monthly_sale
        FROM insert_logs
		$option2
        GROUP BY year, month
        ORDER BY year desc, month DESC limit  1");  
        $yearly_sale = $this->sqlquery("SELECT YEAR(date_inserted) AS year, ifnull(SUM(credit),0) AS yearly_sale
        FROM insert_logs
		$option2
        GROUP BY year
        ORDER BY year desc limit 1"); 
     
        
        $data['today_sales']  = $today_sales[0]['today_sales'] ?? 0;
        $data['weekly_sales'] = $weekly_sales[0]['weekly_sales'] ?? 0;
        $data['monthly_sale'] = $monthly_sale[0]['monthly_sale'] ?? 0;
        $data['yearly_sale']  = $yearly_sale[0]['yearly_sale'] ?? 0;
        return $data;
    }


    function system_info()
    {
		$output = shell_exec("python3 /var/www/python/system_info2.py");
		return "$output";

        // $data = $this->sqlquery("SELECT sys_ver,device_model, processor, cpu_temp, cpu_usage,ram_total,ram_free,ram_used,`storage`, up_time,aes_decrypt(machine_id, 'icandoallthingssc30') as  `serial`, local_ip FROM `system_info`");  
        // return $data;
    } 
   
	function change_ip($ip,$gw,$network_type)
    {   
		if($network_type == 'DHCP')
		{       
			$output = shell_exec("python3 /var/www/python/dhcp.py");
			return "Success";
		} 
		else
		{
			$command = 'sudo nmcli connection modify "Wired connection 1" ipv4.method manual ipv4.addresses '.$ip.'/24 ipv4.gateway '.$gw.' ipv4.dns 8.8.8.8'; 
			$command2 = 'sudo nmcli connection up "Wired connection 1"';  
			$output = '';
			$error = '';
 
			exec($command, $output, $return_var);
			if ($return_var !== 0) {
				$error = 'Error executing command 1: ' . implode("\n", $output);
			}
 
			exec($command2, $output, $return_var);
			if ($return_var !== 0) {
				$error .= ' Error executing command 2: ' . implode("\n", $output);
			} 
			
			$outputString = implode(" ", $output); 
			$pos = strpos($outputString, 'successfully');
			if($pos !== false) 
			{ 
				return "Success";
			}  
			else
			{
				return $error ?: implode("\n", $output); 
			}
		}
    }

    function shutdown_reboot($cmd)
    { 
        if ($cmd == "SHUTDOWN") {
            $command = "sudo /sbin/shutdown now";
        } else {
            $command = "sudo /sbin/reboot";
        }
        $output = exec($command); 
        echo "<pre>$output</pre>";
    }
    function get_timer_settings()
    {
        $sql = "SELECT enable_auto_close,shutdown_sec,sec_insert_coin,sec_attempt_locked, max_attempt, show_member_login, show_create_acc,  
		max_credit_create ,beep_sound_on_state, speed_timer, show_voucher,show_watchtv,enable_auto_reset_time,enable_transfertime,min_transfer,ena_cam,ena_spectate,ena_pc_performance
		FROM `settings`";
        $result = $this->sqlquery($sql); 
        if(!empty($result))
        {
			$show_create_acc = '';
			$show_member_login = '';
			$show_voucher = '';
			$enable_auto_reset_time = '';
			$show_watchtv = '';
			$enable_auto_close = '';
			$enable_transfertime = '';
			$ena_spectate = '';
			$ena_pc_performance = '';
			$ena_cam = '';
			if($result[0]['show_create_acc'] == 'N')
			{
				$show_create_acc = 'selected';
			}
			if($result[0]['show_member_login'] == 'N')
			{
				$show_member_login = 'selected';
			}
			if($result[0]['show_voucher'] == 'N')
			{
				$show_voucher = 'selected';
			}
			if($result[0]['show_watchtv'] == 'N')
			{
				$show_watchtv = 'selected';
			}
			if($result[0]['enable_auto_reset_time'] == 'N')
			{
				$enable_auto_reset_time = 'selected';
			}
			if($result[0]['enable_auto_close'] == 'N')
			{
				$enable_auto_close = 'selected';
			}
			if($result[0]['enable_transfertime'] == 'N')
			{
				$enable_transfertime = 'selected';
			}
			if($result[0]['ena_cam'] == 'N')
			{
				$ena_cam = 'selected';
			} 
			if($result[0]['ena_spectate'] == 'N')
			{
				$ena_spectate = 'selected';
			}  
			if($result[0]['ena_pc_performance'] == 'N')
			{
				$ena_pc_performance = 'selected';
			} 
				
			 $html = '
                <div class="card-body px-2 pb-3" >
                   <div class = "row g-1 px-2"> 
				   
						<div class = "col-xl-6 col-md-6  col-sm-12">
						  <div class="w-100 form-floating mb-1 border rounded-3">
							<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="shutdown_sec" min = "0" name = "shutdown_sec" value = "'.$result[0]['shutdown_sec'].'">
							<label for="shutdown_sec">Shutdown Timer (Secs)</label>
						  </div> 
						</div>
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
						  <div class="w-100 form-floating mb-1 border rounded-3">
							<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="sec_insert_coin" name = "sec_insert_coin" min = "0" value = "'.$result[0]['sec_insert_coin'].'">
							<label for="sec_insert_coin">Insert Timer (Secs)</label>
						  </div> 
						</div> 
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
						  <div class="w-100 form-floating mb-1 border rounded-3">
							<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="max_attempt" name = "max_attempt" min = "0" value = "'.$result[0]['max_attempt'].'">
							<label for="max_attempt">Max Attempt</label>
						  </div> 
						</div> 
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
						  <div class="w-100 form-floating mb-1 border rounded-3">
							<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="sec_attempt_locked" name = "sec_attempt_locked" min = "0" value = "'.$result[0]['sec_attempt_locked'].'">
							<label for="sec_attempt_locked">Max Attempt Locked (Secs)</label>
						  </div> 
						</div> 
						 
						<div class = "col-xl-6 col-md-6  col-sm-12">
						  <div class="w-100 form-floating mb-1 border rounded-3">
							<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="max_credit_create" name = "max_credit_create" min = "0" value = "'.$result[0]['max_credit_create'].'">
							<label for="max_credit_create">Create Account Min Credit (PHP)</label>
						  </div> 
						</div> 
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
						  <div class="w-100 form-floating mb-1 border rounded-3">
							<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="beep_sound_on_state" name = "beep_sound_on_state" min = "0" value = "'.$result[0]['beep_sound_on_state'].'">
							<label for="beep_sound_on_state">Insert Beep Alert On (Seconds)</label>
						  </div> 
						</div> 
						 
						<div class="col-xl-6 col-md-6 col-sm-12">
							<div class="w-100 form-floating mb-1 border rounded-3">
								<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="speed_timer" name = "speed_timer" max = "1000" min = "0" value = "'.$result[0]['speed_timer'].'">
							<label for="speed_timer">Speed Timer (Default:1000ms | 1000ms = 1second)</label>
						  </div> 
						</div> 
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
							<div class="w-100 form-floating mb-1">
							  <select class="ps-4 form-select" id="show_member_login"  name = "show_member_login" aria-label="Floating label select example">
							   <option value="Y">YES</option>
							   <option value="N" '.$show_member_login.'>NO</option> 
							  </select>
							  <label for="show_member_login">Enable Member Login</label>
							</div>
						</div>
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
							<div class="w-100 form-floating mb-1">
							  <select class="ps-4 form-select" id="show_create_acc" name = "show_create_acc"  aria-label="Floating label select example">
							   <option value="Y">YES</option>
							   <option value="N" '.$show_create_acc.'>NO</option> 
							  </select>
							  <label for="show_create_acc">Enable Create Account</label>
							</div>
						</div>
						
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
							<div class="w-100 form-floating mb-1">
							  <select class="ps-4 form-select" id="show_voucher"  name = "show_voucher" aria-label="Floating label select example">
							   <option value="Y">YES</option>
							   <option value="N" '.$show_voucher.'>NO</option> 
							  </select>
							  <label for="show_voucher">Enable Voucher</label>
							</div>
						</div>
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
							<div class="w-100 form-floating mb-1">
							  <select class="ps-4 form-select" id="show_watchtv" name = "show_watchtv"  aria-label="Floating label select example">
							   <option value="Y">YES</option>
							   <option value="N" '.$show_watchtv.'>NO</option> 
							  </select>
							  <label for="show_watchtv">Enable Watch TV</label>
							</div>
						</div>
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
							<div class="w-100 form-floating mb-1">
							  <select class="ps-4 form-select" id="enable_auto_reset_time" name = "enable_auto_reset_time"  aria-label="Floating label select example">
							   <option value="Y">YES</option>
							   <option value="N" '.$enable_auto_reset_time.'>NO</option> 
							  </select>
							  <label for="enable_auto_reset_time">Enable Auto Reset Guest Time Upon Shutdown</label>
							</div>
						</div> 
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
							<div class="w-100 form-floating mb-1">
							  <select class="ps-4 form-select" id="enable_auto_close" name = "enable_auto_close"  aria-label="Floating label select example">
							   <option value="Y">YES</option>
							   <option value="N" '.$enable_auto_close.'>NO</option> 
							  </select>
							  <label for="enable_auto_close">Enable Auto Close All Running Application</label>
							</div>
						</div>  
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
							<div class="w-100 form-floating mb-1">
							  <select class="ps-4 form-select" id="ena_cam" name = "ena_cam"  aria-label="Floating label select example" disabled>
							   <option value="Y">YES</option>
							   <option value="N" '.$ena_cam.'>NO</option> 
							  </select>
							  <label for="ena_cam">Enable Camera Recording</label>
							</div>
						</div>  
						
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
							<div class="w-100 form-floating mb-1">
							  <select class="ps-4 form-select" id="enable_transfertime" name = "enable_transfertime"  aria-label="Floating label select example">
							   <option value="Y">YES</option>
							   <option value="N" '.$enable_transfertime.'>NO</option> 
							  </select>
							  <label for="enable_transfertime">Enable Transfer Time</label>
							</div>
						</div> 
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
						  <div class="w-100 form-floating mb-1 border rounded-3">
							<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="min_transfer" name = "min_transfer" min = "1" value = "'.$result[0]['min_transfer'].'">
							<label for="min_transfer">Minimum Transfer Time</label>
						  </div> 
						</div> 

						<div class = "col-xl-6 col-md-6  col-sm-12">
							<div class="w-100 form-floating mb-1">
							  <select class="ps-4 form-select" id="ena_spectate" name = "ena_spectate"  aria-label="Floating label select example">
							   <option value="Y">YES</option>
							   <option value="N" '.$ena_spectate.'>NO</option> 
							  </select>
							  <label for="ena_spectate">Enable Spectate</label>
							</div>
						</div>  

						<div class = "col-xl-6 col-md-6  col-sm-12">
							<div class="w-100 form-floating mb-1">
							  <select class="ps-4 form-select" id="ena_pc_performance" name = "ena_pc_performance"  aria-label="Floating label select example">
							   <option value="Y">YES</option>
							   <option value="N" '.$ena_pc_performance.'>NO</option> 
							  </select>
							  <label for="ena_pc_performance">Enable PC Performance</label>
							</div>
						</div> 
						 
					</div> 
					
					<div class = "mb-0 mt-1 px-2 mb-1"> 
						<button type="button" class="mb-2 w-100 h-100 mb-0 btn btn-success float-end" onclick = "save_timer()">Save</button> 
					</div> 
                </div> ';  
            return $html;
        }
        else
        {
            return false;
        }
    }
	
	function get_loginRules()
    {
        $sql = "Select * from `loginRules` limit 1";
        $result = $this->sqlquery($sql); 
        if(!empty($result))
        { 
			$is_ena = '';
			if($result[0]['is_enable'] == 'N')
			{
				$is_ena = 'selected';
			}
			
			 $html = '
                <div class="card-body px-2 pb-3 pt-0" >
                   <div class = "row g-1 px-2">  
						<div class = "col-xl-12 col-md-12  col-sm-12">
							<div class="w-100 form-floating mb-1">
							  <select class="ps-4 form-select" id="is_enable" name = "is_enable"  aria-label="Floating label select example">
							   <option value="Y">ENABLE</option>
							   <option value="N" '.$is_ena.'>DISABLE</option> 
							  </select>
							  <label for="is_enable">Enable/Disable this function</label>
							</div>
						</div> 
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
						  <div class="w-100 form-floating mb-1 border rounded-3">
							<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="minimum_consume_time" min = "0" name = "minimum_consume_time" value = "'.$result[0]['minimum_consume_time'].'">
							<label for="minimum_consume_time">Minimum Consume Time (in minutes)</label>
						  </div> 
						</div>
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
						  <div class="w-100 form-floating mb-1 border rounded-3">
							<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="max_attempt2" name = "max_attempt2" min = "0" value = "'.$result[0]['max_attempt2'].'">
							<label for="max_attempt2">Max Attempt</label>
						  </div> 
						</div> 
						 
						<div class = "col-xl-6 col-md-6  col-sm-12">
						  <div class="w-100 form-floating mb-1 border rounded-3">
							<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="lock_time" name = "lock_time" min = "0" value = "'.$result[0]['lock_time'].'">
							<label for="lock_time">Lock Time (in minutes)</label>
						  </div> 
						</div> 
						
						<div class = "col-xl-6 col-md-6  col-sm-12">
						  <div class="w-100 form-floating mb-1 border rounded-3">
							<input type="number" class="form-control ps-2 text-center fw-bold fs-5" id="penalty" name = "penalty" min = "0" value = "'.$result[0]['penalty'].'">
							<label for="penalty">Penalty/Deduction (in minutes)</label>
						  </div> 
						</div> 
					</div> 
					
					<div class = "mb-0 mt-1 px-2 mb-1"> 
						<button type="button" class="mb-2 w-100 h-100 mb-0 btn btn-success float-end" onclick = "save_loginrules()">Save</button> 
					</div> 
                </div> ';  
            return $html;
        }
        else
        {
            return false;
        }
    }

    function save_timer()
    {
        $update = "";
        foreach ($_POST as $key => $value) {
            if($key != "request")
            {
                $update .= "$key = '$value', ";
            }
        }
        $update = rtrim($update, ", ");
        $sql = "Update `settings` set $update";
        $result = $this->sqlnonquery($sql);
        return $result;
    }
	
	function save_loginrules()
	{
		$update = "";
        foreach ($_POST as $key => $value) {
            if($key != "request")
            {
                $update .= "$key = '$value', ";
            }
        }
        $update = rtrim($update, ", ");
        $sql = "Update `loginRules` set $update";
        $result = $this->sqlnonquery($sql);
        return $result;
	}

    function get_announcement()
    {
        $data = $this->sqlquery("Select announcement, speech_msg, time_open, time_close, early_warning, enable_schedule, credit_per_pulse, enable_logo, logo_path, `password`, overwrite_bg, bg_path,ena_bill from `settings`");  
        return $data;
    } 

    function server_ip()
    {  
		$output = shell_exec("python3 /var/www/python/ip.py");
		return "$output";
        // $data = $this->sqlquery("Select local_ip,gateway,network_type from `system_info` ");  
        // return $data;
    }

    function update_announcement($lock_msg, $before_msg)
    {
        $result = $this->sqlnonquery("Update settings set announcement = ?, speech_msg = ?", array($lock_msg, $before_msg));
        return $result;
    }

    function update_open_closed($time_open, $time_close, $early_warning)
    {
        $result = $this->sqlnonquery("Update settings set time_open = ?, time_close = ? , early_warning = ?", array($time_open, $time_close, $early_warning));
        return $result;
    }

    function update_enable_schedule($state)
    {
        if($state == 'true')
        {
            $val = 'Y';
        }
        else
        {
            $val = 'N';
        }
        $result = $this->sqlnonquery("Update settings set enable_schedule = ?", array($val));
        return $result;
    }
	
	function enable_tele($state)
    {
        if($state == 'true')
        {
            $val = 'Y';
        }
        else
        {
            $val = 'N';
        }
        $result = $this->sqlnonquery("UPDATE `telegram` SET is_enable = ?", array($val));
        return $result;
    }
	
	function enable_logo($state)
    {
        if($state == 'true')
        {
            $val = 'Y';
        }
        else
        {
            $val = 'N';
        }
        $result = $this->sqlnonquery("Update settings set enable_logo = ?", array($val));
        return $result;
    }
	
	function ena_bill($state)
    {
        if($state == 'true')
        {
            $val = 'Y';
        }
        else
        {
            $val = 'N';
        }
        $result = $this->sqlnonquery("Update settings set ena_bill = ?", array($val));
        return $result;
    }
	
	function overwrite_bg($state)
    {
        if($state == 'true')
        {
            $val = 'Y';
        }
        else
        {
            $val = 'N';
        }
        $result = $this->sqlnonquery("Update settings set overwrite_bg = ?", array($val));
        return $result;
    }

    function delete_rates($rowid)
    {
        $result = $this->sqlnonquery("DELETE FROM `rates` WHERE rowid = ?", array($rowid));
        return $result;
    }

    function vipdelete_rates($rowid)
    {
        $result = $this->sqlnonquery("DELETE FROM `rates` WHERE rowid = ?", array($rowid));
        return $result;
    }
	
	function vvipdelete_rates($rowid)
    {
        $result = $this->sqlnonquery("DELETE FROM `rates` WHERE rowid = ?", array($rowid));
        return $result;
    }
    function redeem_delete_rates($rowid)
    {
        $result = $this->sqlnonquery("DELETE FROM `points_rates` WHERE rowid = ?", array($rowid));
        return $result;
    }

    function delete_member($rowid)
    {
        $result = $this->sqlnonquery("DELETE FROM `user` WHERE rowid = ?", array($rowid));
        return $result;
    }
    
	function delete_users($rowid)
    {
        $result = $this->sqlnonquery("DELETE FROM `users` WHERE rowid = ?", array($rowid));
        return $result;
    }
    

    function save_rates_update($rowid, $credit,$time_sec, $points)
    {
        if($rowid != "")
        {
            $sql = "UPDATE `rates` SET credit = ?, sec_per_credit = ? , points = ? WHERE rowid = ?";
            $result = $this->sqlnonquery($sql, array($credit,$time_sec, $points, $rowid));
            return $result;
        }
        else
        {
            
            $data = $this->sqlquery("SELECT * FROM rates WHERE credit = '$credit' and is_vip = 'NO'");  
        
            if(!empty($data))
            {   
                return "Credit: $credit is already added!.";
            }
            else
            {
                $sql = "Insert into `rates` (credit, sec_per_credit, points, is_vip) values (?,?,?, 'NO')";
                $result = $this->sqlnonquery($sql, array($credit,$time_sec, $points));
                return $result;
            }
        }
    }

    function redeem_save_rates_update($rowid, $credit,$time_sec)
    {
        if($rowid != "")
        {
            $sql = "UPDATE `points_rates` SET points = ?, reward_time = ? WHERE rowid = ?";
            $result = $this->sqlnonquery($sql, array($credit,$time_sec, $rowid));
            return $result;
        }
        else
        {
            
            $data = $this->sqlquery("SELECT * FROM points_rates WHERE points = '$credit'");  
        
            if(!empty($data))
            {   
                return "Points: $credit is already added!.";
            }
            else
            {
                $sql = "Insert into `points_rates` (points, reward_time) values (?,?)";
                $result = $this->sqlnonquery($sql, array($credit,$time_sec));
                return $result;
            }
        }
    }

    function vipsave_rates_update($rowid, $credit,$time_sec, $points)
    {
        if($rowid != "")
        {
            $sql = "UPDATE `rates` SET credit = ?, sec_per_credit = ? , points = ? WHERE rowid = ?";
            $result = $this->sqlnonquery($sql, array($credit,$time_sec, $points, $rowid));
            return $result;
        }
        else
        {
            
            $data = $this->sqlquery("SELECT * FROM rates WHERE credit = '$credit' and is_vip = 'YES'");  
        
            if(!empty($data))
            {   
                return "Credit: $credit is already added!.";
            }
            else
            {
                $sql = "Insert into `rates` (credit, sec_per_credit, points, is_vip) values (?,?,?, 'YES')";
                $result = $this->sqlnonquery($sql, array($credit,$time_sec, $points));
                return $result;
            }
        }
    }
	
	function vvipsave_rates_update($rowid, $credit,$time_sec, $points)
    {
        if($rowid != "")
        {
            $sql = "UPDATE `rates` SET credit = ?, sec_per_credit = ? , points = ? WHERE rowid = ?";
            $result = $this->sqlnonquery($sql, array($credit,$time_sec, $points, $rowid));
            return $result;
        }
        else
        {
            
            $data = $this->sqlquery("SELECT * FROM rates WHERE credit = '$credit' and is_vip = 'YYES'");  
        
            if(!empty($data))
            {   
                return "Credit: $credit is already added!.";
            }
            else
            {
                $sql = "Insert into `rates` (credit, sec_per_credit, points, is_vip) values (?,?,?, 'YYES')";
                $result = $this->sqlnonquery($sql, array($credit,$time_sec, $points));
                return $result;
            }
        }
    }

    function save_member($rowid, $name,$username, $password)
    {
        if($rowid != "")
        {
            $sql = "UPDATE `user` SET name = ?, username = ? , password = ? WHERE rowid = ?";
            $result = $this->sqlnonquery($sql, array($name,$username, $password, $rowid));
            return $result;
        }
        else
        {
            
            $data = $this->sqlquery("SELECT * FROM user WHERE username like '%$username%'");  
        
            if(!empty($data))
            {   
                return "Username: $username is already exist!.";
            }
            else
            {
                $sql = "Insert into `user` (name, username, password) values (?,?,?)";
                $result = $this->sqlnonquery($sql, array($name,$username, $password));
                return $result;
            }
        }
    }

    function set_as_vip($rowid, $value)
    {
        $sql = "update `clientpc` set is_vip = ? where rowid = ?";
        $result = $this->sqlnonquery($sql, array($value, $rowid));
        return $result;
    }

    function update_pass($full_name,$username,$password)
    {
		$result = $this->sqlquery("Select * from users where `username` =  ? and rowid != ?", array($username, $_SESSION['login_id']));
		
		if(!empty($result))
		{
			return "Already Exist!";
		}
		else
		{
			$sql = "UPDATE `users` SET full_name = ?, username = ?, `password` = ? WHERE rowid = ?";
			$result = $this->sqlnonquery($sql, array($full_name,$username,$password,$_SESSION['login_id']));
			if($result > 0)
			{
				$_SESSION['username'] = $username ;
				$_SESSION['password'] = $password; 
				$_SESSION['full_name'] = $full_name; 
			}
			return $result;
		} 
    }
	
	
	function app_update_pass($pass)
    {
		$sql = "UPDATE `settings` SET password = ?";
		$result = $this->sqlnonquery($sql, array($pass)); 
		return $result;
    }
	
	function get_session()
	{
		$result = $this->sqlquery("Select access from users where rowid = ?", array($_SESSION['login_id']));
		return $result;
	}
	
	function user_time_reset($rowid,$fields)
	{
		$sql = "UPDATE `user` SET $fields = 0 WHERE rowid = ?";
        $result = $this->sqlnonquery($sql, array($rowid));
        return $result;
	}
	
	function reset_data($table)
	{ 
		$sql = "DELETE FROM $table";
        $result = $this->sqlnonquery($sql);
        return $result;
	}
	
	function delete_all_member()
	{ 
		$sql = "DELETE FROM `user`";
        $result = $this->sqlnonquery($sql);
        return $result;
	}
	
	function backup()
	{ 
		$backupFile = '/tmp/backup_members_' . date('Y-m-d_H-i-s') . '.sql';  
		$command = "mysqldump -u ftech -pftech --no-create-info --skip-triggers --complete-insert ftech user > $backupFile";
 
		exec($command, $output, $returnVar);
 
		if ($returnVar === 0) { 
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
			header('Content-Length: ' . filesize($backupFile));
			readfile($backupFile); 
			unlink($backupFile);
		} else {
			echo "Error creating backup: " . implode("\n", $output);
		}
	}
	
	function backup_multiple($param)
	{
		$timestamp = date('Y-m-d_H-i-s');
		$backupFile = "/tmp/backup$timestamp.sql";
 
		$itemsArray = explode("|", $param);
		$fomatParam = str_replace("|", " ", $param);
		
		$truncate = "";
		foreach ($itemsArray as $item) {
			$truncate .= "TRUNCATE TABLE ".$item.";\n";
		}
 
		file_put_contents($backupFile, $truncate);

		// Append mysqldump output (INSERT statements)
		$command = "mysqldump -u ftech -pftech --no-create-info --skip-triggers --complete-insert ftech $fomatParam >> $backupFile";
		exec($command, $output, $returnVar);

		if ($returnVar === 0) { 
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
			header('Content-Length: ' . filesize($backupFile));
			readfile($backupFile); 
			 flush();
			unlink($backupFile);
		} else {
			echo "Error creating backup: " . implode("\n", $output);
		}
	}
	
	function getdefaultbackup()
	{
		$sql = 'SELECT `list` FROM `backup_items`';
	    $result = $this->sqlquery($sql);
        return json_encode($result);
	}
	
	function save_autobakuop($param)
	{  
		$retult = $this->sqlnonquery("UPDATE `backup_items` SET `list` = ?", array($param));
		return $retult;
	}

	function restore() {
		if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
			return json_encode(["success" => false, "message" => "File upload error: " . $_FILES['file']['error']]);
		}

		$backupFile = $_FILES["file"]["tmp_name"];  
		$truncate_cmd = "mysql -u ftech -pftech -e \"TRUNCATE TABLE ftech.user;\""; 
		exec($truncate_cmd, $output1, $returnVar1);   
		
		$command = "mysql --opt -h localhost -u ftech -p'ftech' user < $backupFile";
		exec($command, $output, $returnVar); 

		if ($returnVar === 0) { 
			echo json_encode(["success" => true, "message" => "Database restored successfully."]);
		} else { 
			echo json_encode(["success" => false, "message" => "Error restoring database: ".$backupFile . implode("\n", $output)]);
		}
	}
	
	function zerotier_info()
	{
		$sql = 'Select network_id, zerotier_status, node_id from `system_info`';
	    $result = $this->sqlquery($sql);
        return json_encode($result);
	}
	
	function join_network($network_id)
	{
		$command = "sudo zerotier-cli join $network_id"; 
		$output = shell_exec($command); 
		if ($output) { 
			$position = strpos($output, 'OK'); 
			if ($position !== false) 
			{
				$nodeid = shell_exec("sudo zerotier-cli info");  
				$array = explode(" ", $nodeid);
				$sql = "UPDATE  `system_info` SET network_id = ?, zerotier_status = ?, node_id = ?";
				$this->sqlnonquery($sql, array($network_id,$array[4],$array[2]));
				return htmlspecialchars($output);
			}
			else{
				return  htmlspecialchars($output);
			}
		}else { 
			return "No output or command failed.";
		}
	}
	
	function forget_network($network_id)
	{
		$command = "sudo zerotier-cli leave $network_id"; 
		$output = shell_exec($command); 
		if ($output) { 
			$position = strpos($output, 'OK'); 
			if ($position !== false) 
			{
				$nodeid = shell_exec("sudo zerotier-cli info");  
				shell_exec("sudo systemctl stop zerotier-one");  
				shell_exec("sudo rm /var/lib/zerotier-one/identity.public");  
				shell_exec("sudo rm /var/lib/zerotier-one/identity.secret");  
				shell_exec("sudo systemctl start zerotier-one");  
				$array = explode(" ", $nodeid);
				$sql = "UPDATE  `system_info` SET network_id = ?, zerotier_status = ?, node_id = ?";
				$this->sqlnonquery($sql, array(null,null,null));
				return htmlspecialchars($output);
			}
			else{
			}
		}else { 
			return "No output or command failed.";
		}
	}
	
	function get_coin_pins()
	{ 
        $result = $this->sqlquery("SELECT pins, (SELECT coin_pins FROM `settings`) AS coin_pins
		FROM `gpio_pins`
		WHERE NOT EXISTS (
			SELECT 1 
			FROM `settings`
			WHERE `settings`.set_pins = `gpio_pins`.pins
			   OR `settings`.bill_pins = `gpio_pins`.pins
		)
		GROUP BY pins ORDER BY pins ASC;
		");
        $html = '';

        if(!empty($result))
        {
            foreach($result as $field => $value) 
            { 
				if($value['pins'] == $value['coin_pins'])
				{
					$html .= '<option value="'.$value['pins'].'" selected>'.$value['pins'].'</option>';
				}
				else
				{ 
					$html .= '<option value="'.$value['pins'].'">'.$value['pins'].'</option>';
				}
            }
        } 
       
        return $html; 
	}
	
	
	function get_bill_pins()
	{ 
        $result = $this->sqlquery("SELECT pins, (SELECT bill_pins FROM `settings`) AS coin_pins
		FROM `gpio_pins`
		WHERE NOT EXISTS (
			SELECT 1 
			FROM `settings`
			WHERE `settings`.set_pins = `gpio_pins`.pins
			   OR `settings`.coin_pins = `gpio_pins`.pins
		)
		GROUP BY pins ORDER BY pins ASC; 
		");
        $html = '';

        if(!empty($result))
        {
            foreach($result as $field => $value) 
            { 
				if($value['pins'] == $value['coin_pins'])
				{
					$html .= '<option value="'.$value['pins'].'" selected>'.$value['pins'].'</option>';
				}
				else
				{ 
					$html .= '<option value="'.$value['pins'].'">'.$value['pins'].'</option>';
				}
            }
        } 
       
        return $html; 
	}
	
	function get_set_pins()
	{ 
        $result = $this->sqlquery("SELECT 
			pins, 
			(SELECT set_pins FROM `settings` LIMIT 1) AS set_pins  
		FROM 
			`gpio_pins` gp
		WHERE 
			NOT EXISTS (
				SELECT 1 
				FROM `settings` s
				WHERE s.coin_pins = gp.pins OR s.bill_pins = gp.pins
			)
		GROUP BY pins ORDER BY 
			pins ASC;
		");
        $html = '';

        if(!empty($result))
        {
            foreach($result as $field => $value) 
            { 
				if($value['pins'] == $value['set_pins'])
				{
					$html .= '<option value="'.$value['pins'].'" selected>'.$value['pins'].'</option>';
				}
				else
				{ 
					$html .= '<option value="'.$value['pins'].'">'.$value['pins'].'</option>';
				}
            }
        } 
       
        return $html; 
	}
	
	function get_relay_state()
	{ 
        $result = $this->sqlquery("Select relay_state from `settings`");
        $html = '';

        if(!empty($result))
        {
			if($result[0]['relay_state'] == 'LOW')
			{
				$html .= '<option value="LOW" selected>Active LOW</option>
						<option value="HIGH">Active HIGH</option>';
			}
			else
			{
				$html .= '<option value="LOW">Active LOW</option>
						<option value="HIGH" selected>Active HIGH</option>';
			}
            
        } 
       
        return $html; 
	}
	
	function update_coin_settings($coin_pin, $set_pins,$relay_state)
	{
		$sql = "update `settings` set coin_pins = ? , set_pins = ?, relay_state = ?";
		$this->sqlnonquery($sql, array($coin_pin,$set_pins, $relay_state));
	}
	
	function update_bill_settings($bill_pin, $credit_per_pulse)
	{
		$sql = "update `settings` set bill_pins = ? , credit_per_pulse = ?";
		$this->sqlnonquery($sql, array($bill_pin,$credit_per_pulse));
	}
	
	function get_transfer_pc($rowid)
	{
		$result = $this->sqlquery("SELECT rowid, pc_name FROM `clientpc` WHERE rowid <> '$rowid'");
        $html = "<option value=''></option>";

        if(!empty($result))
        {
			 foreach($result as $field => $value) 
            { 
				$html .= '<option value="'.$value['rowid'].'">'.$value['pc_name'].'</option>';
            }
        } 
       
        return $html; 
	}
	 
	function transfer_now($from_rowid, $to_rowid)
	{		
		$sql = "UPDATE clientpc c1
		JOIN clientpc c2 ON c2.rowid = $from_rowid
		SET c1.remaining_time = CASE 
			WHEN c1.rowid = $to_rowid THEN c1.remaining_time + c2.remaining_time
			WHEN c1.rowid = $from_rowid THEN 0
			ELSE c1.remaining_time
		END
		WHERE c1.rowid IN ($from_rowid, $to_rowid)
		";
        $result = $this->sqlnonquery($sql);
        return $result;
	}
	
	function get_filter_list()
	{  
		$clientpc = $this->sqlquery("SELECT concat(pc_name,' ','(', ip_address, ')' ) as pcnamex, ip_address   from  `clientpc` order by pc_name");
		
		$client_html = '<option value = "ALL" selected>All</option>';
		if(!empty($clientpc))
        {
			foreach($clientpc as $field => $value) 
            {
				$client_html .= '<option value = "'.htmlspecialchars($value['ip_address'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($value['pcnamex'], ENT_QUOTES, 'UTF-8').'</option>';
			}
		} 
		
		$members = $this->sqlquery("SELECT username, concat(name, ' - (',username, ')')`name` FROM `user` order by name"); 
		$members_html = '<option value = "ALL" selected>All</option>';
		if(!empty($members))
        {
			foreach($members as $field => $value) 
            {
				$members_html .= '<option value = "'.htmlspecialchars($value['username'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($value['name'], ENT_QUOTES, 'UTF-8').'</option>';
			}
		}
		
		$data = array(
			"client_pc_list" => $client_html,
			"members_list"   => $members_html
		);
		return json_encode($data);
	}

	function getCoinslot()
	{  
		$clientpc = $this->sqlquery("Select coinslot_name from `sub_vendo` order by coinslot_name");
		 
		$coinslotlist = '<option value = "ALL" selected>All</option>';
		$coinslotlist .= '<option value = "MAIN COINSLOT">MAIN COINSLOT</option>';
		if(!empty($clientpc))
        {
			foreach($clientpc as $field => $value) 
            {
				$coinslotlist .= '<option value = "'.htmlspecialchars($value['coinslot_name'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($value['coinslot_name'], ENT_QUOTES, 'UTF-8').'</option>';
			}
		} 
		 
		$data = array(
			"coinslot_list" => $coinslotlist 
		);
		return json_encode($data);
	}
	
	function shutdown_reboot_pc($rowid, $fields)
	{
		$result = $this->sqlnonquery('Update clientpc set '.$fields.'="Y" where rowid = ?', array($rowid));
        return $result;
	}
	
	
	function wake_on_lan($mac)
    { 
        $command = "sudo /usr/bin/wakeonlan " . $mac;
		$output = '';
		$error = '';
		exec($command, $output, $return_var); 
        return $error ?: implode("\n", $output); 
    }
	
	function wake_all()
	{
		$result = $this->sqlquery("SELECT mac_address FROM `clientpc` ");
       
        if(!empty($result))
        { 
			$results = [];
            foreach($result as $field => $value) 
            {    
				$mac = $value['mac_address'];
				$command = "sudo /usr/bin/wakeonlan " . $mac;
				$output = [];
				$return_var = 0;
				exec($command, $output, $return_var); 
				$results[$mac] = implode("\n", $output);				
            }
			return $results;
        }
	}
	
	function top_up($top_up_rowid,$credit,$top_up_table)
	{
		$sql = "UPDATE ".$top_up_table." SET credit = credit + ? WHERE rowid = ?";
		$result = $this->sqlnonquery($sql, array($credit,$top_up_rowid));
		
		if($result > 0)
		{
			if($top_up_table == "clientpc")
			{
				$query = "INSERT INTO `top_up_logs` (credit, ip_address, mac_address,pc_name, transaction_type, top_up_by) 
				SELECT credit, ip_address, mac_address,pc_name , 'guest_top_up' AS transaction_type, '".$_SESSION['username']."' as top_up_by FROM `clientpc` WHERE rowid = ?";
			}
			else
			{ 
				$query = "INSERT INTO `top_up_logs` (credit, username, transaction_type, top_up_by) 
				SELECT credit ,username, 'member_top_up' AS transaction_type, '".$_SESSION['username']."' as top_up_by  FROM `user` WHERE rowid = ?";
			}
			$this->sqlnonquery($query, array($top_up_rowid));
		}
        return $result;
	}
	
	function deduct_top_up_guest($top_up_rowid,$credit,$top_up_table)
	{
		$sql = "UPDATE ".$top_up_table." SET credit = case when credit - ? < 0 then 0 else credit - ? end WHERE rowid = ?";
		$result = $this->sqlnonquery($sql, array($credit,$credit,$top_up_rowid)); 
        return $result;
	}
	
	function member_idle($member_idle)
	{
		$result = $this->sqlnonquery("Update `settings` set member_idle_time = ?", array($member_idle));
		return $result;
	}
	
	function get_idle_cnt()
	{
		$result = $this->sqlquery("SELECT member_idle_time from settings"); 
		return $result[0]['member_idle_time'];
	}
	function get_machine_info()
	{
		$result = $this->sqlquery("Call `get_machine_id`()"); 
		return json_encode($result);
	}
	
	function getSerial()
	{
		$result = $this->sqlquery("Select serial from system_info"); 
		return json_encode($result);
	}
	
	/* function verify_license($license_key, $serialNum)
	{
		$result = $this->sqlquery("Call `get_machine_id`");  
		$generatedHash = hash('sha224', $result[0]['machine_id']."icandoallthingssc30"); 
		
		if($result[0]['license_status'] == "activated" && $result[0]['is_free_trial'] == "NO")
		{
			return "This Machine is already activated!.";
		}
		else
		{  
			if ($generatedHash === $license_key) { 
				$this->verify_license2($license_key);
				return "Congratulations";   
			} else {
				return "Invalid license key";   
			}
		}
	} */

	  
	function verify_license2($license_key)
	{
		$sql = "SELECT license_key, machine_id, isActive FROM license WHERE license_key = ? LIMIT 1";
		$result = $this->sqlquery($sql, [$license_key]);
		return $result;
	}
 
	
	function verify()
	{ 
		$output = shell_exec("python3 /var/www/python/check_license.py");
		return $output;
	}
	
	function get_sub_users()
    { 
        $result = $this->sqlquery("Select rowid, full_name,username, `password`, access,`role` from `users` where `role` <> 'admin'");
        $html = '';
        if(!empty($result))
        {
            foreach($result as $field => $value) 
            {      
                $html .= '
                    <tr> 
                        <td class="align-middle text-center text-sm">'.$value['full_name'].'</td>
                        <td class="align-middle text-center text-sm">'.$value['username'].'</td> 
                        <td class="align-middle text-center text-sm">
							<div class="input-group d-flex justify-content-center align-items-center">
								<input type="password" id="passwordField'.$value['rowid'].'" class="text-center form-control text-white" value="'.$value['password'].'" readonly style="pointer-events: none;">
								<i class="fa-solid fa-eye text-white text-sm fs-6" id = "eyeIcon'.$value['rowid'].'" onclick="togglePassword2('.$value['rowid'].')" ></i>
							</div>
						</td>
                        <td class="align-middle text-center text-sm">'.$value['access'].'</td>  
                        <td class="align-middle text-center text-sm"> 
							<a class="mb-0" href="#" onclick="delete_users(`'.$value['rowid'].'`)" data-bs-toggle="tooltip" title="Delete Users">
								<i class="fa-solid fa-trash-can text-white  fs-6"></i>
							</a>
							<a class="mb-0 ms-1" href="#" onclick="update_users(`'.$value['rowid'].'`,`'.$value['full_name'].'`,`'.$value['username'].'`,`'.$value['password'].'`,`'.($value['access'] != "" ? $value['access']: 'dashboard').'`)" data-bs-toggle="tooltip" title="Update Users">
								<i class="fa-sharp text-white fa-solid fa-pen-to-square fs-6"></i>
							</a>    
                        </td>  
                    </tr>';
            }
        }
        
        return $html; 
    }
	
	function save_users($action,$name,$username,$password,$access, $rowid)
	{ 
		if($action == 'Save')
		{ 
			$result = $this->sqlquery("Select * from users where `username` =  ?", array($username));
			
			if(!empty($result))
			{
				return "Already Exist!";
			}
			else
			{
				$reslt = $this->sqlnonquery("insert into users (full_name,username,password,access) values (?,?,?,?)", array($name,$username,$password,$access));
				return $reslt;
			} 
		}
		else
		{
			// update here
			$result = $this->sqlquery("Select * from users where `username` =  ? and rowid != ?", array($username, $rowid));
			
			if(!empty($result))
			{
				return "Already Exist!";
			}
			else
			{
				$reslt = $this->sqlnonquery("update users set full_name = ?,username = ?,password = ?,access = ? where rowid = ?", array($name,$username,$password,$access, $rowid));
				return $reslt;
			} 
		} 
	}
	
	function get_voucher()
	{
		$result = $this->sqlquery("SELECT rowid,status,voucher,price,sec_to_time(time_sec) as time,expiration,date_created,prefix, voucher_type FROM `voucher_list`"); 
		$html = '';
        if(!empty($result))
        {
            foreach($result as $field => $value) 
            {   
				$type = "";
				if($value['voucher_type'] == "YES")
				{
					$type = "VIP";
				}
				else if($value['voucher_type'] == "YYES")
				{
					$type = "V-VIP";
				}
				else
				{
					$type = "NON-VIP";
				}
				$text_color = ($value['status'] == "UNUSED") ? "text-success" : "text-danger";
                $html .= '
                    <tr> 
                        <td class="align-middle text-center text-sm '.$text_color.'">'.$value['status'].'</td> 
                        <td class="align-middle text-center text-sm">'.$value['voucher'].'</td>
                        <td class="align-middle text-center text-sm">'.$type.'</td>
                        <td class="align-middle text-center text-sm">₱ '.$value['price'].'</td>
                        <td class="align-middle text-center text-sm">'.$value['time'].'</td> 
                        <td class="align-middle text-center text-sm">'.$value['expiration'].'</td> 
                        <td class="align-middle text-center text-sm">'.$value['date_created'].'</td> 
                        <td class="align-middle text-center text-sm">'.$value['prefix'].'</td> 
                        <td class="align-middle text-center text-sm">
                            <a class="text-danger p-2" href="#" onclick = "delete_voucher(`'.$value['rowid'].'`)">Delete</a>
                        </td>  
                    </tr>';
            }
        } 
        return $html; 
	}
	
	function wifi_get_voucher()
	{
		$result = $this->sqlquery("SELECT * FROM `wifi_voucher`"); 
		$html = '';
        if(!empty($result))
        {
            foreach($result as $field => $value) 
            {   
				$text_color = ($value['status'] == "UNUSED") ? "text-success" : "text-danger";
                $html .= '
                    <tr> 
                        <td class="align-middle text-center text-sm '.$text_color.'">'.$value['status'].'</td> 
                        <td class="align-middle text-center text-sm">'.$value['voucher'].'</td>
                        <td class="align-middle text-center text-sm">₱ '.$value['price'].'</td> 
                        <td class="align-middle text-center text-sm">'.$value['expiration'].'</td> 
                        <td class="align-middle text-center text-sm">'.$value['date_created'].'</td> 
                        <td class="align-middle text-center text-sm">'.$value['prefix'].'</td> 
                        <td class="align-middle text-center text-sm">
                            <a class="text-danger p-2" href="#" onclick = "delete_voucher(`'.$value['rowid'].'`)">Delete</a>
                        </td>  
                    </tr>';
            }
        } 
        return $html; 
	}
	
	public function saveVoucherCodes($prefix, $voucherCodes, $price, $time_sec, $expiration, $voucher_type)
    { 
        $sql = "INSERT INTO voucher_list (prefix, voucher, price, time_sec, expiration, voucher_type) VALUES ";
 
        $placeholders = [];
        $params = []; 
        foreach ($voucherCodes as $voucherCode) {
            $placeholders[] = "(?, ?, ?, ?, ?, ?)";  
            $params[] = $prefix;    
            $params[] = $voucherCode;  
            $params[] = $price;        
            $params[] = $time_sec;    
            $params[] = $expiration;     
            $params[] = $voucher_type;     
        } 
        $sql .= implode(", ", $placeholders); 
        return $this->sqlnonquery($sql, $params);
    }
	
	public function wifi_saveVoucherCodes($prefix, $voucherCodes, $price, $time_sec, $expiration)
    { 
        $sql = "INSERT INTO wifi_voucher (prefix, voucher, price, time_sec, expiration) VALUES ";
 
        $placeholders = [];
        $params = []; 
        foreach ($voucherCodes as $voucherCode) {
            $placeholders[] = "(?, ?, ?, ?, ?)";  
            $params[] = $prefix;    
            $params[] = $voucherCode;  
            $params[] = $price;        
            $params[] = $time_sec;    
            $params[] = $expiration;       
        } 
        $sql .= implode(", ", $placeholders); 
        return $this->sqlnonquery($sql, $params);
    }
	
	public function delete_voucher($rowid)
	{
        return $this->sqlnonquery("Delete from voucher_list where rowid = ?", array($rowid));
	}
	public function wifi_delete_voucher($rowid)
	{
        return $this->sqlnonquery("Delete from wifi_voucher where rowid = ?", array($rowid));
	}
	public function delete_voucher_where($filter)
	{
        return $this->sqlnonquery("Delete from voucher_list where status = ?", array($filter));
	}
	public function wifi_delete_voucher_where($filter)
	{
        return $this->sqlnonquery("Delete from wifi_voucher where status = ?", array($filter));
	}
	
	public function delete_single_sales($rowid,$table)
	{
        return $this->sqlnonquery("Delete from $table where rowid = ?", array($rowid));
	}
	
	function get_whitelisted()
    { 
        $result = $this->sqlquery("SELECT rowid,app_name FROM `whitelist_app`");
        $html = '';
        if(!empty($result))
        {
			$i = 0;
            foreach($result as $field => $value) 
            {   
				$i += 1;
                $html .= '
                    <tr> 
                        <td class="align-middle text-center text-sm">'.$i.'</td>
                        <td class="align-middle text-center text-sm">'.$value['app_name'].'</td> 
                        <td class="align-middle text-center text-sm"> 
                            <a class="text-danger p-2" href="#" onclick = "delete_app(`'.$value['rowid'].'`)">Delete</a>
                        </td>  
                    </tr>';
            }
        }
        
        return $html; 
    }

	function get_chat()
    { 
        $result = $this->sqlquery("SELECT rowid, title, message FROM `msg_template`");
        $html = '';
        if(!empty($result))
        {
			$i = 0;
            foreach($result as $field => $value) 
            {   
				$i += 1;
                $html .= '
                    <tr> 
                        <td class="align-middle text-center text-sm">'.$i.'</td>
                        <td class="align-middle text-center text-sm">'.$value['title'].'</td> 
                        <td class="align-middle text-center text-sm">'.$value['message'].'</td> 
                        <td class="align-middle text-center text-sm"> 
                            <a class="text-danger p-2" href="#" onclick = "delete_chat(`'.$value['rowid'].'`)">Delete</a>
                        </td>  
                    </tr>';
            }
        }
        
        return $html; 
    }
 
	
	function delete_app($rowid)
	{
        return $this->sqlnonquery("Delete from whitelist_app where rowid = ?", array($rowid));
	}

	function delete_chat($rowid)
	{
        return $this->sqlnonquery("Delete from msg_template where rowid = ?", array($rowid));
	}
	
	function add_app($app_name)
	{
        return $this->sqlnonquery("insert into whitelist_app set app_name = ?", array($app_name));
	}

	function add_chat($title,$msg)
	{
        return $this->sqlnonquery("INSERT INTO `msg_template` (title,message) VALUES (?,?)", array($title,$msg));
	}
	
	function remove_all()
	{ 
        return $this->sqlnonquery("DELETE FROM `clientpc`");
	}
	function delete_all_members($ids)
	{  
		if (!empty($ids)) {
			$idList = implode(",", array_map('intval', $ids));

			$query = "DELETE FROM `user` WHERE rowid IN ($idList)";
			return $this->sqlnonquery($query); 
		}else{
			return false;
		}
	}
	
	function addCron($cron_job)
	{  
		exec("sudo crontab -l", $output); 
		$current_cron = implode("\n", $output);
 
		if (strpos($current_cron, $cron_job) === false) {
			$current_cron .= "\n" . $cron_job . "\n";
			file_put_contents("/tmp/crontab.txt", $current_cron);
			exec("sudo crontab /tmp/crontab.txt", $output, $return_var);

			if ($return_var === 0) {
				return "Cron job added successfully!";
			} else {
				return "Failed to add cron job!";
			}
		} else {
			return "Cron job already exists!";
		}
	}
	
	
	function removeCron($cron_job) { 
		
		exec("sudo crontab -l", $output);  
		$current_cron = implode("\n", $output);
 
		//$new_cron = str_replace($cron_job, "", $current_cron); 
		// Remove the specific cron job (using regex to handle spaces/newlines)
		$new_cron = preg_replace('/^' . preg_quote($cron_job, '/') . '$/m', '', $current_cron);

// Remove any extra empty lines that may have been left behind
		$new_cron = preg_replace("/^\s*\n/m", "", trim($new_cron)) . "\n";
		 
		file_put_contents("/tmp/crontab.txt", $new_cron); 
		exec("sudo crontab /tmp/crontab.txt", $output, $return_var);

		if ($return_var === 0) {
			return true;
		} else {
			return false;
		}
	}

	function getAllCrons()
	{
		exec("sudo crontab -l 2>&1", $output, $return_var);
 
		$html = "";
		
		if ($return_var !== 0) {
			$cron_jobs = ["No cron jobs found or permission denied."];
		} else {
			$cron_jobs = $output;
			 
			array_shift($cron_jobs);
			foreach ($cron_jobs as $cron) 
			{
				$html .= '
				<li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fa-solid fa-clock text-primary"></i>
                        <strong>'.htmlspecialchars($cron).'</strong> 
                    </div>
					<button class="btn btn-danger btn-sm delete-cron mt-3" onclick="removeCron(\'' . addslashes($cron) . '\')">
                        <i class="fa-solid fa-trash fs-6"></i>
                    </button>
                </li>'; 
			}
		}
		
		return ($html != "") ? $html : '
				<li class="list-group-item d-flex justify-content-center align-items-center">
                    No Available Cron Jobs
                </li>';
	}
	
	function tele_config($token,$chat_id)
	{
		$reslt = $this->sqlnonquery("update `telegram` set bot_token = ?, chat_id = ?", array($token,$chat_id));
		return $reslt;
	}
	
	function getTeleConfig()
	{
		$result = $this->sqlquery("Select bot_token,chat_id, is_enable from telegram", array()); 
		return $result;
	}
	 
	function cli_cmd($commandx)
	{
		$command = escapeshellcmd($commandx);   
		// List of allowed commands (to prevent dangerous execution)
		$restricted_commands = [
			"useradd", "adduser", "sudo useradd", "sudo adduser", // Restrict user creation
			"passwd", "sudo passwd", "chpasswd", "usermod", "sudo usermod" // Restrict password change
		];
		$output = ''; 
		
		foreach ($restricted_commands as $restricted) {
			if (stripos($command, $restricted) !== false) {
				return json_encode(["output" => "Command not allowed."]);
			}
		} 
		
		$descriptors = [
			0 => ["pipe", "r"],  // STDIN
			1 => ["pipe", "w"],  // STDOUT
			2 => ["pipe", "w"]   // STDERR
		];

		$process = proc_open($command, $descriptors, $pipes);

		if (is_resource($process)) {
			// Auto-confirm for commands requiring input (like `apt-get install -y`)
			fwrite($pipes[0], "Y\n");
			fclose($pipes[0]);

			$output = stream_get_contents($pipes[1]);
			fclose($pipes[1]);

			$error = stream_get_contents($pipes[2]);
			fclose($pipes[2]);

			proc_close($process);

			return json_encode(["output" => nl2br(htmlspecialchars($output . $error))]);
		} else {
			return json_encode(["output" => "Failed to execute command."]);
		}
		 
	}

	
	
	function get_recording($sessionid)
	{
		$result = $this->sqlquery("Select session_id, filename, date_inserted from `recordings` where session_id = ?", array($sessionid)); 
		return json_encode($result);
	}

	function getRetainDays()
	{
		$result = $this->sqlquery("SELECT retention_days FROM `settings`"); 
		return $result[0]['retention_days'];
	}
	
	
	function save_retention($retentionday)
	{ 
		$result = $this->sqlnonquery("Update `settings` set retention_days = ?", array($retentionday));
		return $result; 
	}
	function getRecordingLogs($filter_by)
	{
		// Base query
		$query = "select credit,TIME_FORMAT(IFNULL(SEC_TO_TIME(`credit_time`), 0), '%H:%i:%s') AS credit_time, ip_address,ifnull(username,'') as username, transaction_type, date_inserted, a.session_id from `insert_logs` as a";

		// Apply date filter if selected
		if ($filter_by) {
			$daysAgo = null;
			switch ($filter_by) {
				case 'TODAY': $daysAgo = 0; break;
				case 'YESTERDAY': $daysAgo = 1; break;
				case '2_DAYS_AGO': $daysAgo = 2; break;
				case '3_DAYS_AGO': $daysAgo = 3; break;
				case '4_DAYS_AGO': $daysAgo = 4; break;
				case '5_DAYS_AGO': $daysAgo = 5; break;
				case '6_DAYS_AGO': $daysAgo = 6; break;
				case '7_DAYS_AGO': $daysAgo = 7; break;
			}

			if ($daysAgo !== null) {
				$query .= " WHERE DATE(a.date_inserted) = CURDATE() - INTERVAL $daysAgo DAY  order by date_inserted desc";
			}
		}

		$result = $this->sqlquery($query);

		 // Build HTML table
		$html = '';
		if ($result && count($result) > 0) {
			$html .= '<div class="table-responsive w-100">';
			$html .= '<table class="table table-striped table-bordered w-100">';
			$html .= '<thead class="table-dark">';
			$html .= '<tr>'; 
			$html .= '<th>Credit</th>';
			$html .= '<th>Time</th>';
			$html .= '<th>IP Address</th>';
			$html .= '<th>Username</th>';
			$html .= '<th>Transaction Type</th>';
			$html .= '<th>Date Inserted</th>';
			$html .= '<th>Action</th>';
			$html .= '</tr>';
			$html .= '</thead>';
			$html .= '<tbody>';

			foreach ($result as $row) {
				$username = htmlspecialchars($row['username']);
				$ip = htmlspecialchars($row['ip_address']);
				$credit = htmlspecialchars($row['credit']);
				$type = htmlspecialchars($row['transaction_type']);
				$creditTime = htmlspecialchars($row['credit_time']); 
				$session = htmlspecialchars($row['session_id']);
				$date_inserted = htmlspecialchars($row['date_inserted']);

				$html .= '<tr>'; 
				$html .= "<td>$credit php</td>";
				$html .= "<td>$creditTime</td>";
				$html .= "<td>$ip</td>";
				$html .= "<td>$username</td>";
				$html .= "<td>$type</td>";
				$html .= "<td>$date_inserted</td>";
				$html .= "<td><button class='btn btn-sm btn-info' onclick=\"watchVideo('$session')\">Watch Video</button></td>";
				$html .= '</tr>';
			}

			$html .= '</tbody>';
			$html .= '</table>';
			$html .= '</div>'; // table-responsive
		} else {
			$html = '<h6 class="mb-0 fs-6 text-muted w-100 text-center">No Available Records</h6>';
		}

		return $html;
	} 
	
	function startcam() {
		$cmd = 'sudo systemctl start mjpg-streamer';
		exec($cmd, $output, $status);
		if ($status === 0) {
			return "mjpg_streamer started!";
		} else {
			return "Failed to start mjpg_streamer!";
		}
	}
	
	function getcamSettings()
    {  
        $result = $this->sqlquery("Select ena_cam from settings;"); 
       return $result[0]['ena_cam'];
    }

	function updateffmpeg($type,$rowid)
	{
		$result = $this->sqlnonquery("update `clientpc` set ffmpeg = ? where rowid = ?", array($type, $rowid));
        return $result;
	}
}

?>