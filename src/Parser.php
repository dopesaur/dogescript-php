<?php namespace Doge;

/**
 * dogescript source code parser.
 * 
 * All what it's do is breaking everything into tokens.
 * 
 * @package dogescript-php
 */
class Parser {
    
    /**
     * Parses given code into flat list (indexed array) of tokens
     * 
     * @param string $code
     * @return array
     */
    public function parse ($code) {
        $space = ' ';
        
        $code = trim($code);
        $code = str_replace("\n", " \n ", $code);
        
        $tokens = explode($space, $code);
        $tokens = array_filter($tokens, function ($token) {
            return $token !== '' 
                && $token !== 'the';
        });
        
        return array_values($tokens);
    }
    
}