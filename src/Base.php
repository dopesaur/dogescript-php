<?php namespace Doge;

/**
 * Base trait for grammar classes
 * 
 * @package dogescript-php
 */
trait Base {
    
    /**
     * @var array
     */
    protected $grammar;
    
    /**
     * @param array $grammar
     */
    public function __construct ($grammar) {
        $this->grammar = $grammar;
    }
    
    /**
     * Check if given token is a keyword
     * 
     * @param string $token
     * @return bool
     */
    protected function isKeyword ($token) {
        $token = trim($token, '(){}[]');
        
        return in_array($token, $this->grammar['keywords']);
    }
    
    /**
     * Check if given token is unfinished string token
     * 
     * @param string $token
     * @return bool
     */
    protected function isUnfinishedToken ($token) {
        return preg_match('/("|\')/', $token)
            && !preg_match('/^(\'|").*\1$/', $token);
    }
    
    /**
     * Check if given token is unfinished PHP expression
     * 
     * @param string $token
     * @return bool
     */
    protected function isFinishedToken ($token) {
        return !preg_match('/("|\'|\{|\[)/', $token)
            || preg_match('/^(\'|").*\1$/', $token)
            || preg_match('/^\{.*\}$/', $token)
            || preg_match('/^\[.*\]$/', $token);
    }
    
    /**
     * Check if given token has end of statement token (i.e. new line)
     * 
     * @param string $token
     * @return bool
     */
    protected function isEndOfStatement ($token) {
        return strpos($token, "\n") === strlen($token) - 1;
    }
    
}