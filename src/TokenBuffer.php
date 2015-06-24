<?php namespace Doge;

class TokenBuffer extends Base {
    
    private $tokens = [];
    
    public function append ($token) {
        $this->tokens[] = $token;
    }
    
    public function tokens ($clear = false) {
        $tokens = $this->tokens;
        
        if ($clear) {
            $this->clear();
        }
        
        return $tokens;
    }
    
    public function setTokens ($tokens) {
        $this->tokens = $tokens;
    }
    
    public function clear () {
        $this->tokens = [];
    }
    
    public function isEmpty () {
        return empty($this->tokens);
    }
    
    public function isUnfinished () {
        return $this->isUnfinishedToken($this->toString());
    }
    
    public function isFinished () {
        return $this->isFinishedToken($this->toString());
    }
    
    public function toString ($clear = false) {
        $tokens = $this->tokens;
        
        if ($clear) {
            $this->clear();
        }
        
        return implode(' ', $tokens);
    }
    
}