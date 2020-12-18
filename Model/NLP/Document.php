<?php

namespace Model\NLP;

class Document {
    private $content;
    private $preprocessing;

    public function __construct (string $documentContentTouse) {
        $this->content = $documentContentTouse;
        $this->preprocessing = new Preprocessing();                
    }

    public function getContent() : string {
        return $this->content;
    }

    public function getWords() : array {
        $cleanedDocument = $this->preprocessing->cleanAndLowerCaseString($this->content);
        $cleanedDocumentTokenized = $this->preprocessing->stringToArray($cleanedDocument);
        
        return $cleanedDocumentTokenized;
    }
}