<?php namespace Doge;

abstract class Base {
    
    protected $grammar;
    
    public function __construct ($grammar) {
        $this->grammar = $grammar;
    }
    
    protected function isKeyword ($token) {
        return in_array($token, $this->grammar['keywords']);
    }
    
    protected function isUnfinishedToken ($token) {
        return preg_match('/("|\')/', $token)
            && !preg_match('/^(\'|").*\1$/x', $token);
    }
    
    protected function isEndOfStatement ($token) {
        return strpos($token, "\n") === strlen($token) - 1;
    }
    
}