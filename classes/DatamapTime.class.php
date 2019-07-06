<?php
require_once 'Datamap.class.php';

class DatamapTime extends Datamap {

    public function __construct() {
        $this->type = "time";
    }

    public function generateDatamap() {
        $result = array();
        // first we get all possible raw values with time we got 1440 (24*60) as we only have minutes and hours
        $rawvalues = $this->time_range(0, 86400, 60);


        // with this we got out datatype count
        $datacount = count($rawvalues);

        /*
         * 2 = 1
         * 3 = 0,66
         * 4 = 0,5
         */
        $split = 2 / $datacount;
        $currentmapvalue = -1.0;
        $i = 0;
        while ($i < $datacount) {
            $result[] = array($rawvalues[$i] => $currentmapvalue);
            $currentmapvalue = $currentmapvalue + $split;
            $i++;
        }
//        var_dump($result);
        $this->saveDatamapToDatabase($result);

    }


    private function time_range($start, $end, $step) {
        $return = array();
        date_default_timezone_set('UTC');
        for ($time = $start; $time <= $end; $time += $step)
            $return[] = date('H:i:s', $time);
        return $return;
    }
}