<?php namespace Doge\Captures;

use Doge\Capture;

class TillToken implements Capture {
    
    public function capture ($tokens, $next) {
        $next_fragment = $next;
        $next_token    = current($tokens);
        
        while ($next_fragment !== $next_token && !empty($tokens)) {
            $token      = array_shift($tokens);
            $next_token = current($tokens);
            
            $line[] = $token;
        }
        
        return $line;
    }
    
}