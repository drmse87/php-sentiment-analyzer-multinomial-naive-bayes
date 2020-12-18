<?php 

namespace Model\NLP;

class ClassificationLabel {
    private $name;
    private $documents;
    private $prior;
    private $score;
    private $conditionalProbabilities;
    private $fullFileName;
    private $fileHandler;
    private static $filename = __DIR__ . '/train/conditionalProbabilities_';
    private static $fileEnding = '.txt';

    public function __construct(string $classNameToUse, array $documentsBelongingToClass) {
        $this->name = $classNameToUse;
        $this->documents = $documentsBelongingToClass;
        $this->prior = new Prior($this->name);
        $this->score = new Score();
        $this->fullFileName = self::$filename . $classNameToUse . self::$fileEnding;
        $this->fileHandler = new \Model\FileHandler($this->fullFileName);
        $this->conditionalProbabilities = $this->getConditionalProbabilitiesFromTrainedModelStoredInFileOrEmptyArrayIfNotTrained();
    }

    public function getName() : string {
        return $this->name;
    }

    public function getAllDocuments() : array {
        return $this->documents;
    }

    public function getNumberOfDocuments() : int {
        return count($this->documents);
    }

    public function getScore() : Score {
        return $this->score;
    }

    public function getPrior() : Prior {
        return $this->prior;
    }

    public function addConditionalProbability(ConditionalProbability $conditionalProbabilityToAdd) {
        $this->conditionalProbabilities[] = $conditionalProbabilityToAdd;
    }

    public function getConditionalProbability(string $wordSearchedFor) : float {
        $conditionalProbabilityForWordSearchedFor;

        foreach ($this->conditionalProbabilities as $conditionalProbability) {
            if ($conditionalProbability->getWord() == $wordSearchedFor) {
                $conditionalProbabilityForWordSearchedFor = $conditionalProbability;
                break;                                                
            }
        }

        $value = $conditionalProbabilityForWordSearchedFor->getValue();

        return $value;
    }

    public function storeConditionalProbabilities() {
        $conditionalProbabilitiesToStore = $this->conditionalProbabilities;

        $this->fileHandler->serializeArrayAndSaveToFile($conditionalProbabilitiesToStore);
    }

    public function getWordCount(string $wordToCount) : int {
        $allWordsInClass = $this->getAllWords();

        $count = 0;
        foreach ($allWordsInClass as $word) {
            if ($word == $wordToCount) {
                $count += 1;
            }
        }

        return $count;
    }

    public function getAllWords() : array {
        $result = array();

        foreach ($this->documents as $document) {
            $result = array_merge($result, $document->getWords());
        }

        return $result;
    }

    public function getTotalNumberOfWords() : int {
        return count($this->getAllWords());
    }

    private function getConditionalProbabilitiesFromTrainedModelStoredInFileOrEmptyArrayIfNotTrained() {
        $filename = $this->fullFileName;
        $conditionalProbabilities;

        if (file_exists($filename)) {
            $conditionalProbabilities = $this->loadConditionalProbabilitiesFromFile();
        } else {
            $conditionalProbabilities = array();
        }

        return $conditionalProbabilities;
    }

    private function loadConditionalProbabilitiesFromFile() :  array {
        $conditionalProbabilities = $this->fileHandler->openSerializedArrayFromFileAndUnserialize();

        return $conditionalProbabilities;
    }
}