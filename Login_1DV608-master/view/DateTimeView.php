<?php

class DateTimeView {

	public function show() {
		date_default_timezone_set("Europe/Stockholm");
		$today = new DateTime();

		$day = $today->format('l');
		$date = $today->format('jS');
		$month = $today->format('F');
		$year = $today->format('Y');
		$time = $today->format("H:i:s");

		$timeString = $day . ", the " .
			$date . " of " . $month . " "
			. $year . ", The time is " . $time;

		return '<p>' . $timeString . '</p>';
	}
}
