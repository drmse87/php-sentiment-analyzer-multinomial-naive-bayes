<?php

namespace Model\NLP;

class SentimentAnalyzer {
    private $multinomialNaiveBayes;
    private $preprocessing;

    public function __construct () {
        $this->multinomialNaiveBayes = new MultinomialNaiveBayes();
        $this->preprocessing = new Preprocessing();
    }

    public function run(string $textToAnalyzeSentimentOf) {
        $cleanedText = $this->preprocessing->cleanAndLowerCaseString($textToAnalyzeSentimentOf);
        $tokenizedCleanedText = $this->preprocessing->stringToArray($cleanedText);

        $this->multinomialNaiveBayes->apply($tokenizedCleanedText);

        $maximumAPosterioriClass = $this->multinomialNaiveBayes->getMaximumAPosterioriClass();
        $output = $this->generateOutput($textToAnalyzeSentimentOf, $maximumAPosterioriClass);

        return $output;
    }

    public function trainModel() {
        $this->multinomialNaiveBayes->train();
    }

    private function generateOutput(string $analyzedText, ClassificationLabel $mapClass) {
        return $analyzedText . ' is <span class="' . $mapClass->getName() . '">' . $mapClass->getName() . '</span>';
    }
}

