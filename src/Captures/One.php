<?php namespace Doge\Captures;

use Doge\Capture;

class One implements Capture {
    
    public function capture ($tokens, $next) {
        return [array_shift($tokens)];
    }
    
}