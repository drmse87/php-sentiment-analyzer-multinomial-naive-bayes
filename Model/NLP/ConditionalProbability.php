<?php 

namespace Model\NLP;

class ConditionalProbability {
    private $word;
    private $value;

    public function __construct(string $wordToUse, float $valueToUse) {
        $this->word = $wordToUse;
        $this->value = $valueToUse;
    }

    public function getWord() : string {
        return $this->word;
    }

    public function getValue() {
        return $this->value;
    }
}