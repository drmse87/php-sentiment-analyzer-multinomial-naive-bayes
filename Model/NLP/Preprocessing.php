<?php

namespace Model\NLP;

class Preprocessing {

    public function stringToArray (string $stringToConvertToArray) : array {
        return explode(" ", $stringToConvertToArray);
    }

    public function cleanAndLowerCaseString(string $stringToClean) : string {
        $cleanedStringFromHtml = strip_tags($stringToClean);
        $cleanedStringFromPunctuationAndSpecialChars = $this->stripPunctuationAndSpecialChars($cleanedStringFromHtml);
        $cleanedStringTrimmedAndLowerCased = trim(strtolower($cleanedStringFromPunctuationAndSpecialChars));

        return $cleanedStringTrimmedAndLowerCased;
    }

    private function stripPunctuationAndSpecialChars (string $stringToClean) : string {
        $punctuationAndSpecialChars = array(",", ".", "+", "*", "'", "/", ":", "`", "´", '"', "!", "?", "#", "-", "(", ")", "[", "]");

        return str_replace($punctuationAndSpecialChars, " ", $stringToClean);
    }
}