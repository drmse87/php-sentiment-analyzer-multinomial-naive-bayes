<?php

namespace Model;

class FileHandler {
    private $filename;

    public function __construct(string $filenameToUse) {
        $this->filename = $filenameToUse;
    }

    public function serializeArrayAndSaveToFile(array $arrayToSerializeAndSave) {
        $filename = $this->filename;

        $serializedArray = serialize($arrayToSerializeAndSave);
        if ($serializedArray === FALSE) {
            throw new \Exception("Unable to serialize to file ${filename}.");
        }

        $writingToFile = file_put_contents($filename, $serializedArray);
        if ($writingToFile === FALSE) {
            throw new \Exception("Unable to write to file ${filename}.");            
        }
    }

    public function saveFloatValueToFile(float $valueToStore) {
        $filename = $this->filename;

        $writingToFile = file_put_contents($filename, $valueToStore);
        if ($writingToFile === FALSE) {
            throw new \Exception("Unable to write to file ${filename}.");            
        }
    }

    public function readFloatValueFromFile() : float {
        $filename = $this->filename;

        $readingFromFile = file_get_contents($filename);
        if ($readingFromFile === FALSE) {
            throw new \Exception("Unable to read from file ${filename}.");
        }

        return floatval($readingFromFile);
    }

    public function createNewEmptyFile() {
        $filename = $this->filename;

        $creatingFile = file_put_contents($filename, '');
        if ($creatingFile === FALSE) {
            throw new \Exception("Unable to create new file ${filename}.");
        }
    }

    public function openSerializedArrayFromFileAndUnserialize() : array {
        $filename = $this->filename;

        $readingFromFile = file_get_contents($filename);
        if ($readingFromFile === FALSE) {
            throw new \Exception("Unable to read from file ${filename}.");
        }

        $unserializedFileContent = unserialize($readingFromFile);
        if ($unserializedFileContent === FALSE) {
            throw new \Exception("Unable to unserialize from file ${filename}."); 
        }

        return $unserializedFileContent;
    }
}