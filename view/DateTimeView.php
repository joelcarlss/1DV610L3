<?php

namespace view;

class DateTimeView {

	private $time;
	
	public function setTime($time) {
		$this->time = $time;
	}
	/**
	 * Gets time from controller
	 * @return string
	 */
	public function showTime() {

		$timeString = $this->time;

		return '<p>' . $timeString . '</p>';
	}
}