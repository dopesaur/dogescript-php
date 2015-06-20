<?php namespace Doge;

class Parser extends Base {
    
    public function parse ($code) {
        $buffer = new TokenBuffer($this->grammar);
        $line   = new TokenBuffer($this->grammar);
        
        $output = [];
        
        $code = trim($code);
        $code = "$code\n";
        $code = str_replace("\n", "\n ", $code);
        
        foreach (explode(' ', $code) as $token) {
            if (empty($token)) {
                continue;
            }
            
            $buffer->append(trim($token));
            
            if ($buffer->isUnfinished()) {
                continue;
            }
            
            $line->append($buffer->toString(true));
            
            if ($this->isEndOfStatement($token)) {
                $output[] = $line->tokens(true);
            }
        }
        
        // var_dump($output);
                
        return $output;
    }
    
}