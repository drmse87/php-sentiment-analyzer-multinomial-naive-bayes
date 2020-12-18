<?php 

namespace Model\NLP;

class Score {
    private $value;

    public function setValue(float $newValue) {
        $this->value = $newValue;
    }

    public function getValue() : float {
        return $this->value;
    }
}