<?php 

namespace Model\NLP;

class MultinomialNaiveBayes {
    private $vocabulary;
    private $trainset;

    public function __construct() {
        $this->trainset = new TrainSet();
        $this->vocabulary = new Vocabulary($this->trainset);
    }

    public function train() {
        $allClasses = $this->trainset->getAllClasses();

        foreach ($allClasses as $class) {
            $this->estimatePriorProbability($class);
            $this->estimateConditionalProbabilities($class);
        }
    }

    public function apply(array $documentToAnalyzeSentimentOf) {
        $vocabulary = $this->vocabulary->getVocabulary();
        $allClasses = $this->trainset->getAllClasses();

        foreach ($allClasses as $class) {
            $prior = $class->getPrior()->getValue();
            $score = log($prior);

            foreach ($documentToAnalyzeSentimentOf as $word) {
                if (in_array($word, $vocabulary))
                {
                    $conditionalProbabilityForWord = $class->getConditionalProbability($word);
                    $score += log($conditionalProbabilityForWord);    
                }
            }

            $class->getScore()->setValue($score);
        }
    }

    public function getMaximumAPosterioriClass(): ClassificationLabel {
        $allClasses = $this->trainset->getAllClasses();
        $max = PHP_INT_MIN;
        $maximumAPosterioriClass = NULL;

        foreach ($allClasses as $class) {
            $currentClassScore = $class->getScore()->getValue();

            if ($currentClassScore > $max) {
                $max = $currentClassScore;
                $maximumAPosterioriClass = $class;
            }
        }

        return $maximumAPosterioriClass;
    }

    private function estimatePriorProbability(ClassificationLabel $currentClass) {
        $totalNumberOfDocuments = $this->trainset->getTotalNumberOfDocuments();
        $numberOfDocumentsInClass = $currentClass->getNumberOfDocuments();

        $currentClass->getPrior()->setValue($numberOfDocumentsInClass / $totalNumberOfDocuments);
    }

    private function estimateConditionalProbabilities(ClassificationLabel $currentClass) {
        $vocabulary = $this->vocabulary->getVocabulary();
        $vocabularySize = $this->vocabulary->getVocabularySize();

        foreach ($vocabulary as $word) {
            $wordCountInClass = $currentClass->getWordCount($word);
            $totalNumberOfWordsInClass = $currentClass->getTotalNumberOfWords();

            $probabilityEstimate = ($wordCountInClass + 1) / ($totalNumberOfWordsInClass + $vocabularySize);
            $conditionalProbability = new ConditionalProbability($word, $probabilityEstimate);
            
            $currentClass->addConditionalProbability($conditionalProbability);
        }

        $currentClass->storeConditionalProbabilities();
    }
}