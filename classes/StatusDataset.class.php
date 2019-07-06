<?php


/**
 * Class StatusDataset
 */
class StatusDataset {

    /**
     * @var array
     */
    private $normalizedData = array();
    /**
     * @var array
     */
    private $denormalizedData = array();

    private $countValues = 3;
    /**
     * StatusDataset constructor.
     */
    public function __construct() {

    }

    public function importNormalizedData($data) {

    }

    public function importDenormalizedData($data) {
        if(count($data) !== $this->countValues) {
            throw new Exception("Import failed: Dataset does not match value count needed.");
        }
        $this->denormalizedData = $data;
    }


    /**
     * @return array
     * @throws Exception
     */
    public function getTrainData() {
        $result = array();
        if(count($this->normalizedData) !== $this->countValues) {
            throw new Exception("Dataset does not match value count needed.");
        }
        foreach ($this->normalizedData as $key => $value) {
            $result[] = $value;
        }
        return $result;
    }

    /**
     * Normalize handlers
     */

    private function normalizeTime($time) {

    }

    /**
     * @param $state
     * @return float|int
     * @throws Exception
     */
    private function normalizeTrainState($state) {
        if ($state == "n") {
            return 1.0;
        } elseif ($state == "c") {
            return -1.0;
        } elseif ($state == "p") {
            return 0.0;
        } else {
            throw new Exception("Found invalid normalizer input for TrainState: $state");
        }
    }

    /**
     * Denormalize handlers
     */


    /**
     * @param $state
     * @return float|int
     * @throws Exception
     */
    private function denormalizeTrainState($state, $isNNResult = false) {

        if ($state == 1.0 || ($isNNResult && $state >= 0.33)) {
            return "n";
        } elseif ($state == -1.0 || ($isNNResult && $state <= -0.33)) {
            return "c";
        } elseif ($state == 0.0 || ($isNNResult && $state <= 0.33 && $state >= -0.33)) {
            return "p";
        } else {
            throw new Exception("Found invalid normalizer input for TrainState: $state");
        }
    }

    /**
     * normalize/denormalize  handlers
     */

    public function normalizeInputData($data) {
        foreach ($data as $key => $value) {
            try {
                if ($key == "TrainState") {
                    $normalizedvalue = $this->normalizeTrainState($value);
                    $this->normalizedData[] = $normalizedvalue;
                }

            } catch (Exception $ex) {
                var_dump($ex);
            }
        }
    }

    /**
     *
     */
    public function denormalizeInputData($data) {
        foreach ($data as $key => $value) {
            try {
                if ($key == "Trainstate") {
                    $denormalizedvalue = $this->denormalizeTrainState($value, true);
                    $this->denormalizedData[] = $denormalizedvalue;
                }

            } catch (Exception $ex) {
                var_dump($ex);
            }
        }
    }
}