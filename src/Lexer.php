<?php namespace Doge;

class Lexer extends Base {
    
    public function analyze ($tokens) {
        $result = [];
        
        foreach ($tokens as $line) {
            $result[] = $this->analyzeLine($line);
        }
        
        return $result;
    }
    
    public function analyzeLine ($line) {
        $result = [];
        $copy   = $line;
        
        while (!empty($line)) {
            $token = array_shift($line);
            
            if (!$this->isKeyword($token)) {
                $result[] = $token;
            }
            else {
                $arguments = $this->extractArguments($line, $copy);
                $result[]  = [$token, $arguments];
                
                $line = array_slice($line, count($arguments));
            }
        }
        
        return $result;
    }
    
    private function extractArguments ($line, $original) {
        $result = [];
        
        foreach ($line as $token) {
            if ($this->isKeyword($token) && !in_array('shh', $original)) {
                break;
            }
            
            $result[] = $token;
        }
        
        return $result;
    }
    
}