<?php

namespace model;
use Exception;
class ServerTime {
    

    public function __construct () {
    }

    /**
    * Gets current time
    * Format: "Weekday", the "dd"th of "month" "year", The time is "hh":"mm":"ss"
    * @return string
    */
    public function getCurrentServerTime() : string {
        date_default_timezone_set('Europe/Stockholm');
        $date = date('l, \t\h\e j\t\h \o\f F Y, \T\h\e \t\i\m\e \i\s G:i:s ', time());
        return $date;
}

}