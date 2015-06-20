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
        $tokens = $this->matcher->matchTokens($line);
        
        if (isset($tokens[1][1]) && is_array($tokens[1][1])) {
            $moar_tokens = $this->matcher->matchTokens($tokens[1][1]);
            
            if ($moar_tokens) {
                $tokens[1][1] = $moar_tokens;
            }
        }
        
        return $tokens;
    }
    
}