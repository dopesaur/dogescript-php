<?php namespace Doge;

class Parser extends Base {
    
    private $comment = false;
    
    public function parse ($code) {
        $space = ' ';
        
        $code = trim($code);
        $code = str_replace("\n", " \n ", $code);
        
        $tokens = explode($space, $code);
        $tokens = array_filter($tokens, function ($token) {
            return $token !== '';
        });
        
        return array_values($tokens);
    }
    
}