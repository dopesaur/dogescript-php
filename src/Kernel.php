<?php namespace Doge;

use Doge\Compilers\PHP;

class Kernel {
    
    static function doge ($file) {
        if (!file_exists($file)) {
            throw new Exception("File '$file' not exists!");
        }
        
        $grammar = require dirname(__DIR__) . '/keywords.php';
        
        $parser   = new Parser($grammar);
        $lexer    = new Lexer($grammar);
        $compiler = new PHP($grammar);
        
        $code = file_get_contents($file);
        $tokens = $parser->parse($code);
        $tokens = $lexer->analyze($tokens);
        
        return $compiler->compile($tokens);
    }
    
}