<?php 

namespace Model\NLP;

class Vocabulary {
    private $trainset;
    private $vocabulary;
    private $vocabularySize;
    private $fileHandler;
    private static $filename = __DIR__ . '/train/vocabulary.txt';

    public function __construct (TrainSet $trainsetToUse) {      
        $this->trainset = $trainsetToUse;
        $this->fileHandler = new \Model\FileHandler(self::$filename);
        $this->vocabulary = $this->loadVocabularyFromFileOrGenerateNewIfModelNotTrained($this->trainset);
    }

    public function getVocabulary(): array {
        return $this->vocabulary;
    }

    public function getVocabularySize(): int {
        return count($this->vocabulary);
    }

    private function loadVocabularyFromFileOrGenerateNewIfModelNotTrained(TrainSet $trainsetToGenerateVocabularyFrom) {
        $filename = self::$filename;
        
        if (!file_exists($filename)) {
            $this->generateNewVocabularyAndStoreToFile($trainsetToGenerateVocabularyFrom);
        }
        
        $vocabulary = $this->loadVocabularyFromFile();

        return $vocabulary;
    }

    private function loadVocabularyFromFile() : array {
        $vocabularyUnserialized = $this->fileHandler->openSerializedArrayFromFileAndUnserialize();

        return $vocabularyUnserialized;
    }

    private function generateNewVocabularyAndStoreToFile(TrainSet $trainsetToGenerateVocabularyFrom) {       
        $filename = self::$filename;
        $positiveDocuments = $trainsetToGenerateVocabularyFrom->getPositiveTrainData();
        $negativeDocuments = $trainsetToGenerateVocabularyFrom->getNegativeTrainData();

        $allPosWords = $positiveDocuments->getAllWords();
        $allNegWords = $negativeDocuments->getAllWords();

        $allPositiveAndNegativeWords = array_merge($allPosWords, $allNegWords);
        $vocabularyOfUniqueWords = array_unique($allPositiveAndNegativeWords, SORT_REGULAR);

        $this->fileHandler->serializeArrayAndSaveToFile($vocabularyOfUniqueWords);
    }
}