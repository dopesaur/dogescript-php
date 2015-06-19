<?php namespace Doge;

class Parser extends Base {
    
    public function parse ($code) {
        $output = [];
        $code = trim($code);
        
        foreach (explode("\n", $code) as $line) {
            if (empty($line)) {
                continue;
            }
            
            $output[] = $this->parseLine($line);
        }
        
        return $output;
    }
    
    public function parseLine ($line) {
        return explode(' ', trim($line));
    }
        
}