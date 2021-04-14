# PHP Sentiment Analyzer
Simple Sentiment Analyzer in PHP using [Multinomial Naive Bayes algorithm](https://nlp.stanford.edu/IR-book/html/htmledition/naive-bayes-text-classification-1.html) and the [Large Movie Review Dataset](https://ai.stanford.edu/~amaas/data/sentiment/).

# Limitations
The model has only been trained with 250 reviews (125 negative and 125 positive reviews). The real training set actually consists of 25 000 reviews (12 500 for each class). In theory, this means results could be x100 better. It simply took too long to train the model (PHP might not be the most suited language for machine learning), but there is also no vectorization done, nor lemmatization or stop words removal.
