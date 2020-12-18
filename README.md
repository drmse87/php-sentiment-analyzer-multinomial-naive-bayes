# Sentiment Analyzer
Algorithm: Multinomial Naive Bayes (https://nlp.stanford.edu/IR-book/html/htmledition/naive-bayes-text-classification-1.html)
Training data: Large Movie Review Dataset (https://ai.stanford.edu/~amaas/data/sentiment/)

Please note that result may not be very accurate because of limited training data (only 125 negative and 125 positive reviews). Real training set actually consists of 12 500 reviews for each class (25 000 in total). In theory, this means results could be x100 better. A smaller set was chosen for this application because of long training times (PHP might not be the most suited language for machine learning). Things could probably also have been sped up by more efficient preprocessing and converting documents to feature vectors, again not implemented because of time constraints. Furthermore, sentiment analysis could have been improved with additional normalization measures such as lemmatization. There is also no "neutral" class - only positive or negative, that is why some zero scored texts are classified as negative (because it is the first class checked).

drmse87, October 2020.