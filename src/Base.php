<?php namespace Doge;

abstract class Base {
    
    protected $grammar;
    
    public function __construct ($grammar) {
        $this->grammar = $grammar;
    }
    
    protected function isKeyword ($token) {
        return in_array($token, $this->grammar['keywords']);
    }
    
}