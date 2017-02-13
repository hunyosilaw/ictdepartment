<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ict_date {

	public function __construct() {

	}

	public function get_date ($format) {
		return $this->get_datetime_from_server($format);
	}

	private function get_datetime_from_server ($format) {
		$returned_data = get_headers("http://time.upd.edu.ph/");
		$date = ($returned_data != null)?(strlen((string)$returned_data[1])>0)?str_replace('Date: ','',$returned_data[1]):null:nul;
		
		$datetime = new DateTime();
		$pht = new DateTimeZone('Asia/Manila');
		$datetime->setTimezone($pht);
		if ($date != null) {
			$datetime->setTimestamp(strtotime($date));
		}

		return $datetime->format($format);
	}
}