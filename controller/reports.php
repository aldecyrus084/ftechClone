<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("../model/model.php");

class REPORTS extends MODEL
{ 
	function genrep($df, $dt, $filter_by, $report_type, $coinslot)
	{  
		$fieldx = "ip_address";
		$position = stripos($report_type, "members"); 
		if ($position !== false) {
			$fieldx = "username";
		} 
		
		if($report_type == "daily")
		{
			$result = $this->sqlquery("CALL `daily_sales`('$filter_by','$fieldx', '$df', '$dt', '$coinslot')"); 
		}
		else if ($report_type == "all_guest")
		{
			$result = $this->sqlquery("CALL `all_guest`('$filter_by','$fieldx', '$df', '$dt', '$coinslot')"); 
		}
		else if ($report_type == "all_members")
		{
			$result = $this->sqlquery("CALL `all_members`('$filter_by','$fieldx', '$df', '$dt', '$coinslot')"); 
		}
		else if ($report_type == "per_members")
		{
			$result = $this->sqlquery("CALL `per_members`('$filter_by','$fieldx', '$df', '$dt', '$coinslot')"); 
		}
		else if ($report_type == "per_pc")
		{
			$result = $this->sqlquery("CALL `per_pc`('$filter_by','$fieldx', '$df', '$dt', '$coinslot')"); 
		} 
		else if ($report_type == "interval")
		{
			$result = $this->sqlquery("CALL `interval`('$filter_by','$fieldx', '$df', '$dt', '$coinslot')"); 
		} 
		else if ($report_type == "top_up_guest")
		{
			$result = $this->sqlquery("CALL `top_up_guest`('$filter_by','$fieldx', '$df', '$dt')"); 
		} 
		else if ($report_type == "top_up_members")
		{
			$result = $this->sqlquery("CALL `top_up_members`('$filter_by','$fieldx', '$df', '$dt')"); 
		}  
		else if ($report_type == "voucher_report")
		{
			$result = $this->sqlquery("CALL `voucher_report`('$filter_by','$fieldx', '$df', '$dt')"); 
		}  
		else if ($report_type == "monthly")
		{
			$result = $this->sqlquery("CALL `monthly_sales`('$filter_by','$fieldx', '$df', '$dt', '$coinslot')"); 
		}  
		else if ($report_type == "total_sales")
		{
			$result = $this->sqlquery("CALL `total_sales`('$filter_by','$fieldx', '$df', '$dt', '$coinslot')"); 
		} 
		else if ($report_type == "loginreport")
		{
			$result = $this->sqlquery("CALL `loginreport`('$filter_by','$fieldx', '$df', '$dt')"); 
		} 
		else if($report_type == "transferTime")
		{
			$result = $this->sqlquery("CALL `transferTime`('$filter_by','$fieldx', '$df', '$dt')"); 
		}
		else
		{
			$result = "no data";
		}

		return $this->build_table($result, $report_type);
	}
	
	
	function build_table($array, $rep_type)
	{ 
		if (is_null($array) || !is_array($array) || count($array) <= 0) {
			return "<h1 class = 'text-center fs-5'>No Data!</h1>";
		}

		$html = '<table width="100%" class="table table-dark table-striped dataTables_wrapper form-inline dt-bootstrap no-footer" id="myTable">';	 
		$html .= '<thead>';
		$html .= '<tr>';

		$html .= '<th>#</th>';
		foreach ($array[0] as $key => $value) {
			// Ensure that $key is a string
			if ($key !== 'rowid') {
				$html .= '<th>' . str_replace("_", " ", ucwords(htmlspecialchars($key))) . '</th>';
			}
		}

		if($rep_type == 'all_guest' || $rep_type == 'all_members' ||  $rep_type== 'top_up_guest' ||  $rep_type== 'top_up_members' || $rep_type== 'voucher_report')
		{
			$html .= '<th>' . str_replace("_", " ", ucwords(htmlspecialchars('Action'))) . '</th>';
		}
		
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		$i = 0;
		foreach ($array as $key => $value) {
			$i += 1;
			$html .= '<tr>';
			$html .= '<td>' . $i . '</td>';
			foreach ($value as $key2 => $value2) {
				// Check if $value2 is null, and replace it with an empty string if it is
				if ($key2 !== 'rowid') {
					$html .= '<td>' . htmlspecialchars($value2 ?? '') . '</td>';
				}
			}
			
			if($rep_type == 'all_guest' || $rep_type == 'all_members' || $rep_type== 'voucher_report')
			{
				$html .= '<td><a class="text-danger p-2" href="#" onclick = "deletex('.$value['rowid'].', `insert_logs`)">Delete</a></td>';
			}
			
			if($rep_type== 'top_up_guest' ||  $rep_type== 'top_up_members')
			{
				$html .= '<td><a class="text-danger p-2" href="#" onclick = "deletex('.$value['rowid'].', `top_up_logs`)">Delete</a></td>';
			} 
		
			$html .= '</tr>';
		}

		$html .= '</tbody>';
		$html .= '</table>';

		return $html;
	}

}
