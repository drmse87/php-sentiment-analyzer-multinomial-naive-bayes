<?php 

namespace Model\NLP;

class Prior {
    private static $filename = __DIR__ . '/train/prior_';
    private static $fileEnding = '.txt';
    private $className;
    private $fullFileName;
    private $fileHandler;

    public function __construct(string $classNameToUse) {
        $this->className = $classNameToUse;
        $this->fullFileName = self::$filename . $classNameToUse . self::$fileEnding;
        $this->fileHandler = new \Model\FileHandler($this->fullFileName);
    }

    public function setValue(float $newValue) {
        $this->fileHandler->saveFloatValueToFile($newValue);
    }

    public function getValue() : float {
        $storedPrior = $this->fileHandler->readFloatValueFromFile();

        return $storedPrior;
    }
}