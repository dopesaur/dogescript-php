<?php namespace Doge\Captures;

use Doge\Capture;

class All implements Capture {
    
    public function capture ($tokens, $next) {
        return $tokens;
    }
    
}