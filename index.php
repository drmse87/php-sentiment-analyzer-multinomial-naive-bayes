<?php

require_once('Model/FileHandler.php');
require_once('Model/NLP/SentimentAnalyzer.php');
require_once('Model/NLP/TrainSet.php');
require_once('Model/NLP/MultinomialNaiveBayes.php');
require_once('Model/NLP/Vocabulary.php');
require_once('Model/NLP/ClassificationLabel.php');
require_once('Model/NLP/Document.php');
require_once('Model/NLP/ConditionalProbability.php');
require_once('Model/NLP/Preprocessing.php');
require_once('Model/NLP/Prior.php');
require_once('Model/NLP/Score.php');
require_once('View/Sentiment.php');
require_once('View/SentimentResult.php');

if($_SERVER["HTTPS"] !== "on" || empty($_SERVER["HTTPS"]))
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

$sentimentAnalyzer = new \Model\NLP\SentimentAnalyzer();
$sentimentView = new \View\Sentiment();
$sentimentResult = new \View\SentimentResult();

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sentimentView->echoHTML();
} elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($sentimentView->isThereATextToAnalyze()) {
        $textToAnalyze = $sentimentView->getTextToAnalyze();
        $result = $sentimentAnalyzer->run($textToAnalyze);
    
        $sentimentResult->echoHTML($result);        
    } else {
        $message = $sentimentView->getNoTextToAnalyzeMessage();

        $sentimentView->echoHTML($message);
    }
}



