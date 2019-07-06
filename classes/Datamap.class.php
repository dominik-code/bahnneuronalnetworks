<?php
require_once 'MysqliDb.class.php';
require_once '../config/statusconfig.php';


class Datamap {

    protected $type = "";
    protected $datamap = array();

    public function saveDatamapToDatabase() {

        foreach ($this->datamap as $dataelement) {
            $fromvalue = NULL;
            $tovalue = NULL;
            foreach ($dataelement as $key => $value) {
                $fromvalue = $key;
                $tovalue = $value;
            }
            $mysqli = new mysqli(SETTING_DB_IP, SETTING_DB_USER, SETTING_DB_PASSWORD, SETTING_DB_NAME);
            $mysqli->query("insert into datamap (`datatype`,`fromvalue`, `tovalue`) VALUES ('$this->type','$fromvalue','$tovalue')");
        }
    }

}