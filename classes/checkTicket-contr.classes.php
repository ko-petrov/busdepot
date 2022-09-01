<?php

class checkTicketContr extends checkTicket {

	protected $uid;
	protected $pwd;
	protected $flight;

	public function __construct($uid, $pwd, $flight) {
		$this->uid = $uid;
		$this->pwd = $pwd;
		$this->flight = $flight;
	}

	public function checkDate($ticket) {
		$today = date("Y-m-d");
		$start = (new DateTime($ticket[0]['Дата_начала']))->format('Y-m-d');
		$end = (new DateTime($ticket[0]['Дата_окончания']))->format('Y-m-d');

		$today_time = strtotime($today);
		$start_time = strtotime($start);
		$end_time = strtotime($end);

		if ( ($today_time >= $start_time) && ($today_time <= $end_time) ) {
			$this->writeOff();
			$days = $end_time - $today_time;
			$days = date('d', $days);
			$another = (string)($ticket[0]['Поездки'] - 1);
			if ($another < 0) {
				$code = 1;
			} else {
				$code = 0;
			}
			$arr = array('days' => $days, 'tickets' => $another, 'code' => $code);
			echo json_encode($arr);
		} else {
			echo "Ошибочка вышла";
			return false;
			end();
		}
	}

}
