<?php
require_once 'MysqliDb.class.php';
require_once '../config/statusconfig.php';


class Datamap {

    protected $type = "";
    protected $datamap = array();

    public function saveDatamapToDatabase() {
        $type = $this->type;
        foreach ($this->datamap as $dataelement) {
            $fromvalue = NULL;
            $tovalue = NULL;
            foreach ($dataelement as $key => $value) {
                $fromvalue = $key;
                $tovalue = $value;
            }
            $mysqli = new mysqli(SETTING_DB_IP, SETTING_DB_USER, SETTING_DB_PASSWORD, SETTING_DB_NAME);
            $mysqli->query("INSERT INTO `datamap` (`id`, `datatype`, `fromvalue`, `tovalue`) VALUES (NULL, '$type', '$fromvalue', '$tovalue')");
        }
    }

}