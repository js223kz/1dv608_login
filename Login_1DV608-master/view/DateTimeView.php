<?php
require_once('model/DateTime.php');
class DateTimeView {
	private $model;

	public function show() {
		$model = new \model\DateTime();
		$timeString = $model->getDay() . ", the " .
		$model->getDate() . "th of " . $model->getMonth() . " "
		. $model->getYear() . ", The time is " . $model->getTime();

		return '<p>' . $timeString . '</p>';
	}
}
