<?php

namespace View;

class SentimentResult {
  public function echoHTML(string $result) {  
    echo '
      <!DOCTYPE html>
      <html>
      <head>
        <meta charset="utf-8">
        <title>Multinomial Naive Bayes in PHP by drmse87</title>
        <link rel="stylesheet" href="css/styles.css">
      </head>
      <body>
        <h2>Result of sentiment analysis</h2>
        <h3>' . $result . '*</h3>
       
        <a href=".">Analyze another text</a>

        </body>
        </html>
        ';
  }
}