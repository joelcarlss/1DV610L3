<?php

namespace view;

class DateTimeView {

	private $time;
	
	public function setTime($time) {
		$this->time = $time;
	}
	public function showTime() {

		$timeString = $this->time;

		return '<p>' . $timeString . '</p>';
	}
}