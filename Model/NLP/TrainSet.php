<?php

namespace Model\NLP;

class TrainSet {
    private static $NEGATIVE_TRAIN_DATA_FILE_NAME = __DIR__ . '/train/neg.txt';
    private static $NEGATIVE_CLASS_NAME = 'negative';
    private static $POSITIVE_TRAIN_DATA_FILE_NAME = __DIR__ . '/train/pos.txt';
    private static $POSITIVE_CLASS_NAME = 'positive';
    private $negativeTrainData;
    private $positiveTrainData;

    public function __construct () {
        $negativeClassName = self::$NEGATIVE_CLASS_NAME;
        $negativeDocuments = $this->loadTrainingData(self::$NEGATIVE_TRAIN_DATA_FILE_NAME);
        $positiveClassName = self::$POSITIVE_CLASS_NAME;
        $positiveDocuments = $this->loadTrainingData(self::$POSITIVE_TRAIN_DATA_FILE_NAME);

        $this->negativeTrainData = new ClassificationLabel($negativeClassName, $negativeDocuments);
        $this->positiveTrainData = new ClassificationLabel($positiveClassName, $positiveDocuments);
    }

    public function getAllClasses(): array {
        return array($this->negativeTrainData, $this->positiveTrainData);
    }

    public function getTotalNumberOfDocuments(): int {
        return $this->negativeTrainData->getNumberOfDocuments() +
               $this->positiveTrainData->getNumberOfDocuments();
    }

    public function getNegativeTrainData(): ClassificationLabel {
        return $this->negativeTrainData;
    }

    public function getPositiveTrainData(): ClassificationLabel {
        return $this->positiveTrainData;
    }

    private function loadTrainingData($fileToTurnToArrayOfDocuments) : array {
        $arrayOfStringsWhereEachStringRepresentsDocument = explode(PHP_EOL, file_get_contents($fileToTurnToArrayOfDocuments));
        $arrayOfDocuments = array();

        foreach ($arrayOfStringsWhereEachStringRepresentsDocument as $futureDocument) {
            $arrayOfDocuments[] = new Document($futureDocument);
        }

        return $arrayOfDocuments;
    }
}