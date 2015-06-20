<?php namespace Doge;

class Lexer extends Base {
    
    private $matcher;
    
    public function __construct ($grammar) {
        parent::__construct($grammar);
            
        $this->matcher = new Matcher($grammar);
    }
    
    public function analyze ($tokens) {
        $result = [];
        
        foreach ($tokens as $line) {
            $result[] = $this->analyzeLine($line);
        }
        
        return $result;
    }
    
    public function analyzeLine ($line) {
        return $this->matcher->matchTokens($line);
    }
    
}