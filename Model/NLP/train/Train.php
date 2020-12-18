<?php

namespace Model\NLP;

require_once('../SentimentAnalyzer.php');
require_once('../TrainSet.php');
require_once('../MultinomialNaiveBayes.php');
require_once('../Vocabulary.php');
require_once('../ClassificationLabel.php');
require_once('../Document.php');
require_once('../ConditionalProbability.php');
require_once('../Preprocessing.php');
require_once('../Prior.php');
require_once('../Score.php');

set_time_limit(0);
$sa = new SentimentAnalyzer();
$sa->trainModel();