<?php

namespace View;

class Sentiment {
  private static $text = 'SentimentView::TextToAnalyze';
  private static $analyze = 'SentimentView::AnalyzeSentiment';
  private static $noTextToAnalyzeMessage = 'Please enter a text to analyze.';

  public static function isThereATextToAnalyze() : bool {
    return !empty($_POST[self::$text]);
  }

  public static function getNoTextToAnalyzeMessage() : string {
    return self::$noTextToAnalyzeMessage;
  }

  public static function getTextToAnalyze() : string {
    return $_POST[self::$text];
  }

  public function echoHTML($message = '') {
    echo '
      <!DOCTYPE html>
      <html>
      <head>
        <meta charset="utf-8">
        <title>Multinomial Naive Bayes in PHP by drmse87</title>
        <link rel="stylesheet" href="css/styles.css">
      </head>
      <body>
      <h2>Sentiment Analyzer</h2>
      <form method="post" enctype="multipart/form-data">
          <fieldset>
          <legend>Enter text to analyze sentiment of</legend>
              <p>
                ' . $message . '
              </p>
              <p>
                <textarea name="' . self::$text . '"></textarea>
              </p>
              <input type="submit" name="' . self::$analyze . '" value="Analyze sentiment" />
              <br/>
          </fieldset>
      </form>
      </body>
      </html>
      ';
  }
}