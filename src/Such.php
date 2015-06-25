<?php namespace Doge;

use Doge\Compilers\PHP;

/**
 * Entry point of dogescript compiler
 * 
 * You give it file path with dogescript code and it's converting it to PHP.
 * 
 * @package dogescript-php
 */
class Such {
    
    /**
     * @param string $file
     * @return string
     */
    static function script ($file) {
        if (!file_exists($file)) {
            throw new Exception("File '$file' not exists!");
        }
        
        $grammar = require dirname(__DIR__) . '/keywords.php';
        
        $parser   = new Parser;
        $lexer    = new Lexer($grammar);
        $compiler = new PHP($grammar);
        
        $code = file_get_contents($file);
        $tokens = $parser->parse($code);
        $tokens = $lexer->analyze($tokens);
        
        return $compiler->compile($tokens);
    }
    
}