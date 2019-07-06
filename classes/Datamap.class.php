<?php

class Datamap {

    protected $type = "";

    public function saveDatamapToDatabase($datamap) {
        $type = $this->type;
        foreach ($datamap as $dataelement) {
            $fromvalue = NULL;
            $tovalue = NULL;
            foreach ($dataelement as $key => $value) {
                $fromvalue = $key;
                $tovalue = $value;
            }
//            $mysqli = new mysqli(SETTING_DB_IP, SETTING_DB_USER, SETTING_DB_PASSWORD, SETTING_DB_NAME);
//            $mysqli->query("INSERT INTO `datamap` (`id`, `datatype`, `fromvalue`, `tovalue`) VALUES (NULL, '$type', '$fromvalue', '$tovalue')");
        }
    }

}